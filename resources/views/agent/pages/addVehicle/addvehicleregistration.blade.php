@extends('agent.layouts.app') 

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
						<div class="breadcrumb-title pe-3">Add Vehicle </div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}"><i class="bx bx-car"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">+Add New Vehicle (Registration) <i class="bx bx-car" style="color:green;" ></i></li>
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
								<div class="alert alert-success alert-dismissible fade show" role="alert">
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
									
									<form class="row g-3" method="POST" action="{{ route('agent.postAddVehicleRegistration') }}" enctype="multipart/form-data">
										@csrf
										 <div class="col-md-12">
											<label for="inputState" class="form-label">Select Category of Vehicle <span style="color:red;">*</span> </label>
											
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
										
										<div class="col-sm-6 col-md-6">
											<label for="inputFullName" class="form-label">Owner's Full Name<span style="color:red;">*</span></label>
											<input  required type="text" name="ownerfullname" class="form-control" id="fullname" placeholder="Owner's Full Name">		
										</div>

										<div class="col-sm-6 col-md-6">
											<label for="inputLastName" class="form-label">Owner's Email Address<span style="color:red;">*</span></label>
											<input required type="text" name="owneremail" class="form-control" id="email" placeholder="Owner's Email Address">
										</div>
                                       

										<div class="col-md-6">
											<label for="inputFirstName" class="form-label">Vehicle Make (e.g Toyota) <span style="color:red;">*</span></label>
											<input required type="text" name="vehiclemake" class="form-control" id="vehiclemake" placeholder="Vehicle Brand (e.g Toyota)">
											@error('vehiclemake')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputLastName" class="form-label">Vehicle Model (e.g Corolla) <span style="color:red;">*</span></label>
											<input required type="text" name="vehiclemodel" class="form-control" id="vehiclemodel" placeholder="Vehicle Model (e.g Corolla)">
											@error('vehiclemodel')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputEmail" class="form-label">Year of Make (e.g 2000)</label>
											<select name="year0fmake" id="inputState" class="form-select">
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
											@error('year0fmake')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div> 
								
										<div class="col-md-6">
											<label for="inputAddress" class="form-label">Chassis Number <span style="color:red;">*</span></label>
											<input required type="text" class="form-control" name="chassisnumber" id="chassisnumber" placeholder="Chassis Number">
											@error('chassisnumber')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputAddress2" class="form-label">Engine Number </label>
											<input  type="text" class="form-control" name="enginenumber" id="enginenumber" placeholder="Engine Number ">
											@error('enginenumber')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
											<label for="inputAddress2" class="form-label"> Applicant Full Name  <span style="color:red;">*</span></label>
											<input required type="text" class="form-control" name="applicantfullname" id="applicantfullname" placeholder="Full Name">
											@error('applicantfullname')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6"> 
											<label for="inputAddress2" class="form-label"> Applicant NIN  <span style="color:red;">*</span></label>
											<input required type="number" class="form-control" name="applicantNIN" id="applicantNIN" placeholder="National Identity Number">
											@error('applicantNIN')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
                                        
										<div class="col-md-6">
											<label for="inputAddress2" class="form-label"> Residential Address </label>
											<input  type="text" class="form-control" name="residentialaddress" id="residentialaddress" placeholder="Residential Address">
											@error('phonenumber')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

                                        <div class="col-md-6">
											<label for="inputAddress2" class="form-label">  Phone Number <span style="color:red;">*</span></label>
											<input required type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Phone Number">
											@error('phonenumber')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputAddress2" class="form-label">  Email Address <span style="color:red;">*</span></label>
											<input required type="text" class="form-control" name="emailaddress" id="emailaddress" placeholder="Email Address">
											@error('emailaddress')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputAddress2" class="form-label">  Gender <span style="color:red;">*</span></label>
											<select required name="gender" id="gender" class="form-select">
												<option disabled selected="selected" value="">Select Gender </option>
												<option value="Male"> Male </option>
												<option value="Female"> Female </option>
											</select>
											@error('gender')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputAddress2" class="form-label">  Occupation </label>
											<input  type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation">
											@error('occupation')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputFirstName" class="form-label"> Date of birth <span style="color:red;">*</span> </label>
											<input  required type="date" name="dateofbirth" class="form-control" id="vehiclebrand">
											@error('dateofbirth')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

										<div class="col-md-6">
											<label for="inputLastName" class="form-label"> Marital status  </label>
											<select  name="maritalstatus" id="inputState" class="form-select">
												<option disabled selected="selected" value="">Select Marital status </option>
												<option value="Single"> Single </option>
												<option value="Married"> Married </option>
												<option value="Divorced"> Divorced </option>
											</select>
											@error('maritalstatus')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-md-6">
											<label for="inputLastName" class="form-label"> State Origin  </label>
											<select  name="state" id="inputState" class="form-select">
												<option disabled selected="selected" value="">Select State</option>
												<option value="Abia"> Abia </option>
												<option value="Adamawa"> Adamawa </option>
												<option value="Akwa Ibom"> Akwa Ibom </option>
												<option value="Anambra"> Anambra </option>
												<option value="Bauchi"> Bauchi </option>
												<option value="Bayelsa"> Bayelsa</option>
												<option value="Benue"> Benue </option>
												<option value="Borno"> Borno </option>
												<option value="Cross River"> Cross River</option>
												<option value="Delta"> Delta </option>
												<option value="Ebonyi"> Ebonyi </option>
												<option value="Enugu"> Enugu </option>
												<option value="Edo"> Edo </option>
												<option value="Ekiti"> Ekiti </option>
												<option value="Enugu"> Enugu </option>
												<option value="Gombe"> Gombe </option>
												<option value="Imo"> Imo </option>
												<option value="Jigawa"> Jigawa/option>
												<option value="Kaduna"> Kaduna </option>
												<option value="Kano"> Kano </option>
												<option value="Katsina"> Katsina</option>
												<option value="Kebbi"> Kebbi </option>
												<option value="Kogi"> Kogi </option>
												<option value="Kwara"> Kwara </option>
												<option value="Lagos"> Lagos </option>
												<option value="Nasarawa"> Nasarawa</option>
												<option value="Niger"> Niger </option>
												<option value="Ogun"> Ogun </option>
												<option value="Ondo"> Ondo</option>
												<option value="Osun"> Osun </option>
												<option value="Oyo"> Oyo </option>
												<option value="Plateau"> Plateau </option>
												<option value="Rivers"> Rivers </option>
												<option value="Sokoto"> Sokoto</option>
												<option value="Taraba"> Taraba </option>
												<option value="Yobe"> Yobe </option>
												<option value="Zamfara"> Zamfara</option>
											</select>
											@error('state')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="card radius-10 mb-3">
											<div class="card-body">
												<div class="card-title">
													<p class="mb-0"><b>Upload Custom Papers, and Means of ID  </b></p>
												</div>
												<hr/>
												<div class="row">
													<div class="col-md-6">
													<label for="inputAddress2" class="form-label">Custom Papers <span style="color:red;">*</span> </label> <br>
													<input required class="form-control mb-3" id="fancy-file-upload" type="file" name="custompapers" multiple>
													@error('custompapers')
														<span class="text-danger">{{ $message }}</span>
													@enderror
													</div>


													<div class="col-md-6">
													<label for="inputAddress2" class="form-label">Means of ID <span style="color:red;">*</span></label>  <br>
													<input required class="form-control mb-3" id="fancy-file-upload" type="file" name="meansofid" multiple>
													@error('meansofid')
														<span class="text-danger">{{ $message }}</span>
													@enderror
													</div>

												</div>
											</div>
										</div>
                                        
                                        
										<div class="col-12 mt-30">
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
			<!--footer-->
		
		</div>
		<!--end page-wrapper-->
	</div>
	@endsection