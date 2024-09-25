@extends('user.layouts.app') 

@section('content')
<style>
    /* hide the arrows beside the input type number forms */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }
    /* special handling for mozilla*/
    input[type=number] {
        -moz-appearance:textfield;
    }
    
    
    /* hide the arrows beside the input type number forms */
    input[type=date]::-webkit-inner-spin-button, 
    input[type=date]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }
    /* special handling for mozilla*/
    input[type=date] {
        -moz-appearance:textfield;
    }
        
    .additionSubtractionTable{
            max-width: 30px !important; 
        }
        
        
        .additionSubtraction{
            border-radius: 3px; 
            padding:3px 4px 3px 4px; 
            overflow:hidden; 
            color: #fff;
            background-color: #bbb ; /* #009ee0; */
            min-width: 17px ; 
            /* height: 23px; */
            font-size: 120% ; 
        }
        
        .additionSubtraction:hover{
            cursor: hand !important;
            cursor: pointer !important;
        }
        
        .additionSubtractionForm{
            border-radius: 5px; 
            padding:3px 5px 3px 5px; 
            margin-top: 1px !important;
            width: 32px ; 
            height: 25px;
        }
</style>
    
	<!-- wrapper -->
	<div class="wrapper">

        <div id="userPrice"></div> 


		<!--page-wrapper-->
		<div class="page-wrapper"> 
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content"> 
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
						<div class="breadcrumb-title pe-3">Vehicle</div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="bx bx-home-alt"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page"> Pricing</li>
								</ol>
							</nav>
						</div> 
						
					</div>
					<!--end breadcrumb-->
					
					<div class="row">
						@if (session('success'))
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									{{ session('success') }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>

							</div>
						@endif
						<div class="col-xl-10 mx-auto">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-car me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Pricing</h5>
                            </div>

							
							<div class="card radius-15 border-top border-0 border-4 ">
								<div class="row">
									<div class="col-12 col-lg-12 col-xl-12">
										<div class=" radius-15">
											<div class="card-body">
												<h6 class="text-justify card-title text-danger">
													TIMELINE:
												</h6>
												<h6 class="card-subtitle mb-2">
													<b>Paper Renewals:</b>  [24-48 hours]
												</h6> 
                                                <h6 class="card-subtitle mb-2">
													<b>New Vehicle Reg:</b> [48-72 hours]
												</h6> 
                                                <h6 class="card-subtitle mb-2">
													<b>Change of Ownership:</b> [72hrs - 2.5 weeks ]
												</h6> 
                                                <h6 class="card-subtitle mb-2">
													<b>Drivers Licence Renewal:</b> [72hrs - 4 weeks]
												</h6> 
                                                <h6 class="card-subtitle mb-2">
													<b>New Drivers Licence:</b> [4-6 weeks]
												</h6>
											</div>
										</div>
									</div>
								</div>
							</div>

							<hr>
							<div class="card">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Flush Accordion</h5>
                                    <hr/> --}}
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Vehicle Papers Renewal
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>
                                                        Hey there! Choose the vehicle type and Select the options 
                                                        you need to view the price. For instance, 
                                                        if it's a commercial vehicle that carries loads and passengers 
                                                        , remember to select 
                                                        the Hackney Permit option.
                                                        </b>
                                                    </div> 
                                                    <div class="card border-top border-0 border-4 ">
                                                        <div class="card-body pt-5">
                                                            <div class="ct_opt" id="renewwalPaper"> 
                                                                <div class="col-md-12 pt-3">
                                                                    <label for="inputState" class="form-label">Select State</label>
                                                                    <select required name="stateId" id="stateId" class="form-select">
                                                                        <option disabled selected="selected" value="">-- Select State--</option>
                                                                        @foreach($states as $state) 
                                                                            <option data-stat="{{$state->id}}" data-id = "{{$state->id}}" value="{{$state->id}}">{{$state->name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="col-md-12 pt-3">
                                                                    <label for="inputState" class="form-label">Select Category of Vehicle</label>
                                                                    
                                                                    <select required name="" id="vehicleForm" class="form-select">
                                                                        <option disabled selected="selected" value="">-- Select Category of Vehicle--</option>
                                                                        @foreach($vehiclelist as $vehicle3) 
                                                                            <option data-stat="{{$vehicle3->id}}" data-id = "{{$vehicle3->id}}" value="{{$vehicle3->id}}">{{$vehicle3->name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                

                                                                
                                                                <div class="row mb-2  pt-3">
                                                                    <div class="col-md-6 card-body">
                                                                        <div class=" " >
                                                                            <input name="vehicleLicense" class="form-check-input " type="checkbox" value="0" id="addOne">
                                                                            <label class="form-check-label" for="flexCheckDefault">Vehicle License </label>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 ">
                                                                        <label for="inputAddress2" class="form-label"> Expiry Date</label>
                                                                    
                                                                        <table class="padding-no margin-no additionSubtractionTable additionSubtractionTableTwo ">
                                                                            <tr>
                                                                                <td class= "padding-no margin-righ-no col-md-1" >			
                                                                                    <div class="additionSubtraction minusFigure" data-id = "additionSubtractionButtonTwo" >-</div>
                                                                                </td>
                                                                                <td class= "padding-no margin-right-no col-md-5" > 
                                                                                    <div class=" padding-xs">
                                                                                        <input name="addvehicleLicense" type ="number"  class = "form-control margin-no padding-left-xs  additionSubtractionForm additionSubtractionButtonTwo " 
                                                                                        id= "addSubInput" value="1" >
                                                                                    </div>
                                                                                </td>
                                                                                <td class= "padding-no margin-right-no col-md-1">
                                                                                    <div class= "additionSubtraction plusFigure" data-id = "additionSubtractionButtonTwo" >+</div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>  
                                                                </div>
                                                                <hr>
                                                                <div class="row mb-2" >
                                                                    <div class="card-body col-md-6" >
                                                                        <input class="form-check-input" type="checkbox" value="0" id="addTwo" />
                                                                        <label class="form-check-label" for="defaultCheck2"> Road Worthiness</label>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row mb-2" >
                                                                    <div class="card-body col-md-6" >
                                                                        <input class="form-check-input" type="checkbox" value="0" id="addSix" />
                                                                        <label class="form-check-label" for="defaultCheck3"> Proof Ownership</label>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row mb-2" >
                                                                    <div class="card-body col-md-6" >
                                                                        <input class="form-check-input" type="checkbox" value="0" id="addThree" />
                                                                        <label class="form-check-label" for="defaultCheck3"> Third-Party Insurance</label>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row mb-0" >
                                                                    <div class=" col-md-6" >
                                                                        <input class="form-check-input" type="checkbox" value="0" id="addSeven" />
                                                                        <label class="form-check-label" for="defaultCheck3"> Police CMRIS</label>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row mb-2  ">
                                                                    <div class="col-md-6 card-body">
                                                                        <div class=" " >
                                                                            <input name="hackneyPermit" class="form-check-input" type="checkbox" value="0" id="addFour">
                                                                            <label class="form-check-label" for="flexCheckDefault">Hackney Permit</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 ">
                                                                        <label for="inputAddress2" class="form-label"> Expiry Date</label>
                                                                    
                                                                        <table class="padding-no margin-no additionSubtractionTable additionSubtractionTableTwo ">
                                                                            <tr>
                                                                                <td class= "padding-no margin-righ-no col-md-1" >			
                                                                                    <div class="additionSubtraction minusFigure" data-id = "additionSubtractionTableTwo" >-</div>
                                                                                </td>
                                                                                <td class= "padding-no margin-right-no col-md-5" > 
                                                                                    <div class=" padding-xs">
                                                                                        <input name="addhackneyPermit" type ="number"  class = "form-control margin-no padding-left-xs  additionSubtractionForm additionSubtractionTableTwo " 
                                                                                        id= "addSubInputHackney" value="1" >
                                                                                    </div>
                                                                                </td>
                                                                                <td class= "padding-no margin-right-no col-md-1">
                                                                                    <div class= "additionSubtraction plusFigure" data-id = "additionSubtractionTableTwo" >+</div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row mb-2" >
                                                                    <div class="col-md-12 ">
                                                                        <input class="form-check-input" type="checkbox" value="0" id="addFive" />
                                                                        <label class="form-check-label" for="defaultCheck5"> Book Vehicle Inspection Pick & Drop</label>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            
                                                                <div class="card-body  col-md-12 text-center ">
                                                                    <div class="alert alert-info mt-2" id="mainPrice">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0</span></div>
                                                                    <div class="main-btn-wrap" > 
                                                                        <center> <a href="" class="btn btn-primary px-5 text-center" > Process Paper </a></center>
                                                                    </div>
                                                                </div>
                
                                                                

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- New Vehicle Registration --}}
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                New Vehicle Registration
                                            </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>
                                                            Select the type of Vehicle, then select all the options you require to see the accurate price.
                                                            For instance, if it's a commercial vehicle that carries loads and passengers , remember to select the Hackney Permit option.
                                                        </b>
                                                    </div>
                                                    <div class="card border-top border-0 border-4 ">
                                                        <div class="card-body p-5">
                                                             
                                                            <form class="row g-3" method="POST" action="#">
                                                                @csrf
                                                                <div class="ct_opt" id="ct_opt"> 
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label">Select State</label>
                                                                        <select required name="stateIdReg" id="stateIdReg" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select State--</option>
                                                                            @foreach($states as $state) 
                                                                                <option data-stat="{{$state->id}}" data-id = "{{$state->id}}" value="{{$state->id}}">{{$state->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label">Select Category of Vehicle</label>
                                                                         
                                                                        <select required name="vehicleId" id="vehicleId" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select Vehicle --</option>
                                                                            @foreach($vehiclelist as $vehicle2) 
                                                                                <option data-stat="{{$vehicle2->id}}" data-id = "{{$vehicle2->id}}" value="{{$vehicle2->id}}">{{$vehicle2->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="ct_opt pt-3" id="ct_opt"> 
                                                                    <div class="col-md-12">
                                                                        <label for="inputState" class="form-label"> Registration Type </label>
                                                                        <select required name="registrationTypeId" id="registrationTypeId" class="form-select">
                                                                            <option disabled selected="selected">-- Select Registration Type --</option>
                                                                            @foreach($vehiclecategories as $vehiclecategory) 
                                                                                <option data-stat="{{$vehiclecategory->id}}" data-id = "{{$vehiclecategory->id}}" value="{{$vehiclecategory->id}}">{{$vehiclecategory->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                  
                                                                
                                                                <div class="ct_opt pt-3" id="ct_opt"> 
                                                                    <div class="col-md-12">
                                                                        <label for="inputState" class="form-label"> Number Plate </label>
                                                                        <select required class="form-select" id="numberplate" name="country" aria-label="Default select example">
                                                                            <option disabled selected="selected" >-- Type of Number Plate --</option>
                                                                            <option selected="selected" value="RPN">Random Plate Number</option>
                                                                            <option value="PCN">Personalized/Customize Number</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 pt-3"> 
                                                                    <div class="hackneyPermit " >
                                                                        <input name="hackneyPermit" class="form-check-input" type="checkbox" value="0" id="addOne">
                                                                        <label class="form-check-label" for="flexCheckDefault">Hackney Permit</label>
                                                                    </div>
                                                                </div>  
                                                               <div class="col-md-6 pt-3"> 
                                                                    <div class="hackneyPermit " >
                                                                        <input name="hackneyPermit" class="form-check-input" type="checkbox" value="0" id="addTwo">
                                                                        <label class="form-check-label" for="flexCheckDefault">Police CMRIS</label>
                                                                    </div>
                                                                </div> 
                                                                <div class="pt-3  col-md-12 text-center ">
                                                                    <div id="mainPricevreg" class="alert alert-info mt-3">Total Amount - ₦ <span >0</span></div>
                                                                    <div class="main-btn-wrap ">
                                                                        <center> <a href="" class="btn btn-primary"> Process Paper </a></center>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Change of Ownership
                                            </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>
                                                            Select the type of Vehicle, then select all the options you require, to see the acccurate price.
                                                        </b>
                                                    </div>
                                                    <div class="card border-top border-0 border-4 ">
                                                        <div class="card-body p-5">
                                                            
                                                                <div class="ct_opt" id="ct_opt"> 
                                                                    <div class="col-md-12">
                                                                        <label for="inputState" class="form-label">Select State</label>
                                                                        <select required name="stateIdCO" id="stateIdCO" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select State--</option>
                                                                            @foreach($states as $state) 
                                                                                <option data-stat="{{$state->id}}" data-id = "{{$state->id}}" value="{{$state->id}}">{{$state->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label">Select Category of Vehicle</label>
                                                                        <select required name="vehicleIdCO" id="vehicleIdCO" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select Vehicle --</option>
                                                                            @foreach($vehiclelist as $vehicle3) 
                                                                                <option data-stat="{{$vehicle3->id}}" data-id = "{{$vehicle3->id}}" value="{{$vehicle3->id}}">{{$vehicle3->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <br>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label">Document Expiration Date</label>
                                                                        <select class="form-select" id="vehiclelicensedate" name="vehiclelicensedate" aria-label="Default select example">
                                                                            <option selected disabled>-- Vehicle License: --</option>
                                                                            <option value="lessthan1month">Less than 1 month</option>
                                                                            <option value="morethan1month">More than 1 month</option>
                                                                            <option value="morethan1year">More than 1 year</option>
                                                                            <option value="morethan2year">More than 2 year</option>
                                                                            <option value="morethan3year">More than 3 year</option>
                                                                            <option value="morethan4year">More than 4 year</option>
                                                                            <option value="morethan5year">More than 5 year</option>
                                                                            <option value="morethan6year">More than 6 year</option>
                                                                            <option value="morethan7year">More than 7 year</option>
                                                                        </select>
                                                                    </div>
                                                                   
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label"> Hackney Permit </label>
                                                                        
                                                                        <select class="form-select" name="hacneypermitdate" id="hacneypermitdate" aria-label="Default select example">
                                                                            <option>-- Hackney Permit: --</option>
                                                                            <option value="lessthan1month">Less than 1 month</option>
                                                                            <option value="morethan1month">More than 1 month</option>
                                                                            <option value="morethan1year">More than 1 year</option>
                                                                            <option value="morethan2year">More than 2 year</option>
                                                                            <option value="morethan3year">More than 3 year</option>
                                                                            <option value="morethan4year">More than 4 year</option>
                                                                            <option value="morethan5year">More than 5 year</option>
                                                                            <option value="morethan6year">More than 6 year</option>
                                                                            <option value="morethan7year">More than 7 year</option>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label"> Type of Plate Number </label>
                                                                        <select class="form-select" id="platenumber" name="platenumber" aria-label="Default select example">
                                                                            <option selected disabled>-- Type of Plate Number: --</option>
                                                                            <option value="RPN">New Random Plate Number</option>
                                                                            <option value="CPN">New Customised Plate Number</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6 pt-3"> 
                                                                        <div class="hackneyPermit " >
                                                                            <input name="hackneyPermit" class="form-check-input" type="checkbox" value="0" id="addTwo">
                                                                            <label class="form-check-label" for="flexCheckDefault">Police CMRIS</label>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="pt-3  col-md-12 text-center ">
                                                                        <div id="mainPriceco" class="alert alert-info mt-3">Total Amount - ₦ <span >0.00</span></div>
                                                                        <div class="main-btn-wrap ">
                                                                            <center> <a href="" class="btn btn-primary px-5 text-center" > Process Paper </a></center>
                                                                        </div>
                                                                    </div>
                    
                                                                </div>
                                                            
                                                            
                                                        </div>
                                                    </div>

                                                </div>

                                             </div>
                                        </div>
                                       {{-- Driver's License Renewal --}}
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingFive">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                Driver's License Renewal
                                            </button>
                                            </h2>
                                            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>
                                                            Select the number of years of validity you require.
                                                        </b>
                                                    </div>
                                                    <div class="card border-top border-0 border-4 " id="vehicleFormDLR">
                                                        <div class="card-body p-5">
                                                            
                                                            <form class="row g-3" method="POST" action="#">
                                                                @csrf
                                                                <div class="ct_opt" id="ct_opt"> 
                                                                    <div class="col-md-12">
                                                                        <label for="inputState" class="form-label">Select State</label>
                                                                        <select required name="stateIdDLR" id="stateIdDLR" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select State--</option>
                                                                            @foreach($states as $state) 
                                                                                <option data-stat="{{$state->id}}" data-id = "{{$state->id}}" value="{{$state->id}}">{{$state->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label">Choose Length of Validity</label>
                                                                        <select required name="lengthofyearDLR" id="lengthofyearDLR" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select length of Years --</option>
                                                                        </select>
                                                                    </div> 
                                                                     

                                                                    <div class="pt-3 col-md-12 text-center ">
                                                                        <div id="mainPriceDLR" class="alert alert-info mt-3">Total Amount - ₦ <span >0.00</span></div>
                                                                        <div class="main-btn-wrap ">   
                                                                            <center> <a href="" class="btn btn-primary px-5 text-center"> Process Paper </a></center>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                    
                                                            </form> 
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                        {{-- New Driver's License  --}}
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingSix">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                               New Driver's License 
                                            </button>
                                            </h2>
                                            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>
                                                            Select the number of years of validity you require.
                                                        </b>
                                                    </div>
                                                    <div class="card border-top border-0 border-4 ">
                                                        <div class="card-body p-5">
                                                            
                                                            <div class="ct_opt" id="vehicleFormVL"> 
                                                                <div class="col-md-12">
                                                                    <label for="inputState" class="form-label">Select State</label>
                                                                    <select required name="stateIdVL" id="stateIdVL" class="form-select">
                                                                        <option disabled selected="selected" value="">-- Select State--</option>
                                                                        @foreach($states as $state) 
                                                                            <option data-stat="{{$state->id}}" data-id = "{{$state->id}}" value="{{$state->id}}">{{$state->name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12 pt-3">
                                                                    <label for="inputState" class="form-label">Choose Length of Validity</label>
                                                                    <select required name="lengthofyear" id="lengthofyear" class="form-select">
                                                                        <option disabled selected="selected" value="">-- Select length of Years --</option>
                                                                    </select>
                                                                </div> 

                                                                <div class="card-body  col-md-12 text-center ">
                                                                    <div id="mainPriceVL" class="alert alert-info mt-3">Total Amount - ₦ <span >0.00</span></div>
                                                                    <div class="main-btn-wrap ">  
                                                                        <center> <a href="" class="btn btn-primary px-5 text-center"> Process Paper </a></center>
                                                                    </div>
                                                                </div> 
                
                                                                <div class="col-12 mt-10 text-center " >
                                                                </div>

                                                            </div>
                                                           	
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                        {{-- Internatinal Driver's License --}}
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading7">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapse7">
                                              Internatinal Driver's License 
                                            </button>
                                            </h2>
                                            <div id="flush-collapse7" class="accordion-collapse collapse" aria-labelledby="flush-heading7" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>
                                                            Select the number of years of validity you require.
                                                        </b>
                                                    </div>
                                                    <div class="card border-top border-0 border-4 ">
                                                        <div class="card-body p-5">
                                                            
                                                            <form class="row g-3" method="POST" action="#" id="vehicleFormIDL">
                                                                @csrf
                                                                    <div class="ct_opt" id="ct_opt"> 
                                                                         <div class="col-md-12">
                                                                        <label for="inputState" class="form-label">Select State</label>
                                                                        <select required name="stateIdIDL" id="stateIdIDL" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select State--</option>
                                                                            @foreach($states as $state) 
                                                                                <option data-stat="{{$state->id}}" data-id = "{{$state->id}}" value="{{$state->id}}">{{$state->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12 pt-3">
                                                                        <label for="inputState" class="form-label">Choose Length of Validity</label>
                                                                        <select required name="lengthofyearIDL" id="lengthofyearIDL" class="form-select">
                                                                            <option disabled selected="selected" value="">-- Select length of Years --</option>
                                                                        </select>
                                                                    </div> 

                                                                    <div class="card-body  col-md-12 text-center ">
                                                                        <div class="card-body  col-md-12 text-center ">
                                                                            <div id="mainPriceIDL" class="alert alert-info mt-3">Total Amount - ₦ <span >0.00</span></div>
                                                                            <div class="main-btn-wrap ">  
                                                                                <center> <a href="" class="btn btn-primary px-5 text-center"> Process Paper </a></center>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mt-10 text-center " >
                                                                    </div>
                                                                </div>
                                                            </form>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                         {{-- Other Permits/Papers --}}
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                Other Permits/Papers
                                            </button>
                                            </h2>
                                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <b>
                                                            Select your type of vehicle below.
                                                        </b>
                                                    </div>
                                                    <div class="card border-top border-0 border-4 ">
                                                        <div class="card-body p-5" >
                                                            
                                                            <div class="ct_opt" id="vehicleFormOP"> 
                                                                <div class="col-md-12">
                                                                    <label for="inputState" class="form-label">Select Type of Permit</label>
                                                                    <select class="form-select" id="otherPermitId" name="otherPermitId" aria-label="Default select example">
                                                                        <option >-- Select the Others Permit --</option>
                                                                        @foreach($otherPermits as $otherPermit)
                                                                            <option value="{{ $otherPermit->id }}" >{{ $otherPermit->otherPermitTypeInfo->permitType }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="card-body  col-md-12 text-center ">
                                                                    <div id="mainPriceOP" class="alert alert-info mt-3">Total Amount - ₦ <span >0.00</span></div>
                                                                </div>
                                                                <div class="main-btn-wrap ">  
                                                                    <center> <a href="" class="btn btn-primary px-5 text-center"> Process Paper </a></center>
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
				</div>
			</div>
				
		</div>
		<!--end page-content-wrapper-->
		
    </div>
    <!--end page-wrapper-->
		
        

@endsection