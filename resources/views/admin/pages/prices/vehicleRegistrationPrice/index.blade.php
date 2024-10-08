
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
                    <a href="{{ route("admin.vehicleRegistrationPrice.create") }}" class="btn btn-primary">
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
                            <h3 class="card-title">Vehicel Registration Price List </h3>
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
                                    var successAlert = document.getElementById('success-alert');
                                    if (successAlert) {
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); 
                                    }
                                });
                            </script>
                        <div class="table-responsive ">
                            <nav>
                              <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Random Plate Number</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Customised Plate Number</button>
                              </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                   <br>
                                   <table class="table card-table table-vcenter text-nowrap datatable two-sided-header">
                                        
                                        <thead>
                                            <tr>
                                                <th class="w-1">S/N
                                                    <i class="fa fa-arrow-up"></i>
                                                </th>
                                                <th>Action</th>
                                                <th>State</th>
                                                <th>Vehicle Type</th>
                                                <th>Private Vehicle with 3rd/P Insurance</th>
                                                <th>Private Vehicle with No Insurance</th>
                                                <th>Comercial Vehicle with 3rd/P Insurance</th>
                                                <th>Comercial Vehicle with No Insurance</th>
                                                <th>Hacney Permit</th>
                                                <th>Police CMRIS</th>
                                                <th>Action</th>
                                                <th>Date Updated</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $serial = 1 @endphp
                                            @forelse($data as $data)
                                            <tr>
                                                <td><span class="text-muted">{{ $serial++ }}</span></td>
                                               <td class="text-end">
                                                    <span class="dropdown">
                                                        <a href="{{route("admin.vehicleRegistrationPrice.edit", encrypt($data->id))}}" class="btn">Edit</a>
                                                    </span>
                                                </td>
                                                <td>{{ $data->stateInfo->name ?? 'N/A' }}</td>
                                                 <td>{{ $data->vehicleType->name ?? 'N/A' }}</td>
                                                <td>₦{{ $data->random_private_vehicle_3rd_party_insurance }}</td>
                                                <td>₦{{ $data->random_plate_private_vehicle_no_insurance }}</td>
                                                <td>₦{{ $data->random_commercial_plate_3rd_party_insurance }}</td>
                                                <td>₦{{ $data->random_plate_no_commercial_vehicle_no_insurance }}</td>
                                                <td>₦{{ $data->random_plate_hackney_permit }}</td>
                                                <td>₦{{ $data->random_plate_police_cmris }}</td>
                                                <td class="text-end">
                                                    <span class="dropdown">
                                                        <a href="{{route("admin.vehicleRegistrationPrice.destroy", encrypt($data->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                    </span>
                                                </td>
                                                <td>
                                                     @php
                                                        $date = \Carbon\Carbon::parse($data->created_at);
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
                              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                  <br>
                                   <table class="table card-table table-vcenter text-nowrap datatable two-sided-header">
                                        
                                        <thead>
                                            <tr>
                                                <th class="w-1">S/N
                                                    <i class="fa fa-arrow-up"></i>
                                                </th>
                                                <th>Action</th>
                                                <th>State</th>
                                                <th>Vehicle Type</th>
                                                <th>Private Vehicle with 3rd/P Insurance</th>
                                                <th>Private Vehicle with No Insurance</th>
                                                <th>Comercial Vehicle with 3rd/P Insurance</th>
                                                <th>Comercial Vehicle with No Insurance</th>
                                                <th>Hacney Permit</th>
                                                <th>Police CMRIS</th>
                                                <th>Action</th>
                                                <th>Date Updated</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $serial = 1 @endphp
                                            @forelse($data2 as $data)
                                            <tr>
                                                <td><span class="text-muted">{{ $serial++ }}</span></td>
                                               <td class="text-end">
                                                    <span class="dropdown">
                                                        <a href="{{route("admin.vehicleRegistrationPrice.edit", encrypt($data->id))}}" class="btn">Edit</a>
                                                    </span>
                                                </td>
                                                <td>{{ $data->stateInfo->name ?? 'N/A' }}</td>
                                                <td>{{ $data->vehicleType->name ?? 'N/A' }}</td>
                                                <td>₦{{ $data->customized_private_vehicle_3rd_party_insurance }}</td>
                                                <td>₦{{ $data->customised_plate_private_vehicle_no_insurance }}</td>
                                                <td>₦{{ $data->customised_commercial_plate_3rd_party_insurance }}</td>
                                                <td>₦{{ $data->customized_plate_no_commercial_vehicle_no_insurance }}</td>
                                                <td>₦{{ $data->customized_plate_hackney_permit }}</td>
                                                <td>₦{{ $data->customised_plate_police_cmris }}</td>
                                                <td class="text-end">
                                                    <span class="dropdown">
                                                        <a href="{{route("admin.vehicleRegistrationPrice.destroy", encrypt($data->id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                    </span>
                                                </td>
                                                <td>
                                                     @php
                                                        $date = \Carbon\Carbon::parse($data->created_at);
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

 

</div>

@endsection