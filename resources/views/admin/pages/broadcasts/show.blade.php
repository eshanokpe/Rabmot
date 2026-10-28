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
                                @case('awaiting_whatsapp') <span class="badge bg-warning">WhatsApp pending</span> @break
                                @default <span class="badge bg-light">Draft</span>
                            @endswitch
                        </div></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Scheduled At</strong><div>{{ $broadcast->scheduled_at?->timezone(config('app.display_timezone'))->format('d M Y, H:i') ?? '—' }}</div></div>
                        <div class="col-md-3"><strong>Sent At</strong><div>{{ $broadcast->sent_at?->timezone(config('app.display_timezone'))->format('d M Y, H:i') ?? '—' }}</div></div>
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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($whatsappManual)
                @php
                    $canSendWhatsapp = Auth::guard('admin')->user()->hasPermission('manage-messaging');
                    $whatsappTotal = $whatsappStats['sent'] + $whatsappStats['pending'];
                @endphp
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">WhatsApp — Manual Send</h3>
                        <div class="card-actions text-muted">
                            {{ $whatsappStats['sent'] }} of {{ $whatsappTotal }} sent
                            @if($whatsappStats['no_phone'])
                                · {{ $whatsappStats['no_phone'] }} without a valid number
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if($whatsappTotal)
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" style="width: {{ round($whatsappStats['sent'] / $whatsappTotal * 100) }}%"></div>
                            </div>
                        @endif

                        <label class="form-label" for="whatsapp-template">Message</label>
                        <textarea id="whatsapp-template" class="form-control" rows="6">{{ $whatsappTemplate }}</textarea>
                        <div class="form-hint mb-3">
                            Each message starts with "Hi [recipient name]," followed by this text. Edits here apply to every message you open from this page.
                        </div>

                        @if($nextWhatsappDelivery)
                            @if($canSendWhatsapp)
                                <form method="POST" target="_blank" class="whatsapp-send-form d-inline"
                                    action="{{ route('admin.broadcasts.whatsappSend', [$broadcast, $nextWhatsappDelivery]) }}">
                                    @csrf
                                    <input type="hidden" name="message" />
                                    <button type="submit" class="btn btn-success">
                                        Send to next recipient: {{ $nextWhatsappDelivery->recipient_name ?? $nextWhatsappDelivery->recipient_phone }} →
                                    </button>
                                </form>
                            @else
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                    title="You don't have permission to send broadcasts">
                                    <button type="button" class="btn btn-success" disabled style="pointer-events: none">Send to next recipient →</button>
                                </span>
                            @endif
                        @elseif($whatsappTotal)
                            <div class="text-success fw-bold">All WhatsApp messages have been sent.</div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Recipient</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($whatsappDeliveries as $delivery)
                                <tr>
                                    <td>
                                        {{ $delivery->recipient_name ?? '—' }}
                                        <div class="small text-muted">{{ ucfirst($delivery->recipient_type) }}</div>
                                    </td>
                                    <td>{{ $delivery->recipient_phone ?? '—' }}</td>
                                    <td>
                                        @if($delivery->status === 'sent')
                                            <span class="badge bg-success">Sent</span>
                                            <div class="small text-muted">
                                                Sent on {{ $delivery->delivered_at?->timezone(config('app.display_timezone'))->format('d M Y, H:i') }}
                                                by {{ $delivery->sent_by_admin_name ?? 'Unknown admin' }}
                                            </div>
                                        @elseif($delivery->status === 'pending' && $canSendWhatsapp)
                                            <form method="POST" target="_blank" class="whatsapp-send-form"
                                                action="{{ route('admin.broadcasts.whatsappSend', [$broadcast, $delivery]) }}">
                                                @csrf
                                                <input type="hidden" name="message" />
                                                <button type="submit" class="btn btn-sm btn-success">Open WhatsApp</button>
                                            </form>
                                        @else
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                                title="{{ $delivery->status === 'pending' ? "You don't have permission to send broadcasts" : 'No valid phone number on record' }}">
                                                <button type="button" class="btn btn-sm btn-success" disabled style="pointer-events: none">Open WhatsApp</button>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($whatsappDeliveries->hasPages())
                        <div class="card-footer">
                            {{ $whatsappDeliveries->links() }}
                        </div>
                    @endif
                </div>

                <script>
                    // Carry the (possibly edited) message into each send, then refresh so the
                    // log and the "next recipient" button move on once WhatsApp opens.
                    document.querySelectorAll('.whatsapp-send-form').forEach(function (form) {
                        form.addEventListener('submit', function () {
                            form.querySelector('input[name="message"]').value = document.getElementById('whatsapp-template').value;
                            setTimeout(function () { window.location.reload(); }, 1500);
                        });
                    });
                </script>
            @endif

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
                                <td>{{ in_array($delivery->channel, ['sms', 'whatsapp'], true) ? ($delivery->recipient_phone ?? '—') : ($delivery->recipient_email ?? '—') }}</td>
                                <td>{{ ucfirst($delivery->recipient_type) }}</td>
                                <td><span class="badge bg-secondary">{{ ucfirst($delivery->channel) }}</span></td>
                                <td>
                                    @switch($delivery->status)
                                        @case('sent') <span class="badge bg-success">Sent</span> @break
                                        @case('failed') <span class="badge bg-danger">Failed</span> @break
                                        @case('skipped') <span class="badge bg-light">Skipped</span> @break
                                        @case('pending') <span class="badge bg-warning">Pending</span> @break
                                        @default <span class="badge bg-light">{{ ucfirst($delivery->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="text-muted small">{{ $delivery->error_message ?? '—' }}</td>
                                <td>{{ $delivery->delivered_at?->timezone(config('app.display_timezone'))->format('d M Y, H:i') ?? '—' }}</td>
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
