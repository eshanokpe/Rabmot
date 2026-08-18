@extends('admin.layouts.app')

@section('title', 'Broadcast Detail')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ $broadcast->title }}</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.broadcasts.history') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back to History
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Sent By</strong><div>{{ $broadcast->admin->name ?? 'N/A' }}</div></div>
                        <div class="col-md-3"><strong>Audience</strong><div>{{ ucwords(str_replace('_', ' ', $broadcast->target_audience)) }}</div></div>
                        <div class="col-md-3"><strong>Channels</strong><div>
                            @foreach($broadcast->channels as $channel)
                                <span class="badge bg-secondary me-1">{{ ucfirst($channel) }}</span>
                            @endforeach
                        </div></div>
                        <div class="col-md-3"><strong>Status</strong><div>
                            @switch($broadcast->delivery_status)
                                @case('scheduled') <span class="badge bg-info">Scheduled</span> @break
                                @case('sent') <span class="badge bg-success">Sent</span> @break
                                @case('partial') <span class="badge bg-warning">Partial</span> @break
                                @case('failed') <span class="badge bg-danger">Failed</span> @break
                                @default <span class="badge bg-light">Draft</span>
                            @endswitch
                        </div></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Scheduled At</strong><div>{{ $broadcast->scheduled_at?->format('d M Y, H:i') ?? '—' }}</div></div>
                        <div class="col-md-3"><strong>Sent At</strong><div>{{ $broadcast->sent_at?->format('d M Y, H:i') ?? '—' }}</div></div>
                        <div class="col-md-6"><strong>Delivery Summary</strong><div>
                            @if($broadcast->delivery_report)
                                {{ $broadcast->delivery_report['success'] }} succeeded / {{ $broadcast->delivery_report['failed'] }} failed / {{ $broadcast->delivery_report['total'] }} total
                            @else
                                —
                            @endif
                        </div></div>
                    </div>
                    <hr>
                    <strong>Message</strong>
                    <div class="mt-2">{!! $broadcast->body !!}</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notification Log</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Recipient</th>
                                <th>Type</th>
                                <th>Channel</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Delivered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->recipient_email ?? '—' }}</td>
                                <td>{{ ucfirst($delivery->recipient_type) }}</td>
                                <td><span class="badge bg-secondary">{{ ucfirst($delivery->channel) }}</span></td>
                                <td>
                                    @switch($delivery->status)
                                        @case('sent') <span class="badge bg-success">Sent</span> @break
                                        @case('failed') <span class="badge bg-danger">Failed</span> @break
                                        @case('skipped') <span class="badge bg-light">Skipped</span> @break
                                        @default <span class="badge bg-light">{{ ucfirst($delivery->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="text-muted small">{{ $delivery->error_message ?? '—' }}</td>
                                <td>{{ $delivery->delivered_at?->format('d M Y, H:i') ?? '—' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    No delivery records yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $deliveries->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
