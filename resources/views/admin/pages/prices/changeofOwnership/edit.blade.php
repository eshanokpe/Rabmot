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
                        <a href="{{route("admin.vehicleChangeofOwnershipPrice.index")}}" class="btn btn-primary">
                            View Vehicle Change of Ownership
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
                                <h3 class="card-title">Edit Change Of Ownership Price</h3>
                            </div>
                            <div class="col-12 mt-2 ps-2">
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
                                <form action="{{route("admin.vehicleChangeofOwnershipPrice.update",$data->id )}}" method="POST" >
                                    @csrf 
                                    @method('PUT')
                                    <fieldset class="form-fieldset">
                                    <div class="row">
                                        <div class="col-12 mt-2 ps-2">
                                            <fieldset class="form-fieldset">
                                                <div class="row">
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">State</label>
                                                        <select required class="form-select" name="stateId">
                                                        <option disabled selected>-select state-</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}" {{ $data->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Vehicle Type</label>
                                                        <select required class="form-select" name="vehicleType" >
                                                            <option selected disabled>-select vehicle type-</option>
                                                            @foreach ($vehicleType as $vehicleType)
                                                                <option value="{{ $vehicleType->id }}" {{ $data->vehicle_type_id == $vehicleType->id ? 'selected' : '' }} >{{ $vehicleType->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $data->id }}" class="form-control"  autocomplete="off" required/>
                                               
                                       <fieldset>
                                            <legend>Random Plate Number</legend>
                                             <div class="row">
                                                <div class="mb-3 col-3">
                                                    <label class="form-label required">Vehicle License </label>
                                                    <input type="number" name="random_vehicleLicense" value="{{ $data->random_vehicleLicense }}" class="form-control"  autocomplete="off" required/>
                                                </div>
                                                <div class="mb-3 col-3">
                                                    <label class="form-label required">Hacney Permit</label>
                                                    <input type="number" name="random_hacneyPermit" class="form-control" value="{{ $data->random_hacneyPermit }}" autocomplete="off" required/>
                                                </div>
                                                <div class="mb-3 col-3">
                                                    <label class="form-label required">Police CMRIS</label>
                                                    <input type="number" name="random_policeCmris" class="form-control" value="{{ $data->random_policeCmris }}" autocomplete="off" required/>
                                                </div>
                                                <div class="mb-3 col-3">
                                                    <label class="form-label required">Cost</label>
                                                    <input type="number" name="random_cost" class="form-control" value="{{ $data->random_cost }}" autocomplete="off" required/>
                                                </div>
                                             </div> 
                                        </fieldset>
                                        <fieldset>
                                            <legend>Customised Plate Number</legend>
                                            <div class="row">
                                               <div class="mb-3 col-3">
                                                    <label class="form-label required">Vehicle License </label>
                                                    <input type="number" name="customised_vehicleLicense" class="form-control" value="{{ $data->customised_vehicleLicense }}" autocomplete="off" required/>
                                                </div>
                                                <div class="mb-3 col-3">
                                                    <label class="form-label required">Hacney Permit</label>
                                                    <input type="number" name="customised_hacneyPermit" class="form-control" value="{{ $data->customised_hacneyPermit }}"  autocomplete="off" required/>
                                                </div>
                                                <div class="mb-3 col-3">
                                                    <label class="form-label required">Police CMRIS</label>
                                                    <input type="number" name="customised_policeCmris" class="form-control" value="{{ $data->customised_policeCmris }}" autocomplete="off" required/>
                                                </div>
                                                <div class="mb-3 col-3">
                                                    <label class="form-label required">Cost</label>
                                                    <input type="number" name="customised_cost" class="form-control" value="{{ $data->customised_cost }}" autocomplete="off" required/>
                                                </div>
                                               
                                                <div class="mb-3 col-3">
                                                
                                                    <button type="submit" class="btn btn-primary ms-auto">Update Change of Ownership Price</button>    
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