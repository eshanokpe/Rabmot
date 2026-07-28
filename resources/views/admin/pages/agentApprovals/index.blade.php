@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col-6">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Agent Approvals
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
                                <h3 class="card-title">Agent Applications</h3>
                                <div class="card-actions">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.agentApprovals.index', ['status' => 'pending']) }}" class="btn {{ $status == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">Pending</a>
                                        <a href="{{ route('admin.agentApprovals.index', ['status' => 'approved']) }}" class="btn {{ $status == 'approved' ? 'btn-primary' : 'btn-outline-primary' }}">Approved</a>
                                        <a href="{{ route('admin.agentApprovals.index', ['status' => 'rejected']) }}" class="btn {{ $status == 'rejected' ? 'btn-primary' : 'btn-outline-primary' }}">Rejected</a>
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
                                            <th>Username</th>
                                            <th>Fullname</th>
                                            <th>Email Address</th>
                                            <th>Phone No.</th>
                                            <th>ID Type</th>
                                            <th>Date Applied</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($items as $item)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++}}</span></td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.agentApprovals.show', ['id' => encrypt($item->id)]) }}" class="btn">View</a>
                                            </td>
                                            <td class="text-end">
                                                @if ($item->approval_status == 'approved')
                                                    <span class="badge text-bg-success">Approved</span>
                                                @elseif ($item->approval_status == 'rejected')
                                                    <span class="badge text-bg-danger">Rejected</span>
                                                @elseif ($item->approval_status == 'pending')
                                                    <span class="badge text-bg-warning">Pending</span>
                                                @else
                                                    <span class="badge text-bg-secondary">Unknown</span>
                                                @endif
                                            </td>
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->fullname}} </td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone_no}}</td>
                                            <td>{{ str_replace('_', ' ', ucfirst($item->means_of_identification_type)) }}</td>
                                            <td>
                                                @php
                                                    $date = \Carbon\Carbon::parse($item->created_at);
                                                @endphp
                                                {{ $date->format('F j, Y') }}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9"><p class="text-danger mb-0">No Data found</p></td>
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
