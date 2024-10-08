
@extends('admin.layouts.app') 
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                    Admin
                    </div>
                    <h2 class="page-title">
                        Price Update
                    </h2>
                </div>
                <div class="text-end col-6">
                    <a href="{{route("admin.vehicleChangeofOwnershipPrice.create")}}" class="btn btn-primary">
                        +Add New
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
                            <h3 class="card-title">Change Of Ownership Price List </h3>
                        </div>
                        <br/>
                        @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <script>
                                // Wait for the document to be ready
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Select the success alert element by its ID
                                    var successAlert = document.getElementById('success-alert');
                            
                                    // Check if the alert element exists
                                    if (successAlert) {
                                        // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); // 5000 milliseconds = 5 seconds
                                    }
                                });
                            </script>
                        <div class="table-responsive ">
                            <table class="table card-table table-vcenter text-nowrap datatable two-sided-header">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="side"></th>
                                        <th colspan="4" class="right-side">Random Plate Number</th>
                                        <th colspan="4" class="left-side">Customised Plate Number</th>
                                        <th class="side"></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th class="w-1">S/N
                                            <i class="fa fa-arrow-up"></i>
                                        </th>
                                        <th>Action</th>
                                        <th>State</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle License</th>
                                        <th>Hacney Permit</th>
                                        <th>Police CMRIS</th>
                                        <th>Cost</th>
                                        <th>Vehicle License</th>
                                        <th>Hacney Permit</th>
                                        <th>Police CMRIS</th>
                                        <th>Cost</th>
                                        <th>Date Updated</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   @php $serial = 1 @endphp
                                   @forelse( $data as $data)
                                    <tr>
                                        <td><span class="text-muted"> {{ $serial++ }} </span></td>
                                       <td class="text-end">
                                            <span class="dropdown">
                                                <a href="{{ route('admin.vehicleChangeofOwnershipPrice.edit', encrypt($data->id) ) }}" class="btn">Edit</a>
                                            </span>
                                        </td>
                                        <td>{{ $data->stateInfo->name }}</td>
                                         <td>{{ empty($data->vehicleType) ? 'N/A'  : $data->vehicleType->name }} </td>
                                        <td>₦{{ number_format($data->random_vehicleLicense, 2, '.', ',') }}</td>
                                        <td>₦{{ number_format($data->random_hacneyPermit, 2, '.', ',') }}</td>
                                        <td>₦{{ number_format($data->random_policeCmris, 2, '.', ',') }}</td>
                                        <td>₦{{ number_format($data->random_cost, 2, '.', ',') }}</td>
                                        <td>₦{{ number_format($data->customised_vehicleLicense, 2, '.', ',') }}</td>
                                        <td>₦{{ number_format($data->customised_hacneyPermit, 2, '.', ',') }}</td>
                                        <td>₦{{ number_format($data->customised_policeCmris, 2, '.', ',') }}</td>
                                        <td>₦{{ number_format($data->customised_cost, 2, '.', ',') }}</td>
                                        <td>
                                            @php
                                                $date = \Carbon\Carbon::parse($data->created_at);
                                            @endphp
                                            {{ $date->format('F j, Y') }}
                                        </td>
                                        <td class="text-end">
                                            <span class="dropdown">
                                                <a href="{{route("admin.vehicleChangeofOwnershipPrice.destroy", encrypt($data->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                            </span>
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

@endsection