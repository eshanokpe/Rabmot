@extends('admin.layouts.app') 
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                    View Vehicle
                    </div>
                    <h2 class="page-title">
                        New Driver license
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
                            <h3 class="card-title">New Driverlicense Process</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">S/N
                                            <i class="fa fa-arrow-up"></i>
                                        </th>
                                        <th>View</th>
                                        <th>User Email</th>
                                        <th>Process ID</th>
                                        <th>Process Type</th>
                                        <th>Length of year</th>
                                        <th>First name</th>
                                        <th>Middle name</th>
                                        <th>Last name</th>
                                        <th>Mothermaiden name</th>
                                        <th>Payment Status</th>
                                        <th>Total Amount</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $serial = 1 @endphp
                                    @forelse ($items as $item)
                                    <tr>
                                        <td><span class="text-muted">{{ $serial++ }}</span></td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <a href="{{route('admin.viewNewDriverLicense', encrypt($item->id) )}}" class="btn ">View</a> 
                                            </span>
                                        </td>
                                        <td>{{ $item->user_email}}</td>
                                        <td>{{ $item->process_id}}</td>
                                        <td>{{ $item->process_type}}</td>
                                        <td>
                                            {{ $item->lengthofyear}} Years
                                        </td>
                                        <td>{{ $item->firstname}}</td>
                                        <td>{{ $item->middlename}}</td>
                                        <td>{{ $item->lastname}}</td>
                                        <td>{{ $item->mothermaidenname}}</td>
                                        <td>{{ $item->payment_status}}</td>
                                        <td>₦{{ number_format($item->totalamount,2, '.', ',')}}</td>
                                       
                                        <td>
                                            @php
                                                $date = \Carbon\Carbon::parse($item->created_at);
                                            @endphp
                                            {{ $date->format('F j, Y') }}
                                        </td>
                                    </tr>                               
                                    @empty
                                        <p class="text-danger">No Data found</p>
                                    @endforelse
                                </tbody>

                            </table>
                            <!-- Pagination links -->
                            <div class="pagination-links">
                                {{ $items->links('pagination::simple-bootstrap-4') }} <!-- Or simple-default -->
                            </div>

                        </div>

                        

                    </div>

                </div>

            </div>

        </div>

    </div>

 

</div>

@endsection