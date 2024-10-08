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
                            View New Vehicle Registration Details
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
                                <h3 class="card-title">New Vehicle Registration</h3>
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
                                            <label class="form-label required">Category</label>
                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->vehicleTypeInfo->name}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Vehicle Make</label>
                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->vehiclemake}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Model</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehiclemodel}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Year Of Make</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->year_of_make}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Chasis Number</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->chassisnumber}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Engine Number</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->enginenumber}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle Color</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehiclecolor}}" disabled />

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Name On Document</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->applicantfullname}}" disabled/>
                                        </div>
                                        
                                         <div class="mb-3 col-3">
                                            <label class="form-label">Applicant NIN</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->applicantNIN}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Residential address</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->residentialaddress}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Owner's Number</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->phonenumber}}" disabled/>

                                        </div>


                                        <div class="mb-3 col-3">

                                            <label class="form-label">Email Address</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->emailaddress}}" disabled/>

                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Gender</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->gender}}" disabled/>

                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Occupation</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->occupation}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle License Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->dateofbirth);
                                            @endphp

                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Marital Status</label>

                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->maritalstatus}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">State</label>

                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->state}}" disabled/>

                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Custom Papers Document</label>
                                            <div class="input-group">
                                                <a href="{{ route('vehicle.registration.custom.paper.download', ['id' => encrypt($items->id) ]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Means of ID Document</label>
                                            <div class="input-group">
                                                <a href="{{ route('vehicle.registration.means.of.id.download', ['id' => encrypt($items->id) ]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </div>
    
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <a href="{{route('admin.vehicle.registrations.new')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    

                                        </div>

                                    </div>
                                    

                                </fieldset>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <footer class="footer footer-transparent d-print-none">

            <div class="container-xl">

                <div class="row text-center align-items-center flex-row-reverse">

                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">

                        <ul class="list-inline list-inline-dots mb-0">

                            <li class="list-inline-item">

                                Rabmot © 2023 | Developed By : ODD.Creatives

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </footer>

    </div>

</div>

@endsection