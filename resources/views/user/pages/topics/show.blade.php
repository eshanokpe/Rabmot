@extends('user.layouts.app') 

@section('content')

<body>

	<!--page-wrapper-->
	<div class="wrapper">
		<!--header-->
		<!--end sidebar-wrapper--> 
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

				<br><br> 

				<div class="row">

                <div class="col-xl-10 mx-auto">

                            <div class="card-title d-flex row">

								<div class="col-sm-6">

									<h6>Discussion: {{ $topic->title }}</h6>

								</div>
                            </div>

							<div class="card border-top border-0 border-4 border-primary">

								<div class="card-body p-5">
									<div class="fade show">
                                        <h5 class="mb-0 text-primary">{{ $topic->content }}</h5>
                                        <hr>
                                    </div>
                                   @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if ($topic->comments->isNotEmpty())
                                        @foreach ($topic->comments as $comment)
                                        <div class="row">
                                            <div class="col-4 col-sm-1"> 
                                                @if($user->profile_image)
                                                    <img src="{{ asset('/assets/profileimages/'.$user->profile_image) }}" style="border-radius: 100px" class="w-100" alt="comment images">
                                                @else
                                                    <img src="{{ asset('/assets/img/avatar.png')}}" class="w-100" alt="comment images">
                                                @endif
                                            </div>

                                            <div class="col-12 col-sm-10">

                                            <div class="col-sm-6">

                                                <span class="title" style="font-size: 18px"><b>{{ $comment->author }}</b></span>

                                                <span class="relative-time"  style="font-style: italic;">{{ $comment->created_at->format('d F Y')}}</span>

                                            </div>
                                            <p>{{ $comment->content }}</p>
                                            <span>
                                            </span>
                                            </div>
                                            <hr>
                                        </div>
                                        @endforeach
                                        @else
                                        <p>No comments on this topic yet.</p>
                                        @endif
									<h6>Post a Comment</h6>
                                    <form class="row g-3" action="{{ route('comments.store', encrypt($topic->id) ) }}" method="POST">

                                        @csrf

                                        <div class="col-sm-7">

                                            <textarea id="content" name="content" class="form-control" placeholder="Enter your content" cols="5" rows="4" required></textarea>

                                        </div> 

                                        <div class="col-12 mt-30">

                                            <button type="submit" class="btn btn-primary ">Add Comment</button>

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