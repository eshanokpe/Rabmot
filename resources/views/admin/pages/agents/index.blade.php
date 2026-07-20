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
                            Master Admin
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{route('admin.agent.create')}}">
                            <button type="submit" class="btn btn-primary">+Add Agent</button>
                        </a>
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
                                <h3 class="card-title">List Of Agents</h3>
                                <div class="card-actions">
                                    <form method="GET" action="{{ route('admin.agents') }}" class="d-flex gap-2">
                                        <input type="hidden" name="status" value="{{ request('status') }}">
                                        <input type="hidden" name="approval_status" value="{{ request('approval_status') }}">
                                        <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search username, name, email, phone">
                                        <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="btn-group">
                                    <a href="{{ route('admin.agents', array_merge(request()->except('status'), ['status' => ''])) }}"
                                       class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">All Status</a>
                                    <a href="{{ route('admin.agents', array_merge(request()->except('status'), ['status' => 'active'])) }}"
                                       class="btn btn-sm {{ request('status') == 'active' ? 'btn-primary' : 'btn-outline-primary' }}">Active</a>
                                    <a href="{{ route('admin.agents', array_merge(request()->except('status'), ['status' => 'disable'])) }}"
                                       class="btn btn-sm {{ request('status') == 'disable' ? 'btn-primary' : 'btn-outline-primary' }}">Suspended</a>
                                </div>
                                <div class="btn-group ms-2">
                                    <a href="{{ route('admin.agents', array_merge(request()->except('approval_status'), ['approval_status' => ''])) }}"
                                       class="btn btn-sm {{ !request('approval_status') ? 'btn-primary' : 'btn-outline-primary' }}">All Approval</a>
                                    <a href="{{ route('admin.agents', array_merge(request()->except('approval_status'), ['approval_status' => 'pending'])) }}"
                                       class="btn btn-sm {{ request('approval_status') == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">Pending</a>
                                    <a href="{{ route('admin.agents', array_merge(request()->except('approval_status'), ['approval_status' => 'approved'])) }}"
                                       class="btn btn-sm {{ request('approval_status') == 'approved' ? 'btn-primary' : 'btn-outline-primary' }}">Approved</a>
                                    <a href="{{ route('admin.agents', array_merge(request()->except('approval_status'), ['approval_status' => 'rejected'])) }}"
                                       class="btn btn-sm {{ request('approval_status') == 'rejected' ? 'btn-primary' : 'btn-outline-primary' }}">Rejected</a>
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
                                            <th class="w-1">S/N
                                                <i class="fa fa-arrow-up"></i>
                                            </th>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Username</th>
                                            <th>Fullname</th>
                                            <th>Eamil Address</th>
                                            <th>Phone No.</th>
                                            <th>Location</th>
                                            <th>Gender</th>
                                            <th >Date Created</th>
                                            <th>Updated Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($items as $item)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++}}</span></td>
                                             <td class="text-end">
                                                <a href="{{ route('admin.agent.show', ['id' => encrypt($item->id)]) }}" class="btn btn-sm">View</a>
                                                <a href="{{ route('admin.agent.edit', ['id' => encrypt($item->id)]) }}" class="btn btn-sm">Edit</a>
                                                @if ($item->status == 'active')
                                                    <form method="POST" action="{{ route('admin.agent.suspend', ['id' => encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Suspend this agent?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Suspend</button>
                                                    </form>
                                                @elseif ($item->status == 'disable')
                                                    <form method="POST" action="{{ route('admin.agent.activate', ['id' => encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('Activate this agent?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-outline-success">Activate</button>
                                                    </form>
                                                @endif
                                            </td>
                                             <td class="text-end">
                                                @if ($item->status == 'active')
                                                    <span class="badge text-bg-success">Active</span>
                                                @elseif ($item->status == 'disable')
                                                    <span class="badge text-bg-secondary">Disable</span>
                                                @elseif ($item->status == 'delete')
                                                    <span class="badge text-bg-danger">Delete</span>
                                                @else
                                                    <span class="badge text-bg-warning">Status Not Set</span>
                                                @endif
                                             </td>
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->fullname}} </td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone_no}}</td>
                                            <td>{{$item->location}}</td>
                                            <td>{{$item->gender}}</td>
                                            <td>
                                                @php
                                                    $date = \Carbon\Carbon::parse($item->created_at);
                                                @endphp
                                                {{ $date->format('F j, Y') }}
                                            </td>
                                            <td>
                                                @php
                                                    $date = \Carbon\Carbon::parse($item->updated_at);
                                                @endphp
                                                {{ $date->format('F j, Y') }}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10"><p class="text-danger mb-0">No Data found</p></td>
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
