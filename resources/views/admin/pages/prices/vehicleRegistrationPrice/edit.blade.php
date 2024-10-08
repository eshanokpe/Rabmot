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
                            View Vehicle Registration Price
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
                                <h3 class="card-title">Edit Vehicle Registration Price</h3>
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
                                <fieldset class="form-fieldset">
                                     <form action="{{ route("admin.vehicleRegistrationPrice.update", $data->id) }}" method="POST" >
                                        @csrf 
                                        @method('PUT')
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
                                        <div class="card">
                                            <div class="col-12 mt-2 ps-2">
                                            <fieldset>
                                                 <input type="hidden" name="id" class="form-control" value="{{ $data->id }}"  autocomplete="off"/>
                                            
                                                <legend>Random Plate Number</legend> 
                                                    <div class="row">
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Private Vehicle with 3rd/P Insurance </label>
                                                        <input required type="number" name="random_private_vehicle_3rd_party_insurance" value={{$data->random_private_vehicle_3rd_party_insurance}} class="form-control"  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Private Vehicle with No Insurance</label>
                                                        <input required type="number" name="random_plate_private_vehicle_no_insurance" value={{$data->random_plate_private_vehicle_no_insurance}} class="form-control"  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Comercial Vehicle with 3rd/P Insurance</label>
                                                        <input required type="number" name="random_commercial_plate_3rd_party_insurance" class="form-control" value={{$data->random_commercial_plate_3rd_party_insurance}}  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Comercial Vehicle with No Insurance</label>
                                                        <input required type="number" name="random_plate_no_commercial_vehicle_no_insurance" class="form-control" value={{$data->random_plate_no_commercial_vehicle_no_insurance}}  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Hackney Permit</label>
                                                        <input required type="number" name="random_plate_hackney_permit" class="form-control" value={{$data->random_plate_hackney_permit}}  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Police CMRIS</label>
                                                        <input required type="number" name="random_plate_police_cmris" class="form-control" value={{$data->random_plate_hackney_permit}}  autocomplete="off"/>
                                                    </div>
                                                    </div> 
                                            </fieldset> 
                                            <fieldset>
                                                <legend>Customised Plate Number</legend>
                                                <div class="row">
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Private Vehicle with 3rd/P Insurance </label>
                                                        <input required type="number" name="customized_private_vehicle_3rd_party_insurance"  value={{$data->customized_private_vehicle_3rd_party_insurance}} class="form-control"  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Private Vehicle with No Insurance</label>
                                                        <input required type="number" name="customised_plate_private_vehicle_no_insurance"  value={{$data->customised_plate_private_vehicle_no_insurance}} class="form-control"  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Comercial Vehicle with 3rd/P Insurance</label>
                                                        <input required type="number" name="customised_commercial_plate_3rd_party_insurance"  value={{$data->customised_commercial_plate_3rd_party_insurance}} class="form-control"  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Comercial Vehicle with No Insurance</label>
                                                        <input required type="number" name="customized_plate_no_commercial_vehicle_no_insurance"  value={{$data->customized_plate_no_commercial_vehicle_no_insurance}} class="form-control"  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Hackney Permit</label>
                                                        <input required type="number" name="customized_plate_hackney_permit" class="form-control"  value={{$data->customized_plate_hackney_permit}}  autocomplete="off"/>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label class="form-label required">Police CMRIS</label>
                                                        <input required type="number" name="customised_plate_police_cmris" class="form-control"   value={{$data->customised_plate_police_cmris}} autocomplete="off"/>
                                                    </div>
                                                    
                                                    <div class="mb-3 col-3">
                                                    <label class="form-label">   .</label>
                                                        <button type="submit" class="btn btn-primary ms-auto">Update Vehicle Registration Price</button>    
                                                    </div>
                                                </div>
                                            </fieldset>
                                            </div>
                                        </div>
                                    </form>
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