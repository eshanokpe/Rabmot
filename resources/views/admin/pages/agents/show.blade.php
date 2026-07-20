@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col-6">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Agent Profile
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.agents') }}" class="btn btn-outline-secondary">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">

                    <div class="col-12">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var successAlert = document.getElementById('success-alert');
                                if (successAlert) {
                                    setTimeout(function() {
                                        successAlert.style.display = 'none';
                                    }, 10000);
                                }
                            });
                        </script>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Agent Details
                                    @if ($agent->status == 'active')
                                        <span class="badge text-bg-success">Active</span>
                                    @elseif ($agent->status == 'disable')
                                        <span class="badge text-bg-secondary">Disable</span>
                                    @elseif ($agent->status == 'delete')
                                        <span class="badge text-bg-danger">Delete</span>
                                    @else
                                        <span class="badge text-bg-warning">Status Not Set</span>
                                    @endif

                                    @if ($agent->approval_status == 'approved')
                                        <span class="badge text-bg-success">Approved</span>
                                    @elseif ($agent->approval_status == 'rejected')
                                        <span class="badge text-bg-danger">Rejected</span>
                                    @else
                                        <span class="badge text-bg-warning">Pending</span>
                                    @endif
                                </h3>
                                <div class="card-actions d-flex gap-2">
                                    <a href="{{ route('admin.agent.edit', ['id' => encrypt($agent->id)]) }}" class="btn btn-outline-secondary">Edit</a>
                                    @if ($agent->status == 'active')
                                        <form method="POST" action="{{ route('admin.agent.suspend', ['id' => encrypt($agent->id)]) }}" onsubmit="return confirm('Suspend this agent?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-danger">Suspend</button>
                                        </form>
                                    @elseif ($agent->status == 'disable')
                                        <form method="POST" action="{{ route('admin.agent.activate', ['id' => encrypt($agent->id)]) }}" onsubmit="return confirm('Activate this agent?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-success">Activate</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.agent.resetCredentials', ['id' => encrypt($agent->id)]) }}" onsubmit="return confirm('Send a password reset email to {{ $agent->email }}?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-outline-primary">Reset Credentials (Email)</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless mb-0">
                                    <tr><th width="30%">Username</th><td>{{ $agent->username }}</td></tr>
                                    <tr><th>Full Name</th><td>{{ $agent->fullname }}</td></tr>
                                    <tr><th>Email</th><td>{{ $agent->email }}</td></tr>
                                    <tr><th>Phone Number</th><td>{{ $agent->phone_no }}</td></tr>
                                    <tr><th>Location</th><td>{{ $agent->location }}</td></tr>
                                    <tr><th>Gender</th><td>{{ ucfirst($agent->gender) }}</td></tr>
                                    <tr><th>Date Joined</th><td>{{ \Carbon\Carbon::parse($agent->created_at)->format('F j, Y') }}</td></tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                    <li class="nav-item">
                                        <a href="#tab-orders" class="nav-link active" data-bs-toggle="tab">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-withdrawals" class="nav-link" data-bs-toggle="tab">Withdrawals</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab-referral" class="nav-link" data-bs-toggle="tab">Referral Hierarchy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="tab-pane active show" id="tab-orders">
                                        <h4>Orders</h4>
                                        <div class="table-responsive mb-4">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Order Number</th>
                                                        <th>Product</th>
                                                        <th>Qty</th>
                                                        <th>Amount</th>
                                                        <th>Total</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($orders as $order)
                                                        <tr>
                                                            <td>{{ $order->order_number }}</td>
                                                            <td>{{ $order->product_name }}</td>
                                                            <td>{{ $order->product_qty }}</td>
                                                            <td>₦{{ number_format($order->product_amount, 2) }}</td>
                                                            <td>₦{{ number_format($order->total, 2) }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="6" class="text-muted">No orders found</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $orders->links() }}

                                        <h4 class="mt-4">Process History</h4>
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Process Number</th>
                                                        <th>Process Type</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($processHistory as $process)
                                                        <tr>
                                                            <td>{{ $process->process_number }}</td>
                                                            <td>{{ $process->process_type }}</td>
                                                            <td>{{ $process->status }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($process->created_at)->format('F j, Y') }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="4" class="text-muted">No process history found</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab-withdrawals">
                                        <div class="row row-cards mb-4">
                                            <div class="col-md-4">
                                                <div class="card card-sm">
                                                    <div class="card-body">
                                                        <div class="subheader">Total Earned</div>
                                                        <div class="h3 mb-0">₦{{ number_format($totalEarning, 2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card card-sm">
                                                    <div class="card-body">
                                                        <div class="subheader">Total Withdrawn</div>
                                                        <div class="h3 mb-0">₦{{ number_format($totalWithdrawn, 2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card card-sm">
                                                    <div class="card-body">
                                                        <div class="subheader">Available Balance</div>
                                                        <div class="h3 mb-0">₦{{ number_format($walletBalance, 2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                        <th>Bank</th>
                                                        <th>Account Number</th>
                                                        <th>Account Name</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($withdrawals as $withdrawal)
                                                        <tr>
                                                            <td>{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('F j, Y') }}</td>
                                                            <td>₦{{ number_format($withdrawal->amount, 2) }}</td>
                                                            <td>{{ $withdrawal->bank }}</td>
                                                            <td>{{ $withdrawal->account_number }}</td>
                                                            <td>{{ $withdrawal->account_name }}</td>
                                                            <td>
                                                                @if ($withdrawal->status == 0)
                                                                    <span class="badge text-bg-warning">Pending</span>
                                                                @elseif ($withdrawal->status == 1)
                                                                    <span class="badge text-bg-info">Processing</span>
                                                                @elseif ($withdrawal->status == 2)
                                                                    <span class="badge text-bg-success">Paid</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="6" class="text-muted">No withdrawal requests found</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $withdrawals->links() }}
                                    </div>

                                    <div class="tab-pane" id="tab-referral">
                                        <div class="empty">
                                            <p class="empty-title">Referral Hierarchy</p>
                                            <p class="empty-subtitle text-muted">
                                                Coming soon. Referral tracking and commission rules have not been finalized yet.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
