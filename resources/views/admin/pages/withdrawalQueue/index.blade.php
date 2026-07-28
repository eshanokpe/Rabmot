@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Agent Withdrawal Queue
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Withdrawal Requests</h3>
                                <div class="card-actions">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.withdrawalQueue.index', ['status' => 'pending']) }}" class="btn {{ $status == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">Pending</a>
                                        <a href="{{ route('admin.withdrawalQueue.index', ['status' => 'approved']) }}" class="btn {{ $status == 'approved' ? 'btn-primary' : 'btn-outline-primary' }}">Approved</a>
                                        <a href="{{ route('admin.withdrawalQueue.index', ['status' => 'rejected']) }}" class="btn {{ $status == 'rejected' ? 'btn-primary' : 'btn-outline-primary' }}">Rejected</a>
                                        <a href="{{ route('admin.withdrawalQueue.index', ['status' => 'paid']) }}" class="btn {{ $status == 'paid' ? 'btn-primary' : 'btn-outline-primary' }}">Paid</a>
                                        <a href="{{ route('admin.withdrawalQueue.index', ['status' => 'all']) }}" class="btn {{ $status == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                                    </div>
                                </div>
                            </div>
                            <br>
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
                            <br>

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">S/N</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Agent Email</th>
                                            <th>Amount (NGN)</th>
                                            <th>Bank</th>
                                            <th>Account Number</th>
                                            <th>Account Name</th>
                                            <th>Submitted</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($items as $item)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++}}</span></td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.withdrawalQueue.show', ['id' => encrypt($item->id)]) }}" class="btn">Review</a>
                                            </td>
                                            <td class="text-end">
                                                @if ($item->status == 'pending')
                                                    <span class="badge text-bg-warning">Pending</span>
                                                @elseif ($item->status == 'approved')
                                                    <span class="badge text-bg-info">Approved</span>
                                                @elseif ($item->status == 'rejected')
                                                    <span class="badge text-bg-danger">Rejected</span>
                                                @elseif ($item->status == 'paid')
                                                    <span class="badge text-bg-success">Paid</span>
                                                @else
                                                    <span class="badge text-bg-secondary">{{ ucfirst($item->status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->user_email }}</td>
                                            <td>₦{{ number_format($item->amount, 2, '.', ',') }}</td>
                                            <td>{{ $item->bank }}</td>
                                            <td>{{ $item->account_number }}</td>
                                            <td>{{ $item->account_name }}</td>
                                            <td>
                                                @php
                                                    $date = \Carbon\Carbon::parse($item->created_at);
                                                @endphp
                                                {{ $date->format('F j, Y g:i A') }}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9"><p class="text-danger mb-0">No withdrawal requests found</p></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
