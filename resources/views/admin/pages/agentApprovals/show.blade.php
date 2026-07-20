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
                            Agent Application
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.agentApprovals.index') }}" class="btn btn-outline-secondary">
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
                                <h3 class="card-title">Applicant Details</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless mb-0">
                                    <tr><th width="30%">Username</th><td>{{ $item->username }}</td></tr>
                                    <tr><th>Full Name</th><td>{{ $item->fullname }}</td></tr>
                                    <tr><th>Email</th><td>{{ $item->email }}</td></tr>
                                    <tr><th>Phone Number</th><td>{{ $item->phone_no }}</td></tr>
                                    <tr><th>Location</th><td>{{ $item->location }}</td></tr>
                                    <tr><th>Gender</th><td>{{ ucfirst($item->gender) }}</td></tr>
                                    <tr><th>Date Applied</th><td>{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</td></tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($item->approval_status == 'approved')
                                                <span class="badge text-bg-success">Approved</span>
                                            @elseif ($item->approval_status == 'rejected')
                                                <span class="badge text-bg-danger">Rejected</span>
                                            @else
                                                <span class="badge text-bg-warning">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($item->approval_status !== 'pending')
                                        <tr><th>Reviewed By</th><td>{{ $item->approvedBy?->name ?? 'N/A' }}</td></tr>
                                        <tr><th>Reviewed At</th><td>{{ $item->approved_at ? $item->approved_at->format('F j, Y g:i A') : 'N/A' }}</td></tr>
                                        @if ($item->approval_status == 'rejected')
                                            <tr><th>Rejection Reason</th><td>{{ $item->rejection_reason }}</td></tr>
                                        @endif
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Submitted Documents</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <th width="30%">Means of Identification</th>
                                        <td>
                                            {{ str_replace('_', ' ', ucfirst($item->means_of_identification_type)) }}
                                            &nbsp;
                                            <a href="{{ route('admin.agentApprovals.download.meansOfId', ['id' => encrypt($item->id)]) }}" class="btn btn-sm btn-primary">Download</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Passport Photograph</th>
                                        <td>
                                            <a href="{{ route('admin.agentApprovals.download.passport', ['id' => encrypt($item->id)]) }}" class="btn btn-sm btn-primary">Download</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    @if ($item->approval_status === 'pending')
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Approve Application</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('admin.agentApprovals.approve', ['id' => encrypt($item->id)]) }}" onsubmit="return confirm('Approve this agent application?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success w-100">Approve</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Reject Application</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('admin.agentApprovals.reject', ['id' => encrypt($item->id)]) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label required">Rejection Reason</label>
                                                <textarea name="rejection_reason" class="form-control @error('rejection_reason') is-invalid @enderror" rows="3">{{ old('rejection_reason') }}</textarea>
                                                @error('rejection_reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Reject this agent application?');">Reject</button>
                                        </form>
                                    </div>
                                </div>
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
