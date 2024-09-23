@extends('user.layouts.app') 
@section('content')

	<!--end sidebar-wrapper-->
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
								<li class="breadcrumb-item active" aria-current="page">+Add New Vehicle (Change of Ownership) <i class="bx bx-car" ></i></li>
							</ol>
						</nav>
					</div> 
				</div>

				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-10 mx-auto">
					@if (session('success'))
						<div class="col-sm-12">
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						</div>
					@endif
					</div>

					<div class="col-xl-10 mx-auto">
						<div class="card-title d-flex align-items-center">
							<div>
								<i class="bx bxs-car me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary">Vehicle Details</h5>
						</div>
						<hr>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<form class="row g-3" method="POST" action="{{ route('home.postAddVehicleOwnership') }}" enctype="multipart/form-data">
									@csrf
									<div class="col-md-12">
										<label for="inputState" class="form-label">Select Category of Vehicle <span style="color:red;">*</span></label>									
										<select required  name="category" id="inputState" class="form-select">
											<option disabled selected="selected" value="">-- Select Category of Vehicle--</option>
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
										<input  required type="text" name="vehiclemake" class="form-control" id="vehiclemake" placeholder="Vehicle Brand (e.g Toyota)">
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
										<select name="yearofmake" id="inputState" class="form-select">
											<option selected="selected" disabled>-- select year </option>
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
										@error('yearofmake')
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
										<input required type="text" class="form-control" name="vehiclepapername" id="enginenumber" placeholder=" Name on Vehicle Paper"> 
										@error('vehiclepaper')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputState" class="form-label">What type of Name is on your document?</label>
										<select name="vehicledocumentname" id="inputState" class="form-select">
											<option selected="selected" disabled>-- No Document -- </option>
											<option value="Ash">Individual Name Only</option>
											<option value="Black">Individual & Company Name</option>
											<option value="Black"> Company Name Only </option>
										</select>
										@error('vehicledocumentname')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label">Registered Address of Vehicle </label>
										<input  type="text" class="form-control" name="registeredaddressofvehicle" id="registeredaddressofvehicle" placeholder="Address of Vehicle">
										@error('registeredaddressofvehicle')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<hr>

									<h6 class="mb-0 text-uppercase"><b>New Owners Details</b></h6>
									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label">  Full Name <span style="color:red;">*</span></label>
										<input required type="text" class="form-control" name="ownerfullname" id="ownerfullname" placeholder="Full Name"> 
										@error('ownerfullname')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									
									<div class="col-md-6 col-md-6">
										<label for="inputAddress2" class="form-label"> New Owners NIN  <span style="color:red;">*</span></label>
										<input required type="number" class="form-control" name="ownersNIN" id="ownersNIN" placeholder="National Identity Number">
										@error('ownersNIN')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Address <span style="color:red;">*</span>  </label>
										<input required type="text" class="form-control" name="address" id="registeredaddressofvehicle" placeholder="Address">
										@error('address')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>								

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Phone Number <span style="color:red;">*</span></label>
										<input required type="text" class="form-control" name="phonenumber" id="registeredaddressofvehicle" placeholder="Phone Number">
										@error('phonenumber')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Email Address <span style="color:red;">*</span></label>
										<input required type="email" class="form-control" name="emailaddress" id="emailadress" placeholder="Email Address">
										@error('emailaddress')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Gender <span style="color:red;">*</span></label>
										<select required name="gender" id="inputState" class="form-select">
											<option selected="selected" disabled>-- Select Gender -- </option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
										@error('gender')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Occupation </label>
										<input  type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation ">
										@error('occupation')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<hr>

									<h6 class="mb-0 text-uppercase"><b>Expiry Dates Of Documents</b></h6>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Vehicle License </label>
										<input  type="date" class="form-control" name="vehiclelicenseexpiry" id="vehiclelicenseexpiry">
										@error('vehiclelicenseexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Insurance  </label>
										<input  type="date" class="form-control" name="insuranceexpiry" id="insuranceexpiry">
										@error('insuranceexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Road Worthiness  </label>
										<input  type="date" class="form-control" name="roadworthinessexpiry" id="roadworthinessexpiry">
										@error('roadworthinessexpiry')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Hackney Permit (if applicable) </label>
										<input  type="date" class="form-control" name="hackneypermitexpiry" id="hackneypermitexpiry">
										
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> State Carriage Permit  (if applicable) </label>
										<input  type="date" class="form-control" name="statecarriagepermitexpiry" id="statecarriagepermitexpiry">
										
									</div>

									<div class="col-sm-6 col-md-6">
										<label for="inputAddress2" class="form-label"> Mid-Year Permit  (if applicable) </label>
										<input  type="date" class="form-control" name="midyearpermit" id="midyearpermit">
										
									</div>

									<div class="col-md-12 mb-3">
										<label for="inputAddress2" class="form-label"> Local Government Permit  (if applicable) </label>
										<input  type="date" class="form-control" name="localgovernmentpermitexpiry" id="localgovernmentpermitexpiry">
									</div>

									<hr>

									<div class="card radius-10">
										<div class="card-body">
											<div class="card-title">
												<p class="mb-0"><b>Upload Expired Documents, and Means of ID  </b></p>
													<small><span style="color:red;">Upload the correct file format jpeg, jpg, docx, doc, png</span></small>
											</div>
											<hr/>
											<div class="row mb-3">
												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Vehicle License Papers </label> 
													<input class="form-control" id="fancy-file-upload" type="file" name="vehiclelicensepapers" multiple>
													@error('vehiclelicensepapers')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>

												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Proof Of Ownership </label>  
													<input class="form-control" id="fancy-file-upload" type="file" name="proofofownership" multiple>
													@error('proofofownership')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>

												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Signed Agreement From Both Parties </label>  
													<input class="form-control" id="fancy-file-upload" type="file" name="agreement"  multiple>
													@error('agreement')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>

												<div class="col-md-6 mb-3">
													<label for="inputAddress2" class="form-label">Means of ID (Ownership)</label>  
													<input class="form-control" id="fancy-file-upload" type="file" name="meansofid" multiple>
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

@endsection