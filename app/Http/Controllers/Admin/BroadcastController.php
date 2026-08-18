<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\User;
use App\Models\Agent;
use App\Services\BroadcastDispatchService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'target_audience' => 'required|in:all_users,all_agents,all_consumers,specific_user,specific_agent',
            'channels' => 'required|array|min:1',
            'scheduled_at' => 'nullable|date|after:now',
        ]);

        // Validate target_ids only when needed
        if (in_array($validated['target_audience'], ['specific_user', 'specific_agent'])) {
            $request->validate([
                'target_ids' => 'required|array|min:1',
            ]);
        }

        $targetIds = $request->target_ids ?? [];
        $service = new BroadcastDispatchService();
        $recipientCount = $service->countRecipients($validated['target_audience'], $targetIds);
        $deferLargeAudience = !$validated['scheduled_at'] && $service->shouldDefer($recipientCount);

        // Create broadcast record
        $broadcast = Broadcast::create([
            'admin_id' => auth()->guard('admin')->id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
            'target_audience' => $validated['target_audience'],
            'target_ids' => $targetIds,
            'channels' => $validated['channels'],
            'scheduled_at' => $validated['scheduled_at']
                ? Carbon::parse($validated['scheduled_at'])
                : ($deferLargeAudience ? now() : null),
            'delivery_status' => ($validated['scheduled_at'] || $deferLargeAudience) ? 'scheduled' : 'sent',
        ]);

        // Send immediately if not scheduled and the audience is small enough to process inline
        if (!$validated['scheduled_at'] && !$deferLargeAudience) {
            $service->send($broadcast);
        } 

        $successMessage = match (true) {
            (bool) $validated['scheduled_at'] => 'Broadcast scheduled successfully!',
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
