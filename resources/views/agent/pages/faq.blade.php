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
									 {{-- <h5 class="card-title">Flush Accordion</h5>
                                    <hr/> --}}
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
									 
									    <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading1">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                                                 Is there a grace period after the expiration of my document(s)?
                                            </button>
                                            </h2>
                                            <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="card-body">
                                                        <p>No, there is no provision in the law that allows for a grace period after the expiration of your document(s).
                                                            </p>
                                                    </div>
                                                   
                                                </div>

                                             </div>
                                        </div>
								
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
									 
									    <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                                                 Are driver's licenses issued from other states valid in Lagos State?
                                            </button>
                                            </h2>
                                            <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="card-body">
                                                        <p>Driver's licenses issued from other states are valid in Lagos State as 
                                                            long as the tripartite structure/arrangement is observed and the license is genuine.
                                                            
                                                            </p>
                                                    </div>
                                                   
                                                </div>

                                             </div>
                                        </div>
								
                                    </div>

                                     <div class="accordion accordion-flush" id="accordionFlushExample">
									 
									    <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading4">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                                                 What happens if I fail the roadworthiness vehicle inspection test?
                                            </button>
                                            </h2>
                                            <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-heading4" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="card-body">
                                                        <p>Your vehicle will not be retained. Instead, the faults identified during the test will be 
                                                            communicated to you. You will be required to fix the identified faults and represent the vehicle for a re-test at no additional cost.
                                                           
                                                            
                                                            </p>
                                                    </div>
                                                   
                                                </div>

                                             </div>
                                        </div>
								
                                    </div>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
									 
									    <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading5">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                                                Why are privately registered pick-up trucks and buses given
                                                             a 6-month validity on Roadworthiness Certificates?
                                            </button>
                                            </h2>
                                            <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-heading5" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="card-body">
                                                        <p>According to the law, any commercially designed vehicle, including pick-up trucks and buses, has a Roadworthiness Certificate validity period of 6 months. 
                                                            This ensures that these vehicles meet the required safety standards for commercial operations.
                                                            
                                                            
                                                            </p>
                                                    </div>
                                                   
                                                </div>

                                             </div>
                                        </div>
								
                                    </div>
                                     <div class="accordion accordion-flush" id="accordionFlushExample">
									 
									    <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading6">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6">
                                                  Will I have to pay additional costs for inspection after paying for the Roadworthiness Certificate?

                                            </button>
                                            </h2>
                                            <div id="flush-collapse6" class="accordion-collapse collapse" aria-labelledby="flush-heading6" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="card-body">
                                                        <p>No, the cost of inspection is already included in the payment made for the Roadworthiness Certificate.
                                                            </p>
                                                    </div>
                                                   
                                                </div>

                                             </div>
                                        </div>
								
                                    </div>
                                     
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
									 
									    <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading8">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse8" aria-expanded="false" aria-controls="flush-collapse8">
                                                  Where are the Enforcing Camera's located?

                                            </button>
                                            </h2>
                                            <div id="flush-collapse8" class="accordion-collapse collapse" aria-labelledby="flush-heading8" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="card-body">
                                                        <p>The Enforcing Cameras are strategically positioned throughout Lagos, but their specific locations are not disclosed to the general public.
                                                        </p>
                                                    </div>
                                                   
                                                </div>

                                             </div>
                                        </div>
								
                                    </div>
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
									 
									    <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading9">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse9" aria-expanded="false" aria-controls="flush-collapse9">
                                                 Is there a website where I can verify the authenticity of my vehicle papers?


                                            </button>
                                            </h2>
                                            <div id="flush-collapse9" class="accordion-collapse collapse" aria-labelledby="flush-heading9" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="card-body">
                                                        <p>
                                                            <b> Yes, you can verify the legitimacy of your vehicle documents through the following websites:</b>
                                                        </p>
                                                        
                                                        <p>  
                                                        * To verify your vehicle license, visit <a href="http://verify.autoreg.ng/"> "www.verify.autoreg.ng,"</a> input your plate number, select "I am not a robot," and click search.
                                                         </p>  
                                                         <p>
                                                         * To verify your vehicle insurance certificate, go to <a href="https://askniid.org/">"www.askniid.org,"</a> click on "check Policy," select "vehicle policy," and choose "single." Enter your plate number or insurance policy number, then click search.
                                                         </p>
                                                         <p>
                                                         * To verify your roadworthiness certificate, dial <a href="tel:*554*38#">*554*38#</a>  on your phone. Standard SMS rates apply.
                                                        </p>
                                                        <p>
                                                            * To verify your hackney permit, visit <a href="http://verify.autoreg.ng/"> "www.verify.autoreg.ng,"</a> input your plate number, select "I am not a robot," and click search.
                                                         </p>
                                                         <p>
                                                         * To verify your driver's license, go to <a href="https://www.nigeriadriverslicence.org/"> "www.nigeriadriverslicence.org,"</a> click on "Edit Application," enter your driver's license number and date of birth, and click search. 
                                                        </p>
                                                    </div>
                                                   
                                                </div>

                                             </div>
                                        </div>
								
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



	