@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Reports</div>
                        <h2 class="page-title">Referral Reports</h2>
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
                                        <a href="{{ route('admin.reports.export', ['report' => 'referrals', 'format' => 'csv'] + request()->query()) }}" class="btn btn-outline-secondary">Export CSV</a>
                                        <a href="{{ route('admin.reports.export', ['report' => 'referrals', 'format' => 'pdf'] + request()->query()) }}" class="btn btn-outline-secondary">Export PDF</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="subheader">Total Referrals</div>
                                <div class="h1 mb-0">{{ number_format($totalReferrals) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="subheader">Total Referral Commission</div>
                                <div class="h1 mb-0">₦{{ number_format($totalReferralCommission, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Top Referrers</h3></div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Agent</th>
                                            <th>Email</th>
                                            <th>Referrals</th>
                                            <th>Referral Commission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($referrers as $row)
                                            <tr>
                                                <td>{{ $row->agent->fullname }}</td>
                                                <td>{{ $row->agent->email }}</td>
                                                <td>{{ $row->referrals }}</td>
                                                <td>₦{{ number_format($row->referralCommission, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-muted">No referral activity in this period.</td></tr>
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
