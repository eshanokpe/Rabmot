@extends('layouts.app')

@section('content')

<style>

    .intl-license-page{
        padding:80px 0;
        background:#f7f9fc;
        min-height:100vh;
    }

   .service-banner{

        background:linear-gradient(145deg,#0d2b52,#173f73);

        border-radius:20px;

        overflow:hidden;

        position:sticky;

        top:20px;

        color:#fff;

        box-shadow:0 20px 40px rgba(0,0,0,.15);

    }

    .service-overlay{

        padding:35px;

    }

    .service-badge{

        display:inline-flex;

        align-items:center;

        padding:8px 18px;

        border-radius:30px;

        background:rgba(255,255,255,.15);

        font-size:14px;

        font-weight:600;

    }

    .service-badge i{

        margin-right:8px;

    }

    .service-title{

        font-size:32px;

        font-weight:700;

        margin-top:20px;

    }

    .service-description{

        opacity:.9;

        line-height:1.8;

        margin:20px 0 30px;

    }

    .info-card{

        display:flex;

        align-items:center;

        padding:18px;

        background:rgba(255,255,255,.08);

        border-radius:15px;

    }

    .info-card .icon{

        width:55px;

        height:55px;

        border-radius:50%;

        background:#fff;

        color:#173f73;

        display:flex;

        align-items:center;

        justify-content:center;

        font-size:22px;

        margin-right:15px;

    }

    .requirements-card{

        margin-top:30px;

    }

    .requirements-card h5{

        margin-bottom:20px;

    }

    .requirements-card ul{

        list-style:none;

        padding:0;

    }

    .requirements-card li{

        margin-bottom:14px;

    }

    .requirements-card i{

        color:#38d39f;

        margin-right:10px;

    }

    .benefits-card{

        margin-top:35px;

    }

    .benefit-item{

        display:flex;

        align-items:center;

        padding:12px 0;

    }

    .benefit-item i{

        width:35px;

        color:#ffd166;

    }

    .notice-box{

        margin-top:35px;

        padding:18px;

        background:rgba(255,193,7,.15);

        border-left:4px solid #ffc107;

        border-radius:10px;

        font-size:14px;

        line-height:1.8;

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

    .payment-icon{

    width:90px;

    height:90px;

    margin:auto;

    border-radius:50%;

    background:#eaf7ee;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:38px;

    color:#28a745;

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

    <div class="container-fluid py-5">

        <div class="row">

            <!-- Left Panel -->

            <div class="col-lg-4 mb-4">

                <div class="service-banner">

                    <div class="service-overlay">

                        

                        <!-- Title -->

                        <h2 class="service-title">

                            Driver's License

                        </h2>

                        <p class="service-description text-white" >

                            Apply for your first Nigerian Driver's License online by completing the required information and making a secure payment.

                        </p>

                        <!-- Processing Time -->

                        <div class="info-card mb-4">

                            <div class="icon">

                                <i class="fas fa-clock"></i>

                            </div>

                            <div>

                                <small class="text-light">Estimated Processing</small>

                                <h6 class="mb-0 text-white">
                                    5 – 10 Working Days
                                </h6>

                            </div>

                        </div>

                        <!-- Requirements -->

                        <div class="requirements-card">

                            <h5>

                                <i class="fas fa-clipboard-check mr-2"></i>

                                Requirements

                            </h5>

                            <ul>

                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    National Identification Number (NIN)
                                </li>

                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    Valid Phone Number
                                </li>

                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    Active Email Address
                                </li>

                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    Accurate Personal Information
                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Right Panel -->

            <div class="col-lg-8">

                <div class="application-card">

                    <!-- Stepper -->

                    <div class="wizard-wrapper">

                        <div class="wizard-steps">

                            <div class="wizard-step active" id="indicator1">

                                <div class="circle">
                                    1
                                </div>

                                <p>
                                    Personal
                                </p>

                            </div>

                            <div class="wizard-step" id="indicator2">

                                <div class="circle">
                                    2
                                </div>

                                <p>
                                    Contact
                                </p>

                            </div>

                            <div class="wizard-step" id="indicator3">

                                <div class="circle">
                                    3
                                </div>

                                <p>
                                    Physical
                                </p>

                            </div>

                            <div class="wizard-step" id="indicator4">

                                <div class="circle">
                                    4
                                </div>

                                <p>
                                    Next of Kin
                                </p>

                            </div>

                            <div class="wizard-step" id="indicator5">

                                <div class="circle">
                                    5
                                </div>

                                <p>
                                    Review
                                </p>

                            </div>

                            <div class="wizard-step" id="indicator6">

                                <div class="circle">
                                    6
                                </div>

                                <p>
                                    Payment
                                </p>

                            </div>

                        </div>

                    </div>

                    <form id="freshDriversLicenseForm">

                        <!-- STEP 1 -->

                        <div class="step-content active" id="step1">

                            <h4 class="section-title">

                                Personal Information

                            </h4>

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label>
                                        Surname *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="surname">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>
                                        First Name *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="firstname">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>
                                        Other Name
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="othername">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Sex *
                                    </label>

                                    <select
                                        class="form-control"
                                        id="gender">

                                        <option value="">
                                            Select Gender
                                        </option>

                                        <option>
                                            Male
                                        </option>

                                        <option>
                                            Female
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Date of Birth *
                                    </label>

                                    <input
                                        type="date"
                                        class="form-control"
                                        id="dob">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Place of Birth *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="place_of_birth">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Marital Status *
                                    </label>

                                    <select
                                        class="form-control"
                                        id="marital_status">

                                        <option value="">
                                            Select Status
                                        </option>

                                        <option>
                                            Single
                                        </option>

                                        <option>
                                            Married
                                        </option>

                                        <option>
                                            Divorced
                                        </option>

                                        <option>
                                            Widowed
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Nationality *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="nationality"
                                        value="Nigerian">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Residential Address *
                                    </label>

                                    <textarea
                                        class="form-control"
                                        rows="3"
                                        id="address"></textarea>

                                </div>

                            </div>

                            <div class="text-right">

                                <button
                                    type="button"
                                    class="btn btn-primary-custom"
                                    onclick="validateStep1()">

                                    Continue

                                </button>

                            </div>

                        </div>

                        <!-- STEP 2 -->

                        <!-- STEP 2 -->

                        <div class="step-content" id="step2">

                            <h4 class="section-title">
                                Personal Information (Part 2)
                            </h4>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label>
                                        State of Origin *
                                    </label>

                                    <select
                                        class="form-control"
                                        id="state_origin">

                                        <option value="">
                                            Select State
                                        </option>

                                        <option value="Lagos">Lagos</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Abia">Abia</option>
                                        <option value="Abuja">FCT Abuja</option>
                                        <option value="Rivers">Rivers</option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Local Government of Origin *
                                    </label>

                                    <select
                                        class="form-control"
                                        id="lga_origin">

                                        <option value="">
                                            Select LGA
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Phone Number *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="phone">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Email Address *
                                    </label>

                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        National Identification Number (NIN) *
                                    </label>

                                    <input
                                        type="text"
                                        maxlength="11"
                                        class="form-control"
                                        id="nin"
                                        placeholder="11-digit NIN">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Occupation *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="occupation">

                                </div>

                                <div class="col-md-12 mb-4">

                                    <label>
                                        Mother's Maiden Name *
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="mother_maiden_name">

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-6">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="goToStep(1)">

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button
                                        type="button"
                                        class="btn btn-primary-custom"
                                        onclick="validateStep2()">

                                        Continue

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- STEP 3 -->

                        <!-- =========================
                            STEP 3 - PHYSICAL INFORMATION
                        ========================= -->

                        <div class="step-content" id="step3">

                            <h4 class="section-title">

                                Physical Information

                            </h4>

                            <p class="text-muted mb-4">

                                Please provide your physical information accurately.

                            </p>

                            <div class="row">

                                <!-- Blood Group -->

                                <div class="col-md-6 mb-4">

                                    <label>

                                        Blood Group
                                        <span class="text-danger">*</span>

                                    </label>

                                    <select
                                        class="form-control"
                                        id="blood_group">

                                        <option value="">
                                            Select Blood Group
                                        </option>

                                        <option>A+</option>
                                        <option>A-</option>
                                        <option>B+</option>
                                        <option>B-</option>
                                        <option>AB+</option>
                                        <option>AB-</option>
                                        <option>O+</option>
                                        <option>O-</option>

                                    </select>

                                </div>

                                <!-- Height -->

                                <div class="col-md-6 mb-4">

                                    <label>

                                        Height (cm)
                                        <span class="text-danger">*</span>

                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            class="form-control"
                                            id="height"
                                            min="50"
                                            max="250"
                                            placeholder="Example: 175">

                                        <div class="input-group-append">

                                            <span class="input-group-text">

                                                cm

                                            </span>

                                        </div>

                                    </div>

                                    <small class="text-muted">

                                        Enter your height in centimetres.

                                    </small>

                                </div>

                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-6">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="goToStep(2)">

                                        <i class="fas fa-arrow-left mr-2"></i>

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button
                                        type="button"
                                        class="btn btn-primary-custom"
                                        onclick="validateStep3()">

                                        Continue

                                        <i class="fas fa-arrow-right ml-2"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- STEP 4 -->

                        <!-- ==========================
                            STEP 4 - NEXT OF KIN
                        =========================== -->

                        <div class="step-content" id="step4">

                            <h4 class="section-title">

                                Next of Kin Information

                            </h4>

                            <p class="text-muted mb-4">

                                Kindly provide your next of kin information.

                            </p>

                            <div class="row">

                                <!-- Phone Number -->

                                <div class="col-md-6 mb-4">

                                    <label>

                                        Next of Kin Phone Number
                                        <span class="text-danger">*</span>

                                    </label>

                                    <input
                                        type="tel"
                                        class="form-control"
                                        id="nok_phone"
                                        placeholder="08012345678">

                                </div>

                                <!-- Nationality -->

                                <div class="col-md-6 mb-4">

                                    <label>

                                        Nationality of Next of Kin
                                        <span class="text-danger">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="nok_nationality"
                                        value="Nigerian">

                                </div>

                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-6">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="goToStep(3)">

                                        <i class="fas fa-arrow-left mr-2"></i>

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button
                                        type="button"
                                        class="btn btn-primary-custom"
                                        onclick="validateStep4()">

                                        Continue

                                        <i class="fas fa-arrow-right ml-2"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- STEP 5 -->

                        <!-- ==========================
                            STEP 5 - REVIEW APPLICATION
                        =========================== -->

                        <div class="step-content" id="step5">

                            <h4 class="section-title">
                                Review Your Application
                            </h4>

                            <p class="text-muted mb-4">
                                Please review your information carefully before proceeding to payment.
                            </p>

                            <!-- Personal Information -->

                            <div class="card shadow-sm mb-4">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <strong>Personal Information</strong>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            onclick="goToStep(1)">

                                        <i class="fas fa-edit"></i> Edit

                                    </button>

                                </div>

                                <div class="card-body">

                                    <table class="table table-borderless mb-0">

                                        <tr>
                                            <th width="35%">Surname</th>
                                            <td id="review_surname"></td>
                                        </tr>

                                        <tr>
                                            <th>First Name</th>
                                            <td id="review_firstname"></td>
                                        </tr>

                                        <tr>
                                            <th>Other Name</th>
                                            <td id="review_othername"></td>
                                        </tr>

                                        <tr>
                                            <th>Gender</th>
                                            <td id="review_gender"></td>
                                        </tr>

                                        <tr>
                                            <th>Date of Birth</th>
                                            <td id="review_dob"></td>
                                        </tr>

                                        <tr>
                                            <th>Nationality</th>
                                            <td id="review_nationality"></td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <!-- Contact Information -->

                            <div class="card shadow-sm mb-4">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <strong>Contact Information</strong>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            onclick="goToStep(2)">

                                        <i class="fas fa-edit"></i> Edit

                                    </button>

                                </div>

                                <div class="card-body">

                                    <table class="table table-borderless mb-0">

                                        <tr>
                                            <th width="35%">Phone Number</th>
                                            <td id="review_phone"></td>
                                        </tr>

                                        <tr>
                                            <th>Email Address</th>
                                            <td id="review_email"></td>
                                        </tr>

                                        <tr>
                                            <th>NIN</th>
                                            <td id="review_nin"></td>
                                        </tr>

                                        <tr>
                                            <th>Occupation</th>
                                            <td id="review_occupation"></td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <!-- Physical Information -->

                            <div class="card shadow-sm mb-4">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <strong>Physical Information</strong>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            onclick="goToStep(3)">

                                        <i class="fas fa-edit"></i> Edit

                                    </button>

                                </div>

                                <div class="card-body">

                                    <table class="table table-borderless mb-0">

                                        <tr>
                                            <th width="35%">Blood Group</th>
                                            <td id="review_blood_group"></td>
                                        </tr>

                                        <tr>
                                            <th>Height</th>
                                            <td id="review_height"></td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <!-- Next of Kin -->

                            <div class="card shadow-sm mb-4">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <strong>Next of Kin</strong>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            onclick="goToStep(4)">

                                        <i class="fas fa-edit"></i> Edit

                                    </button>

                                </div>

                                <div class="card-body">

                                    <table class="table table-borderless mb-0">

                                        <tr>
                                            <th width="35%">Phone Number</th>
                                            <td id="review_nok_phone"></td>
                                        </tr>

                                        <tr>
                                            <th>Nationality</th>
                                            <td id="review_nok_nationality"></td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <!-- Payment Summary -->

                            <div class="alert alert-success">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <strong>Fresh Driver's License</strong>

                                        <br>

                                        Application Fee

                                    </div>

                                    <h4 class="mb-0">

                                        ₦15,000

                                    </h4>

                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-6">

                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            onclick="goToStep(4)">

                                        <i class="fas fa-arrow-left"></i>

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button type="button"
                                            class="btn btn-success"
                                            onclick="preparePayment()">

                                        Proceed to Payment

                                        <i class="fas fa-lock ml-2"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- STEP 6 -->

                        <!-- ===================================
                            STEP 6 - PAYMENT SUMMARY
                        ==================================== -->

                        <div class="step-content" id="step6">

                            <div class="text-center mb-4">

                                <div class="payment-icon">

                                    <i class="fas fa-credit-card"></i>

                                </div>

                                <h3 class="mt-3">

                                    Payment Summary

                                </h3>

                                <p class="text-muted">

                                    You're almost done. Please review your payment details before proceeding.

                                </p>

                            </div>

                            <!-- Applicant -->

                            <div class="card shadow-sm mb-4">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <strong>Applicant</strong>

                                            <p id="payment_name"></p>

                                        </div>

                                        <div class="col-md-6">

                                            <strong>Email Address</strong>

                                            <p id="payment_email"></p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- Service -->

                            <div class="card shadow-sm mb-4">

                                <div class="card-header">

                                    <strong>Order Summary</strong>

                                </div>

                                <div class="card-body">

                                    <table class="table table-borderless mb-0">

                                        <tr>

                                            <td>

                                                Fresh Driver's License

                                            </td>

                                            <td class="text-right">

                                                ₦15,000

                                            </td>

                                        </tr>

                                        <tr>

                                            <td>

                                                Processing Fee

                                            </td>

                                            <td class="text-right">

                                                ₦0

                                            </td>

                                        </tr>

                                        <tr class="border-top">

                                            <th>

                                                Total

                                            </th>

                                            <th class="text-right text-success">

                                                ₦15,000

                                            </th>

                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <!-- Notice -->

                            <div class="alert alert-info">

                                <i class="fas fa-info-circle mr-2"></i>

                                After payment, your application will be submitted automatically and a confirmation receipt will be sent to your email.

                            </div>

                            <div class="row mt-4">

                                <div class="col-6">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="goToStep(5)">

                                        <i class="fas fa-arrow-left"></i>

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button
                                        type="button"
                                        class="btn btn-success btn-lg px-5"
                                        id="payNowBtn">

                                        <i class="fas fa-lock mr-2"></i>

                                        Pay ₦15,000

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
    function validateStep1(){

        let required = [

            'surname',

            'firstname',

            'gender',

            'dob',

            'place_of_birth',

            'marital_status',

            'nationality',

            'address'

        ];

        let valid = true;

        required.forEach(function(field){

            let input = $('#'+field);

            if(input.val() == ''){

                input.css('border','1px solid red');

                valid = false;

            }else{

                input.css('border','1px solid #ced4da');

            }

        });

        if(!valid){

            alert('Please complete all required fields.');

            return;

        }

        goToStep(2);

    }

    function goToStep(step){

        $('.step-content').removeClass('active').hide();

        $('#step' + step).addClass('active').show();

        $('.wizard-step').removeClass('active completed');

        for(let i = 1; i <= 6; i++){

            if(i < step){
                $('#indicator' + i).addClass('completed');
            }

            if(i === step){
                $('#indicator' + i).addClass('active');
            }

        }

    }

    const lgas = {

        Lagos: [
            "Agege",
            "Ajeromi-Ifelodun",
            "Alimosho",
            "Amuwo-Odofin",
            "Apapa",
            "Eti-Osa",
            "Ikeja",
            "Ikorodu",
            "Kosofe",
            "Lagos Island",
            "Lagos Mainland",
            "Mushin",
            "Ojo",
            "Oshodi-Isolo",
            "Surulere"
        ],

        Ogun: [
            "Abeokuta North",
            "Abeokuta South",
            "Ado-Odo/Ota",
            "Ijebu North",
            "Ijebu Ode",
            "Ifo",
            "Sagamu"
        ],

        Oyo: [
            "Ibadan North",
            "Ibadan South-West",
            "Ogbomosho North",
            "Oyo East",
            "Oyo West"
        ],

        Osun: [
            "Osogbo",
            "Ilesa East",
            "Ife Central",
            "Ede North"
        ],

        Abia: [
            "Aba North",
            "Aba South",
            "Umuahia North",
            "Umuahia South"
        ],

        Abuja: [
            "Abaji",
            "Bwari",
            "Gwagwalada",
            "Kuje",
            "Kwali",
            "Municipal Area Council"
        ],

        Rivers: [
            "Port Harcourt",
            "Obio-Akpor",
            "Eleme",
            "Ikwerre",
            "Okrika"
        ]

    };

    $('#state_origin').change(function(){

        let state = $(this).val();

        $('#lga_origin').html(
            '<option value="">Select LGA</option>'
        );

        if(lgas[state]){

            lgas[state].forEach(function(lga){

                $('#lga_origin').append(
                    `<option>${lga}</option>`
                );

            });

        }

    });

    function validateStep2(){

        let required = [

            'state_origin',

            'lga_origin',

            'phone',

            'email',

            'nin',

            'occupation',

            'mother_maiden_name'

        ];

        let valid = true;

        required.forEach(function(field){

            let input = $('#'+field);

            if(input.val() == ''){

                input.css('border','1px solid red');

                valid = false;

            }else{

                input.css('border','1px solid #ced4da');

            }

        });

        if($('#nin').val().length != 11){

            alert('NIN must be exactly 11 digits.');

            return;

        }

        if(!valid){

            alert('Please complete all required fields.');

            return;

        }

        goToStep(3);

    }

    function validateStep3(){

        let required = [

            'blood_group',

            'height'

        ];

        let valid = true;

        required.forEach(function(field){

            let input = $('#'+field);

            if(input.val() == ''){

                input.addClass('is-invalid');

                valid = false;

            }else{

                input.removeClass('is-invalid');

            }

        });

        if(!valid){

            alert('Please complete all required fields.');

            return;

        }

        let height = parseInt($('#height').val());

        if(height < 50 || height > 250){

            alert('Please enter a valid height.');

            return;

        }

        goToStep(4);

    }

    function validateStep4(){

        let required = [

            'nok_phone',

            'nok_nationality'

        ];

        let valid = true;

        required.forEach(function(field){

            let input = $('#' + field);

            if(input.val().trim() === ''){

                input.addClass('is-invalid');

                valid = false;

            }else{

                input.removeClass('is-invalid');

            }

        });

        if(!valid){

            alert('Please complete all required fields.');

            return;

        }

        let phone = $('#nok_phone').val();

        if(phone.length < 11){

            alert('Please enter a valid phone number.');

            return;

        }

        goToStep(5);

    }

    function prepareReview(){

        // Step 1

        $('#review_surname').text($('#surname').val());
        $('#review_firstname').text($('#firstname').val());
        $('#review_othername').text($('#othername').val());
        $('#review_gender').text($('#gender').val());
        $('#review_dob').text($('#dob').val());
        $('#review_nationality').text($('#nationality').val());

        // Step 2

        $('#review_phone').text($('#phone').val());
        $('#review_email').text($('#email').val());
        $('#review_nin').text($('#nin').val());
        $('#review_occupation').text($('#occupation').val());

        // Step 3

        $('#review_blood_group').text($('#blood_group').val());
        $('#review_height').text($('#height').val() + ' cm');

        // Step 4

        $('#review_nok_phone').text($('#nok_phone').val());
        $('#review_nok_nationality').text($('#nok_nationality').val());

        goToStep(5);

    }

    function showPayment(){

        $('#payment_name').text(

            $('#surname').val() +

            ' ' +

            $('#firstname').val()

        );

        $('#payment_email').text(

            $('#email').val()

        );

        goToStep(6);

    }
</script>

@endsection