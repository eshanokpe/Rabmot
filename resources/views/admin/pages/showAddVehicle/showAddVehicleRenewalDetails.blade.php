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
                        View Vehicle Renewal Details
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

                            <h3 class="card-title">Vehicle Renewal</h3>

                        </div>
                        @if(session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="col-12 mt-2 ps-2">

                            <form method="POST"
                                action="{{ route('admin.vehicle.renewals.update', $items->id) }}"
                                class="form-fieldset">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="mb-3 col-3">

                                        <label class="form-label required">User Email</label>

                                        <input type="text" class="form-control" autocomplete="off"
                                            value="{{ $items->user_email }}" disabled />

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label required">Category</label>
                                        <div style="font-weight:bold">{{ $items->vehicleTypeInfo->name }}</div>
                                        <select required name="category" id="inputState" class="form-select">
                                            <option selected="selected" value="{{ $items->vehicleTypeInfo->id }}">
                                                {{ $items->vehicleTypeInfo->name }}</option>
                                            @foreach($vehicleList as $vehicleList)
                                                <option value="{{ $vehicleList->id }}"> {{ $vehicleList->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label required">Vehicle Make</label>
                                        <div style="font-weight:bold">{{ $items->vehiclemake }}</div>
                                        <input type="text" name="vehiclemake" class="form-control" autocomplete="off"
                                            value="{{ $items->vehiclemake }}" />

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Vehicle Model</label>
                                        <div style="font-weight:bold">{{ $items->vehiclemodel }}</div>
                                        <input type="text" name="vehiclemodel" class="form-control" autocomplete="off"
                                            value="{{ $items->vehiclemodel }}" />

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Year Of Make</label>
                                        <div style="font-weight:bold">{{ $items->year0fmake }}</div>
                                        <input type="text" name="year0fmake" class="form-control" autocomplete="off"
                                            value="{{ $items->year0fmake }}" />

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Plate Number</label>
                                        <div style="font-weight:bold">{{ $items->platenumber }}</div>
                                        <input type="text" name="platenumber" class="form-control" autocomplete="off"
                                            value="{{ $items->platenumber }}" />

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Chasis Number</label>
                                        <div style="font-weight:bold">{{ $items->chassisnumber }}</div>
                                        <input type="text" name="chassisnumber" class="form-control" autocomplete="off"
                                            value="{{ $items->chassisnumber }}" />

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Engine Number</label>
                                        <div style="font-weight:bold">{{ $items->enginenumber }}</div>
                                        <input type="text" name="enginenumber" class="form-control" autocomplete="off"
                                            value="{{ $items->enginenumber }}" />

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Vehicle Color</label>
                                        <div style="font-weight:bold">{{ $items->vehiclecolor }}</div>
                                        <input type="text" name="vehiclecolor" class="form-control" autocomplete="off"
                                            value="{{ $items->vehiclecolor }}" />

                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label"> Name on Document</label>
                                        <div style="font-weight:bold">{{ $items->vehiclename }}</div> 
                                        <input type="text" name="vehiclename" class="form-control" autocomplete="off"
                                            value="{{ $items->vehiclename }}" />
                                    </div>

                                    

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Vehicle Document Name Type</label>
                                        <div style="font-weight:bold">{{ $items->vehicledocumentname }}</div>
                                        <select name="vehicledocumentname" id="inputState" class="form-select">
                                            <option selected="selected" value="{{ $items->vehicledocumentname }}">
                                                {{ $items->vehicledocumentname }}</option>
                                            <option value="Individual Name Only">Individual Name Only</option>
                                            <option value="Individual & Company Name">Individual & Company Name</option>
                                            <option value="Company Name Only"> Company Name Only </option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Owner's Number</label>
                                        <div style="font-weight:bold">{{ $items->ownersphonenumber }}</div>
                                        <input type="text" name="ownersphonenumber" class="form-control"
                                            autocomplete="off" value="{{ $items->ownersphonenumber }}" />
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Register Address Of Vehicle</label>
                                        <div style="font-weight:bold">{{ $items->registeredaddressofvehicle }}</div>
                                        <input type="text" name="registeredaddressofvehicle" class="form-control"
                                            autocomplete="off" value="{{ $items->registeredaddressofvehicle }}" />
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Email Address</label>
                                        <div style="font-weight:bold">{{ $items->emailAddress }}</div>
                                        <input type="text" name="emailAddress" class="form-control" autocomplete="off"
                                            value="{{ $items->emailAddress }}" />
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="mb-3 col-3">
                                        <label class="form-label">Vehicle License Expiry Date</label>
                                        @php
                                            $date = \Carbon\Carbon::parse($items->vehiclelicenseexpiry);
                                        @endphp
                                        <div style="font-weight:bold">
                                            {{ $date->format('F j, Y') }}</div>
                                        <input type="date" name="vehiclelicenseexpiry" class="form-control"
                                            autocomplete="off"
                                            value="{{ $date->format('Y-m-d') }}" required />
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Vehicle Insurance Expiry Date</label>
                                        @php
                                            $date2 = \Carbon\Carbon::parse($items->insuranceexpiry);
                                        @endphp
                                        <div style="font-weight:bold">
                                            {{ $date2->format('F j, Y') }}</div>
                                        <input type="date" name="insuranceexpiry" class="form-control"
                                            autocomplete="off"
                                            value="{{ $date2->format('Y-m-d') }}" required />
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Road Worthiness Expiry Date</label>
                                        @php
                                            $date3 = \Carbon\Carbon::parse($items->roadworthinessexpiry);
                                        @endphp
                                        <div style="font-weight:bold">
                                            {{ $date3->format('F j, Y') }}</div>
                                        <input type="date" name="roadworthinessexpiry" class="form-control"
                                            autocomplete="off"
                                            value="{{ $date3->format('Y-m-d') }}" required />
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Hackney Permit Expiry Date</label>
                                        @php
                                            $date4 = \Carbon\Carbon::parse($items->hackneypermitexpiry);
                                        @endphp
                                        <div style="font-weight:bold">
                                            {{ $date4->format('F j, Y') }}</div>
                                        <input type="date" name="hackneypermitexpiry" class="form-control"
                                            autocomplete="off"
                                            value="{{ $date4->format('Y-m-d') }}" required />
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">State Carriage Permit Expiry Date</label>
                                        @php
                                            $date5 = \Carbon\Carbon::parse($items->statecarriagepermitexpiry);
                                        @endphp
                                        <div style="font-weight:bold">
                                            {{ $date5->format('F j, Y') }}</div>
                                        <input type="date" name="statecarriagepermitexpiry" class="form-control"
                                            autocomplete="off"
                                            value="{{ $date5->format('Y-m-d') }}" />
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Hackney Duty Permit Expiry Date</label>
                                        @php
                                            $date6 = \Carbon\Carbon::parse($items->hackneydutypermitexpiry);
                                        @endphp
                                        <div style="font-weight:bold">
                                            {{ $date6->format('F j, Y') }}</div>
                                        <input type="date" name="hackneydutypermitexpiry" class="form-control"
                                            autocomplete="off"
                                            value="{{ $date6->format('Y-m-d') }}" />

                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Local Govt. Permit Expiry Date</label>
                                        @php
                                            $date7 = \Carbon\Carbon::parse($items->localgovernmentpermitexpiry);
                                        @endphp
                                        <div style="font-weight:bold"> 
                                            {{ $date7->format('F j, Y') }}</div>
                                        <input type="date" name="localgovernmentpermitexpiry" class="form-control"
                                            autocomplete="off"
                                            value="{{ $date7->format('Y-m-d') }}" />

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="mb-3 col-3">

                                        <label class="form-label">Vehicle License Document</label>

                                        <div class="input-group">
                                            <a href="{{ route('vehicle.license.papers.download', ['id' => encrypt($items->id)]) }}"
                                                class="btn btn-primary">Download</a>
                                        </div>

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Vehicle Insurance Document</label>

                                        <div class="input-group">
                                            <a href="{{ route('vehicle.insurance.papers.download', ['id' => encrypt($items->id)]) }}"
                                                class="btn btn-primary">Download</a>
                                        </div>

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Road Worthiness Document</label>

                                        <div class="input-group">
                                            <a href="{{ route('vehicle.roadworthiness.download', ['id' => encrypt($items->id) ]) }}"
                                                class="btn btn-primary">Download</a>
                                        </div>

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">Hackney Permit Document</label>

                                        <div class="input-group">
                                            <a href="{{ route('vehicle.hackney.permit.download', ['id' => encrypt($items->id) ]) }}"
                                                class="btn btn-primary">Download</a>
                                        </div>

                                    </div>

                                    <div class="mb-3 col-3">

                                        <label class="form-label">State Carriage Permit Document</label>

                                        <div class="input-group">
                                            <div class="input-group">
                                                <a href="{{ route('vehicle.state.carriage.permit.download', ['id' => encrypt($items->id) ]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Local Govt. Permit Document</label>
                                        <div class="input-group">

                                            <a href="{{ route('vehicle.local.government.permit.download', ['id' => encrypt($items->id) ]) }}"
                                                class="btn btn-primary">Download</a>

                                        </div>
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Mid year Permit</label>
                                        <div class="input-group">
                                            <a href="{{ route('vehicle.midyear.permit.download', ['id' => encrypt($items->id) ]) }}"
                                                class="btn btn-primary">Download</a>

                                        </div>
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label class="form-label">Means of ID</label>
                                        <div class="input-group">
                                            <a href="{{ route('vehicle.means.of.id.download', ['id' => encrypt($items->id) ]) }}"
                                                class="btn btn-primary">Download</a>
                                        </div>

                                    </div>



                                </div>

                                <div class="row pt-3">
                                    <div class="mb-3 col-6">
                                        <a href="{{ route('admin.vehicle.renewals') }}"
                                                class="btn btn-primary ms-auto">Back</a>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <input type="submit" class="btn btn-primary ms-auto" value="Update" />
                                    </div>
                                </div>
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
