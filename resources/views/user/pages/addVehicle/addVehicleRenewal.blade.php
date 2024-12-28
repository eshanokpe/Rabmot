@extends('user.layouts.app') 

@section('content')

	<!--page-wrapper--> 
	<div class="page-wrapper">
		<!--page-content-wrapper-->
		<div class="page-content-wrapper">
			<div class="page-content"> 
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Vehicle </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ route('home.addVehicle') }}"><i class="bx bx-car"></i></a>
								</li> 
								<li class="breadcrumb-item active" aria-current="page">+Add New Vehicle (Renewal) <i class="bx bx-car" style="color:red;"></i></li>
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
								{{ session('error') }}
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
								
								<form class="row g-3" method="POST" action="{{ route('home.postAddVehicleRenewal') }}" enctype="multipart/form-data">
									@csrf
									<div class="col-md-12">
										<label for="inputState" class="form-label">Select Category of Vehicle <span style="color:red;">*</span></label>
										
										<select required name="category" id="inputState" class="form-select">
											<option disabled selected="selected" value="">-- Select Category of Vehicle--</option>
											{{-- <option value = "00" data-id="00" > + Add New Vehicle </option> --}}
											@foreach($vehicleList as $vehicleList) 
											<option value="{{$vehicleList->id}}"> {{$vehicleList->name}} </option>
											@endforeach
										</select>
										@error('category')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-4">
										<label for="inputFirstName" class="form-label">Vehicle Make (e.g Toyota) <span style="color:red;">*</span></label>
										<input required type="text" name="vehiclemake" class="form-control" id="vehiclemake" placeholder="Vehicle Make (e.g Toyota)">
										@error('vehiclemake')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div> 

									<div class="col-sm-6 col-md-4">
										<label for="inputLastName" class="form-label">Vehicle Model (e.g Corolla) <span style="color:red;">*</span></label>
										<input required type="text" name="vehiclemodel" class="form-control" id="vehiclemodel" placeholder="Vehicle Model (e.g Corolla)">
										@error('vehiclemodel')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-4">
										<label for="inputEmail" class="form-label">Year of Make (e.g 2000)</label>
									
										<select name="year0fmake" id="inputState" class="form-select">
											<option selected="selected" disabled>-- select year </option>
											<option value="2000">2000</option>
											<option value="2001">2001</option>
											<option value="2002">2002 </option>
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
											<option value="2024"> 2024 </option>
											<option value="2025"> 2025 </option>
											<option value="2026"> 2026 </option>
											<option value="2027"> 2027 </option>
											<option value="2028"> 2028 </option>
											<option value="2029"> 2029 </option>
											<option value="2030"> 2030 </option>
											<option value="2031"> 2031 </option>
											<option value="2032"> 2032 </option>
											<option value="2033"> 2033 </option>
											<option value="2034"> 2034 </option>
											<option value="2035"> 2035 </option>
											<option value="2036"> 2036 </option>
											<option value="2037"> 2037 </option>
											<option value="2038"> 2038 </option>
											<option value="2039"> 2039 </option>
											<option value="2040"> 2040 </option>
										</select>
										@error('year0fmake')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-4">
										<label for="inputPassword" class="form-label">Registration/Plate Number <span style="color:red;">*</span></label>
										<input required type="text" class="form-control" name="platenumber" id="platenumber" placeholder="Registration/Plate Number">
										@error('platenumber')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-4">
										<label for="inputAddress" class="form-label">Chassis Number</label>
										<input  type="text" class="form-control" name="chassisnumber" id="chassisnumber" placeholder="Chassis Number">
										@error('chassisnumber')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-4">
										<label for="inputAddress2" class="form-label">Engine Number</label>
										<input  type="text" class="form-control" name="enginenumber" id="enginenumber" placeholder="Engine Number ">
										@error('enginenumber')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputState" class="form-label">Select Color <span style="color:red;">*</span></label>
										<select required name="vehiclecolor" id="inputState" class="form-select">
											<option selected="selected" value="">-- Select Color--</option>
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
										@error('vehiclecolor')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Name written on Vehicle Paper <span style="color:red;">*</span></label>
										<input required  type="text" class="form-control" name="vehiclename" id="enginenumber" placeholder="Name written on Vehicle Paper"> 
										@error('vehiclename')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputState" class="form-label">What type of Name is on your document?</label>
										<select name="vehicledocumentname" id="inputState" class="form-select">
											<option selected="selected" disabled>-- select -- </option>
											<option value="Ash">Individual Name Only</option>
											<option value="Black">Individual & Company Name</option>
											<option value="Black"> Company Name Only </option>
										</select>
										@error('vehicledocumentname')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div> 
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Owners' Phone Number  <span style="color:red;">*</span></label>
										<input  type="text" class="form-control" name="ownersphonenumber" id="ownersphonenumber" placeholder="Phone of Vehicle">
										@error('ownersphonenumber')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label">Registered Address of Vehicle </label>
										<input  type="text" class="form-control" name="registeredaddressofvehicle" id="registeredaddressofvehicle" placeholder="Registered Address of Vehicle">
										@error('registeredaddressofvehicle')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Email Address</label>
										<input  type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="Address of Vehicle">
										@error('emailAddress')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<hr>
									<h6 class="mb-0 text-uppercase"><b>Expiry Dates Of Documents</b></h6>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Vehicle License </label>
										<input  type="date" class="form-control" name="vehiclelicenseexpiry" id="vehiclelicenseexpiry" >
										@error('vehiclelicenseexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Insurance  </label>
										<input  type="date" class="form-control" name="insuranceexpiry" id="insuranceexpiry" >
										@error('insuranceexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Road Worthiness  </label>
										<input  type="date" class="form-control" name="roadworthinessexpiry" id="roadworthinessexpiry" >
										@error('roadworthinessexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Hackney Permit (if applicable) </label>
										<input  type="date" class="form-control" name="hackneypermitexpiry" id="hackneypermitexpiry" >
										@error('hackneypermitexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> State Carriage Permit  (if applicable) </label>
										<input  type="date" class="form-control" name="statecarriagepermitexpiry" id="statecarriagepermitexpiry" >
										@error('statecarriagepermitexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Mid-Year Permit  (if applicable) </label>
										<input  type="date" class="form-control" name="hackneydutypermitexpiry" id="hackneydutypermitexpiry" >
										@error('hackneydutypermitexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="col-md-12 ">
										<label for="inputAddress2" class="form-label"> Local Government Permit  (if applicable) </label>
										<input  type="date"  class="form-control"  name="localgovernmentpermitexpiry" id="localgovernmentpermitexpiry" >
										@error('localgovernmentpermitexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<br>
									<hr>
									<div class="card radius-10 mb-3">
										<div class="card-body">
											<div class="card-title">
												<p class="mb-0"><b>Upload Expired Documents, and Means of ID  </b></p>
											</div>
											<hr/>
											<div class="row">
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Vehicle License Papers <span style="color:red;">*</span></label> 
													<input requied class="form-control" id="fancy-file-upload" type="file" name="vehiclelicensepapers" >
													@error('vehiclelicensepapers')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Insurance Papers <span style="color:red;">*</span></label>  
													<input requied class="form-control" id="fancy-file-upload" type="file" name="insurancepapers" >
													@error('insurancepapers')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Road Worthiness Papers <span style="color:red;">*</span></label> 
													<input requied class="form-control" id="fancy-file-upload" type="file" name="roadworthinesspapers" >
													@error('roadworthinesspapers')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Hackney Permit (if applicable) </label>  
													<input class="form-control" id="fancy-file-upload" type="file" name="hackneypermitpaper" >
													
												</div>
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">State Carriage Permit (if applicable) </label>  
													<input  class="form-control" id="fancy-file-upload" type="file" name="statecarriagepermit"  >
													
												</div>
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Mid-Year Permit (if applicable) </label>  
													<input  class="form-control" id="fancy-file-upload" type="file" name="midyearpermit"  >
												
												</div>
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Local Government Permit (if applicable) </label>  
													<input  class="form-control" id="fancy-file-upload" type="file" name="localgovernmentpermit"  >
													
												</div>
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Means of ID</label> <span style="color:red;">*</span> <br>
													<input requied class="form-control" id="fancy-file-upload" type="file" name="meansofid" >
													@error('meansofid')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>
										</div>
									</div>

									
									<div class="col-12 mt-10">
										<button type="submit" class="btn btn-primary px-5">Submit</button>
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
	
@endsection