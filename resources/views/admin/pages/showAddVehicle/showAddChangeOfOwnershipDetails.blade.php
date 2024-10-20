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
                            View Change of owernship
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

                                <h3 class="card-title">Change of owernship</h3>
                                
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
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
                                    action="{{ route('admin.vehicle.changeOfOwnership.update', $items->id) }}"
                                    class="form-fieldset">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">User Email</label>
                                            <div style="font-weight:bold">{{ $items->user_email }}</div>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->user_email}}" disabled/>
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
                                            <input type="text" name="vehiclemake" class="form-control"  autocomplete="off" value="{{ $items->vehiclemake}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Model</label>
                                            <div style="font-weight:bold">{{ $items->vehiclemodel }}</div>
                                            <input type="text" name="vehiclemodel" class="form-control" autocomplete="off" value="{{ $items->vehiclemodel}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Year Of Make</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->yearofmake);
                                            @endphp
                                            <div style="font-weight:bold">{{ $date }}</div>
                                            <input type="text" name="yearofmake" class="form-control" autocomplete="off" value="{{ $items->yearofmake}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Plate Number</label>
                                            <div style="font-weight:bold">{{ $items->platenumber }}</div>
                                            <input type="text" name="platenumber" class="form-control" autocomplete="off" value="{{ $items->platenumber}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Chasis Number</label>
                                            <div style="font-weight:bold">{{ $items->chassisnumber }}</div>
                                            <input type="text" name="chassisnumber" class="form-control" autocomplete="off" value="{{ $items->chassisnumber}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Engine Number</label>
                                            <div style="font-weight:bold">{{ $items->enginenumber }}</div>
                                            <input type="text" name="enginenumber" class="form-control" autocomplete="off" value="{{ $items->enginenumber}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Color</label>
                                            <div style="font-weight:bold">{{ $items->vehiclecolor }}</div>
                                            <input type="text" name="vehiclecolor" class="form-control" autocomplete="off" value="{{ $items->vehiclecolor}}"  />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Paper name</label>
                                            <div style="font-weight:bold">{{ $items->vehiclepapername }}</div>
                                            <input type="text" name="vehiclepapername" class="form-control" autocomplete="off" value="{{ $items->vehiclepapername}}" />

                                        </div>

                                        {{-- <div class="mb-3 col-3">
                                            <label class="form-label">Document Name Type</label>
                                            <div style="font-weight:bold">{{ $items->vehicledocumentname }}</div>
                                            <input type="text" name="vehicledocumentname" class="form-control" autocomplete="off" value="{{ $items->vehicledocumentname}}" />

                                        </div> --}}

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Document Name</label>
                                            <div style="font-weight:bold">{{ $items->vehicledocumentname }}</div>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehicledocumentname}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Register Address Of Vehicle</label>
                                            <div style="font-weight:bold">{{ $items->registeredaddressofvehicle }}</div>
                                            <input type="text" name="registeredaddressofvehicle" class="form-control" autocomplete="off" value="{{ $items->registeredaddressofvehicle}}" />

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Owner Fullname</label>
                                            <div style="font-weight:bold">{{ $items->ownerfullname }}</div>
                                            <input type="text" name="ownerfullname" class="form-control" autocomplete="off" value="{{ $items->ownerfullname}}" />
                                        </div>
                                        
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Owner NIN</label>
                                            <div style="font-weight:bold">{{ $items->ownerfullname }}</div>
                                            <input type="text" name="ownersNIN" class="form-control" autocomplete="off" value="{{ $items->ownersNIN}}" />
                                        </div>
                                        
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Address</label>
                                            <div style="font-weight:bold">{{ $items->ownerfullname }}</div>
                                            <input type="text" name="address" class="form-control" autocomplete="off" value="{{ $items->address}}" />
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Phone number</label>
                                            <div style="font-weight:bold">{{ $items->phonenumber }}</div>
                                            <input type="number" name="phonenumber" class="form-control" autocomplete="off" value="{{ $items->phonenumber}}" />
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Email Address</label>
                                            <div style="font-weight:bold">{{ $items->emailaddress }}</div>
                                            <input type="text" name="emailaddress" class="form-control" autocomplete="off" value="{{ $items->emailaddress}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Gender</label>
                                            <div style="font-weight:bold">{{ $items->gender }}</div>
                                            <input type="text" name="gender" class="form-control" autocomplete="off" value="{{ $items->gender}}" />
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Occupation</label>
                                            <div style="font-weight:bold">{{ $items->occupation }}</div>
                                            <input type="text" name="occupation" class="form-control" autocomplete="off" value="{{ $items->occupation}}" />
                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle License Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->vehiclelicenseexpiry);
                                            @endphp
                                            <div style="font-weight:bold">{{ $date->format('F j, Y')  }}</div>
                                            <input type="date" name="vehiclelicenseexpiry" class="form-control" autocomplete="off"  value="{{ $date->format('Y-m-d') }}" />

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Vehicle Insurance Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->insuranceexpiry);
                                            @endphp
                                            <div style="font-weight:bold">{{ $date->format('F j, Y') }}</div>
                                            <input type="date" class="form-control" autocomplete="off" value="{{ $date->format('Y-m-d') }}" />
                                        </div>
                                        

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Road Worthiness Expiry Date</label>
                                            @php
                                                $dateW = \Carbon\Carbon::parse($items->roadworthinessexpiry);
                                            @endphp
                                            <div style="font-weight:bold">{{ $dateW->format('F j, Y')  }}</div>
                                            <input type="date" class="form-control" autocomplete="off"  value="{{ $dateW->format('Y-m-d') }}" />

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Hackney Permit Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->hackneypermitexpiry);
                                            @endphp
                                            <div style="font-weight:bold">{{ $date->format('F j, Y')  }}</div>
                                            <input type="date" class="form-control" autocomplete="off"  value="{{ $date->format('Y-m-d') }}" />

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">State Carriage Permit Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->statecarriagepermitexpiry);
                                            @endphp
                                            <div style="font-weight:bold">{{ $date->format('F j, Y')  }}</div>
                                            <input type="date" class="form-control" autocomplete="off"  value="{{ $date->format('Y-m-d') }}" />
                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Mid year permit</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->midyearpermit);
                                            @endphp
                                            <div style="font-weight:bold">{{ $date->format('F j, Y')  }}</div>
                                            <input type="date" class="form-control" autocomplete="off"  value="{{ $date->format('Y-m-d') }}" />

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Local Govt. Permit Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->localgovernmentpermitexpiry);
                                            @endphp
                                            <div style="font-weight:bold">{{ $date->format('F j, Y')  }}</div>
                                            <input type="date" class="form-control" autocomplete="off"  value="{{ $date->format('Y-m-d') }}" />

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle License Document</label>

                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnership.vehicle.license.download', ['id' => encrypt($items->id) ])}}" class="btn btn-primary">Download</a>
                                            </div>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Proof of Ownership Document</label>

                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnership.proof.download', ['id' => encrypt($items->id) ])}}" class="btn btn-primary">Download</a>
                                            </div>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Agreements Document</label>

                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnership.agreements.download', ['id' => encrypt($items->id)])}}" class="btn btn-primary">Download</a>
                                            </div>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Means of ID Document</label>

                                            <div class="input-group">
                                                <a href="{{route('changeOfOwnership.means.of.id.download', ['id' => encrypt($items->id) ])}}" class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ">
                                        <input type="submit" class="btn btn-primary ms-auto" value="Update" />
                                    </div>
                                </form>

                                <div class="mb-3 col-6">
                                    <a href="{{route('admin.changeOfOwnership')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

      
    </div>

</div>

@endsection