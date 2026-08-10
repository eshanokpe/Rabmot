<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\User;
use App\Models\Agent;
use App\Services\BroadcastDispatchService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BroadcastController extends Controller
{
    // Show compose form
    public function compose()
    {
        // Load ONLY regular Users
        $users = User::select('id', 'fullname', 'email', 'role')->get();

        // Load ONLY Agents (from your separate Agent model)
        $agents = Agent::select('id', 'fullname', 'email', 'userType', 'phone_no')->get();

        return view('admin.pages.broadcasts.compose', compact('users', 'agents'));
    }

    // Save & schedule/send broadcast
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'target_audience' => 'required|in:all_users,all_agents,all_consumers,specific_user,specific_agent',
            'target_ids' => 'required_if:target_audience,specific_user,specific_agent|array',
            'channels' => 'required|array|min:1|in:in_app,email,whatsapp',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        $service = new BroadcastDispatchService();
        $recipientCount = $service->countRecipients($request->target_audience, $request->target_ids);
        $deferLargeAudience = !$request->scheduled_at && $service->shouldDefer($recipientCount);

        // Create broadcast record
        $broadcast = Broadcast::create([
            'admin_id' => auth()->guard('admin')->id(),
            'title' => $request->title,
            'body' => $request->body,
            'target_audience' => $request->target_audience,
            'target_ids' => $request->target_ids,
            'channels' => $request->channels,
            'scheduled_at' => $request->scheduled_at
                ? Carbon::parse($request->scheduled_at)
                : ($deferLargeAudience ? now() : null),
            'delivery_status' => ($request->scheduled_at || $deferLargeAudience) ? 'scheduled' : 'draft',
        ]);

        // Send immediately if not scheduled and the audience is small enough to process inline
        if (!$request->scheduled_at && !$deferLargeAudience) {
            $service->send($broadcast);
        }

        $successMessage = match (true) {
            (bool) $request->scheduled_at => 'Broadcast scheduled successfully!',
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

        return view('admin.pages.broadcasts.show', compact('broadcast', 'deliveries'));
    }

    // Live recipient-count preview for the compose form
    public function previewCount(Request $request)
    {
        $request->validate([
            'target_audience' => 'required|in:all_users,all_agents,all_consumers,specific_user,specific_agent',
            'target_ids' => 'array',
        ]);

        $count = (new BroadcastDispatchService())->countRecipients($request->target_audience, $request->target_ids);

        return response()->json(['count' => $count]);
    }
}
