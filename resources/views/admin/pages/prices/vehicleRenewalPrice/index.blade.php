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
                    <a href="{{route("admin.vehicleRenewalPrice.create")}}">
                        <button type="submit" class="btn btn-primary">+Add New</button>
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
                            <h3 class="card-title">Vehicle Renewal Price List </h3>
                        </div>
                        <br/>
                        @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <script>
                                // Wait for the document to be ready
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Select the success alert element by its ID
                                    var errorAlert = document.getElementById('error-alert');
                            
                                    // Check if the alert element exists
                                    if (errorAlert) {
                                        // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                        setTimeout(function() {
                                            errorAlert.style.display = 'none';
                                        }, 5000); // 5000 milliseconds = 5 seconds
                                    }
                                });
                            </script>
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
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">S/N
                                            <i class="fa fa-arrow-up"></i>
                                        </th>
                                        <th>Action</th>
                                        <th>State</th>
                                        <th>vehicle Type</th>
                                        <th>vehicle License</th>
                                        <th>Round Worthness</th>
                                        <th>Third Party Insurance</th>
                                        <th>Proof Of Ownership</th>
                                        <th>Hacney Permit</th>
                                        <th>Vehicle Inspection Pick Up and Drop off</th>
                                        <th>Police CMRIS</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @php $serial = 1 @endphp
                                    @forelse($vehicleRenewal as $vehicleRenewal)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++ }}</span></td>
                                           <td class="text-end">
                                                <span class="dropdown">
                                                    <a href="{{route("admin.vehicleRenewalPrice.edit", encrypt($vehicleRenewal->id) )}}" class="btn">Edit</a>
                                                </span>
                                            </td>
                                           <td>{{ $vehicleRenewal->stateInfo->name ?? 'N/A' }}</td>
                                            <td>{{$vehicleRenewal->VehicleType->name ?? 'N/A' }} </td>
                                            <td>₦{{$vehicleRenewal->vehicle_license}}</td>
                                            <td>₦{{$vehicleRenewal->road_worthiness}}</td>
                                            <td>₦{{$vehicleRenewal->third_party_insurance}}</td>
                                            <td>₦{{$vehicleRenewal->proof_of_ownership}}</td> 
                                            <td>₦{{$vehicleRenewal->hackney_permit}}</td>
                                            <td>₦{{$vehicleRenewal->vehicle_inspection_pickanddrop}}</td>
                                            <td>₦{{$vehicleRenewal->police_cmris}}</td>
                                            <td>
                                                 @php
                                                    $date = \Carbon\Carbon::parse($vehicleRenewal->created_at);
                                                @endphp
                                                {{ $date->format('F j, Y') }}
                                            </td>
                                             <td class="text-end">
                                                <span class="dropdown">
                                                    <a href="{{ route("admin.vehicleRenewalPrice.update", encrypt($vehicleRenewal->id)) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
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