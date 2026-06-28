@extends('layouts.app')

@section('content')

<style>

    .intl-license-page{
        padding:80px 0;
        background:#f7f9fc;
        min-height:100vh;
    }

    /* LEFT PANEL */

    .service-banner{
        position:relative;
        min-height:700px;
        border-radius:15px;
        overflow:hidden;
        background-size:cover;
        background-position:center;
    }

    .service-banner::before{
        content:'';
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(20,36,68,.75);
    }

    .service-banner-content{
        position:relative;
        z-index:2;
        color:#fff;
        padding:60px 40px;
        height:100%;
        display:flex;
        flex-direction:column;
        justify-content:center;
    }

    .service-banner-content h2{
        font-size:36px;
        font-weight:700;
        margin-bottom:20px;
    }

    .service-banner-content p{
        font-size:16px;
        line-height:1.8;
        color:#ffffff;
    }

    .service-benefits{
        margin-top:30px;
        padding:0;
        list-style:none;
    }

    .service-benefits li{
        margin-bottom:15px;
        font-size:15px;
    }

    .service-benefits i{
        color:#28a745;
        margin-right:10px;
    }

    /* RIGHT PANEL */

    .application-card{
        background:#fff;
        border-radius:15px;
        padding:35px;
        box-shadow:0 5px 25px rgba(0,0,0,.08);
    }

    .application-title{
        color:#142444;
        font-weight:700;
        margin-bottom:10px;
    }

    .application-subtitle{
        color:#6c757d;
        margin-bottom:30px;
    }

    /* STEPPER */

    .wizard-wrapper{
        margin-bottom:40px;
    }

    .wizard-steps{
        display:flex;
        justify-content:space-between;
        align-items:center;
        position:relative;
    }

    .wizard-step{
        flex:1;
        text-align:center;
        position:relative;
        z-index:2;
    }

    .wizard-step .circle{
        width:45px;
        height:45px;
        line-height:45px;
        margin:auto;
        border-radius:50%;
        background:#dee2e6;
        color:#6c757d;
        font-weight:700;
        transition:.3s;
    }

    .wizard-step.active .circle{
        background:#142444;
        color:#fff;
    }

    .wizard-step.completed .circle{
        background:#28a745;
        color:#fff;
    }

    .wizard-step p{
        margin-top:10px;
        font-size:13px;
        font-weight:600;
    }

    .wizard-line{
        position:absolute;
        top:22px;
        left:10%;
        width:80%;
        height:3px;
        background:#dee2e6;
        z-index:1;
    }

    /* FORM */

    .step-content{
        display:none;
    }

    .step-content.active{
        display:block;
    }

    .section-title{
        color:#142444;
        font-size:22px;
        font-weight:600;
        margin-bottom:25px;
    }

    label{
        font-weight:600;
        margin-bottom:8px;
    }

    .form-control{
        height:50px;
        border-radius:8px;
    }

    textarea.form-control{
        height:120px;
    }

    .btn-primary-custom{
        background:#142444;
        border:none;
        color:white;
        padding:12px 35px;
        border-radius:8px;
        font-weight:600;
    }

    .btn-primary-custom:hover{
        background:#0f1d37;
        color:white;
    }

    .btn-outline-custom{
        border:1px solid #142444;
        color:#142444;
        padding:12px 35px;
        border-radius:8px;
        font-weight:600;
        background:white;
    }

    .btn-outline-custom:hover{
        background:#142444;
        color:white;
    }

    .upload-container{
        margin-top:20px;
    }

    .upload-box{
        border:2px dashed #d6dce5;
        border-radius:12px;
        padding:40px;
        text-align:center;
        background:#fafbfd;
        transition:.3s;
    }

    .upload-box:hover{
        border-color:#142444;
        background:#f3f6fb;
    }

    .upload-box input[type=file]{
        margin:auto;
    }

    #previewImage{
        width:180px;
        height:180px;
        object-fit:cover;
        border-radius:12px;
        border:4px solid #e9ecef;
    }

    @media(max-width:991px){

        .service-banner{
            min-height:350px;
            margin-bottom:30px;
        }

        .application-card{
            padding:25px;
        }

        .wizard-step p{
            font-size:11px;
        }

    }

</style>

<div class="intl-license-page">

    <div class="container">

        <div class="row">

            <!-- LEFT PANEL -->

            <div class="col-lg-5">

                <div class="service-banner"
                     style="background-image:url('{{ asset('assets/img/Car_11.png') }}')">

                    <div class="service-banner-content">

                        <h2>
                            International Driver's License
                        </h2>

                        <p>
                            Complete your application online in a few simple steps.
                            Fast, secure and convenient.
                        </p>

                        <ul class="service-benefits">

                            <li>
                                <i class="fa fa-check-circle"></i>
                                Fast Processing
                            </li>

                            <li>
                                <i class="fa fa-check-circle"></i>
                                Secure Online Payment
                            </li>

                            <li>
                                <i class="fa fa-check-circle"></i>
                                Upload Documents Online
                            </li>

                            <li>
                                <i class="fa fa-check-circle"></i>
                                Track Application Status
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            <!-- RIGHT PANEL -->

            <div class="col-lg-7">

                <div class="application-card">

                    <h3 class="application-title">
                        Application Form
                    </h3>

                    <p class="application-subtitle">
                        Fill in your information to begin your application.
                    </p>

                    <!-- WIZARD -->

                    <div class="wizard-wrapper">

                        <div class="wizard-steps">

                            <div class="wizard-line"></div>

                            <div class="wizard-step active" id="indicator1">
                                <div class="circle">1</div>
                                <p>Personal Info</p>
                            </div>

                            <div class="wizard-step" id="indicator2">
                                <div class="circle">2</div>
                                <p>Upload</p>
                            </div>

                            <div class="wizard-step" id="indicator3">
                                <div class="circle">3</div>
                                <p>Review</p>
                            </div>

                            <div class="wizard-step" id="indicator4">
                                <div class="circle">4</div>
                                <p>Payment</p>
                            </div>

                        </div>

                    </div>

                    <form id="licenseForm" method="POST" action="{{ route('international-license.store') }}" enctype="multipart/form-data">

                        @csrf

                        <!-- STEP 1 GOES HERE -->
                            <!-- STEP 1 -->
                            <div class="step-content active" id="step1">

                                <h4 class="section-title">
                                    Personal Information
                                </h4>

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="first_name"
                                            id="first_name"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Middle Name</label>
                                        <input type="text"
                                            name="middle_name"
                                            id="middle_name"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="last_name"
                                            id="last_name"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date"
                                            name="dob"
                                            id="dob"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="phone"
                                            id="phone"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="email"
                                            name="email"
                                            id="email"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Country of Destination <span class="text-danger">*</span></label>
                                        <select name="country_destination"
                                                id="country_destination"
                                                class="form-control"
                                                required>
                                            <option value="">Select Country</option>
                                            <option>United States</option>
                                            <option>United Kingdom</option>
                                            <option>Canada</option>
                                            <option>Germany</option>
                                            <option>France</option>
                                            <option>United Arab Emirates</option>
                                            <option>South Africa</option>
                                            <option>Ghana</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Driver's License Number <span class="text-danger">*</span></label>
                                        <input type="text"
                                            name="license_number"
                                            id="license_number"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Driver's License Expiry Date <span class="text-danger">*</span></label>
                                        <input type="date"
                                            name="license_expiry"
                                            id="license_expiry"
                                            class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Residential Address <span class="text-danger">*</span></label>
                                        <textarea name="address"
                                                id="address"
                                                class="form-control"
                                                required></textarea>
                                    </div>

                                </div>

                                <div class="text-right mt-4">

                                    <button type="button"
                                            class="btn btn-primary-custom"
                                            onclick="validateStep1()">

                                        Continue

                                    </button>

                                </div>

                            </div>
                        <!-- STEP 2 -->
                            <div class="step-content" id="step2">

                                <h4 class="section-title">
                                    Upload Passport Photograph
                                </h4>

                                <div class="alert alert-info">
                                    Please upload a recent passport photograph.
                                    Accepted formats: JPG, JPEG, PNG.
                                    Maximum size: 5MB.
                                </div>

                                <div class="upload-container">

                                    <div class="upload-box">

                                        <div id="previewWrapper" style="display:none;">

                                            <img id="previewImage"
                                                src=""
                                                alt="Passport Preview">

                                        </div>

                                        <div id="uploadPlaceholder">

                                            <i class="fa fa-cloud-upload fa-4x mb-3 text-primary"></i>

                                            <h5>
                                                Drag & Drop Passport Photograph
                                            </h5>

                                            <p>
                                                or click below to select file
                                            </p>

                                        </div>

                                        <input type="file"
                                            name="passport_photo"
                                            id="passport_photo"
                                            accept=".jpg,.jpeg,.png"
                                            class="form-control-file mt-3">

                                    </div>

                                </div>

                                <div class="row mt-4">

                                    <div class="col-6">

                                        <button type="button"
                                                class="btn btn-outline-custom"
                                                onclick="goToStep(1)">

                                            Back

                                        </button>

                                    </div>

                                    <div class="col-6 text-right">

                                        <button type="button"
                                                class="btn btn-primary-custom"
                                                onclick="prepareReview()">

                                            Continue

                                        </button>

                                    </div>

                                </div>

                            </div>
                        <!-- STEP 3 -->

                            <div class="step-content" id="step3">

                                <h4 class="section-title">
                                    Review Application
                                </h4>

                                <div class="card border-0 shadow-sm">

                                    <div class="card-body">

                                        <h5 class="mb-4">
                                            Personal Information
                                        </h5>

                                        <div class="table-responsive">

                                            <table class="table table-bordered">

                                                <tbody>

                                                    <tr>
                                                        <th width="35%">First Name</th>
                                                        <td id="review_first_name"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Middle Name</th>
                                                        <td id="review_middle_name"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Last Name</th>
                                                        <td id="review_last_name"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Date of Birth</th>
                                                        <td id="review_dob"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Phone Number</th>
                                                        <td id="review_phone"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Email Address</th>
                                                        <td id="review_email"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Country of Destination</th>
                                                        <td id="review_country"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Driver's License Number</th>
                                                        <td id="review_license_number"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>License Expiry Date</th>
                                                        <td id="review_license_expiry"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Residential Address</th>
                                                        <td id="review_address"></td>
                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                        <hr>

                                        <h5 class="mb-4">
                                            Passport Photograph
                                        </h5>

                                        <div class="text-center">

                                            <img id="review_passport"
                                                src=""
                                                alt="Passport Preview"
                                                class="img-thumbnail"
                                                style="max-width:200px;">

                                        </div>

                                    </div>

                                </div>

                                <div class="row mt-4">

                                    <div class="col-6">

                                        <button type="button"
                                                class="btn btn-outline-custom"
                                                onclick="goToStep(2)">

                                            Back

                                        </button>

                                    </div>

                                    <div class="col-6 text-right">

                                        
                                        <button type="button"
                                                class="btn btn-primary-custom"
                                                onclick="preparePayment()">
                                            Proceed To Payment
                                        </button>

                                    </div>

                                </div>

                            </div>

                        <!-- STEP 4 -->

                            <div class="step-content" id="step4">

                                <h4 class="section-title">
                                    Payment Summary
                                </h4>

                                <div class="card border-0 shadow-sm">

                                    <div class="card-body">

                                        <div class="text-center mb-4">

                                            <i class="fa fa-credit-card fa-4x text-success mb-3"></i>

                                            <h4>
                                                International Driver's License Application
                                            </h4>

                                            <p class="text-muted">
                                                Please review your payment details below.
                                            </p>

                                        </div>

                                        <table class="table table-bordered">

                                            <tbody>

                                                <tr>
                                                    <th>Service</th>
                                                    <td>International Driver's License</td>
                                                </tr>

                                                <tr>
                                                    <th>Applicant</th>
                                                    <td id="payment_applicant"></td>
                                                </tr>

                                                <tr>
                                                    <th>Email Address</th>
                                                    <td id="payment_email"></td>
                                                </tr>

                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td id="payment_phone"></td>
                                                </tr>

                                                <tr class="table-primary">
                                                    <th>Total Amount</th>
                                                    <td>
                                                        <strong>₦150,000</strong>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>

                                        <div class="alert alert-info">

                                            <strong>Note:</strong>

                                            After clicking "Proceed to Payment",
                                            you will be redirected to the payment gateway
                                            to complete your application.

                                        </div>

                                    </div>

                                </div>

                                <div class="row mt-4">

                                    <div class="col-6">

                                        <button type="button"
                                                class="btn btn-outline-custom"
                                                onclick="goToStep(3)">

                                            Back

                                        </button>

                                    </div>

                                    <div class="col-6 text-right">

                                        <button type="submit"
                                                class="btn btn-success btn-lg">

                                            Proceed To Payment

                                        </button>

                                    </div>

                                </div>

                            </div>
                        <!-- STEP 4 GOES HERE -->

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
<script>

    document.addEventListener('DOMContentLoaded', function(){

        const uploadInput =
            document.getElementById('passport_photo');

        const previewImage =
            document.getElementById('previewImage');

        const previewWrapper =
            document.getElementById('previewWrapper');

        const uploadPlaceholder =
            document.getElementById('uploadPlaceholder');

        uploadInput.addEventListener('change', function(){

            const file = this.files[0];

            if(file){

                const reader = new FileReader();

                reader.onload = function(e){

                    previewImage.src = e.target.result;

                    previewWrapper.style.display = 'block';

                    uploadPlaceholder.style.display = 'none';

                };

                reader.readAsDataURL(file);
            }

        });

    });


    function validateStep1(){

        let requiredFields = [

            'first_name',
            'last_name',
            'dob',
            'phone',
            'email',
            'country_destination',
            'license_number',
            'license_expiry',
            'address'

        ];

        let valid = true;

        requiredFields.forEach(function(field){

            let input = document.getElementById(field);

            if(!input.value){

                input.style.borderColor = 'red';

                valid = false;

            }else{

                input.style.borderColor = '#ced4da';

            }

        });

        if(!valid){

            alert('Please complete all required fields.');

            return;
        }

        goToStep(2);
    }

    function goToStep(step){

        $('.step-content').removeClass('active');

        $('#step'+step).addClass('active');

        $('.wizard-step')
            .removeClass('active completed');

        for(let i = 1; i <= step; i++){

            if(i < step){

                $('#indicator'+i)
                    .addClass('completed');

            }else{

                $('#indicator'+i)
                    .addClass('active');

            }

        }

    }

    function prepareReview(){

        document.getElementById('review_first_name').innerText =
            document.getElementById('first_name').value;

        document.getElementById('review_middle_name').innerText =
            document.getElementById('middle_name').value;

        document.getElementById('review_last_name').innerText =
            document.getElementById('last_name').value;

        document.getElementById('review_dob').innerText =
            document.getElementById('dob').value;

        document.getElementById('review_phone').innerText =
            document.getElementById('phone').value;

        document.getElementById('review_email').innerText =
            document.getElementById('email').value;

        document.getElementById('review_country').innerText =
            document.getElementById('country_destination').value;

        document.getElementById('review_license_number').innerText =
            document.getElementById('license_number').value;

        document.getElementById('review_license_expiry').innerText =
            document.getElementById('license_expiry').value;

        document.getElementById('review_address').innerText =
            document.getElementById('address').value;

        const passport =
            document.getElementById('previewImage');

        document.getElementById('review_passport').src =
            passport.src;

        goToStep(3);
    }

    function preparePayment(){

        document.getElementById('payment_applicant').innerText =
            document.getElementById('first_name').value + ' ' +
            document.getElementById('last_name').value;

        document.getElementById('payment_email').innerText =
            document.getElementById('email').value;

        document.getElementById('payment_phone').innerText =
            document.getElementById('phone').value;

        goToStep(4);
    }
</script>

@endsection