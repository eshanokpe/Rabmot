<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessHistory;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    // Main Order List with filters
    public function index(Request $request)
    {
        $query = ProcessHistory::with(['user', 'adminAssigned'])
            ->latest();

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('process_type')) {
            $query->where('process_type', $request->process_type);
        }
        if ($request->filled('user_type')) {
            $query->where('userType', $request->user_type);
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->date_from)->startOfDay(),
                Carbon::parse($request->date_to)->endOfDay()
            ]);
        }
        if ($request->filled('assigned_admin_id')) {
            $query->where('assigned_admin_id', $request->assigned_admin_id);
        }

        $orders = $query->paginate(20);
        $admins = Admin::where('status', 'active')->get();
        $serviceTypes = ProcessHistory::distinct()->pluck('process_type');

        return view('admin.pages.orders.index', compact('orders', 'admins', 'serviceTypes'));
    }

    // Filter by single status
    public function byStatus($status)
    {
        $orders = ProcessHistory::with(['user', 'adminAssigned'])
            ->where('status', $status)
            ->latest()
            ->paginate(20);

        // ✅ Added missing variables here
        $admins = Admin::where('status', 'active')->get();
        $serviceTypes = ProcessHistory::distinct()->pluck('process_type');

        return view('admin.pages.orders.index', compact('orders', 'status', 'admins', 'serviceTypes'));
    }

    // Orders assigned to current admin
    public function assigned(Request $request)
    {
        $adminId = auth()->guard('admin')->id();
        $orders = ProcessHistory::with(['user'])
            ->where('assigned_admin_id', $adminId)
            ->latest()
            ->paginate(20);

        // ✅ Added missing variables here
        $admins = Admin::where('status', 'active')->get();
        $serviceTypes = ProcessHistory::distinct()->pluck('process_type');

        return view('admin.pages.orders.index', compact('orders', 'admins', 'serviceTypes'));
    }

    // Single order detail
    public function show($id)
    {
        $order = ProcessHistory::with(['user', 'adminAssigned'])->findOrFail($id);
        return view('admin.pages.orders.show', compact('order'));
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:submitted,agent_assigned,processing,ready,delivered'
        ]);

        $order = ProcessHistory::findOrFail($id);
        $oldStatus = $order->status;

        // Save status and log history
        $order->update([
            'status' => $request->status,
            'status_history' => collect($order->status_history ?? [])->push([
                'from' => $oldStatus,
                'to' => $request->status,
                'by_admin_id' => auth()->guard('admin')->id(),
                'by_admin_name' => auth()->guard('admin')->user()->name,
                'note' => $request->note ?? '',
                'created_at' => now()
            ])
        ]);

        // Optional: Send WhatsApp notification here
        // WhatsApp::send($order->user->phone, "Your order #{$order->process_id} is now: {$request->status}");

        return back()->with('success', 'Status updated successfully');
    }

    // Set ETA
    public function setEta(Request $request, $id)
    {
        $request->validate(['estimated_completion_date' => 'required|date']);
        ProcessHistory::findOrFail($id)->update([
            'estimated_completion_date' => $request->estimated_completion_date
        ]);
        return back()->with('success', 'ETA updated');
    }

    // Add internal notes
    public function addNotes(Request $request, $id)
    {
        $request->validate(['internal_admin_notes' => 'required|string']);
        ProcessHistory::findOrFail($id)->update([
            'internal_admin_notes' => $request->internal_admin_notes
        ]);
        return back()->with('success', 'Notes saved');
    }

    // Assign order to admin
    public function assignAdmin(Request $request, $id)
    {
        $request->validate(['assigned_admin_id' => 'required|exists:admins,id']);
        ProcessHistory::findOrFail($id)->update([
            'assigned_admin_id' => $request->assigned_admin_id
        ]);
        return back()->with('success', 'Order assigned');
    }
}