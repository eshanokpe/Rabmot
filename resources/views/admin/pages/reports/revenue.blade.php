@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Reports</div>
                        <h2 class="page-title">Revenue Dashboard</h2>
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
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <a href="{{ route('admin.reports.export', ['report' => 'revenue', 'format' => 'csv'] + request()->query()) }}" class="btn btn-outline-secondary">Export CSV</a>
                                        <a href="{{ route('admin.reports.export', ['report' => 'revenue', 'format' => 'pdf'] + request()->query()) }}" class="btn btn-outline-secondary">Export PDF</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="subheader">Total Revenue</div>
                                <div class="h1 mb-0">₦{{ number_format($totalRevenue, 2) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="subheader">Transactions</div>
                                <div class="h1 mb-0">{{ number_format($transactionCount) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="subheader">Average Transaction</div>
                                <div class="h1 mb-0">₦{{ number_format($averageTransaction, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daily Revenue</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="revenueChart" height="90"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Payments ({{ $payments->count() }} of up to 500 shown)</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->orderNo }}</td>
                                                <td>₦{{ number_format($payment->amount, 2) }}</td>
                                                <td><span class="badge text-bg-success">{{ $payment->status }}</span></td>
                                                <td>{{ $payment->created_at->format('F j, Y g:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-muted">No successful payments in this period.</td></tr>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script>
        const ctx = document.getElementById('revenueChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dailySeries->pluck('day')) !!},
                datasets: [{
                    label: 'Revenue (₦)',
                    data: {!! json_encode($dailySeries->pluck('total')) !!},
                    borderColor: '#206bc4',
                    backgroundColor: 'rgba(32, 107, 196, 0.1)',
                    tension: 0.3,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
@endsection
