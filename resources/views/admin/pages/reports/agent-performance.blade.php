@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Reports</div>
                        <h2 class="page-title">Agent Performance</h2>
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
                                        <label class="form-label">Sort By</label>
                                        <select name="sort_by" class="form-select">
                                            <option value="revenue" {{ $sortBy === 'revenue' ? 'selected' : '' }}>Revenue</option>
                                            <option value="orders" {{ $sortBy === 'orders' ? 'selected' : '' }}>Orders</option>
                                            <option value="referrals" {{ $sortBy === 'referrals' ? 'selected' : '' }}>Referrals</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <a href="{{ route('admin.reports.export', ['report' => 'agent-performance', 'format' => 'csv'] + request()->query()) }}" class="btn btn-outline-secondary">Export CSV</a>
                                        <a href="{{ route('admin.reports.export', ['report' => 'agent-performance', 'format' => 'pdf'] + request()->query()) }}" class="btn btn-outline-secondary">Export PDF</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Agent</th>
                                            <th>Email</th>
                                            <th>Orders</th>
                                            <th>Revenue</th>
                                            <th>Referrals</th>
                                            <th>Referral Commission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($agents as $row)
                                            <tr>
                                                <td>{{ $row->agent->fullname }}</td>
                                                <td>{{ $row->agent->email }}</td>
                                                <td>{{ $row->orders }}</td>
                                                <td>₦{{ number_format($row->revenue, 2) }}</td>
                                                <td>{{ $row->referrals }}</td>
                                                <td>₦{{ number_format($row->referralCommission, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="6" class="text-muted">No agent data available.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $agents->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
