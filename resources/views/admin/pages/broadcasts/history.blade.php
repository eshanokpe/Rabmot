@extends('admin.layouts.app')

@section('title', 'Broadcast History')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Broadcast History</h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.broadcasts.compose') }}" class="btn btn-primary">
                        <i class="fa fa-plus me-1"></i> New Broadcast
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-fluid">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">S/N</th>
                                <th>Date / Time</th>
                                <th>Title</th>
                                <th>Audience</th>
                                <th>Channels</th>
                                <th>Status</th>
                                <th>Delivery</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($broadcasts as $item)
                            <tr>
                                <td>
                                    <strong>{{ ($broadcasts->currentPage() - 1) * $broadcasts->perPage() + $loop->iteration }}</strong>
                                </td>
                                <td>
                                    <div>{{ $item->created_at->format('d M Y') }}</div>
                                    <div class="text-muted small">{{ $item->created_at->format('H:i') }}</div>
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $item->target_audience)) }}</td>
                                <td>
                                    @foreach($item->channels as $channel)
                                        <span class="badge bg-secondary me-1">{{ ucfirst($channel) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @switch($item->delivery_status)
                                        @case('scheduled') <span class="badge bg-info">Scheduled</span> @break
                                        @case('sent') <span class="badge bg-success">Sent</span> @break
                                        @case('partial') <span class="badge bg-warning">Partial</span> @break
                                        @case('failed') <span class="badge bg-danger">Failed</span> @break
                                        @default <span class="badge bg-light">Draft</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($item->delivery_report)
                                        {{ $item->delivery_report['success'] }} / {{ $item->delivery_report['total'] }}
                                    @elseif($item->delivery_status === 'scheduled')
                                        —
                                    @else
                                        No data
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.broadcasts.show', $item) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No broadcasts have been sent yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $broadcasts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection