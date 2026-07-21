<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Models\User;
use App\Models\Agent;
use App\Models\Admin;
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

        // Create broadcast record
        $broadcast = Broadcast::create([
            'admin_id' => auth()->guard('admin')->id(),
            'title' => $request->title,
            'body' => $request->body,
            'target_audience' => $request->target_audience,
            'target_ids' => $request->target_ids,
            'channels' => $request->channels,
            'scheduled_at' => $request->scheduled_at ? Carbon::parse($request->scheduled_at) : null,
            'delivery_status' => $request->scheduled_at ? 'scheduled' : 'draft',
        ]);

        // Send immediately if not scheduled
        if (!$request->scheduled_at) {
            $this->processBroadcast($broadcast);
            $broadcast->update([
                'sent_at' => now(),
                'delivery_status' => 'sent'
            ]);
        }

        return redirect()->route('admin.broadcasts.history')
            ->with('success', $request->scheduled_at ? 'Broadcast scheduled successfully!' : 'Broadcast sent successfully!');
    }

    // Broadcast history list
    public function history()
    {
        $broadcasts = Broadcast::with('admin')->latest()->paginate(20);
        return view('admin.pages.broadcasts.history', compact('broadcasts'));
    }

    // Helper: Process sending logic (matches your User model)
    private function processBroadcast(Broadcast $broadcast)
    {
        // Get target recipients using YOUR `role` column
        $recipients = match ($broadcast->target_audience) {
            'all_users' => User::all(),
            'all_agents' => Agent::all(),
            'all_consumers' => User::where('role', 'consumer')->get(),
            'specific_user' => User::whereIn('id', $broadcast->target_ids)->get(),
            'specific_agent' => Agent::whereIn('id', $broadcast->target_ids)->get(),
            default => collect(),
        };

        $report = ['total' => $recipients->count(), 'success' => 0, 'failed' => 0];

        foreach ($recipients as $user) {
            try {
                // Send In-App Message
                if (in_array('in_app', $broadcast->channels)) {
                    // Add to your messages table here
                }

                // Send Email (uses your `email` field)
                if (in_array('email', $broadcast->channels)) {
                    // Mail::to($user->email)->send(new \App\Mail\BroadcastMail($broadcast));
                }

                // Send WhatsApp (uses your `phone` field)
                if (in_array('whatsapp', $broadcast->channels && !empty($user->phone))) {
                    $message = "{$broadcast->title}\n\n{$broadcast->body}";
                    // WhatsApp integration here: use $user->phone
                }

                $report['success']++;
            } catch (\Exception $e) {
                $report['failed']++;
                \Log::error("Broadcast failed for user {$user->id}: {$e->getMessage()}");
            }
        }

        $broadcast->update(['delivery_report' => $report]);
    }
}