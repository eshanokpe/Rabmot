
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
                            View Other Permit Process Details
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

                                <h3 class="card-title">Other Permit Process</h3>
                                
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

                                            <label class="form-label">Permit Type</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->permitInfo->name}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Firstname</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->firstname}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Middlename</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->middlename}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Lastname</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->lastname}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Mothermaiden Name</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->mothermaidenname}}" disabled />

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Email</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->email}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Gender</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->gender}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Maritalstatus</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->maritalstatus}}" disabled/>

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
                                            <label class="form-label">Local govt. Place of birth</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->localgovtplaceofbirth);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Date of birth</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->dateofbirth);
                                            @endphp

                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Phonenumber</label>

                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->phonenumber}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Blood Group</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->bloodgroup}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Height</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->height}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Next of kin Name</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nextofkinname}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Next of kin Phonenumber</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nextofkinphonenumber}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->address}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Name of Vehicle Documents</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nameofvehicledocuments}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Make</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->vehicle_make}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Model</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->vehicle_model}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Reg number</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->reg_number}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Purpose</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->purpose}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Length of years</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->lengthofyears}} Year" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Name on driver</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nameondriver}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Driver license number</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->driverlicensenumber}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Next of kin</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nextofkin}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Next of kin Phone number</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nextofkinphone_no}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Class of License</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->classoflicense}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Reason for</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->reasonfor}}" disabled/>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <label class="form-label">passport</label>
                                            <div class="input-group">
                                                <a href="{{route('otherpermitpassport.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Means of ID Document</label>
                                            <div class="input-group">
                                                <a href="{{route('otherpermitmeansofID.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Picture of the Vehicle License</label>
                                            <div class="input-group">
                                                <a href="{{route('otherpermitpictureoftheVehicleLicense.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Affidavit</label>
                                            <div class="input-group">
                                                <a href="{{route('otherpermitaffidavit.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Police Report</label>
                                            <div class="input-group">
                                                <a href="{{route('otherpermitpolicereport.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-6">

                                            <a href="{{route('admin.processOtherPermit')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    

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

