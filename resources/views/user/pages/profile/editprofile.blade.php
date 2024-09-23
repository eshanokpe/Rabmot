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

					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">

						<div class="breadcrumb-title pe-3">Edit Profile</div>

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
                                <form class="row g-3" id="profile_setup_frm" action="{{route('update.profile')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 border-right ">
                                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                          
                                                @if($userdetails->profile_image)
                                                    <img src="{{ asset('public/assets/profileimages/'.$userdetails->profile_image) }}" id="image_preview_container" class="rounded-circle shadow " width="250" height="250" alt="" />
                                                @else
                                                    <img src="{{ asset('public/assets/img/avatar.png')}}" id="image_preview_container" class="rounded-circle shadow " width="250" height="250" alt="" />
                                                @endif

                                                <span class="font-weight-bold pt-3">
                                                    <input class="form-control" id="profile_image" type="file" name="profile_image" >
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-8 border-right ">
                                            <div class="p-3 py-5">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="text-right">Profile Settings</h4>
                                                </div>
                                                <div class="row" id="res"></div>
                                                <div class="card-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12  border-right">
                                                                
                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Full Name</label>
                                                                        <input type="text" name="fullname" value="{{$userdetails->fullname}}" class="form-control">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Email Address</label>
                                                                        <input name="email" type="email" value="{{$userdetails->email}}" class="form-control">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Phone Number</label>
                                                                        <input name="phone" type="text" value="{{$userdetails->phone }}" class="form-control">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Address</label>
                                                                        <input name="address" type="text" value="{{$userdetails->address}}" class="form-control" placeholder="Address">
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <label class="form-label">Gender</label>
                                                                        <select name="gender" class="form-control">
                                                                            <option value="male" {{ $userdetails->gender === 'male' ? 'selected' : ''}}>Male</option>
                                                                            <option value="female" {{ $userdetails->gender === 'female' ? 'selected' : ''}}>Female</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <center> 
                                                                            <button id="btn" type="submit" class="btn btn-sm btn-primary mt-2">Save Profile</button>
                                                                        </center>
                                                                    </div>
                                                            													
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
								<!--end row-->
                                <script>
                                    $(document).ready(function(){
                                        //image Preview
                                        $("#profile_image").change(function(){
                                            let reader = new FileReader();

                                            reader.onload = (e) => {
                                                $('#image_preview_container').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(this.files[0]);
                                        })

                                        $('#profile_setup_frm').submit(function(e){
                                            e.preventDefault();
                                            var formData = new FormData(this);

                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $("#btn").attr("disabled", true);
                                            $("#btn").html("Updating...");
                                            $.ajax({
                                                type:"POST",
                                                url: this.action,
                                                data: formData,
                                                cache:false,
                                                contentType: false,
                                                processData: false,
                                                success: (response) => {
                                                    if (response.code == 400) {
                                                        let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                                                        $("#res").html(error);
                                                        $("#btn").attr("disabled", false);
                                                        $("#btn").html("Save Profile");
                                                    }else if(response.code == 200){
                                                        let success = '<span class="alert alert-success">'+response.msg+'</span>';
                                                        $("#res").html(success);
                                                        setTimeout(function() {
                                                            $("#res").html(success).hide();
                                                        }, 1000); 
                                                        location.reload();
                                                        $("#btn").attr("disabled", false);
                                                        $("#btn").html("Save Profile");
                                                    }
                                                }
                                            })
                                        })
                                    })
                                </script>
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