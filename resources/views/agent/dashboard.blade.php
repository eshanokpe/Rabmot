@extends('agent.layouts.app') 

@section('content')

	<!-- wrapper -->
	<div class="wrapper">
		<!--header-->
	 
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper--> 
			<div class="page-content-wrapper"> 
				<div class="page-content">
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
						<div class="col-12 col-lg-4"> 
							<div class="card radius-15 bg-voilet">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white">{{ $totalCountVehicle}} <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
										</div>
										<div class="ms-auto font-35 text-white">
											<i class="bx bx-car"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Vehicles</p>
										</div>
										<div class="ms-auto font-14 text-white"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="card radius-15 bg-primary-blue">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white">0<i class='bx bxs-down-arrow-alt font-14 text-white'></i> </h2>
										</div>
										<div class="ms-auto font-35 text-white"><i class="bx bx-cart-alt"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Orders</p>
										</div>
										<div class="ms-auto font-14 text-white"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="card radius-15 bg-rose">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white"><small>NGN</small> {{number_format($totalWalletAmount, 2,'.',',')}} <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
										</div>
										<div class="ms-auto font-35 text-white"><i class="bx bx-money"></i>
										</div>
									</div>
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-white">Wallet</p>
										</div>
										<div class="ms-auto font-14 text-white"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
					
					<div class="user-profile-page">
                    <div class="card">
						<div class="card-body">
							<div class="card-title">
								<h4 class="mb-0">Vehicle Registered</h4>
							</div>
							<hr/>
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
                                            <th>S/N</th>
											<th>Owners Name</th>
											<th>Vehicle Category</th>
											<th>Vehicle Model</th>
											<th>Vehicle Reg. No.</th>
											<th>Vehicle Chasis No.</th>
											<th>Vehicle License</th>
											<th>Road Worthiness</th>
											<th>Third Party Insurance</th>
											<th>Hackney  Permit</th>
											<th>Local Govt. Permit</th>
										</tr>
									</thead>
									<tbody>
										@php $serial = 1 @endphp
										@forelse ($getaddvehicle as $vehicle)
											<tr>
												<td>{{ $serial++}}</td>
												<td>{{$vehicle->ownerfullname}}</td>
												<td>
													@if( $vehicle->vehicleTypeInfo == null )

													@else
													{{ $vehicle->vehicleTypeInfo->name }}
													@endif
												</td>
												<td>{{$vehicle->vehiclemodel}}</td>
												<td>{{$vehicle->platenumber}}</td>
												<td>{{$vehicle->chassisnumber}}</td>
												<th>
													@if($vehicle->vehiclelicenseexpiry == null) 
													 	0 day 
													@else
													@php
														$currentDate = new DateTime();
														$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->vehiclelicenseexpiry);
														$interval = $currentDate->diff($expiryDate);
														$remainingDays = $interval->days;
														$remainingMonths = $interval->m;
														$remainingYears = $interval->y;
													@endphp
														@if( $remainingDays == 0)
														 Vehicle Lincense: 	{{$remainingDays}} day 
														@else
																{{$remainingDays}} days left
														@endif
														
													@endif
												</th>
												<th>
													@if($vehicle->roadworthinessexpiry == null)
													 0 day 
													@else
														@php
															$currentDate = new DateTime();
															$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->roadworthinessexpiry);
															$interval = $currentDate->diff($expiryDate);
															$remainingDays = $interval->days;
															$remainingMonths = $interval->m;
															$remainingYears = $interval->y;
														@endphp
															@if( $remainingDays == 0)
															{{-- Road Worthiness: {{$remainingDays}} day --}}
															@else
															 {{$remainingDays}} days left
															@endif
														
													@endif
												</th>
												<th>
													@if($vehicle->insuranceexpiry == null)
													0 day 
													@else
														@php
															$currentDate = new DateTime();
															$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->insuranceexpiry);
															$interval = $currentDate->diff($expiryDate);
															$remainingDays = $interval->days;
															$remainingMonths = $interval->m;
															$remainingYears = $interval->y;

														@endphp

															@if( $remainingDays == 0)
															@else
															 {{$remainingDays}} days left
															@endif
														
													@endif
												</th>
												<th>
													@if($vehicle->hackneypermitexpiry == null)
													0 day 
													@else
														@php
															$currentDate = new DateTime();
															$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->hackneypermitexpiry);
															$interval = $currentDate->diff($expiryDate);
															$remainingDays = $interval->days;
															$remainingMonths = $interval->m;
															$remainingYears = $interval->y;

														@endphp

															@if( $remainingDays == 0)
															@else
															{{$remainingDays}} days left
															@endif
														
													@endif
												</th>
												<th>
													@if($vehicle->localgovernmentpermitexpiry == null)
													0 day 
													@else
														@php
															$currentDate = new DateTime();
															$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->localgovernmentpermitexpiry);
															$interval = $currentDate->diff($expiryDate);
															$remainingDays = $interval->days;
															$remainingMonths = $interval->m;
															$remainingYears = $interval->y;
 
														@endphp

															@if( $remainingDays == 0)
															@else
															 {{$remainingDays}} days left
															@endif
														
													@endif
												</th>
											</tr>
										@empty
											<p class="text-danger">No Vehicle Registration</p>
										@endforelse
									</tbody>
								</table>

								
								
				            </div>
				        </div>
				    </div>
				    </div>
				</div>
                                    
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->

		<!--footer-->
		
		<!--end footer-->
	</div>

	
@endsection