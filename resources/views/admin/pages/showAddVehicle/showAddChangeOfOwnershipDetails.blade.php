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
                            @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                            <div class="col-12 mt-2 ps-2">

                                <fieldset class="form-fieldset">

                                    <div class="row">
                                        
                                        <div class="mb-3 col-3">

                                            <label class="form-label required">User Email</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->user_email}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label required">Category</label>

                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->vehicleTypeInfo ? $items->vehicleTypeInfo->name : 'N/A'}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label required">Vehicle Make</label>

                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->vehiclemake}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle Model</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehiclemodel}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Year Of Make</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->yearofmake}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Plate Number</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->platenumber}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Chasis Number</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->chassisnumber}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Engine Number</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->enginenumber}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle Color</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehiclecolor}}" disabled />

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle License</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehiclelicense}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Document Name Type</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehicledocumentname}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle Document Name</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->vehicledocumentname}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Register Address Of Vehicle</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->registeredaddressofvehicle}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Owner Fullname</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->ownerfullname}}" disabled/>
                                        </div>
                                        
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Owner NIN</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->ownersNIN}}" disabled/>
                                        </div>
                                        
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->address}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Phone number</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->phonenumber}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->emailaddress}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Gender</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->gender}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Occupation</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->occupation}}" disabled/>
                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle License Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->vehiclelicenseexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Vehicle Insurance Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->vehiclelicenseexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Road Worthiness Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->roadworthinessexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Hackney Permit Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->hackneypermitexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">State Carriage Permit Expiry Date</label>

                                            @php
                                                $date = \Carbon\Carbon::parse($items->statecarriagepermitexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>


                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Mid year permit</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->midyearpermit);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Local Govt. Permit Expiry Date</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->localgovernmentpermitexpiry);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

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


                                        <div class="mb-3 col-6">

                                            <a href="{{route('admin.changeOfOwnership')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    

                                        </div>

                                    </div>
                                    

                                </fieldset>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <footer class="footer footer-transparent d-print-none">

            <div class="container-xl">

                <div class="row text-center align-items-center flex-row-reverse">

                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">

                        <ul class="list-inline list-inline-dots mb-0">

                            <li class="list-inline-item">

                                Rabmot © 2023 | Developed By : ODD.Creatives

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </footer>

    </div>

</div>

@endsection