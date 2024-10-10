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
                                                <span class="dropdown">
                                                    <a href="{{ route('admin.agent.edit', ['id' => encrypt($item->id)]) }}" class="btn">Edit</a>
                                                 </span>
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
                                            <p class="text-danger">No Data found</p>
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
</div>
@endsection