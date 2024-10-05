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
                            View International Driverlicense Process Details
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

                                <h3 class="card-title">International Driverlicense Process</h3>
                                
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
                                            <label class="form-label required">First name</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->firstname}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Middle name</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->middlename}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Last name</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->lastname}}" disabled/>
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
                                            <label class="form-label">Length of year</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->lengthofyear}} Year" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Gender</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->gender}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Date of birth</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->dateofbirth);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Marital status</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->maritalstatus}}" disabled/>
                                        </div>
                                         <div class="mb-3 col-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->address}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Local Government</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->localgovernment}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->state}}" disabled/>
                                        </div> 
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Local Govt. Place of Birth</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->localgovtplaceofbirth}}" disabled/>
                                        </div>                                     
                                        <!--<div class="mb-3 col-3">-->
                                        <!--    <label class="form-label">Place of birth</label>-->
                                        <!--     <input type="text" class="form-control" autocomplete="off" value="{{ $items->placeofbirth}}" disabled/>-->
                                        <!--</div>-->

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Phonenumber</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->phonenumber}}" disabled/>
                                        </div>
                                        
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Total Amount</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->totalamount}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Passport</label>
                                            <div class="input-group">
                                                <a href="{{route('internationalDriverlicensepassport.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <a href="{{route('admin.processInternationalDriverLicense')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    
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