@extends('user.layouts.app') 

@section('content')

	<!-- wrapper -->
	<div class="wrapper">
		<!--page-wrapper-->
		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pe-3"> Profile</div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">User Profile</li>
								</ol>
							</nav>
						</div>
					</div>
					<!--end breadcrumb-->

					<div class="user-profile-page">
                    <div class="col-xl-12 mx-auto">
						<div class="card radius-15">
							<div class="card-body">
                                 <div class="row"> 
                                        <div class="col-md-4 border-right ">
                                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                                @if($userdetails->profile_image)
                                                    <img src="{{ asset('/assets/profileimages/'.$userdetails->profile_image) }}" id="image_preview_container" class="rounded-circle shadow " width="250" height="250" alt="" />
                                                @else
                                                    <img src="{{ asset('/assets/img/avatar.png')}}" id="image_preview_container" class="rounded-circle shadow " width="250" height="250" alt="" />
                                                @endif
                                                {{-- <img src="{{ asset('/assets/img/avatar.png')}}" id="image_preview_container" class="rounded-circle shadow " width="200" height="200" alt="" />--}}
                                                <span class="font-weight-bold pt-3">
                                                    {{-- <input class="form-control" id="profile_image" type="file" name="profile_image" > --}}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-8 border-right ">
                                            <div class="p-3 py-5">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="text-right">View Profile </h4>
                                                </div>
                                                <div class="row" id="res"></div>
                                                <div class="card-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12  border-right">
                                                                
                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Full Name</label>
                                                                        <input type="text" name="fullname" disabled value="{{$userdetails->fullname}}" class="form-control">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Email Address</label>
                                                                        <input name="email" type="text" disabled value="{{$userdetails->email}}" class="form-control">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Phone Number</label>
                                                                        <input name="phone" type="text" disabled value="{{$userdetails->phone }}" class="form-control">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Address</label>
                                                                        <input name="address" type="text" disabled value="{{$userdetails->address}}" class="form-control" placeholder="Address">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Gender</label>
                                                                        <select name="gender" class="form-control" disabled>
                                                                            <option value="male">Male</option>
                                                                            <option value="female">Female</option>
                                                                            <option value="{{$userdetails->gender }}">{{$userdetails->gender }}</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <center> 
                                                                            <a href="{{ route('home.editprofile')}}"  class="btn btn-sm btn-primary mt-2">Edit Profile</a>
                                                                        </center>
                                                                    </div>
                                                            													
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<!--end row-->
                               
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