@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
   
    /* Apply custom styles for the checked state to the checkbox's appearance */
    .form-check-input:checked::before {
        content: "\2713"; /* Unicode character for checkmark */
        display: block;
        text-align: center;
        font-size: 16px;
        line-height: 20px;
        background-color: #142444;
        color: #fff; /* Change this color to your desired checkmark color */
    }
</style> 

@section('content')
<section class="how-we-are padding-top-100 padding-bottom-50 " style="padding-top: 80px;">
    <div class="container">
        <div class="col-lg-12">
            <div class="border-bottom padding-bottom-5 ">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="widget-title "> <b>Check Pricing</b></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 vehic" id="vpr">
            <h2 class="widget-title padding-top-30 padding-bottom-20"> <b>Vehicle Papers Renewal </b></h2>
            <div class="border-bottom padding-bottom-20 ">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bg-white border1 shadow ">
                            <div class="note5  shadow-sm">
                                <p>PROCESSING TIME <br>
                                Paper Renewals [72 hours] </p>
                                <p> INSTRUCTION: <br>
                                Select Vehicle type from drop-down, Choose which documents you wish to see it price by checking the boxes. </p>
                            
                                <p> NOTE: <br>
                                 You must select the HACKNEY PERMIT option for a vehicle that carries 
                                    loads and passengers (Taxi, Commercial vehicle, Company Vehicle).
                                </p>
                                
                                <p> ELIGIBILITY: <br>
                                 Only a vehicle used and registered in Nigeria are eligible for a renewal.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="bg-white border1 shadow ">
                            <div class="note  shadow-sm">
                                <span style="font-size: 16px;"> Select the Option of your choice.</span>
                            </div>

                            <div class="note1" id="renewwalPaper"> 
                                <div class="input-group input-group-merge pt-2">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="stateId" id="stateId" class="form-select">
                                        <option disabled selected="selected" value="">-- Select State --</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group input-group-merge pt-3">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="vehicleForm" id="vehicleForm" class="form-select">
                                        <option disabled selected="selected" value="">-- Select Vehicle --</option>
                                        @foreach($vehiclelist as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <input name="vehicleLicense" class="form-check-input additionSubtraction" type="checkbox" value="0" id="addOne" />
                                        <label class="form-check-label" for="addOne"> Vehicle License</label>                 
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <input class="form-check-input additionSubtraction" type="checkbox" value="0" id="addTwo" />
                                        <label class="form-check-label" for="addTwo"> Road Worthiness</label>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <input class="form-check-input additionSubtraction" type="checkbox" value="0" id="addThree" />
                                        <label class="form-check-label" for="addThree"> Third-Party Insurance</label>
                                    </div>
                                </div> 
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <input class="form-check-input additionSubtraction" type="checkbox" value="0" id="addFour" />
                                        <label class="form-check-label" for="addFour"> Hackney Permit</label>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <input class="form-check-input additionSubtraction" type="checkbox" value="0" id="addFive" />
                                        <label class="form-check-label" for="addFive"> Book Vehicle Inspection Pick & Drop</label>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <input class="form-check-input additionSubtraction" type="checkbox" value="0" id="addSix" />
                                        <label class="form-check-label" for="addSix"> Proof of Ownership</label>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <input class="form-check-input additionSubtraction" type="checkbox" value="0" id="addSeven" />
                                        <label class="form-check-label" for="addSeven"> Police CMRIS</label>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="check-listg">
                                        <p class="check-listgk" id="mainPrice">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0.00</span></p>
                                        <div class="main-btn-wrap">
                                            <center><a href="{{ route('home.vehicleRenewalPaper') }}" class="btn btn-primary" style="background-color: #142444; border-color:#142444"> Process Paper </a></center>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
  

                                <script>
                                    $(document).ready(function() {
                                        $.ajaxSetup({
                                        headers: {
												'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
											}
										});
                                        var inputHackeyvalue = 0;
                                        var inputVehiclelicense = 0;
                                    
                                        // Function to update hackey value
                                        function updateHackeyvalue() {
                                            inputHackeyvalue = parseFloat($('#addSubInputHackney').val()) || 0;
                                            updateTotal();
                                        }
                                    
                                        // Function to update display value
                                        function updateDisplayValue() {
                                            inputVehiclelicense = parseFloat($('#addSubInput').val()) || 0;
                                            updateTotal();
                                        }
                                    
                                        // Event listener for stateId change
                                        $('#stateId').change(function() {
                                            sendAjaxRequest();
                                        });
                                    
                                        // Event listener for vehicleForm change
                                        $('#vehicleForm').change(function() {
                                            sendAjaxRequest();
                                        });
                                
                                    // Function to send AJAX request
                                    function sendAjaxRequest() {
                                        var stateId = $('#stateId').val();
                                        var vehicleId = $('#vehicleForm').val();
                                
                                        if (stateId && vehicleId) {
                                            $.ajax({
                                                url: "{{ route('getVPpricing') }}",
                                                method: 'POST',
                                                data: {
                                                    stateId: stateId,
                                                    vehicleId: vehicleId
                                                },
                                                success: function(response) {
                                                    console.log('AJAX success:', response);
                                
                                                    // Update input values
                                                    $('#addOne').val(response.vehiclelicense || 0);
                                                    $('#addTwo').val(response.roadworthiness || 0);
                                                    $('#addThree').val(response.thirdpartyinsurance || 0);
                                                    $('#addFour').val(response.hackneypermit || 0);
                                                    $('#addFive').val(response.vehicleinspectionpickanddrop || 0);
                                                    $('#addSix').val(response.proofofownership || 0);
                                                    $('#addSeven').val(response.policeCMRIS || 0);
                                
                                                    // Update total
                                                    updateTotal();
                                                },
                                                error: function(err) {
                                                    console.error('AJAX error:', err);
                                                    // Set all input values to 0 on error
                                                    $('#addOne').val(0);
                                                    $('#addTwo').val(0);
                                                    $('#addThree').val(0);
                                                    $('#addFour').val(0);
                                                    $('#addFive').val(0);
                                                    $('#addSix').val(0);
                                                    $('#addSeven').val(0);
                                
                                                    // Update total with current input values
                                                    updateTotal();
                                                }
                                            }); 
                                        } 
                                    }
                                
                                    // Event listeners for checkboxes and input fields
                                    $('.additionSubtraction, #addSubInput, #addSubInputHackney').on('input', function() {
                                        updateDisplayValue();
                                        updateHackeyvalue();
                                    });
                                     
                                        // Function to update total
                                        function updateTotal() {    
                                            var checkbox1 = $("input[id=addOne]").prop("checked") ? parseInt($("input[id=addOne]").val()) : 0;
											var checkbox2 = $("input[id=addTwo]").prop("checked") ? parseInt($("input[id=addTwo]").val()) : 0;
											var checkbox3 = $("input[id=addThree]").prop("checked") ? parseInt($("input[id=addThree]").val()) : 0;
											var checkbox4 = $("input[id=addFour]").prop("checked") ? parseInt($("input[id=addFour]").val()) : 0;
											var checkbox5 = $("input[id=addFive]").prop("checked") ? parseInt($("input[id=addFive]").val()) : 0;
											var checkbox6 = $("input[id=addSix]").prop("checked") ? parseInt($("input[id=addSix]").val()) : 0;
											var checkbox7 = $("input[id=addSeven]").prop("checked") ? parseInt($("input[id=addSeven]").val()) : 0;
                                    
                                            var vl = checkbox1;
                                            var rw = checkbox2 + checkbox3;
                                            var hp = checkbox4;
                                            var vi = checkbox5 + checkbox6;
                                            var po = checkbox7;
                                    
                                            var result = vl + rw + hp + vi + po;
                                    
                                            // Format the result with two decimal places
                                            var formattedValue = new Intl.NumberFormat('en-US', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }).format(result);
                                    
                                            // Update total display
                                            $('#mainPrice span').text(formattedValue);
                                        }
                                    
                                        // Initial AJAX request on page load
                                        sendAjaxRequest();
                                    });

                                </script>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        

        <div class="col-lg-12 vehic" id="nvr">
            <h2 class="widget-title padding-top-30 padding-bottom-20"> <b>New Vehicle Registration</b></h2>
            <div class="border-bottom padding-bottom-20 ">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bg-white border1 shadow ">
                            <div class="note5  shadow-sm">
                                <p>
                                PROCESSING TIME <br>
                                    New Vehicle Reg. [48-72 hours] <br><br>
                                INSTRUCTION: <br>
                                Only a brand new, foreign used vehicle, or a vehicle used in Nigeria and yet to 
                                be registered, qualify for New Vehicle Registration; 
                                <br><br>
                                Select the type of Vehicle, 
                                then select all the options you require to see the accurate price <br> <br>
                                NOTE: <br> You must select the HACKNEY PERMIT option for a vehicle that carries 
                                    loads and passengers (Taxi, Commercial vehicle, Company Vehicle)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="bg-white border1 shadow ">
                            <div class="note  shadow-sm">
                                <span style="font-size: 16px;"> Select the Option of your choice. 
                                </span>
                            </div>

                            <div class="note1" >
                                <div class="input-group input-group-merge pt-2">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="stateIdReg" id="stateIdReg" class="form-select">
                                        <option disabled selected="selected" value="">-- Select State --</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="input-group input-group-merge pt-3">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="vehicleId" id="vehicleIdReg" class="form-select">
                                        <option disabled selected="selected" value="">-- Select Vehicle --</option>
                                        @foreach($vehiclelist as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group input-group-merge pt-3">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="registrationTypeId" id="registrationTypeId" class="form-select">
                                        <option disabled selected="selected">-- Select Registration Type --</option>
                                        @foreach($vehicleregistrationTypes as $vehicleregistrationType) 
                                            <option value="{{$vehicleregistrationType->id}}">{{$vehicleregistrationType->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group input-group-merge pt-3">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required class="form-select" id="numberplate" name="country" aria-label="Default select example">
                                        <option disabled selected="selected" >-- Type of Number Plate --</option>
                                        <option selected="selected" value="RPN">Random Plate Number</option>
                                        <option value="PCN">Personalized/Customize Number</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-6 pt-2">
                                    <div class="hackneyPermit">
                                        <input class="form-check-input" type="checkbox" value="0" id="addOneReg" />
                                        <label class="form-check-label" for="defaultCheck4">  Hackney Permit</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 pt-2">
                                    <div class="hackneyPermit">
                                        <input class="form-check-input" type="checkbox" value="0" id="addTwoReg" />
                                        <label class="form-check-label" for="defaultCheck4">   Police CMRIS</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 ">
                                    <div class="check-listg">
                                        <p class="check-listgk" id="mainPriceVReg">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0.00</span></p>
                                        <div class="main-btn-wrap ">
                                        <center> <a href="{{ route('home.newVehicleRegistration') }}" class="btn btn-primary" style="background-color: #142444; border-color:#142444"> Process Paper </a></center>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                   $(document).ready(function() {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        var stateIdReg, vehicleIdReg, registrationTypeId, numberplateType;
                                        
                                        
                                        $('#stateIdReg, #vehicleIdReg, #registrationTypeId, #numberplate, .hackneyPermit').change(function() {
                                            sendAjaxRequest();
                                        });
                                     
                                        function sendAjaxRequest() {
                                            stateIdReg = $('#stateIdReg').val();
                                            vehicleIdReg = $('#vehicleIdReg').val();
                                            registrationTypeId = $('#registrationTypeId').val();
                                            numberplateType = $('#numberplate').val();
                                            
                                            
                                             // Get the ID of the clicked checkbox
                                            var checkboxValue = 0, checkboxCMRISValue = 0;
                                            
                                            var checkboxId = $("input#addOneReg").val();
                                            var checkboxCMRIS = $("input#addTwoReg").val();
                                            
                                             // Check if the checkbox is checked and update the checkboxValue accordingly
                                            if ($("input#addOneReg").is(":checked")) {
                                                checkboxValue = parseFloat(checkboxId);
                                            } else {
                                                checkboxValue = 0;
                                            }
                                            if ($("input#addTwoReg").is(":checked")) {
                                                checkboxCMRISValue = parseFloat(checkboxCMRIS);
                                            } else {
                                                checkboxCMRISValue = 0;
                                            }
                                            $.ajax({
                                                type: 'POST',
                                                url: "{{ route('getVRpricing') }}", // Replace with your route name
                                                data: {
                                                    stateIdReg : stateIdReg,
                                                    vehicleIdReg: vehicleIdReg,
                                                    registrationTypeId: registrationTypeId,
                                                    numberplateType: numberplateType,
                                                },
                                                success: function(response) {
                                                    console.log('NumberplateType', response.NumberplateType); 
                                                    console.log('hackneyPermit', response.hackneyPermit);
                                    
                                                    var resultReg = parseFloat(response.amount);
                                                    var hackneyPermit = parseFloat(response.hackneyPermit);
                                                    var policeCmris = parseFloat(response.policeCmris);
                                                    
                                                    // Add the checkboxValue to the result
                                                    var totalValueReg = resultReg  + checkboxValue + checkboxCMRISValue;

                                                    var formattedValueReg = new Intl.NumberFormat('en-US',{
                                                        minimumFractionDigits:2,
                                                        maximumFractionDigits:2
                                                    }).format(totalValueReg); 
                                
                                                
                                                    $('input#addOneReg').val(hackneyPermit);
                                                    $('input#addTwoReg').val(policeCmris);
                                                    $("#mainPriceVReg span").text(formattedValueReg);
                                    
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('AJAX Error:', error);
                                                    var resultReg = parseFloat(0);
                                                    var hackneyPermitReg = parseFloat(0);
                                                    var policeCmrisReg = parseFloat(0);
                                                    $('input#addOnRege').val(hackneyPermitReg);
                                                    $('input#addTwoReg').val(policeCmrisReg);
                                
                                                    var totalValueReg = resultReg + checkboxValue + checkboxCMRISValue;
                                
                                                    var formattedValueReg = new Intl.NumberFormat('en-US', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }).format(totalValueReg);
                                
                                                    // Handling error response
                                                    $('#addOneReg').val(0);
                                                    $('#addTwoReg').val(0);
                                                    $("#mainPriceVReg span").text(formattedValueReg);
                                                }
                                            });
                                        }
                                    });

                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 vehic" id="coo">
            <h2 class="widget-title padding-top-30 padding-bottom-20"> <b>Change Of Ownership</b></h2>
            <div class="border-bottom padding-bottom-20 ">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bg-white border1 shadow ">
                            <div class="note5  shadow-sm">
                                <p>
                                PROCESSING TIME <br>
                                Change of Ownership. [72 hours -2.5 weeks] <br><br>
                                INSTRUCTION: <br>
                                Only a vehicle registered in Nigeria by the previous owner is eligible for a 
                                Change of Ownership; <br> <br>
                                Select the type of Vehicle, then select all the options you require, to see the 
                                accurate price. <br> <br>
                        
                                NOTE: <br> You must select the HACKNEY PERMIT option for a vehicle that carries 
                                    loads and passengers (Taxi, Commercial vehicle, Company Vehicle)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="bg-white border1 shadow ">
                            <div class="note  shadow-sm">
                                <span style="font-size: 16px;"> Select the Option of your choice. 
                                </span>
                            </div>

                            <div class="note1">
                                <div class="input-group input-group-merge pt-2">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="" id="stateIdCO" class="form-select">
                                        <option disabled selected="selected" value="">-- Select State --</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option> 
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="input-group input-group-merge pt-3">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="" id="vehicleIdCO" class="form-select">
                                        <option disabled selected="selected" value="">-- Select Vehicle --</option>
                                        @foreach($vehiclelist as $vehicle3) 
                                            <option data-stat="{{$vehicle3->id}}" data-id = "{{$vehicle3->id}}" value="{{$vehicle3->id}}">{{$vehicle3->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <label class="pt-3">Document Expiration Date</label>
                                <div class="input-group input-group-merge ">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select class="form-select" id="vehiclelicensedate" name="country" aria-label="Default select example">
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
                                
                               
                                <div class="input-group input-group-merge pt-3">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select class="form-select" name="hacneypermitdate" id="hacneypermitdate" aria-label="Default select example">
                                        <option selected disabled>-- Hackney Permit: --</option>
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

                                <div class="input-group input-group-merge pt-3">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select class="form-select" id="platenumber" name="platenumber" aria-label="Default select example">
                                        <option selected disabled>-- Type of Plate Number: --</option>
                                        <option value="RPN">New Random Plate Number</option>
                                        <option value="CPN">New Customised Plate Number</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-6 pt-3">
                                    <div class="hackneyPermit">
                                        <input class="form-check-input" type="checkbox" value="0" id="addTwo" />
                                        <label class="form-check-label" for="defaultCheck4">   Police CMRIS</label>
                                    </div>
                                </div>
                               
                                <div class="col-sm-12 ">
                                    <div class="check-listg">
                                        <p class="check-listgk" id="mainPriceco">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0.00</span></p>
                                        <div class="main-btn-wrap ">
                                        <center> <a href="{{ route('home.changeofownership') }}" class="btn btn-primary" style="background-color: #142444; border-color:#142444"> Process Paper </a></center>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    jQuery(document).ready(function ($) {

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        }); 
                                        
                                        // Handle change event for the first select element (Select Vehicle)
                                        $('#stateIdCO, #vehicleIdCO, #vehiclelicensedate, #hacneypermitdate, #platenumber, #addTwo').on('change', function () {
                                            var stateIdCO = $('#stateIdCO').val();
                                            var vehicleIdCO = $('#vehicleIdCO').val();
                                            var vehiclelicensedate = $('#vehiclelicensedate').val();
                                            var hacneypermitdate = $('#hacneypermitdate').val();
                                            var platenumber = $('#platenumber').val();
                                            var checkboxCMRISValue = $('#addTwo').is(":checked") ? parseFloat($('#addTwo').val()) : 0;
                                            
                                            // alert(stateIdCO);
                                            // alert(vehicleIdCO);
                                            // alert(vehiclelicensedate);
                                            // alert(hacneypermitdate);
                                            // alert(platenumber);

                                            // Get the ID of the clicked checkbox
                                            var checkboxCMRIS = $("input#addTwo").val();

                                            // Check if the checkbox is checked and update the checkboxValue accordingly
                                            if ($("input#addTwo").is(":checked")) {
                                                checkboxpoliceValue = parseFloat(checkboxCMRIS);
                                            } else {
                                                checkboxpoliceValue = 0;
                                            }

                                            $.ajax({
                                                type:'POST',
                                                url:"{{ route('getCOpricing') }}",
                                                data:{
                                                    stateIdCO:stateIdCO,
                                                    vehicleIdCO : vehicleIdCO,
                                                    vehiclelicensedate : vehiclelicensedate,
                                                    hacneypermitdate: hacneypermitdate,
                                                    platenumber: platenumber,
                                                }, 
                                                success: function(response){
                                                    console.log('Success. Response:', response.data);
                                                    var vehicleCost =  parseFloat(response.vehicleCost);
                                                    var vehiclelicenseAmount = parseFloat(response.vehiclelicenseAmount);
                                                    var hacneypermitAmount = parseFloat(response.hacneypermitAmount);
                                                    var policeCMRIS = parseFloat(response.policeCMRIS);
                                                            
                                                    
                                                    var result = vehicleCost + vehiclelicenseAmount + hacneypermitAmount + checkboxpoliceValue; 
                                                    
                                                    var formattedValue = new Intl.NumberFormat('en-US', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }).format(result);
                                                    $('input#addTwo').val(policeCMRIS);
                                                    $("#mainPriceco span").text(formattedValue);	
                                                }, 
                                                error: function (xhr, status, error){
                                                    // alert('Error');
                                                }
                                            }); 
                                        });

                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 vehic" id="ndl">
            <h2 class="widget-title padding-top-30 padding-bottom-20 "> <b>New Driver License  </b></h2>
            <div class="border-bottom padding-bottom-20 ">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bg-white border1 shadow ">
                            <div class="note5  shadow-sm">
                                <p>
                                PROCESSING AND CAPTURING TIMELINE<br>
                                26 Working Days <br><br>
                                INSTRUCTION: <br>
                                Select the number of years of validity you require. <br> <br>
                                ELIGIBLE LOCATION: <br>
                                <b>Note:</b> We only process new driver’s licenses in Lagos, Abuja, Oyo, Ogun, Abia, Rivers and Anambra States <br> <br>
                                PROCESS: <br>
                                <span>
                                    It takes 6weeks, and you will only show up once for capturing and CBT
                                    In the 4th week and you will receive your temporary card immediately. <br> Then, 
                                    two weeks later, an SMS will be sent to you stating your permanent card is 
                                    ready… then we will pick it up and deliver it to your doorstep. <br> <br></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="bg-white border1 shadow ">
                            <div class="note  shadow-sm">
                                <span style="font-size: 16px;"> Select the Option of your choice. 
                                </span>
                            </div>

                            <div class="note1" id="vehicleForm">
                                <div class="input-group input-group-merge pt-2">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="" id="stateIdVL" class="form-select">
                                        <option disabled selected="selected" value="">-- Select State --</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option> 
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="input-group input-group-merge pt-3">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="lengthofyear" id="lengthofyear" class="form-select">
                                        <option disabled selected="selected" value="">-- Select length of Years --</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 pt-3">
                                    <div class="check-listg">
                                        <p class="check-listgk" id="mainPriceDL">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0.00</span></p>
                                        <div class="main-btn-wrap ">
                                        <center> <a href="{{ route('home.newdriverlicense') }}" class="btn btn-primary" style="background-color: #142444; border-color:#142444"> Process Paper </a></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function ($) {
                                    $.ajaxSetup({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										}
									});
                                    //add new vehicle
                                    $('#vehicleForm, #stateIdVL').on('change', function() { 
                                        var stateIdVL = $('#stateIdVL').val();
                                       
                                       	var selectedValue = $('#lengthofyear').val();
                                       	
                                        $.ajax({ 
                                            type:'POST',
                                            url:"{{ route('getVLPrice') }}",
                                            data:{
                                                stateIdVL : stateIdVL, 
                                            }, 
                                            success:function(response){    
                                                console.log('lengthYears', response.lengthYears); 
                                                $('#lengthofyear').empty();
                                                $('#lengthofyear').append('<option disabled selected="selected" value="">-- Select length of Years --</option>');
                                                $.each(response.lengthYears, function(key, length) {
                                                    $('#lengthofyear').append('<option data-id = "'+length.amount+ '" value="' + length.id + '">' + length.yearsType  + ' Years' + '</option>');
                                                                         
                                                });   
                                                // Reselect the stored value
                                                $('#lengthofyear').val(selectedValue);
                                                var selectedOption = $('#lengthofyear option:selected');
                                                var result = selectedOption.data('id') || 0; 
                                                  
											    var formattedValue = new Intl.NumberFormat('en-US', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }).format(result);
											    $("#mainPriceDL span").text(formattedValue);	
											    $("#mainPriceDL span").val(formattedValue);
											     
                                            },  
                                            error: function(xhr, status, error) {
                                               // alert('error'); 
                                            }
                                        });
										
                                    });
                                });
                            </script>	
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 vehic" id="dlr">
            <h2 class="widget-title padding-top-30 padding-bottom-20"> <b> Driver License  Renewal </b></h2>
            <div class="border-bottom padding-bottom-20 ">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bg-white border1 shadow ">
                            <div class="note5  shadow-sm">
                                <p>
                                PROCESSING TIME <br>
                                New Driver’s License [ 72 Hours - 3 weeks] <br><br>
                                INSTRUCTION: <br>
                                Select the number of years of validity you require. <br>
                                <br>
                                PROCESS: <br>
                                <span>
                                You'll obtain the temporary paperwork within 72 hours. Your physical presence is required only if there are any errors, for which we'll schedule a recapture session. <br> <br>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="bg-white border1 shadow ">
                            <div class="note  shadow-sm">
                                <span style="font-size: 16px;"> Select the Option of your choice. 
                                </span>
                            </div>

                            <div class="note2" id="vehicleFormDLR">
                                <div class="input-group input-group-merge pt-2">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="" id="stateIdDLR" class="form-select">
                                        <option disabled selected="selected" value="">-- Select State --</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option> 
                                        @endforeach
                                    </select>
                                </div> 
                                 <div class="input-group input-group-merge pt-3">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="lengthofyearDLR" id="lengthofyearDLR" class="form-select">
                                        <option disabled selected="selected" value="">-- Select length of Years --</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 pt-3">
                                    <div class="check-listg">
                                        <p class="check-listgk" id="mainPriceDLR">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0.00</span></p>
                                        <div class="main-btn-wrap ">
                                        <center> <a href="{{ route('home.newdriverlicense') }}" class="btn btn-primary" style="background-color: #142444; border-color:#142444"> Process Paper </a></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function ($) {
                                    $.ajaxSetup({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										}
									});
                                    //add new vehicle
                                    $('#vehicleFormDLR, #stateIdDLR').on('change', function() { 
                                        var stateIdDLR = $('#stateIdDLR').val();
                                       
                                       	var selectedValueDLR = $('#lengthofyearDLR').val();
                                       	
                                        $.ajax({ 
                                            type:'POST',
                                            url:"{{ route('getDLRPrice') }}",
                                            data:{
                                                stateIdDLR : stateIdDLR, 
                                            },  
                                            success:function(response){    
                                                // alert('response'); 
                                                console.log('lengthYearsDLR', response.lengthYearsDLR); 
                                                $('#lengthofyearDLR').empty();
                                                $('#lengthofyearDLR').append('<option disabled selected="selected" value="">-- Select length of Years --</option>');
                                                 $.each(response.lengthYearsDLR, function(key, length) {
                                                    $('#lengthofyearDLR').append('<option data-id = "'+length.amount+ '" value="' + length.id + '">' + length.yearType  + ' Years Validity' + '</option>');
                                                });  
                                                // Reselect the stored value
                                                $('#lengthofyearDLR').val(selectedValueDLR);
                                                var selectedOption = $('#lengthofyearDLR option:selected');
                                                var result = selectedOption.data('id') || 0; 
                                                  
											    var formattedValue = new Intl.NumberFormat('en-US', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }).format(result);
											    $("#mainPriceDLR span").text(formattedValue);	
											    $("#mainPriceDLR span").val(formattedValue);
											     
                                            },  
                                            error: function(xhr, status, error) {
                                               // alert('error'); 
                                            }
                                        });
										
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12 vehic" id="ndl">
            <h2 class="widget-title padding-top-30 padding-bottom-20 "> <b>International Driver License  </b></h2>
            <div class="border-bottom padding-bottom-20 ">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bg-white border1 shadow ">
                            <div class="note5  shadow-sm">
                                <p>
                                PROCESSING TIME <br>
                                International Driver’s License [ 72 Hours - 5 Working Days] <br><br>
                                INSTRUCTION: <br>
                                It's Come with One year of validity. <br> <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="bg-white border1 shadow ">
                            <div class="note  shadow-sm">
                                <span style="font-size: 16px;"> Select the Option of your choice. 
                                </span>
                            </div>

                            <div class="note1" id="vehicleFormIDL">
                               <div class="input-group input-group-merge pt-2">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="" id="stateIdIDL" class="form-select">
                                        <option disabled selected="selected" value="">-- Select State --</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option> 
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="input-group input-group-merge pt-3">
                                    <span class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select required name="lengthofyearIDL" id="lengthofyearIDL" class="form-select">
                                        <option disabled selected="selected" value="">-- Select length of Years --</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 pt-3">
                                    <div class="check-listg">
                                        <p class="check-listgk" id="mainPriceIDL">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0.00</span></p>
                                        <div class="main-btn-wrap ">
                                            <center> <a href="{{ route('home.internationaldriverlicense') }}" class="btn btn-primary" style="background-color: #142444; border-color:#142444"> Process Paper </a></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <script type="text/javascript">
                                jQuery(document).ready(function ($) {
                                    $.ajaxSetup({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										}
									});
                                    //add new vehicle
                                    $('#vehicleFormIDL, #stateIdIDL').on('change', function() { 
                                        var stateIdIDL = $('#stateIdIDL').val();
                                       
                                       	var selectedValueIDL = $('#lengthofyearIDL').val();
                                       	
                                        $.ajax({ 
                                            type:'POST',
                                            url:"{{ route('getIDLPrice') }}",
                                            data:{
                                                stateIdIDL : stateIdIDL, 
                                            },  
                                            success:function(response){    
                                                // alert('response'); 
                                                console.log('lengthYearsIDL', response.lengthYearsIDL); 
                                                $('#lengthofyearIDL').empty();
                                                $('#lengthofyearIDL').append('<option disabled selected="selected" value="">-- Select length of Years --</option>');
                                                
                                                $.each(response.lengthYearsIDL, function(key, length) {
                                                  $('#lengthofyearIDL').append('<option data-id="' + length.amount + '" value="' + length.id + '">' + length.yearType + ' Years' + '</option>');
                                                });
                                                // Reselect the stored value
                                                $('#lengthofyearIDL').val(selectedValueIDL);
                                                var selectedOption = $('#lengthofyearIDL option:selected');
                                                var result = selectedOption.data('id') || 0; 
                                                  
											    var formattedValue = new Intl.NumberFormat('en-US', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }).format(result);
											    $("#mainPriceIDL span").text(formattedValue);	
											    $("#mainPriceIDL span").val(formattedValue);
											     
                                            },  
                                            error: function(xhr, status, error) {
                                               // alert('error'); 
                                            }
                                        });
										
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                
        <div class="col-lg-12 vehic" id="ndl">
            <h2 class="widget-title padding-top-30 padding-bottom-20 "> <b>Other Permits </b></h2>
            <div class="border-bottom padding-bottom-20 ">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="bg-white border1 shadow ">
                            <div class="note5  shadow-sm">
                                <p>
                                PROCESSING TIME <br>
                                Other Permits [ 72 Hours] <br><br>
                                INSTRUCTION: <br>
                                Select the Permits type for the Price. <br> <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="bg-white border1 shadow ">
                            <div class="note  shadow-sm">
                                <span style="font-size: 16px;"> Select the Option of your choice. 
                                </span>
                            </div>

                            <div class="note1">
                               
                                <div class="input-group input-group-merge pt-3">
                                    <span id="fullname" class="input-group-text"><i class="fa fa-car"></i></span>
                                    <select class="form-select" id="otherPermitId" name="otherPermitId" aria-label="Default select example">
                                        <option >-- Select the Others Permit --</option>
                                        {{-- @foreach($otherPermits as $otherPermit)
                                            <option value="{{ $otherPermit->id }}" >{{ $otherPermit->otherPermitTypeInfo->permitType }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="col-sm-12 pt-3">
                                    <div class="check-listg">
                                     <p class="check-listgk" id="mainPriceOP">TOTAL AMOUNT: ₦ <span class="check-listgk" style="font-size: 16px">0.00</span></p>
                                        <div class="main-btn-wrap ">
                                        <center> <a href="{{route('home.otherpermit')}}" class="btn btn-primary" style="background-color: #142444; border-color:#142444"> Process Paper </a></center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <script type="text/javascript">
                                jQuery(document).ready(function ($) {
                                    $.ajaxSetup({
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										}
									});
                                    //add new vehicle
                                    $('#vehicleFormIDL, #otherPermitId').on('change', function() { 
                                        var otherPermitId = $('#otherPermitId').val();
                                       
                                        $.ajax({ 
                                            type:'POST',
                                            url: "{{ route('getOtherPermitPrice') }}",
                                            data:{
                                                otherPermit:otherPermitId,
                                            },  
                                            success:function(response){    
                                                // alert('success');
                                                console.log('Amount', response.amount);
                                                var result = isNaN(response.amount) ? 0 : response.amount;
                                                var formattedValue = new Intl.NumberFormat('en-US', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }).format(result);
                                                
                                                $("#mainPriceOP span").text(formattedValue);
                                                $("#mainPriceOP span").val(formattedValue);
                                            },  
                                            error: function(xhr, status, error) {
                                               // alert('error'); 
                                            }
                                        });
										
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection