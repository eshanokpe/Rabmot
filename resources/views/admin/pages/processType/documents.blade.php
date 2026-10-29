@extends('admin.layouts.app')

@section('title', 'Documents')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Process Type Management</div>
                        <h2 class="page-title">Process Type</h2>
                        <div class="text-muted mt-1">View and manage submitted documents across all services.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header pb-0">
                        <ul class="nav nav-tabs card-header-tabs flex-wrap" role="tablist" aria-label="Filter documents by service">
                            <li class="nav-item" role="presentation">
                                <button
                                    type="button"
                                    class="nav-link {{ $selectedService === 'all' ? 'active' : '' }}"
                                    role="tab"
                                    aria-selected="{{ $selectedService === 'all' ? 'true' : 'false' }}"
                                    data-service-filter="all"
                                >
                                    All Services <span class="badge bg-secondary-lt ms-1">{{ $documents->count() }}</span>
                                </button>
                            </li>
                            @foreach ($services as $service)
                                @php
                                    $serviceCount = $documents->where('service', $service['key'])->count();
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <button
                                        type="button"
                                        class="nav-link {{ $selectedService === $service['key'] ? 'active' : '' }}"
                                        role="tab"
                                        aria-selected="{{ $selectedService === $service['key'] ? 'true' : 'false' }}"
                                        data-service-filter="{{ $service['key'] }}"
                                    >
                                        {{ $service['label'] }}
                                        <span class="badge bg-secondary-lt ms-1">{{ $serviceCount }}</span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th class="w-1">S/N</th>
                                    <th>Service</th>
                                    <th>Process ID</th>
                                    <th>Applicant</th>
                                    <th>Email Address</th>
                                    <th>Payment Status</th>
                                    <th class="text-end">Amount</th>
                                    <th>Date Added</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody id="documents-table-body">
                                @php $serial = 1 @endphp
                                @forelse ($documents as $document)
                                    <tr data-service="{{ $document->service }}">
                                        <td><span class="text-muted">{{ $serial++ }}</span></td>
                                        <td>{{ $document->service_label }}</td>
                                        <td>{{ $document->process_id ?: '—' }}</td>
                                        <td>{{ $document->applicant ?: '—' }}</td>
                                        <td>{{ $document->email ?: '—' }}</td>
                                        <td>
                                            @if ($document->payment_status)
                                                <span class="badge bg-success-lt">{{ ucfirst($document->payment_status) }}</span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            {{ $document->amount !== null ? '₦'.number_format((float) $document->amount, 2) : '—' }}
                                        </td>
                                        <td>{{ $document->created_at?->format('M j, Y g:i A') ?? '—' }}</td>
                                        <td class="text-end">
                                            <a href="{{ $document->view_url }}" class="btn btn-sm btn-outline-primary">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="documents-empty-state">
                                        <td colspan="9" class="py-4 text-center text-muted">No documents have been submitted yet.</td>
                                    </tr>
                                @endforelse
                                @if ($documents->isNotEmpty())
                                    <tr id="documents-filter-empty-state" class="d-none">
                                        <td colspan="9" class="py-4 text-center text-muted">No documents found for this service.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('[data-service-filter]');
            const rows = document.querySelectorAll('#documents-table-body tr[data-service]');
            const emptyState = document.getElementById('documents-filter-empty-state');

            function applyServiceFilter(service) {
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const visible = service === 'all' || row.dataset.service === service;
                    row.classList.toggle('d-none', !visible);
                    if (visible) visibleCount++;
                });

                tabs.forEach(function (tab) {
                    const active = tab.dataset.serviceFilter === service;
                    tab.classList.toggle('active', active);
                    tab.setAttribute('aria-selected', active ? 'true' : 'false');
                });

                if (emptyState) {
                    emptyState.classList.toggle('d-none', visibleCount > 0);
                }
            }

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    applyServiceFilter(tab.dataset.serviceFilter);
                });
            });

            applyServiceFilter(@json($selectedService));
        });
    </script>
@endsection
