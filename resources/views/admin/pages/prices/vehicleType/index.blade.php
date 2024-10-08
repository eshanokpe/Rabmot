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
                        <a href="{{route('admin.vehicle.type.add')}}">
                            <button type="submit" class="btn btn-primary">+Add Vehicle Type</button>
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
                                <h3 class="card-title">List Of State</h3>
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
                                // Wait for the document to be ready
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Select the success alert element by its ID
                                    var successAlert = document.getElementById('success-alert');
                            
                                    // Check if the alert element exists
                                    if (successAlert) {
                                        // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 10000); // 10000 milliseconds = 10 seconds
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
                                            <th>Name</th>
                                            <th >Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @php $serial = 1 @endphp
                                        @forelse($vehicleTypes as $vehicleType)
                                        <tr>
                                            <td>{{$serial++}}</td>
                                            <td> 
                                                <a href="{{ route('admin.vehicle.type.edit',  ['id' => encrypt($vehicleType->id)]) }}" class="btn">View</a>
                                            </td>
                                            <td>{{ $vehicleType->name}}</td>
                                            <td>
                                                 @php
                                                    $date = \Carbon\Carbon::parse($vehicleType->created_at);
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