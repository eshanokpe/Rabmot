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
                            Withdrawal Request
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.withdrawalQueue.index') }}" class="btn btn-outline-secondary">
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
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
                                    Request Details
                                    @if ($item->status == 'pending')
                                        <span class="badge text-bg-warning">Pending</span>
                                    @elseif ($item->status == 'approved')
                                        <span class="badge text-bg-info">Approved</span>
                                    @elseif ($item->status == 'rejected')
                                        <span class="badge text-bg-danger">Rejected</span>
                                    @elseif ($item->status == 'paid')
                                        <span class="badge text-bg-success">Paid</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless mb-0">
                                    <tr><th width="30%">Agent</th><td>{{ $agent->fullname ?? 'Unknown' }} ({{ $agent->username ?? '-' }})</td></tr>
                                    <tr><th>Email</th><td>{{ $item->user_email }}</td></tr>
                                    <tr><th>Amount</th><td>₦{{ number_format($item->amount, 2, '.', ',') }}</td></tr>
                                    <tr><th>Bank</th><td>{{ $item->bank }}</td></tr>
                                    <tr><th>Account Number</th><td>{{ $item->account_number }}</td></tr>
                                    <tr><th>Account Name</th><td>{{ $item->account_name }}</td></tr>
                                    <tr><th>Submitted</th><td>{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y g:i A') }}</td></tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if ($item->status === 'pending')
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Approve Request</h3>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('admin.withdrawalQueue.approve', ['id' => encrypt($item->id)]) }}" onsubmit="return confirm('Are you sure you want to approve this withdrawal request?');">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" name="confirm_approval" id="confirm_approval" required>
                                                    <label class="form-check-label" for="confirm_approval">
                                                        I have reviewed this withdrawal request and confirm it should be approved.
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-success w-100">Approve</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Reject Request</h3>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('admin.withdrawalQueue.reject', ['id' => encrypt($item->id)]) }}" onsubmit="return confirm('Are you sure you want to reject this withdrawal request?');">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label required">Rejection Reason</label>
                                                    <textarea name="rejection_reason" class="form-control" rows="3">{{ old('rejection_reason') }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-danger w-100">Reject</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($item->status === 'approved')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Mark as Paid</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.withdrawalQueue.markPaid', ['id' => encrypt($item->id)]) }}" enctype="multipart/form-data" onsubmit="return confirm('Confirm this payout has been completed and mark it as paid?');">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="form-label required">Transaction Reference</label>
                                                <input type="text" name="transaction_reference" class="form-control" value="{{ old('transaction_reference') }}" required>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label required">Payment Proof</label>
                                                <input type="file" name="payment_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                                                <small class="form-hint">JPG, PNG or PDF. Max 9MB.</small>
                                            </div>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="confirm_paid" id="confirm_paid" required>
                                            <label class="form-check-label" for="confirm_paid">
                                                I confirm I have completed this bank transfer and the details above are correct.
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-success">Mark as Paid</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @elseif ($item->status === 'rejected')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Rejection Details</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="30%">Reason</th><td>{{ $item->rejection_reason }}</td></tr>
                                        <tr><th>Reviewed By</th><td>{{ optional(\App\Models\Admin::find($item->reviewed_by))->name ?? 'N/A' }}</td></tr>
                                        <tr><th>Reviewed At</th><td>{{ $item->reviewed_at ? \Carbon\Carbon::parse($item->reviewed_at)->format('F j, Y g:i A') : 'N/A' }}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @elseif ($item->status === 'paid')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payment Details</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="30%">Transaction Reference</th><td>{{ $item->transaction_reference }}</td></tr>
                                        <tr>
                                            <th>Payment Proof</th>
                                            <td>
                                                <a href="{{ route('admin.withdrawalQueue.downloadProof', ['id' => encrypt($item->id)]) }}" class="btn btn-sm btn-primary">Download</a>
                                            </td>
                                        </tr>
                                        <tr><th>Paid By</th><td>{{ optional(\App\Models\Admin::find($item->paid_by))->name ?? 'N/A' }}</td></tr>
                                        <tr><th>Paid At</th><td>{{ $item->paid_at ? \Carbon\Carbon::parse($item->paid_at)->format('F j, Y g:i A') : 'N/A' }}</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
