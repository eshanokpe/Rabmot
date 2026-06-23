@extends('layouts.app')

@section('content')

<style>
    .intl-license-page{
        padding:80px 0;
        background:#f7f9fc;
        min-height:100vh;
    }
    .application-card{
        background:#fff;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 25px rgba(0,0,0,.08);
    }

    .service-banner{
        min-height:100%;
        background:#142444;
        border-radius:15px;
        overflow:hidden;
    }

    .service-overlay{
        padding:35px;
        color:#fff;
    }

    .section-title{
        font-size:24px;
        font-weight:700;
        margin-bottom:25px;
    }

    .step-content{
        display:none;
    }

    .step-content.active{
        display:block;
    }

    .wizard-wrapper{
        margin-bottom:40px;
    }

    .wizard-steps{
        display:flex;
        justify-content:space-between;
    }

    .wizard-step{
        text-align:center;
        flex:1;
    }

    .wizard-step .circle{
        width:45px;
        height:45px;
        line-height:45px;
        border-radius:50%;
        background:#e9ecef;
        margin:auto;
        font-weight:bold;
    }

    .wizard-step.active .circle{
        background:#142444;
        color:#fff;
    }

    .wizard-step.completed .circle{
        background:#28a745;
        color:#fff;
    }

    .btn-primary-custom{
        background:#142444;
        color:#fff;
        border:none;
    }

    .btn-primary-custom:hover{
        color:#fff;
    }
</style>

<div class="intl-license-page">

    <div class="container">

        <div class="row">

            <!-- LEFT PANEL -->

            <div class="col-lg-4 mb-4">

                <div class="service-banner">

                    <div class="service-overlay">

                        <h4>
                            Vehicle Papers Renewal
                        </h4>

                        <small class="text-white-70">
                            Renew your vehicle documents online without visiting a licensing office.
                            Select your state, vehicle type, choose renewal services and upload documents.
                        </small>

                        <div class="alert alert-light mt-4">

                            <h6>
                                Instructions
                            </h6>

                            <small class="mb-2">
                                Select your vehicle type and state.
                            </small>

                            <small class="mb-2">
                                Choose the renewal services you require.
                            </small>

                            <small class="mb-0">
                                Upload the required documents and proceed to payment.
                            </small>

                        </div>

                        <div class="alert alert-warning">

                            <small><strong>NOTE:</strong></small>
                            <small>
                                Select the Hackney Permit option for vehicles used for commercial transportation,
                                taxi services and company vehicles.
                            </small>
                        </div>

                        <div class="alert alert-success">

                            <small><strong>ELIGIBILITY:</strong></small>
                            <small>
                                Only vehicles registered and used within Nigeria are eligible for renewal.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT PANEL -->

            <div class="col-lg-8">

                <div class="application-card">

                    <!-- Stepper Here -->
                     <div class="wizard-wrapper">

                        <div class="wizard-steps">

                            <div class="wizard-step active" id="indicator1">

                                <div class="circle">
                                    1
                                </div>

                                <p>Contact</p>

                            </div>

                            <div class="wizard-step" id="indicator2">

                                <div class="circle">
                                    2
                                </div>

                                <p>Selection</p>

                            </div>

                            <div class="wizard-step" id="indicator3">

                                <div class="circle">
                                    3
                                </div>

                                <p>Documents</p>

                            </div>

                            <div class="wizard-step" id="indicator4">

                                <div class="circle">
                                    4
                                </div>

                                <p>Review</p>

                            </div>

                            <div class="wizard-step" id="indicator5">

                                <div class="circle">
                                    5
                                </div>

                                <p>Payment</p>

                            </div>

                        </div>

                    </div>

                    <!-- Form Here -->
                    <form id="renewalForm">

                        <!-- STEP 1 -->
                        <div class="step-content active" id="step1">

                            <h4 class="section-title">
                                Contact Information
                            </h4>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Full Name *
                                    </label>

                                    <input type="text"
                                        id="full_name"
                                        class="form-control">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Phone Number *
                                    </label>

                                    <input type="text"
                                        id="phone"
                                        class="form-control">

                                </div>

                                <div class="col-md-12 mb-3">

                                    <label>
                                        Email Address *
                                    </label>

                                    <input type="email"
                                        id="email"
                                        class="form-control">

                                </div>

                            </div>

                            <div class="text-right">

                                <button type="button"
                                        class="btn btn-primary-custom"
                                        onclick="validateStep1()">

                                    Continue

                                </button>

                            </div>

                        </div>
                        <!-- STEP 2 -->
                        <div class="step-content" id="step2">

                            <h6 class="section-title">
                                Vehicle Information & Renewal Selection
                            </h6>

                            <div class="row">

                                <!-- Left Column -->

                                <div class="col-lg-8">

                                    <div class="card border-0 shadow-sm mb-4">

                                        <div class="card-body">

                                            <h5 class="mb-4">
                                                Vehicle Information
                                            </h5>

                                            <div class="row">

                                                <div class="col-md-6 mb-3">

                                                    <label>
                                                        State *
                                                    </label>

                                                    <select class="form-control"
                                                            id="state">

                                                        <option value="">
                                                            Select State
                                                        </option>

                                                        <option>Lagos</option>
                                                        <option>Ogun</option>
                                                        <option>Oyo</option>
                                                        <option>Osun</option>
                                                        <option>Abia</option>
                                                        <option>Abuja</option>
                                                        <option>Rivers</option>

                                                    </select>

                                                </div>

                                                <div class="col-md-6 mb-3">

                                                    <label>
                                                        Vehicle Type *
                                                    </label>

                                                    <select class="form-control"
                                                            id="vehicle_type">

                                                        <option value="">
                                                            Select Vehicle Type
                                                        </option>

                                                        <option>Saloon</option>
                                                        <option>SUV</option>
                                                        <option>Coaster</option>
                                                        <option>Truck - 15 Tons</option>
                                                        <option>Truck - 20 Tons</option>
                                                        <option>Truck - 30 Tons</option>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- Renewal Services -->

                                    <div class="card border-0 shadow-sm">

                                        <div class="card-body">

                                            <h5 class="mb-4">
                                                Select Renewal Services
                                            </h5>

                                            <div class="custom-control custom-checkbox mb-3">

                                                <input type="checkbox"
                                                    class="custom-control-input renewal-service"
                                                    id="vehicle_license"
                                                    data-name="Vehicle License"
                                                    data-price="5000">

                                                <label class="custom-control-label"
                                                    for="vehicle_license">

                                                    Vehicle License

                                                </label>

                                            </div>

                                            <div class="custom-control custom-checkbox mb-3">

                                                <input type="checkbox"
                                                    class="custom-control-input renewal-service"
                                                    id="road_worthiness"
                                                    data-name="Road Worthiness"
                                                    data-price="8000">

                                                <label class="custom-control-label"
                                                    for="road_worthiness">

                                                    Road Worthiness

                                                </label>

                                            </div>

                                            <div class="custom-control custom-checkbox mb-3">

                                                <input type="checkbox"
                                                    class="custom-control-input renewal-service"
                                                    id="insurance"
                                                    data-name="Third Party Insurance"
                                                    data-price="5500">

                                                <label class="custom-control-label"
                                                    for="insurance">

                                                    Third Party Insurance

                                                </label>

                                            </div>

                                            <div class="custom-control custom-checkbox mb-3">

                                                <input type="checkbox"
                                                    class="custom-control-input renewal-service"
                                                    id="hackney"
                                                    data-name="Hackney Permit"
                                                    data-price="6000">

                                                <label class="custom-control-label"
                                                    for="hackney">

                                                    Hackney Permit

                                                </label>

                                            </div>

                                            <div class="custom-control custom-checkbox mb-3">

                                                <input type="checkbox"
                                                    class="custom-control-input renewal-service"
                                                    id="inspection"
                                                    data-name="Vehicle Inspection Pick & Drop"
                                                    data-price="10000">

                                                <label class="custom-control-label"
                                                    for="inspection">

                                                    Vehicle Inspection Pick & Drop

                                                </label>

                                            </div>

                                            <div class="custom-control custom-checkbox mb-3">

                                                <input type="checkbox"
                                                    class="custom-control-input renewal-service"
                                                    id="ownership"
                                                    data-name="Proof of Ownership"
                                                    data-price="3500">

                                                <label class="custom-control-label"
                                                    for="ownership">

                                                    Proof of Ownership

                                                </label>

                                            </div>

                                            <div class="custom-control custom-checkbox">

                                                <input type="checkbox"
                                                    class="custom-control-input renewal-service"
                                                    id="cmris"
                                                    data-name="Police CMRIS"
                                                    data-price="4500">

                                                <label class="custom-control-label"
                                                    for="cmris">

                                                    Police CMRIS

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- Warning -->

                                    <div class="alert alert-warning mt-4"
                                        id="hackneyAlert"
                                        style="display:none;">

                                        <strong>NOTICE:</strong>

                                        Hackney Permit is required for
                                        commercial vehicles, taxis,
                                        and company vehicles.

                                    </div>

                                </div>

                                <!-- Summary -->

                                <div class="col-lg-4">

                                    <div class="card shadow-sm sticky-top">

                                        <div class="card-header bg-primary text-white">

                                            Renewal Summary

                                        </div>

                                        <div class="card-body">

                                            <p>

                                                <strong>State:</strong>

                                                <span id="summary_state">
                                                    -
                                                </span>

                                            </p>

                                            <p>

                                                <strong>Vehicle Type:</strong>

                                                <span id="summary_vehicle">
                                                    -
                                                </span>

                                            </p>

                                            <hr>

                                            <h6>
                                                Selected Services
                                            </h6>

                                            <ul id="selected_services">

                                                <li>
                                                    No Service Selected
                                                </li>

                                            </ul>

                                            <hr>

                                            <h5 class="text-success">

                                                Estimated Total

                                            </h5>

                                            <h3 id="estimated_total">

                                                ₦0

                                            </h3>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-6">

                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            onclick="goToStep(1)">

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button type="button"
                                            class="btn btn-primary-custom"
                                            onclick="generateUploadFields(); goToStep(3);">

                                        Continue

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- STEP 3 -->
                        <div class="step-content" id="step3">

                            <h4 class="section-title">
                                Upload Required Documents
                            </h4>

                            <div class="alert alert-info">

                                Upload clear and valid copies of the required documents.

                            </div>

                            <div id="documentUploads">

                                <!-- Dynamic Upload Fields -->

                            </div>

                            <div class="row mt-4">

                                <div class="col-6">

                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            onclick="goToStep(2)">

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button type="button"
                                            class="btn btn-primary-custom"
                                            onclick="validateStep3()">

                                        Continue

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- STEP 4 -->
                        <div class="step-content" id="step4">

                            <h4 class="section-title">
                                Review Application
                            </h4>

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <!-- Contact Information -->

                                    <h5 class="border-bottom pb-2 mb-3">
                                        Contact Information
                                    </h5>

                                    <table class="table table-bordered">

                                        <tbody>

                                            <tr>
                                                <th width="35%">Full Name</th>
                                                <td id="review_full_name"></td>
                                            </tr>

                                            <tr>
                                                <th>Phone Number</th>
                                                <td id="review_phone"></td>
                                            </tr>

                                            <tr>
                                                <th>Email Address</th>
                                                <td id="review_email"></td>
                                            </tr>

                                        </tbody>

                                    </table>

                                    <!-- Vehicle Information -->

                                    <h5 class="border-bottom pb-2 mb-3 mt-5">
                                        Vehicle Information
                                    </h5>

                                    <table class="table table-bordered">

                                        <tbody>

                                            <tr>
                                                <th width="35%">State</th>
                                                <td id="review_state"></td>
                                            </tr>

                                            <tr>
                                                <th>Vehicle Type</th>
                                                <td id="review_vehicle_type"></td>
                                            </tr>

                                        </tbody>

                                    </table>

                                    <!-- Selected Services -->

                                    <h5 class="border-bottom pb-2 mb-3 mt-5">
                                        Selected Renewal Services
                                    </h5>

                                    <div id="review_services">

                                    </div>

                                    <!-- Uploaded Documents -->

                                    <h5 class="border-bottom pb-2 mb-3 mt-5">
                                        Uploaded Documents
                                    </h5>

                                    <div id="review_documents">

                                    </div>

                                    <!-- Total -->

                                    <div class="alert alert-success mt-4">

                                        <h5 class="mb-0">

                                            Estimated Total:

                                            <span id="review_total">
                                                ₦0
                                            </span>

                                        </h5>

                                    </div>

                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-6">

                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            onclick="goToStep(3)">

                                        Back

                                    </button>

                                </div>

                                <div class="col-6 text-right">

                                    <button type="button"
                                            class="btn btn-primary-custom"
                                            onclick="preparePayment()">

                                        Continue

                                    </button>

                                </div>

                            </div>

                        </div>

                        <!-- STEP 5 -->
                        <div class="step-content" id="step5">

                            <h4 class="section-title">
                                Payment Summary
                            </h4>

                            <div class="card shadow-sm">

                                <div class="card-body">

                                    <div class="text-center mb-4">

                                        <i class="fa fa-credit-card fa-4x text-success mb-3"></i>

                                        <h4>
                                            Vehicle Papers Renewal
                                        </h4>

                                        <p class="text-muted">
                                            Review your payment details before proceeding.
                                        </p>

                                    </div>

                                    <table class="table table-bordered">

                                        <tbody>

                                            <tr>

                                                <th width="35%">
                                                    Applicant Name
                                                </th>

                                                <td id="payment_full_name"></td>

                                            </tr>

                                            <tr>

                                                <th>
                                                    Phone Number
                                                </th>

                                                <td id="payment_phone"></td>

                                            </tr>

                                            <tr>

                                                <th>
                                                    Email Address
                                                </th>

                                                <td id="payment_email"></td>

                                            </tr>

                                            <tr>

                                                <th>
                                                    State
                                                </th>

                                                <td id="payment_state"></td>

                                            </tr>

                                            <tr>

                                                <th>
                                                    Vehicle Type
                                                </th>

                                                <td id="payment_vehicle_type"></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                    <h5 class="mt-4 mb-3">
                                        Selected Renewal Services
                                    </h5>

                                    <div id="payment_services">

                                    </div>

                                    <div class="alert alert-success mt-4">

                                        <h4 class="mb-0">

                                            Total Amount:

                                            <span id="payment_total">

                                                ₦0

                                            </span>

                                        </h4>

                                    </div>

                                    <div class="alert alert-info">

                                        <strong>Important:</strong>

                                        You will be redirected to our secure payment gateway
                                        to complete your renewal application.

                                    </div>

                                    <!-- Hidden Fields -->

                                    <input type="hidden"
                                        name="service_type"
                                        value="vehicle_papers_renewal">

                                    <input type="hidden"
                                        id="final_amount"
                                        name="amount">

                                </div>

                            </div>

                            <div class="row mt-4">

                                <div class="col-6">

                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            onclick="goToStep(4)">

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
    function goToStep(step){

        $('.step-content').removeClass('active');

        $('#step' + step).addClass('active');

        $('.wizard-step')
            .removeClass('active completed');

        for(let i = 1; i <= 5; i++){

            if(i < step){

                $('#indicator' + i)
                    .addClass('completed');

            }

            if(i === step){

                $('#indicator' + i)
                    .addClass('active');

            }

        }

    }

    function validateStep1(){

        let fields = [

            'full_name',
            'phone',
            'email'

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

    // Update State
    $('#state').on('change', function(){

        $('#summary_state').text($(this).val());

    });

    // Update Vehicle Type
    $('#vehicle_type').on('change', function(){

        $('#summary_vehicle').text($(this).val());

    });

    // Renewal Services
    $('.renewal-service').on('change', function(){

        let total = 0;

        let services = [];

        $('.renewal-service:checked').each(function(){

            total += parseInt($(this).data('price'));

            services.push($(this).data('name'));

        });

        let html = '';

        if(services.length > 0){

            services.forEach(function(service){

                html += '<li>' + service + '</li>';

            });

        }else{

            html = '<li>No Service Selected</li>';

        }

        $('#selected_services').html(html);

        $('#estimated_total').text(
            '₦' + total.toLocaleString()
        );

        if($('#hackney').is(':checked')){

            $('#hackneyAlert').show();

        }else{

            $('#hackneyAlert').hide();

        }

    });

    function validateStep2(){

        let state =
            $('#state').val();

        let vehicle =
            $('#vehicle_type').val();

        let services =
            $('.renewal-service:checked').length;

        if(!state){

            alert('Please select a state.');

            return;
        }

        if(!vehicle){

            alert('Please select a vehicle type.');

            return;
        }

        if(services === 0){

            alert('Please select at least one renewal service.');

            return;
        }

        goToStep(3);

    }
    
    function generateUploadFields(){

        let html = '';

        $('.renewal-service:checked').each(function(){

            let serviceId = $(this).attr('id');
            let serviceName = $(this).data('name');

            html += `
                <div class="card shadow-sm mb-3">

                    <div class="card-body">

                        <label>
                            Upload ${serviceName}
                        </label>

                        <input type="file"
                            class="form-control-file required-upload"
                            data-service="${serviceName}"
                            id="upload_${serviceId}">

                        <small class="text-muted">
                            PDF, JPG or PNG accepted
                        </small>

                    </div>

                </div>
            `;
        });

        html += `
            <div class="card shadow-sm mb-3">

                <div class="card-body">

                    <label>
                        Vehicle Photograph (Optional)
                    </label>

                    <input type="file"
                        class="form-control-file"
                        id="vehicle_photo">

                </div>

            </div>
        `;

        $('#documentUploads').html(html);

    }

    function validateStep3(){

        let valid = true;

        $('.required-upload').each(function(){

            if(!$(this).val()){

                valid = false;

            }

        });

        if(!valid){

            alert(
                'Please upload all required documents.'
            );

            return;
        }

        prepareReview();

    }

    $(document).on(
        'change',
        '.required-upload',
        function(){

            let fileName =
                $(this).val().split('\\').pop();

            $(this).next('.file-name').remove();

            $(this).after(
                '<div class="file-name text-success mt-2">' +
                fileName +
                '</div>'
            );

        }
    );

    function prepareReview(){

        // Contact Information

        $('#review_full_name').text(
            $('#full_name').val()
        );

        $('#review_phone').text(
            $('#phone').val()
        );

        $('#review_email').text(
            $('#email').val()
        );

        // Vehicle Information

        $('#review_state').text(
            $('#state').val()
        );

        $('#review_vehicle_type').text(
            $('#vehicle_type').val()
        );

        // Services

        let servicesHtml = `
            <ul class="list-group">
        `;

        let total = 0;

        $('.renewal-service:checked').each(function(){

            let service =
                $(this).data('name');

            let amount =
                parseInt($(this).data('price'));

            total += amount;

            servicesHtml += `
                <li class="list-group-item d-flex justify-content-between">

                    ${service}

                    <strong>
                        ₦${amount.toLocaleString()}
                    </strong>

                </li>
            `;

        });

        servicesHtml += '</ul>';

        $('#review_services').html(
            servicesHtml
        );

        // Documents

        let documentHtml = `
            <ul class="list-group">
        `;

        $('.required-upload').each(function(){

            let fileName =
                $(this).val().split('\\').pop();

            let service =
                $(this).data('service');

            documentHtml += `
                <li class="list-group-item">

                    ✓ ${service}

                    <br>

                    <small class="text-muted">

                        ${fileName}

                    </small>

                </li>
            `;

        });

        documentHtml += '</ul>';

        $('#review_documents').html(
            documentHtml
        );

        $('#review_total').text(
            '₦' + total.toLocaleString()
        );

        goToStep(4);

    }

    function preparePayment(){

        $('#payment_full_name').text(
            $('#full_name').val()
        );

        $('#payment_phone').text(
            $('#phone').val()
        );

        $('#payment_email').text(
            $('#email').val()
        );

        $('#payment_state').text(
            $('#state').val()
        );

        $('#payment_vehicle_type').text(
            $('#vehicle_type').val()
        );

        let html = '';

        let total = 0;

        $('.renewal-service:checked').each(function(){

            let service =
                $(this).data('name');

            let amount =
                parseInt($(this).data('price'));

            total += amount;

            html += `
                <div class="d-flex justify-content-between border-bottom py-2">

                    <span>

                        ${service}

                    </span>

                    <strong>

                        ₦${amount.toLocaleString()}

                    </strong>

                </div>
            `;

        });

        $('#payment_services').html(
            html
        );

        $('#payment_total').text(
            '₦' + total.toLocaleString()
        );

        $('#final_amount').val(
            total
        );

        goToStep(5);

    }

    $('#renewalForm').submit(function(e){

        e.preventDefault();

        alert(
            'Application submitted successfully. Redirecting to payment gateway...'
        );

    });
</script>

@endsection