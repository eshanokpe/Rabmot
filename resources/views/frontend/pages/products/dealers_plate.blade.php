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

    .service-banner-content h4{
        font-size:28px;
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
        font-size:16px;
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
                    style="background-image:url('{{ asset('assets/img/Car_22.png') }}')">

                    <div class="service-banner-content">

                        
                        <h4>
                            Dealer's Plate Number
                        </h4>

                        <p>
                            Apply for a Dealer's Plate Number online. Submit your company information,
                            upload required documents, and complete your application securely.
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
                                Company Verification
                            </li>

                            <li>
                                <i class="fa fa-check-circle"></i>
                                Upload Supporting Documents
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

                    <h4 class="application-title">
                        Application Form
                    </h4>

                    <p class="application-subtitle" style="font-size:14px;">
                        Fill in your information to begin your application.
                    </p>

                    <!-- WIZARD -->

                    <div class="wizard-wrapper">

                        <div class="wizard-steps">

                            <div class="wizard-line"></div>

                            <div class="wizard-step active" id="indicator1">
                                <div class="circle">1</div>
                                <p>Information</p>
                            </div>

                            <div class="wizard-step" id="indicator2">
                                <div class="circle">2</div>
                                <p>Documents</p>
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

                    <form id="dealerForm" method="POST" action="{{ route('dealer-plate-number.store') }}" enctype="multipart/form-data">

                        @csrf

                        <!-- STEP 1 GOES HERE -->
                            <!-- STEP 1 -->
                            <div class="step-content active" id="step1">

                                <h6 class="section-title">
                                    Applicant & Company Information
                                </h6>

                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <h6 class="border-bottom pb-2">
                                            Personal Information
                                        </h6>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            id="full_name"
                                            name="full_name"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Sex <span class="text-danger">*</span></label>

                                        <select id="sex"
                                                name="sex"
                                                class="form-control">

                                            <option value="">Select Gender</option>
                                            <option>Male</option>
                                            <option>Female</option>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date"
                                            id="dob"
                                            name="dob"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Place of Birth <span class="text-danger">*</span></label>
                                        <input type="text"
                                            id="place_of_birth"
                                            name="place_of_birth"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <input type="text"
                                            id="phone"
                                            name="phone"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="email"
                                            id="email"
                                            name="email"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>State <span class="text-danger">*</span></label>
                                        <input type="text"
                                            id="state"
                                            name="state"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Local Government <span class="text-danger">*</span></label>
                                        <input type="text"
                                            id="lga"
                                            name="lga"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Residential Address <span class="text-danger">*</span></label>

                                        <textarea id="address"
                                                name="address"
                                                class="form-control"></textarea>
                                    </div>

                                    <div class="col-12 mt-4 mb-3">
                                        <h6 class="border-bottom pb-2">
                                            Company Information
                                        </h6>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>Company Name <span class="text-danger">*</span></label>

                                        <input type="text"
                                            id="company_name"
                                            name="company_name"
                                            class="form-control">
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
                                    Upload Required Documents
                                </h4>

                                <div class="alert alert-info">
                                    Upload all required documents before proceeding.
                                    Accepted formats: JPG, JPEG, PNG, PDF.
                                    Maximum file size: 5MB per file.
                                </div>

                                <div class="row">

                                    <!-- Means of Identification -->

                                    <div class="col-md-6 mb-4">

                                        <label>
                                            Means of Identification *
                                        </label>

                                        <input type="file"
                                            id="means_of_id"
                                            name="means_of_id"
                                            class="form-control-file"
                                            accept=".jpg,.jpeg,.png,.pdf">

                                        <small class="text-muted">
                                            National ID, Driver's License, Voter's Card, or International Passport
                                        </small>

                                    </div>

                                    <!-- Passport Photograph -->

                                    <div class="col-md-6 mb-4">

                                        <label>
                                            Passport Photograph *
                                        </label>

                                        <input type="file"
                                            id="passport_photo"
                                            name="passport_photo"
                                            class="form-control-file"
                                            accept=".jpg,.jpeg,.png">

                                    </div>

                                    <!-- CAC Certificate -->

                                    <div class="col-md-6 mb-4">

                                        <label>
                                            CAC Certificate *
                                        </label>

                                        <input type="file"
                                            id="cac_certificate"
                                            name="cac_certificate"
                                            class="form-control-file"
                                            accept=".jpg,.jpeg,.png,.pdf">

                                    </div>

                                    <!-- Company Letter Head -->

                                    <div class="col-md-6 mb-4">

                                        <label>
                                            Company Letter Head *
                                        </label>

                                        <input type="file"
                                            id="company_letterhead"
                                            name="company_letterhead"
                                            class="form-control-file"
                                            accept=".jpg,.jpeg,.png,.pdf">

                                    </div>

                                </div>

                                <!-- Preview Area -->

                                <div class="row mt-3">

                                    <div class="col-md-3 text-center">

                                        <img id="passport_preview"
                                            src=""
                                            class="img-thumbnail"
                                            style="display:none;height:120px;width:120px;object-fit:cover;">

                                        <small class="d-block mt-2">
                                            Passport Photo
                                        </small>

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
                                                onclick="validateStep2()">

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

                                        <!-- Personal Information -->

                                        <h5 class="mb-3 border-bottom pb-2">
                                            Personal Information
                                        </h5>

                                        <div class="table-responsive">

                                            <table class="table table-bordered">

                                                <tbody>

                                                    <tr>
                                                        <th width="35%">Full Name</th>
                                                        <td id="review_full_name"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Sex</th>
                                                        <td id="review_sex"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Date of Birth</th>
                                                        <td id="review_dob"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Place of Birth</th>
                                                        <td id="review_place_of_birth"></td>
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
                                                        <th>State</th>
                                                        <td id="review_state"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Local Government</th>
                                                        <td id="review_lga"></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Residential Address</th>
                                                        <td id="review_address"></td>
                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                        <!-- Company Information -->

                                        <h5 class="mt-5 mb-3 border-bottom pb-2">
                                            Company Information
                                        </h5>

                                        <table class="table table-bordered">

                                            <tbody>

                                                <tr>
                                                    <th width="35%">Company Name</th>
                                                    <td id="review_company_name"></td>
                                                </tr>

                                            </tbody>

                                        </table>

                                        <!-- Documents -->

                                        <h5 class="mt-5 mb-3 border-bottom pb-2">
                                            Uploaded Documents
                                        </h5>

                                        <table class="table table-bordered">

                                            <tbody>

                                                <tr>
                                                    <th width="35%">Means of Identification</th>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            Uploaded
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Passport Photograph</th>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            Uploaded
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>CAC Certificate</th>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            Uploaded
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Company Letter Head</th>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            Uploaded
                                                        </span>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>

                                        <div class="text-center mt-4">

                                            <img id="review_passport"
                                                src=""
                                                class="img-thumbnail"
                                                style="max-width:180px;">

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
                                                Dealer's Plate Number Application
                                            </h4>

                                            <p class="text-muted">
                                                Review your payment details before proceeding.
                                            </p>

                                        </div>

                                        <table class="table table-bordered">

                                            <tbody>

                                                <tr>
                                                    <th width="35%">Service</th>
                                                    <td>Dealer's Plate Number</td>
                                                </tr>

                                                <tr>
                                                    <th>Applicant Name</th>
                                                    <td id="payment_full_name"></td>
                                                </tr>

                                                <tr>
                                                    <th>Company Name</th>
                                                    <td id="payment_company_name"></td>
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
                                                        <strong>₦250,000</strong>
                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                        <div class="alert alert-info">

                                            <strong>Important:</strong>

                                            After clicking the payment button, you will be redirected
                                            to our secure payment gateway to complete your application.

                                        </div>

                                        <!-- Hidden Fields -->

                                        <input type="hidden"
                                            name="service_type"
                                            value="dealer_plate">

                                        <input type="hidden"
                                            name="amount"
                                            value="250000">

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

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
<script>

    document.addEventListener('DOMContentLoaded', function(){

        const passportInput =
            document.getElementById('passport_photo');

        if(passportInput){

            passportInput.addEventListener('change', function(){

                const file = this.files[0];

                if(file){

                    const reader = new FileReader();

                    reader.onload = function(e){

                        document.getElementById('passport_preview')
                            .src = e.target.result;

                        document.getElementById('passport_preview')
                            .style.display = 'block';

                    };

                    reader.readAsDataURL(file);

                }

            });

        }

    });

    function goToStep(step){

        $('.step-content').removeClass('active');
        $('#step' + step).addClass('active');

        $('.wizard-step')
            .removeClass('active completed');

        for(let i = 1; i <= 4; i++){

            if(i < step){

                $('#indicator' + i)
                    .addClass('completed');

            }

            if(i == step){

                $('#indicator' + i)
                    .addClass('active');

            }

        }

    }

    function validateStep1(){

        let fields = [

            'full_name',
            'sex',
            'dob',
            'place_of_birth',
            'phone',
            'email',
            'state',
            'lga',
            'address',
            'company_name'

        ];

        let valid = true;

        fields.forEach(function(field){

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

    function validateStep2(){

        let fields = [

            'means_of_id',
            'passport_photo',
            'cac_certificate',
            'company_letterhead'

        ];

        let valid = true;

        fields.forEach(function(field){

            let input = document.getElementById(field);

            if(input.files.length === 0){

                input.style.border = '1px solid red';

                valid = false;

            }else{

                input.style.border = '';

            }

        });

        if(!valid){

            alert('Please upload all required documents.');

            return;
        }

        prepareReview();

    }

    function prepareReview(){

        document.getElementById('review_full_name').innerText =
            document.getElementById('full_name').value;

        document.getElementById('review_sex').innerText =
            document.getElementById('sex').value;

        document.getElementById('review_dob').innerText =
            document.getElementById('dob').value;

        document.getElementById('review_place_of_birth').innerText =
            document.getElementById('place_of_birth').value;

        document.getElementById('review_phone').innerText =
            document.getElementById('phone').value;

        document.getElementById('review_email').innerText =
            document.getElementById('email').value;

        document.getElementById('review_state').innerText =
            document.getElementById('state').value;

        document.getElementById('review_lga').innerText =
            document.getElementById('lga').value;

        document.getElementById('review_address').innerText =
            document.getElementById('address').value;

        document.getElementById('review_company_name').innerText =
            document.getElementById('company_name').value;

        document.getElementById('review_passport').src =
            document.getElementById('passport_preview').src;

        goToStep(3);

    }

    function preparePayment(){

        document.getElementById('payment_full_name').innerText =
            document.getElementById('full_name').value;

        document.getElementById('payment_company_name').innerText =
            document.getElementById('company_name').value;

        document.getElementById('payment_email').innerText =
            document.getElementById('email').value;

        document.getElementById('payment_phone').innerText =
            document.getElementById('phone').value;

        goToStep(4);

    }
</script>

@endsection