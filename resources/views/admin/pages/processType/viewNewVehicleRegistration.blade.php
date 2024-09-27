@extends('admin.layouts.app') 

@section('content')

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            View New Vehicle Registration Process Details
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

                                <h3 class="card-title"> View New Vehicle Registration Process</h3>
                                
                            </div>
                            @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <script>
                                // Wait for the document to be ready
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Select the success alert element by its ID
                                    var successAlert = document.getElementById('error-alert');
                            
                                    // Check if the alert element exists
                                    if (successAlert) {
                                        // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); // 5000 milliseconds = 5 seconds
                                    }
                                });
                            </script>

                            <div class="col-12 mt-2 ps-2">

                                <fieldset class="form-fieldset">

                                    <div class="row">

                                        <div class="mb-3 col-3">
                                            <label class="form-label required">User Email</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->user_email}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Process ID</label>
                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->process_id}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Process Type</label>
                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->process_type}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Vehicle Type</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->categoryInfo->name}}" disabled/>
                                        </div>
                                       
                                        <div class="row">
                                       
                                            <div class="mb-3 col-3">
                                                <label class="form-label">Vehicle Registration Type</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehicleregistrationType->name}}" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Created date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->created_at);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Total Amount</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->totalamount}}" disabled/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <a href="{{route('admin.processNewVehicleRegistration')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    
                                        </div>
                                    </div>                                   

                                </fieldset>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>

@endsection