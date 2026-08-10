@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Reports</div>
                        <h2 class="page-title">Order Reports</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" class="row g-2 align-items-end">
                                    <div class="col-auto">
                                        <label class="form-label">From</label>
                                        <input type="date" name="date_from" class="form-control" value="{{ $from->format('Y-m-d') }}">
                                    </div>
                                    <div class="col-auto">
                                        <label class="form-label">To</label>
                                        <input type="date" name="date_to" class="form-control" value="{{ $to->format('Y-m-d') }}">
                                    </div>
                                    <div class="col-auto">
                                        <label class="form-label">Process Type</label>
                                        <select name="process_type" class="form-select">
                                            <option value="">All</option>
                                            @foreach ($processTypes as $type)
                                                <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">All</option>
                                            @foreach (\App\Http\Controllers\Admin\AdminReportsController::ORDER_STATUS_LABELS as $value => $label)
                                                <option value="{{ $value }}" {{ (string) $selectedStatus === (string) $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <a href="{{ route('admin.reports.export', ['report' => 'orders', 'format' => 'csv'] + request()->query()) }}" class="btn btn-outline-secondary">Export CSV</a>
                                        <a href="{{ route('admin.reports.export', ['report' => 'orders', 'format' => 'pdf'] + request()->query()) }}" class="btn btn-outline-secondary">Export PDF</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="subheader">Total Orders</div>
                                <div class="h1 mb-0">{{ number_format($totalOrders) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">By Status</h3></div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter">
                                    <tbody>
                                        @forelse ($byStatus as $status => $count)
                                            <tr>
                                                <td>{{ \App\Http\Controllers\Admin\AdminReportsController::ORDER_STATUS_LABELS[$status] ?? $status }}</td>
                                                <td class="text-end">{{ $count }}</td>
                                            </tr>
                                        @empty
                                            <tr><td class="text-muted">No data.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">By Service Type</h3></div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter">
                                    <tbody>
                                        @forelse ($byType as $row)
                                            <tr>
                                                <td>{{ $row->process_type }}</td>
                                                <td class="text-end">{{ $row->total }}</td>
                                            </tr>
                                        @empty
                                            <tr><td class="text-muted">No data.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders ({{ $orders->count() }} of up to 500 shown)</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Process Number</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>{{ $order->process_number }}</td>
                                                <td>{{ $order->process_type }}</td>
                                                <td>{{ \App\Http\Controllers\Admin\AdminReportsController::ORDER_STATUS_LABELS[$order->status] ?? $order->status }}</td>
                                                <td>{{ $order->created_at->format('F j, Y g:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-muted">No orders in this period.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
