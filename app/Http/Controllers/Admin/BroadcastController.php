<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\BroadcastDelivery;
use App\Models\User;
use App\Models\Agent;
use App\Services\BroadcastDispatchService;
use App\Support\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon; 

class BroadcastController extends Controller
{ 
    // Show compose form
    public function compose()
    {
        // Load ONLY regular Users
        $users = User::select('id', 'fullname', 'email', 'phone', 'role')->get();

        // Load ONLY Agents (from your separate Agent model)
        $agents = Agent::select('id', 'fullname', 'email', 'userType', 'phone_no')->get();

        $whatsappManual = !(new BroadcastDispatchService())->isWhatsappApiConfigured();

        return view('admin.pages.broadcasts.compose', compact('users', 'agents', 'whatsappManual'));
    }

    // Save & schedule/send broadcast
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'target_audience' => 'required|in:all_users,all_agents,all_consumers,specific_user,specific_agent',
            'channels' => 'required|array|min:1',
            'channels.*' => ['required', Rule::in(['in_app', 'email', 'sms', 'whatsapp'])],
            'scheduled_at' => 'nullable|date',
        ]);

        // The form's datetime-local value is in the admin's timezone; store it in UTC.
        $scheduledAt = !empty($validated['scheduled_at'])
            ? Carbon::parse($validated['scheduled_at'], config('app.display_timezone'))->utc()
            : null;

        if ($scheduledAt && $scheduledAt->isPast()) {
            return back()->withInput()->withErrors(['scheduled_at' => 'The schedule time must be in the future.']);
        }

        // Validate target_ids only when needed
        if (in_array($validated['target_audience'], ['specific_user', 'specific_agent'])) {
            $request->validate([
                'target_ids' => 'required|array|min:1',
            ]);
        }

        $targetIds = $request->target_ids ?? [];
        $service = new BroadcastDispatchService();
        $recipientCount = $service->countRecipients($validated['target_audience'], $targetIds);
        $deferLargeAudience = !$scheduledAt && $service->shouldDefer($recipientCount);

        // Create broadcast record
        $broadcast = Broadcast::create([
            'admin_id' => auth()->guard('admin')->id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
            'target_audience' => $validated['target_audience'],
            'target_ids' => $targetIds,
            'channels' => $validated['channels'],
            'scheduled_at' => $scheduledAt ?? ($deferLargeAudience ? now() : null),
            'delivery_status' => ($scheduledAt || $deferLargeAudience) ? 'scheduled' : 'sent',
        ]);

        // Send immediately if not scheduled and the audience is small enough to process inline
        if (!$scheduledAt && !$deferLargeAudience) {
            $service->send($broadcast);

            if ($broadcast->delivery_status === 'awaiting_whatsapp') {
                return redirect()->route('admin.broadcasts.show', $broadcast)
                    ->with('success', 'Broadcast sent. Now send the WhatsApp messages below.');
            }
        }
 
        $successMessage = match (true) {
            (bool) $scheduledAt => 'Broadcast scheduled successfully!',
            $deferLargeAudience => 'Broadcast queued for sending — the audience is large, so it will go out within a minute.',
            default => 'Broadcast sent successfully!',
        };

        return redirect()->route('admin.broadcasts.history')->with('success', $successMessage);
    }

    // Broadcast history list
    public function history()
    {
        $broadcasts = Broadcast::with('admin')->latest()->paginate(20);
        return view('admin.pages.broadcasts.history', compact('broadcasts'));
    }

    // Broadcast detail + per-recipient delivery log
    public function show(Broadcast $broadcast)
    {
        $broadcast->load('admin');
        $deliveries = $broadcast->deliveries()->latest()->paginate(20);

        $whatsappManual = (bool) ($broadcast->delivery_report['whatsapp_manual'] ?? false);
        $whatsappDeliveries = null;
        $nextWhatsappDelivery = null;
        $whatsappTemplate = null;
        $whatsappStats = null;

        if ($whatsappManual) {
            $service = new BroadcastDispatchService();
            $whatsappQuery = $broadcast->deliveries()->where('channel', 'whatsapp');

            $whatsappDeliveries = (clone $whatsappQuery)->orderBy('id')->paginate(25, ['*'], 'wa_page');
            $this->attachRecipientNames($whatsappDeliveries->getCollection());

            $nextWhatsappDelivery = (clone $whatsappQuery)->where('status', 'pending')->orderBy('id')->first();
            if ($nextWhatsappDelivery) {
                $this->attachRecipientNames(collect([$nextWhatsappDelivery]));
            }

            $whatsappStats = [
                'sent' => (clone $whatsappQuery)->where('status', 'sent')->count(),
                'pending' => (clone $whatsappQuery)->where('status', 'pending')->count(),
                'no_phone' => (clone $whatsappQuery)->where('status', 'failed')->count(),
            ];
            $whatsappTemplate = $service->plainTextMessage($broadcast);
        }

        return view('admin.pages.broadcasts.show', compact(
            'broadcast', 'deliveries', 'whatsappManual', 'whatsappDeliveries',
            'nextWhatsappDelivery', 'whatsappTemplate', 'whatsappStats'
        ));
    }

    // Log a manual WhatsApp send, then open the pre-filled wa.me chat
    public function sendManualWhatsapp(Request $request, Broadcast $broadcast, BroadcastDelivery $delivery)
    {
        if ($delivery->broadcast_id !== $broadcast->id || $delivery->channel !== 'whatsapp') {
            abort(404);
        }

        $validated = $request->validate([
            'message' => 'nullable|string|max:4000',
        ]);

        if ($delivery->status !== 'pending') {
            return redirect()->route('admin.broadcasts.show', $broadcast)
                ->with('error', $delivery->status === 'sent'
                    ? 'This WhatsApp message was already sent.'
                    : 'No valid phone number on record.');
        }

        $phone = PhoneNumber::normalize($delivery->recipient_phone);
        if (!$phone) {
            return redirect()->route('admin.broadcasts.show', $broadcast)->with('error', 'No valid phone number on record.');
        }

        $this->attachRecipientNames(collect([$delivery]));

        $service = new BroadcastDispatchService();
        if (!$service->markManualWhatsappSent($delivery, auth()->guard('admin')->user())) {
            return redirect()->route('admin.broadcasts.show', $broadcast)->with('error', 'This WhatsApp message was already sent.');
        }

        $message = $service->manualWhatsappMessage($broadcast, $delivery->recipient_name, $validated['message'] ?? null);

        return redirect()->away(PhoneNumber::whatsappUrl($phone, $message));
    }

    // Look up recipient names for delivery rows (users and agents live in separate tables)
    private function attachRecipientNames($deliveries): void
    {
        $names = [
            'user' => User::whereIn('id', $deliveries->where('recipient_type', 'user')->pluck('recipient_id'))->pluck('fullname', 'id'),
            'agent' => Agent::whereIn('id', $deliveries->where('recipient_type', 'agent')->pluck('recipient_id'))->pluck('fullname', 'id'),
        ];

        foreach ($deliveries as $delivery) {
            $delivery->recipient_name = $names[$delivery->recipient_type][$delivery->recipient_id] ?? null;
        }
    }

    // Live recipient-count preview for the compose form
    public function previewCount(Request $request)
    {
        $request->validate([
            'target_audience' => 'required|in:all_users,all_agents,all_consumers,specific_user,specific_agent',
            'target_ids' => 'array',
        ]);

        $service = new BroadcastDispatchService();
        $count = $service->countRecipients($request->target_audience, $request->target_ids);
        $validPhones = $service->countValidPhones($request->target_audience, $request->target_ids);

        return response()->json(['count' => $count, 'valid_phones' => $validPhones]);
    }
}
