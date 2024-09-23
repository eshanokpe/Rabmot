@extends('user.layouts.dashboardheader') 

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
						<div class="breadcrumb-title pe-3">Community</div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="bx bx-home-alt"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page"> Disscussion<i class="bx bx-user"></i></li>
								</ol>
							</nav>
						</div> 
						
					</div>
					<!--end breadcrumb-->
				<!-- <div class="row">
					<div class=" radius-15">
						
							<div class="card-title text-center">
								<h5 class="mb-0">Add New Vehicle</h5>
							</div>
						
					</div>
				</div>-->
				<br><br> 
				<div class="row">
                <div class="col-xl-10 mx-auto">
                            <div class="card-title d-flex row">
								<div class="col-sm-6">
									<h5 class="mb-0 text-primary">Join Recent Disscussion</h5>
								</div>
                                
                                
								
							 	
                            </div>
							<hr>
							<div class="card border-top border-0 border-4 border-primary">
								<div class="card-body p-5">
									
									<!-- <ul>
										@foreach ($topics as $topic)
											<li><a href="{{ route('topics.show', $topic->id) }}">{{ $topic->title }}</a></li>
										@endforeach
									</ul> -->
									
									@foreach ($topics as $topic)
										<div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading{{ $topic->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $topic->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $topic->id }}">
											{{ $topic->title }}
                                            
                                            </button>
                                            </h2>
                                            <div id="flush-collapse{{ $topic->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $topic->id }}" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                   <a href="{{ route('topics.show', $topic->id) }}"> <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>{{ $topic->content }}</b>
                                                    
														<div class="text-end">
															<span  class="relative-time" id="relativeTime" style="font-style: italic; font-size:14px"></span>
														</div></a>
													</div>
                                                </div>
                                            </div>
                                        </div>@endforeach
										<div class="col-sm-12 text-end pt-2">
											<h6 ><a href="{{ route('topics.create') }}"> +Create New Discusion</a></h6>
								
										</div>
								</div>
							</div>
							
						</div>
				</div>
				<!--end row-->

			</div>
		</div>
			<!--footer-->
		@include('user.layouts.dashboardfooter');
		<!--end footer-->
	</div>


    <script>
        function calculateRelativeTime(date) {
        const now = new Date();
        const diffInMilliseconds = now - new Date(date);

        // Calculate the difference in days
        const diffInDays = Math.floor(diffInMilliseconds / (1000 * 60 * 60 * 24));

        // Return the relative time string
        if (diffInDays === 0) {
            return "Today";
        } else if (diffInDays === 1) {
            return "Yesterday";
        } else {
            return `${diffInDays} Days Ago`;
        }
        }

        const dates = {!! json_encode($topic->pluck('created_at')) !!};

        document.addEventListener('DOMContentLoaded', () => {
        const relativeTimeElements = document.querySelectorAll('.relative-time');
        relativeTimeElements.forEach((element, index) => {
            const date = new Date(dates[index]);
            const relativeTime = calculateRelativeTime(date);
            element.textContent = relativeTime;
        });
        });
    </script>

@endsection