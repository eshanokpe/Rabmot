@extends('user.layouts.app') 

@section('content')
<body>
	<!--page-wrapper-->
	<div class="wrapper">

		<!--header-->
	
		<!--end sidebar-wrapper-->
		
		<!--page-content-wrapper-->
		<div class="page-content-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
						<div class="breadcrumb-title pe-3">Add Vehicles</div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page"> +Add New Vehicle <i class="bx bx-car"></i></li>
								</ol>
							</nav>
						</div> 
						
					</div>
					
				<br><br> 
				<div class="row">
					<!-- <div class="col-12 col-lg-1 "></div> -->
					<div class="col-12 col-lg-3">
						<a href="{{ route('home.addVehicleRenewal')}}">
							<div class="card radius-15 w-100 text-center border-primary">
								
								<div class="card-body"> 
									<i class="bx bx-car" style="font-size:48px; color:red;"></i>
									<div class=" align-items-center text-center">
										<div>
											<h6 class="mb-4"> + Add New Vehicle</h5>
										</div>
									</div>
									<div class="align-items-center text-center">
										<div>
											<h5 class="mb-4"> <b> For Vehicle Paper Renewal</b></h5>
										</div>
									</div>
									
								</div>
								
							</div>
						</a>
					</div>


					<div class="col-12 col-lg-3 ">
						<a href="{{ route('home.addVehicleRegistration')}}">
						<div class="card radius-15 w-100 text-center border-primary">
							<div class="card-body">
								<i class="bx bx-car" style="font-size:48px; color:green;"></i>
								<div class=" align-items-center text-center">
									<div>
										<h6 class="mb-4"> +Add New Vehicle</h5>
									</div>
								</div>
								<div class="align-items-center text-center">
									<div>
										<h5 class="mb-4"> <b>For New Vehicle Registration</b></h5>
									</div>
								</div>
								
							</div>
						</div>
						</a>
					</div>
					<div class="col-12 col-lg-3 ">
						<a href="{{ route('home.addVehicleOwnership')}}">
						<div class="card radius-15 w-100 text-center border-primary">
							<div class="card-body">
								<i class="bx bx-car" style="font-size:48px; color:ash;"></i>
								<div class=" align-items-center text-center">
									<div>
										<h6 class="mb-4"> +Add New Vehicle</h6>
									</div>
								</div>
								<div class="align-items-center text-center">
									<div>
										<h5 class="mb-4"> <b> For Change Of Ownership</b></h5>
									</div>
								</div>
								
							</div>
						</div>
						</a>
					</div>
					<div class="col-12 col-lg-3 ">
						<a href="https://wa.me/message/CXH37OUHPFJ3J1">
						<div class="card radius-15 w-100 text-center border-success">
							<div class="card-body">
								<i class="bx bx-car" style="font-size:48px; color:green;"></i>
								<div class=" align-items-center text-center">
									<div>
										<h6 class="mb-4"> +Add New Vehicle</h6>
									</div>
								</div>
								<div class="align-items-center text-center">
									<div>
										<h5 class="mb-4" style=" color:green;"> <b> Add Vehicle by Whatsapp</b></h5>
									</div>
								</div>
								
							</div>
						</div>
						</a>
					</div>
					
				</div>
				<!--end row-->

			</div>
		</div>
		
	</div>



@endsection