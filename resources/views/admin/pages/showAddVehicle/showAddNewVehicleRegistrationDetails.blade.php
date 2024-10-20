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
                            View New Vehicle Registration Details
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
                                <h3 class="card-title">New Vehicle Registration</h3>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var successAlert = document.getElementById('error-alert');
                                    if (successAlert) {
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); 
                                    }
                                });
                            </script>

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
                                            <input type="text" name="user_email" class="form-control" autocomplete="off" value="{{ $items->user_email}}" disabled/>
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
                                            <div style="font-weight:bold">{{ $items->year_of_make }}</div>

                                            <input type="number" name="year_of_make" class="form-control" 
                                            min="1900" max="{{ date('Y') }}" autocomplete="off" 
                                            value="{{ $items->year_of_make }}" placeholder="Year of Make" />
                                     
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
                                            <label class="form-label">Name On Document</label>
                                            <div style="font-weight:bold">{{ $items->applicantfullname }}</div>
                                            <input type="text" name="applicantfullname" class="form-control" autocomplete="off" value="{{ $items->applicantfullname}}" />
                                        </div>
                                        
                                         <div class="mb-3 col-3">
                                            <label class="form-label">Applicant NIN</label>
                                            <div style="font-weight:bold">{{ $items->applicantNIN }}</div>
                                            <input type="text" name="applicantNIN" class="form-control" autocomplete="off" value="{{ $items->applicantNIN}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Residential address</label>
                                            <div style="font-weight:bold">{{ $items->residentialaddress }}</div>
                                            <input type="text" name="residentialaddress" class="form-control" autocomplete="off" value="{{ $items->residentialaddress}}" />
                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Owner's Number</label>
                                            <div style="font-weight:bold">{{ $items->phonenumber }}</div>
                                            <input type="text" name="phonenumber" class="form-control" autocomplete="off" value="{{ $items->phonenumber}}" />
                                        </div>


                                        <div class="mb-3 col-3">
                                            <label class="form-label">Email Address</label>
                                            <div style="font-weight:bold">{{ $items->emailaddress }}</div>
                                            <input type="text" name="emailaddress" class="form-control" autocomplete="off" value="{{ $items->emailaddress}}" />
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
                                            <div style="font-weight:bold">{{ $items->date }}</div>
                                            <input type="date" name="insuranceexpiry" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" />
                                        </div>

                                        <div class="mb-3 col-3">

                                            <label class="form-label">Marital Status</label>
                                            <div style="font-weight:bold">{{ $items->maritalstatus }}</div>
                                            <input type="text" name="maritalstatus" class="form-control" autocomplete="off"  value="{{ $items->maritalstatus}}" />

                                        </div>

                                        <div class="mb-3 col-3">
                                            <label class="form-label">State</label>
                                            <div style="font-weight:bold">{{ $items->state }}</div>
                                            <input type="text" class="form-control" autocomplete="off" name="state"  value="{{ $items->state}}" />
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Custom Papers Document</label>
                                            <div class="input-group">
                                                <a href="{{ route('vehicle.registration.custom.paper.download', ['id' => encrypt($items->id) ]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Means of ID Document</label>
                                            <div class="input-group">
                                                <a href="{{ route('vehicle.registration.means.of.id.download', ['id' => encrypt($items->id) ]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </div>
    
                                        </div>


                                    </div>
                                    
                                    <div class="mb-3 ">
                                        <input type="submit" class="btn btn-primary ms-auto" value="Update" />
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <a href="{{route('admin.vehicle.registrations.new')}}"><button  class="btn btn-primary ms-auto">Back</button></a>    

                                    </div>

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