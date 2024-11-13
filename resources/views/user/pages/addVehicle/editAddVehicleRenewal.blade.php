@extends('user.layouts.app') 

@section('content')

	<!-- wrapper -->
	<div class="wrapper">
		 
        <!--page-wrapper-->
        <div class="page-wrapper">
            <!--page-content-wrapper-->
            <div class="page-content-wrapper">
                <div class="page-content"> 
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3">Edit Vehicle </div>
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/home/addvehicle') }}"><i class="bx bx-car"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit New Vehicle (Renewal) <i class="bx bx-car" style="color:red;"></i></li>
                                </ol>
                            </nav>
                        </div> 
                        
                    </div>
                    <!--end breadcrumb-->

                    <div class="row">
                        @if (session('success'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            </div>
                        @endif
                        @if (session('error'))
                            <div class="col-sm-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            </div>
                        @endif
                        <div class="col-xl-10 mx-auto">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-car me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Vehicle Details</h5>
                            </div>
                            <hr>
                            <div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body p-5">
                                    
                                    <form class="row g-3" method="POST" action="{{ route('update.vehiclePaperRenewal', ['id' => $vehicleId->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') 
                                        <div class="col-sm-6 col-md-4">
                                            <label for="inputFirstName" class="form-label">Vehicle Make (e.g Toyota) <span style="color:red;">*</span></label>
                                            <input required type="text" name="vehiclemake" class="form-control" value="{{ $vehicleId->vehiclemake}}" placeholder="Vehicle Make (e.g Toyota)">
                                        </div> 

                                        <div class="col-sm-6 col-md-4">
                                            <label for="inputLastName" class="form-label">Vehicle Model (e.g Corolla) <span style="color:red;">*</span></label>
                                            <input required type="text" name="vehiclemodel" class="form-control" value="{{ $vehicleId->vehiclemodel}}" id="vehiclemodel" placeholder="Vehicle Model (e.g Corolla)">
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <label for="inputEmail" class="form-label">Year of Make (e.g 2000)</label>
                                            <select name="year0fmake" id="inputState" class="form-select">
                                                <option selected="selected" disabled>{{ $vehicleId->year0fmake}}</option>
                                                <option value="2000">2000</option>
                                                <option value="2001">2001</option>
                                                <option value="2002"> 2002 </option>
                                                <option value="2003">2003</option>
                                                <option value="2004">2004</option>
                                                <option value="2005"> 2005 </option>
                                                <option value="2006">2006</option>
                                                <option value="2007">2007</option>
                                                <option value="2008"> 2008 </option>
                                                <option value="2009">2009</option>
                                                <option value="2010">2010</option>
                                                <option value="2011"> 2011 </option>
                                                <option value="2012">2012</option>
                                                <option value="2013">2013</option>
                                                <option value="2014"> 2014 </option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                                <option value="2017"> 2017 </option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020"> 2020 </option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023"> 2023 </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <label for="inputPassword" class="form-label">Registration/Plate Number <span style="color:red;">*</span></label>
                                            <input required type="text" value="{{ $vehicleId->platenumber}}" class="form-control" name="platenumber" id="platenumber" placeholder="Registration/Plate Number">
                                            </div>
                                        <div class="col-sm-6 col-md-4">
                                            <label for="inputAddress" class="form-label">Chassis Number</label>
                                            <input required type="text" class="form-control" value="{{ $vehicleId->chassisnumber}}" name="chassisnumber" id="chassisnumber" placeholder="Chassis Number">
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <label for="inputAddress2" class="form-label">Engine Number</label>
                                            <input required type="text" class="form-control" value="{{ $vehicleId->enginenumber}}" name="enginenumber" id="enginenumber" placeholder="Engine Number (Optional)">
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputState" class="form-label">Select Color <span style="color:red;">*</span></label>
                                            <select  name="vehiclecolor" id="inputState" class="form-select">
                                                <option selected="selected" disabled>{{ $vehicleId->vehiclecolor}}</option>
                                                <option value="Ash">Ash</option>
                                                <option value="Black">Black</option>
                                                <option value="Blue">Blue</option>
                                                <option value="Brown">Brown</option>
                                                <option value="Cream">Cream</option>
                                                <option value="Custom">Custom</option>
                                                <option value="Gold">Gold</option>
                                                <option value="Green">Green</option>
                                                <option value="Grey">Grey</option>
                                                <option value="Indigo">Indigo</option>
                                                <option value="Lemon">Lemon</option>
                                                <option value="Maroon">Maroon</option>
                                                <option value="Orange">Orange</option>
                                                <option value="Pink">Pink</option>
                                                <option value="Purple">Purple</option>
                                                <option value="Red">Red</option>
                                                <option value="Silver">Silver</option>
                                                <option value="Sky Blue">Sky Blue</option>
                                                <option value="Violet">Violet</option>
                                                <option value="White">White</option>
                                                <option value="Wine">Wine</option>
                                                <option value="Yellow">Yellow</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Name written on Vehicle Paper <span style="color:red;">*</span></label>
                                            <input value="{{ $vehicleId->vehiclename}}"  required  type="text" class="form-control" name="vehiclename" id="enginenumber" placeholder="Vehicle Name"> 
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputState" class="form-label">What type of Name is on your document?</label>
                                            <select name="vehicledocumentname" id="inputState" class="form-select">
                                                <option selected="selected" disabled>{{ $vehicleId->vehicledocumentname}} </option>
                                                <option value="Individual Name Only">Individual Name Only</option>
                                                <option value="Individual & Company Name">Individual & Company Name</option>
                                                <option value=" Company Name Only"> Company Name Only </option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Owners' Phone Number  <span style="color:red;">*</span></label>
                                            <input required type="text" class="form-control" value="{{ $vehicleId->ownersphonenumber}}" name="ownersphonenumber" id="ownersphonenumber" placeholder="Phone of Vehicle">
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label">Registered Address of Vehicle </label>
                                            <input  type="text" class="form-control" value="{{ $vehicleId->registeredaddressofvehicle}}" name="registeredaddressofvehicle" id="registeredaddressofvehicle" placeholder="Address of Vehicle">
                                            
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Email Address</label>
                                            <input  type="email" value="{{ $vehicleId->emailAddress }}" class="form-control" name="emailAddress" id="emailAddress" placeholder="Address of Vehicle">
                                            
                                        </div>

                                        <hr>
                                        <h6 class="mb-0 text-uppercase"><b>Expiry Dates Of Documents</b></h6>

                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Vehicle License </label>
                                            <input required type="date" class="form-control" value="{{$vehicleId->vehiclelicenseexpiry}}" name="vehiclelicenseexpiry" id="vehiclelicenseexpiry" >
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Insurance  </label>
                                            <input required type="date" class="form-control" value="{{$vehicleId->insuranceexpiry}}" name="insuranceexpiry" id="insuranceexpiry" >
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Road Worthiness  </label>
                                            <input required type="date" class="form-control" value="{{$vehicleId->roadworthinessexpiry}}" name="roadworthinessexpiry" id="roadworthinessexpiry" >
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Hackney Permit (if applicable) </label>
                                            <input  type="date" class="form-control"  value="{{$vehicleId->hackneypermitexpiry}}" name="hackneypermitexpiry" id="hackneypermitexpiry" >
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> State Carriage Permit  (if applicable) </label>
                                            <input required type="date" class="form-control" value="{{$vehicleId->statecarriagepermitexpiry}}"  name="statecarriagepermitexpiry" id="statecarriagepermitexpiry" >
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label for="inputAddress2" class="form-label"> Mid-Year Permit  (if applicable) </label>
                                            <input required type="date" class="form-control" value="{{$vehicleId->hackneydutypermitexpiry}}" name="hackneydutypermitexpiry" id="hackneydutypermitexpiry" >
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="inputAddress2" class="form-label"> Local Government Permit  (if applicable) </label>
                                            <input  type="date"  class="form-control" value="{{$vehicleId->localgovernmentpermitexpiry}}" name="localgovernmentpermitexpiry" id="localgovernmentpermitexpiry" >
                                        </div>
                                        
                                        <hr>
                                        
                                        <div class="col-12 mt-10 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary px-5">Update Vehicle Paper Renewal</button>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--end page-content-wrapper-->
        </div>
        <!--end page-wrapper-->
    </div>
@endsection