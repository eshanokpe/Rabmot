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
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Paper Renewal Price</h3>
                            </div>
                            <div class="col-12 mt-2 ps-2">
                                <fieldset class="form-fieldset">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    @if(session('stateerror'))
                                        <div class="alert alert-danger" id="error-alert">
                                            {{ session('stateerror') }}
                                        </div>
                                    @endif
                                   
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var errorAlert = document.getElementById('error-alert');
                                    
                                            if (errorAlert) {
                                                setTimeout(function() {
                                                    errorAlert.style.display = 'none';
                                                }, 5000); 
                                            }
                                        });
                                    </script>
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
                                    
                                    <div class="row">
                                        <div class="col-3">   
                                        </div>
                                        <div class="col-6">
                                             @if(session('success'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                           <form action="{{ route('admin.vehicleRenewalPrice.store') }}" method="POST">
                                            @csrf 
                                            <div class="mb-3 col-12">
                                                <label class="form-label">State</label>
                                                    <select required  name="stateId" class="form-select" >
                                                    <option disabled selected>-select-</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}</option>  
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Vehicle Type</label>
                                                 
                                                <select required name="vehicleType" class="form-select">
                                                    <option disabled selected="selected" value="">-- Select Vehicle --</option>
                                                    @foreach ($vehcileType as $vehcileType)
                                                        <option value="{{ $vehcileType->id }}">{{ $vehcileType->name }}</option>  
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Vehicle License</label>
                                                <input required type="number" name="vehicleLicense" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Road Worthiness</label>
                                                <input required type="number" name="roadWorthiness" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Thrid Party Insurance</label>
                                                <input required type="number" name="thridPartyInsurance" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Proof Of Ownership</label>
                                                <input required type="number" name="proofOfOwnership" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Hackney Permit</label>
                                                <input required type="number" name="hackneyPermit" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Police CMRIS</label>
                                                <input required type="number" name="policeCmris" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">Vehicle Inspection Pick-Up & Drop Off</label>
                                                <input required type="number" name="vehicleInspection" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-3">
                                            <label class="form-label">   .</label>
                                                <button type="submit" class="btn btn-primary ms-auto">Add Vehicle Renewal Price</button>    
                                            </div>
                                            </form>
                                        </div>
                                        <div class="col-3">   
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