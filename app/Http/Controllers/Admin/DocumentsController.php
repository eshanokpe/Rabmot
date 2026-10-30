<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessHistory;
use Illuminate\Http\Request;

/**
 * Admin > Documents: every customer order (process history) in one table,
 * newest first, with tabs by status.
 */
class DocumentsController extends Controller
{
    // process_histories.status => tab key, label, badge, and the detail page
    // where the admin moves the order on to its next status
    public const STATUSES = [
        '0' => ['key' => 'pending', 'label' => 'Pending', 'badge' => 'bg-secondary', 'view_route' => 'admin.viewpendingpaper'],
        '1' => ['key' => 'processing', 'label' => 'Processing', 'badge' => 'bg-warning', 'view_route' => 'admin.viewprocesspaper'],
        '2' => ['key' => 'ready', 'label' => 'Ready for Delivery', 'badge' => 'bg-info', 'view_route' => 'admin.viewdeliveryinprogress'],
        '3' => ['key' => 'in_progress', 'label' => 'Delivery in Progress', 'badge' => 'bg-primary', 'view_route' => 'admin.viewdeliveryinprogress'],
        '4' => ['key' => 'delivered', 'label' => 'Delivered', 'badge' => 'bg-success', 'view_route' => 'admin.viewdeliveredPaper'],
    ];

    public function index(Request $request)
    {
        $tabs = collect(self::STATUSES)->mapWithKeys(fn ($status, $value) => [$status['key'] => $value]);

        $filters = $request->validate([
            'status' => 'nullable|in:' . $tabs->keys()->implode(','),
            'search' => 'nullable|string|max:100',
        ]);
        $statusKey = $filters['status'] ?? null;
        $search = trim($filters['search'] ?? '');

        $statusCounts = ProcessHistory::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        $counts = ['all' => $statusCounts->sum()];
        foreach (self::STATUSES as $value => $status) {
            $counts[$status['key']] = (int) ($statusCounts[$value] ?? 0);
        }

        $documents = ProcessHistory::query()
            ->when($statusKey, fn ($q) => $q->where('status', $tabs[$statusKey]))
            ->when($search !== '', function ($q) use ($search) {
                $like = '%' . $search . '%';
                $q->where(fn ($q) => $q->where('process_id', 'like', $like)
                    ->orWhere('process_number', 'like', $like)
                    ->orWhere('user_email', 'like', $like));
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $data = [
            'documents' => $documents,
            'counts' => $counts,
            'statusKey' => $statusKey,
            'search' => $search,
            'statuses' => self::STATUSES,
        ];

        // Tabs, search and pagination swap just the table in place
        if ($request->ajax()) {
            return view('admin.pages.documents._table', $data);
        }

        return view('admin.pages.documents.index', $data);
    }
}
