@extends('admin.layouts.app')

@section('title', 'Document Expiry')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Overview</div>
                    <h2 class="page-title">Document Expiry</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @php
                $activeStatus = $filters['status'] ?? null;
                $tiles = [
                    'expired' => ['Expired', 'text-danger'],
                    'week' => ['Within 7 days', 'text-danger'],
                    'soon' => ["Within {$windowDays} days", 'text-warning'],
                    'valid' => ['Valid', 'text-success'],
                    'none' => ['No date', 'text-muted'],
                ];
                $canSendReminder = Auth::guard('admin')->user()->hasPermission('manage-vehicles');
            @endphp

            <div class="row row-cards mb-3">
                @foreach($tiles as $status => [$label, $colour])
                    <div class="col-6 col-sm-4 col-lg">
                        <a href="{{ route('admin.documentExpiry.index', $activeStatus === $status ? [] : ['status' => $status]) }}"
                            class="card card-sm card-link text-reset {{ $activeStatus === $status ? 'border-primary' : '' }}">
                            <div class="card-body">
                                <div class="font-weight-medium fs-3 {{ $colour }}">{{ $counts[$status] }}</div>
                                <div class="text-muted">{{ $label }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="card">
                <div class="card-body border-bottom">
                    <form method="GET" action="{{ route('admin.documentExpiry.index') }}" class="row g-2 align-items-end">
                        <div class="col-12 col-md-3">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Plate, owner or phone"
                                value="{{ $filters['search'] ?? '' }}" />
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All</option>
                                @foreach($tiles as $status => [$label])
                                    <option value="{{ $status }}" @selected($activeStatus === $status)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label">Document</label>
                            <select name="document" class="form-select">
                                <option value="">All</option>
                                @foreach($documentLabels as $field => $label)
                                    <option value="{{ $field }}" @selected(($filters['document'] ?? null) === $field)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label">Source</label>
                            <select name="source" class="form-select">
                                <option value="">All</option>
                                @foreach($sources as $source => $label)
                                    <option value="{{ $source }}" @selected(($filters['source'] ?? null) === $source)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-md-1">
                            <label class="form-label">Expiry from</label>
                            <input type="date" name="from" class="form-control" value="{{ $filters['from'] ?? '' }}" />
                        </div>
                        <div class="col-6 col-md-1">
                            <label class="form-label">to</label>
                            <input type="date" name="to" class="form-control" value="{{ $filters['to'] ?? '' }}" />
                        </div>
                        <div class="col-6 col-md-1 d-flex gap-1">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.documentExpiry.index') }}" class="btn btn-link px-1">Clear</a>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Owner</th>
                                <th>Vehicle</th>
                                <th>Document</th>
                                <th>Expiry</th>
                                <th>Reminder</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documents as $document)
                                <tr>
                                    <td>
                                        {{ $document['owner_name'] ?? '—' }}
                                        <div class="small text-muted">{{ $document['raw_phone'] ?: 'No phone' }}</div>
                                        <div class="small text-muted">{{ $document['email'] ?: 'No email' }}</div>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $document['plate'] ?: '—' }}</span>
                                        <div class="small text-muted">{{ $document['vehicle'] ?: '' }} · {{ $document['source_label'] }}</div>
                                    </td>
                                    <td>{{ $document['label'] }}</td>
                                    <td class="text-nowrap">
                                        {{ $document['expiry_date']?->format('d M Y') ?? '—' }}
                                        @include('admin.partials.documentExpiryBadge', ['document' => $document])
                                    </td>
                                    <td style="min-width: 240px">
                                        @if(in_array($document['status'], ['expired', 'week', 'month'], true))
                                            @include('admin.partials.reminderChannels', ['document' => $document, 'canSend' => $canSendReminder, 'small' => true])
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ $document['view_url'] }}" class="btn btn-sm btn-outline-primary">View record</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No documents match these filters.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($documents->hasPages())
                    <div class="card-footer">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
