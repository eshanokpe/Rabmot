@extends('agent.layouts.app') 
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<body>

	<!-- wrapper -->
	<style>
		.hidden {
		display: none;
		}
	</style>

	<div class="wrapper">
		<!--page-wrapper--> 

		<div class="page-wrapper">

			<!--page-content-wrapper-->

			<div class="page-content-wrapper">

				<div class="page-content"> 

					<!--breadcrumb-->

					<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

						<div class="breadcrumb-title pe-3">FAQ</div>

						<div class="ps-3">

							<nav aria-label="breadcrumb">

								<ol class="breadcrumb mb-0 p-0">

									<li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="bx bx-home-alt"></i></a>

									</li>

									<li class="breadcrumb-item active" aria-current="page"> FAQ</li>

								</ol>

							</nav>

						</div> 

						

					</div>

					<!--end breadcrumb-->

					

					<div class="row">

						<div class="col-xl-10 mx-auto">

							<div class="card-title d-flex align-items-center">

								<div><i class="bx bx-help-circle me-1 font-22 text-primary"></i>

								</div>

								<h5 class="mb-0 text-primary">Frequently Ask Question </h5>
							</div>
						

							<hr>

							<div class="card border-top border-0 border-4 border-primary">
                                <div class="card-body">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        @foreach($faqs as $key => $faq)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-heading{{ $key }}">
                                                    <button class="accordion-button collapsed" type="button" 
                                                            data-bs-toggle="collapse" 
                                                            data-bs-target="#flush-collapse{{ $key }}" 
                                                            aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" 
                                                            aria-controls="flush-collapse{{ $key }}">
                                                        {{ $faq->question }}
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse{{ $key }}" 
                                                     class="accordion-collapse collapse {{ $key === 0 ? 'show' : '' }}" 
                                                     aria-labelledby="flush-heading{{ $key }}" 
                                                     data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <div class="card-body">
                                                            <p>{{ $faq->answer }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

							

						</div>

					</div>

				</div>

			</div>


		</div>

		<!--end page-wrapper-->

		

	@endsection



	