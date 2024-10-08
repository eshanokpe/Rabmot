@extends('admin.layouts.app') 
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                    ADD Vehicle
                    </div>
                    <h2 class="page-title">
                        Vehicles Registration 
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
                            <h3 class="card-title">Client Vehicles</h3>
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
                                        <th>Category</th>
                                        <th>Vehicle Make</th>
                                        <th>Vehicle Model</th>
                                        <th>Year of Make</th>
                                        <th>Chasis Number</th>
                                        <th>Engine Number</th>
                                        <th>Vehicle Color</th>
                                        <th>Name On Document</th>
                                        <th>Applicant NIN</th>
                                        <th>Residential address</th>
                                        <th>Owner's Number</th>
                                        <th>Email Address</th>
                                        <th>Gender</th>
                                        <th>Occupation</th>
                                        <th> Date of Birth</th>
                                        <th>Marital Status</th>
                                        <th>State</th>
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
                                                <a href="{{route('admin.vehicle.registrations.view', encrypt($item->id) )}}" class="btn ">View</a> 
                                            </span>
                                        </td>
                                        <td>{{ $item->user_email}}</td>
                                        <td>{{ $item->vehicleTypeInfo->name}}</td>
                                        <td>{{ $item->vehiclemake}}</td>
                                        <td>{{ $item->vehiclemodel}}</td>
                                        <td>{{ $item->year_of_make}}</td>
                                        <td>{{ $item->chassisnumber}}</td>
                                        <td>{{ $item->enginenumber}}</td>
                                        <td>{{ $item->vehiclecolor}}</td>
                                        <td>{{ $item->applicantfullname}}</td>
                                        <td>{{ $item->applicantNIN}}</td>
                                        <td>{{ $item->residentialaddress}}</td>
                                        <td>{{ $item->phonenumber}}</td>
                                        <td>{{ $item->emailaddress}}</td>
                                        <td>{{ $item->gender}}</td>
                                        <td>{{ $item->occupation}}</td>
                                        <td>
                                            @php
                                                $date = \Carbon\Carbon::parse($item->dateofbirth);
                                            @endphp
                                                {{ $date->format('F j, Y') }}
                                        </td>
                                        <td>{{ $item->maritalstatus}}</td>
                                        <td>{{ $item->state}}</td>
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