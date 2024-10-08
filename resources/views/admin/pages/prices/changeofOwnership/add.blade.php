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
                        <a href="{{ route("admin.vehicleRegistrationPrice.index") }}" class="btn btn-primary">
                            View Change Of Ownership Price
                        </a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var successAlert = document.getElementById('success-alert');
                    
                            if (successAlert) {
                                setTimeout(function() {
                                    successAlert.style.display = 'none';
                                }, 25000); 
                            }
                        });
                    </script>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Change Of Ownership Price</h3>
                            </div>
                             @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger" id="success-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="col-12 mt-2 ps-2">
                                <form action="{{ route("admin.vehicleChangeofOwnershipPrice.store") }}" method="POST" >
                                    @csrf 
                                    <fieldset class="form-fieldset">
                                        <div class="row">
                                            <fieldset class="form-fieldset">
                                                <div class="row">
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">State</label>
                                                        <select required name="stateId" class="form-select">
                                                        <option disabled selected>-select-</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}">{{ $state->name }}</option>  
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Vehicle Type</label>
                                                        <select required name="vehicle_type_id" class="form-select">
                                                            <option disabled selected="selected" value="">-- Select Vehicle --</option>
                                                            @foreach ($VehicleType as $VehicleType)
                                                                <option value="{{ $VehicleType->id }}">{{ $VehicleType->name }}</option>  
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>Random Plate Number</legend>
                                                 <div class="row">
                                                    <div class="mb-3 col-3">
                                                        <label class="form-label required">Vehicle License </label>
                                                        <input type="number" name="random_vehicleLicense" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                    <div class="mb-3 col-3">
                                                        <label class="form-label required">Hacney Permit</label>
                                                        <input type="number" name="random_hacneyPermit" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                    <div class="mb-3 col-3">
                                                        <label class="form-label required">Police CMRIS</label>
                                                        <input type="number" name="random_policeCmris" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                    <div class="mb-3 col-3">
                                                        <label class="form-label required">Cost</label>
                                                        <input type="number" name="random_cost" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                 </div> 
                                            </fieldset>
                                            <fieldset>
                                                <legend>Customised Plate Number</legend>
                                                <div class="row">
                                                   <div class="mb-3 col-3">
                                                        <label class="form-label required">Vehicle License </label>
                                                        <input type="number" name="customised_vehicleLicense" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                    <div class="mb-3 col-3">
                                                        <label class="form-label required">Hacney Permit</label>
                                                        <input type="number" name="customised_hacneyPermit" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                    <div class="mb-3 col-3">
                                                        <label class="form-label required">Police CMRIS</label>
                                                        <input type="number" name="customised_policeCmris" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                    <div class="mb-3 col-3">
                                                        <label class="form-label required">Cost</label>
                                                        <input type="number" name="customised_cost" class="form-control"  autocomplete="off" required/>
                                                    </div>
                                                   
                                                    <div class="mb-3 col-3">
                                                    
                                                        <button type="submit" class="btn btn-primary ms-auto">Add Change of Ownership Price</button>    
                                                    </div>
                                                </div>
                                            </fieldset>
                                            
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            

                            

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection