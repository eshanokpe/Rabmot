@extends('user.layouts.app') 

@section('content')
<body>
	<!--page-wrapper-->
	<div class="wrapper">

		
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
				
				<br><br> 
				<div class="row">
                <div class="col-xl-10 mx-auto">
                            <div class="card-title d-flex row">
								<div class="col-sm-6">
									<h5 class="mb-0 text-primary">Create Discusion</h5>
								</div>
                                <div class="col-sm-6 text-end">
								<h6 ><a href="{{ route('topics.index') }}">  Join Recent Disscussion</a></h6>
								
								</div>
                                
								
							 	
                            </div>
							<hr>
							<div class="card border-top border-0 border-4 border-primary">
                            
								<div class="card-body p-5">
								<h6 ><a href="{{ route('topics.index') }}">  Join Recent Disscussion</a></h6>
								
								
                                <form class="row g-3" action="{{ route('topics.store') }}" method="POST">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="inputTitle" class="form-label">Title:</label>
                                        <input  type="text" name="title" class="form-control" id="title" placeholder="Enter your title" required>
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <label for="content" class="form-label">Content: </label>
                                        <textarea name="content" id="content" class="form-control" placeholder="Enter your content" required  cols="5" rows="5"></textarea>
                                    </div>
                                    <div class="col-12 mt-30">
                                        <button type="submit" class="btn btn-primary px-5">Create Topic</button>
                                    </div>
                                    
                                </form>
								</div>
							</div>
							
						</div>
				</div>
				<!--end row-->

			</div>
		</div>
	</div>



@endsection