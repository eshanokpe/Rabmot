{{-- Documents table; returned on its own for in-place tab/search/page changes.
     Expects: $documents, $statuses, $search --}}
<div class="table-responsive">
    <table class="table table-vcenter card-table">
        <thead>
            <tr>
                <th>Process ID</th>
                <th>Customer</th>
                <th>Process Type</th>
                <th class="text-end">Amount (NGN)</th>
                <th>Status</th>
                <th>Date Added</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($documents as $document)
                @php $status = $statuses[(string) $document->status] ?? null; @endphp
                <tr>
                    <td class="fw-bold text-nowrap">{{ $document->process_id ?: '—' }}</td>
                    <td>
                        {{ $document->user_email ?: '—' }}
                        <div class="small text-muted">{{ $document->userType ? ucfirst(strtolower($document->userType)) : '' }}</div>
                    </td>
                    <td>{{ $document->process_type ?: '—' }}</td>
                    <td class="text-end text-nowrap">{{ is_numeric($document->totalamount) ? number_format((float) $document->totalamount, 2) : ($document->totalamount ?: '—') }}</td>
                    <td>
                        @if($status)
                            <span class="badge {{ $status['badge'] }} text-white">{{ $status['label'] }}</span>
                        @else
                            <span class="badge bg-light">Unknown</span>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        {{ $document->created_at?->timezone(config('app.display_timezone'))->format('d M Y') ?? '—' }}
                        <div class="small text-muted">{{ $document->created_at?->timezone(config('app.display_timezone'))->format('g:i A') }}</div>
                    </td>
                    <td>
                        @if($status)
                            <a href="{{ route($status['view_route'], encrypt($document->id)) }}" class="btn btn-sm btn-outline-primary">Actions</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        {{ $search !== '' ? 'No documents match your search.' : 'No documents here yet.' }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($documents->hasPages())
    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">Showing {{ $documents->firstItem() }}–{{ $documents->lastItem() }} of {{ $documents->total() }}</p>
        <div class="ms-auto">{{ $documents->links('pagination::bootstrap-5') }}</div>
    </div>
@endif
