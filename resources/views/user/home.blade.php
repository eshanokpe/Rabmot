@extends('user.layouts.app') 

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
									{{ session('success') }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>

							</div>
						@endif
						<div class="col-12 col-lg-4">
							<div class="card radius-15 bg-voilet">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h2 class="mb-0 text-white">{{ $vehicleCount }} <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
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
											<h2 class="mb-0 text-white">0 <i class='bx bxs-up-arrow-alt font-14 text-white'></i> </h2>
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
					
					<div class="card radius-15  overflow-hidden">
						<br>
						<div class="card-header pt-10 border-bottom-0">
							<div class="d-lg-flex align-items-center">
								<br> 
								<div class="col-sm-6">
									<h5 class="mb-0">COMMISSIONS EARNED</h5>
									<!--<h6 class="mb-0">Total Referral: {{$referralsCount ?? 0 }} | Earned:  {{$tokenCount}} </h5>-->
									<h6 class="mb-0">Total Referral: {{ isset($referralsCount) ? $referralsCount : 0 }} | Earned: {{ isset($tokenCount) ? $tokenCount : 0 }}</h6>


								</div>
								<div class="col-sm-6">
									<small>Refer & Earn</small>
									<small>( Copy Referral Link <i class='bx bx-link' style="font-size:18px;"></i> )</small>
								<input type="text" value="{{$referralLink}}" id="textToCopy"class="form-control" readonly>
										<div id="copiedMessage" style="display: none;" class="text-success pt-3">Copied!</div>
								</div>
								
							</div>
						</div>
						<br>
						
					</div>
					<div class="card radius-5  overflow-hidden p-2">
						<div class="card-header pt-10 border-bottom-0">
							@if($vehicleCount == 0)
							<div class="">
								<div class="col-12 pb-2">
									<small class="mb-0 text-muted">Registerd Vehicle {{ $vehicleCount }}</small>
								
								</div>
								<div class="col-12">
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<span class="alert-link">Opps!</span> You need to add a vehicle to your account Page. 
										<a href="{{ route('home.addVehicleRenewal') }}" class="alert-link">Add Vehicle </a>
										
									</div>
								</div>
							</div>
							@else
								<div class="">
									<div class="col-12 pb-2">
										<small class="mb-0 text-muted">Registerd Vehicle {{ $vehicleCount }}</small>
									
									</div>
									<div class="col-12">
										@foreach ($getaddvehicle as $vehicle)
											<div class="row border radius-2 p-2">
												<div class="col-sm-1  ">
													<i class="bx bx-car text-muted" style="font-size:48px" ></i>
												</div>
												<div class="col-sm-4">
													<small> Vehicle Make: {{$vehicle->vehiclemake}}</small><br>
													<small> Vehicle Reg.: {{$vehicle->platenumber}}</small> <br>
													<small> Vehicle Type: 
														@if( $vehicle->categoryInfo == null )

														@else
														{{ $vehicle->categoryInfo->name }}
														@endif
														
													</small>
												</div>
												
												<div class="col-sm-4">
													
													<p class="font-10 text-muted"> 
														
														@if($vehicle->vehiclelicenseexpiry == null) 
														{{-- Vehicle Lincense: 	0 day --}}
														
														@else
														@php
															//Get the current data (today)
															$currentDate = new DateTime();
															// Convert the expiry date string to a DateTime object
															$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->vehiclelicenseexpiry);
															// Calcutlate the difference between the current data and the expiry data
															$interval = $currentDate->diff($expiryDate);
															// Get the remaining days, months, and years
															$remainingDays = $interval->days;
															$remainingMonths = $interval->m;
															$remainingYears = $interval->y;
														@endphp
															@if( $remainingDays == 0)
															{{-- Vehicle Lincense: 	{{$remainingDays}} day --}}
															@else
															Vehicle Lincense: 	{{$remainingDays}} days
															@endif
															
														@endif
													</p>
													<p class="font-10 text-muted"> 
														
														@if($vehicle->roadworthinessexpiry == null)
															{{-- Road Worthiness: 0 day --}}
														@else
															@php
																//Get the current data (today)
																$currentDate = new DateTime();
																// Convert the expiry date string to a DateTime object
																$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->roadworthinessexpiry);
																// Calcutlate the difference between the current data and the expiry data
																$interval = $currentDate->diff($expiryDate);
																// Get the remaining days, months, and years
																$remainingDays = $interval->days;
																$remainingMonths = $interval->m;
																$remainingYears = $interval->y;

															@endphp

																@if( $remainingDays == 0)
																{{-- Road Worthiness: {{$remainingDays}} day --}}
																@else
																Road Worthiness: {{$remainingDays}} days
																@endif
															
														@endif
													</p> 
													<p class="font-10 text-muted"> 
														
														@if($vehicle->insuranceexpiry == null)
														{{-- Hackney Permit: 0 day --}}
														@else
															@php
																//Get the current data (today)
																$currentDate = new DateTime();
																// Convert the expiry date string to a DateTime object
																$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->insuranceexpiry);
																// Calcutlate the difference between the current data and the expiry data
																$interval = $currentDate->diff($expiryDate);
																// Get the remaining days, months, and years
																$remainingDays = $interval->days;
																$remainingMonths = $interval->m;
																$remainingYears = $interval->y;

															@endphp

																@if( $remainingDays == 0)
																	{{-- Insurance: {{$remainingDays}} day --}}
																@else
																Insurance: {{$remainingDays}} days
																@endif
															
														@endif
													</p> 
													<p class="font-10 text-muted"> 
														
														@if($vehicle->hackneypermitexpiry == null)
														{{-- Hackney Permit: 0 day --}}
														@else
															@php
																//Get the current data (today)
																$currentDate = new DateTime();
																// Convert the expiry date string to a DateTime object
																$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->hackneypermitexpiry);
																// Calcutlate the difference between the current data and the expiry data
																$interval = $currentDate->diff($expiryDate);
																// Get the remaining days, months, and years
																$remainingDays = $interval->days;
																$remainingMonths = $interval->m;
																$remainingYears = $interval->y;

															@endphp

																@if( $remainingDays == 0)
																	{{-- Hackney Permit: {{$remainingDays}} day --}}
																@else
																Hackney Permit: {{$remainingDays}} days
																@endif
															
														@endif
													</p> 
													<p class="font-10 text-muted"> 
														State Carriage Permit: 
														@if($vehicle->statecarriagepermitexpiry == null)
															0 day
														@else
															@php
																//Get the current data (today)
																$currentDate = new DateTime();
																// Convert the expiry date string to a DateTime object
																$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->statecarriagepermitexpiry);
																// Calcutlate the difference between the current data and the expiry data
																$interval = $currentDate->diff($expiryDate);
																// Get the remaining days, months, and years
																$remainingDays = $interval->days;
																$remainingMonths = $interval->m;
																$remainingYears = $interval->y;

															@endphp

																@if( $remainingDays == 0)
																	{{$remainingDays}} day
																@else
																	{{$remainingDays}} days
																@endif
															
														@endif
													</p>
													<p class="font-10 text-muted"> 
														
														@if($vehicle->hackneydutypermitexpiry == null)
															{{-- Mid-Year Permit: 0 day --}}
														@else
															@php
																//Get the current data (today)
																$currentDate = new DateTime();
																// Convert the expiry date string to a DateTime object
																$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->hackneydutypermitexpiry);
																// Calcutlate the difference between the current data and the expiry data
																$interval = $currentDate->diff($expiryDate);
																// Get the remaining days, months, and years
																$remainingDays = $interval->days;
																$remainingMonths = $interval->m;
																$remainingYears = $interval->y;

															@endphp

																@if( $remainingDays == 0)
																	{{-- Mid-Year Permit: {{$remainingDays}} day --}}
																@else
																	Mid-Year Permit: {{$remainingDays}} days
																@endif
															
														@endif
													</p>
													<p class="font-10 text-muted"> 
														
														@if($vehicle->localgovernmentpermitexpiry == null)
															{{-- Local Government Permit: 0 day --}}
														@else
															@php
																//Get the current data (today)
																$currentDate = new DateTime();
																// Convert the expiry date string to a DateTime object
																$expiryDate = DateTime::createFromFormat('Y-m-d', $vehicle->localgovernmentpermitexpiry);
																// Calcutlate the difference between the current data and the expiry data
																$interval = $currentDate->diff($expiryDate);
																// Get the remaining days, months, and years
																$remainingDays = $interval->days;
																$remainingMonths = $interval->m;
																$remainingYears = $interval->y;

															@endphp

																@if( $remainingDays == 0)
																{{-- Local Government Permit: {{$remainingDays}} day --}}
																@else
																Local Government Permit: {{$remainingDays}} days
																@endif
															
														@endif
													</p>
												</div>
												<div class="col-sm-3 ">
													<div class=row>
														<div class="col-6 p-1">
															<a href="{{ route('edit.vehiclePaperRenewal', ['encryptedId' => encrypt($vehicle->id) ]) }}" class="btn btn-sm btn-primary  text-center" >Edit Vehicle</a>
														</div>
													
														<div class="col-6 p-1">
															<a href="{{ route('delete.vehiclePaperRenewal', ['encryptedId' => encrypt($vehicle->id) ]) }}" class="btn btn-sm btn-secondary text-center" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete Vehicle</a>
															
														</div>
													</div>
												</div>
											</div>
										@endforeach
										
									</div>
								</div>
							@endif
							
						</div>
						<br>
						
					</div>
				</div>
                
                <script>
                    var textToCopy = document.getElementById("textToCopy");
                    textToCopy.addEventListener("click", function() {
                        // Select the text in the input element
                        textToCopy.select();
                        textToCopy.setSelectionRange(0, 99999); // For mobile devices
                    
                        // Copy the text to the clipboard
                        document.execCommand("copy");
                    
                        // Show a "Copied!" message
                        var copiedMessage = document.getElementById("copiedMessage");
                        copiedMessage.style.display = "block";
                    
                        // Hide the message after a short delay
                        setTimeout(function() {
                            copiedMessage.style.display = "none";
                        }, 2000); // 2 seconds (adjust as needed)
                    });
                </script>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->

		<!--footer-->
		
		<!--end footer-->
	</div>

@endsection