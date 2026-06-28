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
                            Master Admin
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{route("admin.vehicleRenewalPrice.index")}}">
                            <button type="submit" class="btn btn-primary">View vehicle renewal</button>
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
                                <h3 class="card-title">Edit Paper Renewal Price</h3>
                            </div>
                            <div class="col-12 mt-2 ps-2">
                                <fieldset class="form-fieldset">
                                    
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var successAlert = document.getElementById('success-alert');
                                    
                                            if (successAlert) {
                                                setTimeout(function() {
                                                    successAlert.style.display = 'none';
                                                }, 5000); 
                                            }
                                        });
                                    </script>
                                    <div class="row center">
                                        <div class="col-2">   
                                        </div>
                                        <div class="col-8">
                                             @if(session('success'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            <form action="{{ route('admin.vehicleRenewalPrice.update',  $vehicleRenewal->id ) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                 <input type="hidden" name="id" class="form-control" value="{{ $vehicleRenewal->id }}"  autocomplete="off"/>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label">State</label>
                                                    <select class="form-select" name="stateId">
                                                        <option selected>-select state-</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}" {{ $vehicleRenewal->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label">Vehicle type</label>
                                                    <select class="form-select" name="vehicleType" >
                                                        <option selected>-select vehicle type-</option>
                                                        @foreach ($vehicleType as $vehicleType)
                                                            <option value="{{ $vehicleType->id }}" {{ $vehicleRenewal->vehicleType_id == $vehicleType->id ? 'selected' : '' }} >{{ $vehicleType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                 <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label required">Vehicle License</label> 
                                                    <input type="text" name="vehicleLicense" class="form-control" value="{{ $vehicleRenewal->vehicle_license }}"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label required">Road Worthiness</label>
                                                    <input type="text" name="roadWorthiness" class="form-control" value="{{ $vehicleRenewal->road_worthiness }}"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label required">Thrid Party Insurance</label>
                                                    <input type="text" name="thridPartyInsurance" class="form-control" value="{{ $vehicleRenewal->third_party_insurance }}"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label required">Proof Of Ownership</label>
                                                    <input type="text" name="proofOfOwnership" class="form-control" value="{{ $vehicleRenewal->proof_of_ownership }}"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label required">Hackney Permit</label>
                                                    <input type="text" name="hackneyPermit" class="form-control" value="{{ $vehicleRenewal->hackney_permit }}"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label required">Police CMRIS</label>
                                                    <input type="text" name="policeCmris" class="form-control" value="{{ $vehicleRenewal->police_cmris }}"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-12 col-12 mb-2">
                                                    <label class="form-label required">Vehicle Inspection Pick-Up & Drop Off</label>
                                                    <input type="text" name="vehicleInspection" class="form-control" value="{{ $vehicleRenewal->vehicle_inspection_pickanddrop }}"  autocomplete="off"/>
                                                </div>
                                                <div class="mb-12 col-12">
                                                <label class="form-label">   .</label>
                                                    <button type="submit" class="btn btn-primary ms-auto">Update Vehicle Renewal Price</button>    
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-2">
                                            
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