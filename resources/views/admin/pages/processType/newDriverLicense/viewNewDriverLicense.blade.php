@extends('admin.layouts.app') 

@section('content')
<style>
    .order-status {
        padding: 5px;
        border: 1px solid #ccc;
        margin: 5px;
        border-radius: 4px;
        align-items: center;
    }

    .pending {
        background-color: yellow;
        color: black;
    }

    .processing {
        background-color: orange;
        color: white;
    }

    .ready {
        background-color: blue;
        color: white;
    }

    .delivery {
        background-color: green;
        color: white;
    }

    .delivered {
        background-color: teal;
        color: white;
    }

</style>
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
                            View New Driver License Process Details
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
                                <h3 class="card-title"> New Driver License Process</h3>
                                
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
                                            <label class="form-label required">Mothermaiden name</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->mothermaidenname}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Mothermaiden name</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->mothermaidenname}}" disabled/>
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
                                            <label class="form-label required">Gender</label>
                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->gender}}" disabled/>
                                        </div> 

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Length of year</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->lengthofyear}}" disabled/>
                                        </div> 

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Date of birth</label>
                                            @php

                                                $date = \Carbon\Carbon::parse($items->created_at);

                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div> 

                                         <div class="mb-3 col-3">
                                            <label class="form-label">Phonenumber</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->phonenumber}}" disabled/>
                                        </div> 

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Local Government</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->localgovernment}}" disabled/>
                                        </div> 

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Marital status</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->maritalstatus}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->state}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Local govt place of birth</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->localgovtplaceofbirth}}" disabled/>
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
                                            <label class="form-label">Next of kin name</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nextofkinname}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Next of kin Phonenumber</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nextofkinphonenumber}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Next of kin Phonenumber</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->nextofkinphonenumber}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Total Amount</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $items->totalamount}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Status</label>
                                            <p>
                                                @if( $items->payment_status == '0')
                                                <h4><center><span class="badge badge-secondary pending">Pending</span></center></h4>
                                                {{-- <div class="order-status pending">Pending</div> --}}
                                                @endif
                                                @if( $items->payment_status == '1')
                                                    <h4><center><span class="badge badge-secondary processing">Processing</span></center></h4>
                                                @endif
                                                @if( $items->payment_status == '2')
                                                    <h4><center><span class="badge badge-success ready">Ready for Delivery</span></center></h4>
                                                @endif
                                                @if( $items->payment_status == '3')
                                                    <h4><center><span class="badge badge-primary delivery">Delivered</span></center></h4>
                                                @endif
                                                @if( $items->payment_status == '4')
                                                    <h4><center><span class="badge badge-primary delivered ">Delivered</span></center></h4>
                                                @endif
                                            </p>
                                        </div>
                                       
    
                                        <div class="row">
    
                                            <div class="mb-3 col-6">
    
                                                <a href="{{route('admin.processNewDriverlicense')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    
    
                                            </div>
    
                                        </div> 

                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </dv>
                </div>
            </div>
        </div>


    </div>

</div>

@endsection