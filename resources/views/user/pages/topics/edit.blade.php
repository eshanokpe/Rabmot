@extends('user.layouts.dashboardheader') 

@section('content')
<body>
	<!--page-wrapper-->
	<div class="wrapper">

		<!--header-->
		@include('user.layouts.topnav');
		<!--end header-->
		<!--sidebar-wrapper-->
		@include('user.layouts.dashboardsidebar');
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
									<li class="breadcrumb-item active" aria-current="page"> <a href="{{ route('topics.index') }}"> Disscussion </a><i class="bx bx-user"></i></li>
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
								</div>
                                <!-- <div class="col-sm-6 text-end">
								<h6 ><a href="{{ route('topics.create') }}"> Recent Discusion</a></h6>
								
								</div> -->
								
								<div class="fade show">
                                        <h6>Edit Comment</h6>
                                        <hr>
                                    </div>
                            </div>
							
							<div class="card border-top border-0 border-4 border-primary">
								<div class="card-body p-5">
									<div class="fade show">
                                        <h5 class="mb-0 text-primary">{{ $topic->content }}</h5>
                                        <hr>
                                    </div>
                                    
                                    @if(isset($comment))
                                        <form class="row g-3" action="{{ route('comments.update', ['topic' => $topic, 'comment' => $comment]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                                <label for="content">Content:</label>
                                                <div class="col-sm-7">
													<textarea id="content" name="content" class="form-control" placeholder="Enter your content" cols="5" rows="4" required>{{ $comment->content }}</textarea>
												</div>
												<div class="col-12 mt-30">
													
													<button type="submit" class="btn btn-primary ">Update Comment</button>
												</div>
                                        </form>
                                    @else
                                        <p>Comment not found.</p>
                                    @endif
								</div>
                                
							</div>
							
						</div>
				</div>
				<!--end row-->

			</div>
		</div>
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

        const dates = {!! json_encode($comment->pluck('created_at')) !!};

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