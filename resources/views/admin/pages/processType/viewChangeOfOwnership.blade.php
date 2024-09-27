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
                            View Change of Ownership Process Details
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

                                <h3 class="card-title">Change of Ownership Process</h3>
                                
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
                                            <label class="form-label required">Vehicle Category</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehicle_category}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Fullname</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->fullname}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehiclelicenseexpiry Date</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->vehiclelicenseexpiry_date}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Address</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->address}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Phone Number</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->phonenumber}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Gender</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->gender}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Occupation</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->occupation}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehiclelicense Expiry</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->vehiclelicenseexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Insurance Expiry</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->insuranceexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Roadworthiness Expiry</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->roadworthinessexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Hackneypermit Expiry</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->hackneypermitexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Statecarriagepermit Expiry</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->statecarriagepermitexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Hackneydutypermit Expiry</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->hackneydutypermitexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Local Government Permit Expiry</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->localgovernmentpermitexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Created date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->created_at);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Payment Status</label>
                                            <select disabled class="form-select" id="select-option" name="status">
                                                <option value="0" @if ($items->payment_status == 0) selected @endif>Pending</option>
                                                <option value="1" @if ($items->payment_status == 1) selected @endif>Processing</option>
                                                <option value="2" @if ($items->payment_status == 2) selected @endif>Ready for Delivery</option>
                                                <option value="3" @if ($items->payment_status == 3) selected @endif>Delivered</option>
                                            </select>  
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Total Amount</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->totalamount}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle License Papers</label>
                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnershipLicensePaper.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Proof of Ownership</label>
                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnershipProof.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Agreement</label>
                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnershipMeansOfId.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Means of ID</label>
                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnershipMeansOfId.download', ['id' => $items->id ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <a href="{{route('admin.processChangeOfOwnership')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    
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