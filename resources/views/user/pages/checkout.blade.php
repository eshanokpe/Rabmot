@extends('user.layouts.app') 

@section('content')
<!--page-wrapper-->
<div class="page-wrapper">
    <style>
        .hidden {
        display: none;
        }
    </style>
    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
         <!--header-->
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Cart</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-cart-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-xl-10 mx-auto">
                <div class="card radius-5 p-3">
                    <div class="card-body">
                        @if (session('success'))
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                        </div>
                    @endif
                        <div class="row">
                            <div class="col-12 col-sm-8">
                                <div class="card-title">
                                    <h6 class="mb-0">
                                        Fullname : <span> {{ $fullname }} </span>
                                    </h6>
                                    <h6 class="mb-0">
                                        Email: <span> {{ $email }}</span>
                                    </h6>
                                </div>
                            </div>
                            <hr/>
                        </div>
                        
                        
                        <div class="card-body">
                        
                                <div class="row">
                                    <div class="col-md-12">
                                       @php
                                        $processTypes = [];
                                        @endphp
                                        
                                        @foreach($cartItems as $item)
                                            @php
                                                $processType = $item->model->process_type;
                                            @endphp
                                        
                                            @unless(in_array($processType, $processTypes))
                                                {{ $processType }}
                                                @unless ($loop->last && count($processTypes) === 1)
                                                    ,
                                                @endunless
                                                @php
                                                    $processTypes[] = $processType;
                                                @endphp
                                            @endunless
                                        @endforeach

                                    </div>
                                    
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>S/N</th> --}}
                                                        <th>Order ID</th>
                                                        <th>Process ID</th>
                                                        <th>Process Details</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($cartItems as $item)
                                                    <tr>
                                                        <td>{{ $orderNumber }}</td> 
                                                        <td>{{ $item->model->process_id }}</td>
                                                        <td>  
                                                            @if($item->model->process_type == 'Other Permit')
                                                                {{ $item->model->permitInfo->name }}
                                                            @elseif($item->model->process_type == 'Dealer`s Plate Number')
                                                                {{ $item->model->process_type }}, {{ $item->model->fullname }}
                                                            @elseif($item->model->process_type == 'International Driver License')
                                                                Validity: {{ $internationalDL->lengthofyear }} Years
                                                            @elseif($item->model->process_type == 'Driver License Renewal')
                                                                Validity: {{ $driverlicenserenewal->lengthofyear }} Years
                                                            @elseif($item->model->process_type == 'New Driver License')
                                                                Validity: {{ $newdriverlicense->lengthofyear }} Years
                                                            @elseif($item->model->process_type == 'Change of Ownership')
                                                                {{ $item->model->vehicle_category }}<br>
                                                                @if($item->model->vehiclelicenseexpiry)
                                                                    Vehicle Expiring Date<br>
                                                                @endif
                                                                @if($item->model->insuranceexpiry)
                                                                    Insurance Expiring Date<br>
                                                                @endif
                                                                @if($item->model->roadworthinessexpiry)
                                                                    Roadworthiness Expiring Date<br>
                                                                @endif
                                                                @if($item->model->hackneypermitexpiry)
                                                                    Hackney Permit Expiring Date<br>
                                                                @endif
                                                                @if($item->model->localgovernmentpermitexpiry)
                                                                    Local Government Permit Expiring Date<br>
                                                                @endif
                                                                @if($item->model->policeCMRIS)
                                                                    <b>Police CMRIS</b>
                                                                @endif
                                                            @elseif($item->model->process_type == 'Vehicle Paper Renewal')
                                                                @foreach (['vehicleLicense', 'roadWorthiness', 'vehicleInspectionPickanddrop', 'hackneyPermit', 'thirdPartyInsurance', 'policeCMRIS', 'proofOfOwnership'] as $key)
                                                                    @if($item->model->$key)
                                                                        <div style="display: inline;">
                                                                            {{ ucfirst(str_replace('_', ' ', $key)) }}: ₦{{ number_format($item->model->$key, 2) }}
                                                                        </div>,
                                                                    @endif
                                                                @endforeach
                                                            @elseif($item->model->process_type == 'Vehicle Registration')
                                                                {{ $item->model->categoryInfo->name }}<br>
                                                                <span class="mb-3">{{ $item->model->vehicleregistrationType->name }}<br></span>
                                                                @if($item->model->numberplate == 'PCN')
                                                                    <p><b>Personalized/Customize Number</b>,<br> (<b>{{ $item->model->preferrednumber }}</b>)</p>
                                                                    @php
                                                                        $isHackneyPermitSelected = false;
                                                                    @endphp
                                                                    @foreach (['hackneypermit', 'policeCMRIS'] as $key)
                                                                        @if($item->model->$key)
                                                                            @if($key == 'hackneypermit')
                                                                                <p style="display: inline;">Hackney Permit</p>
                                                                                @php $isHackneyPermitSelected = true; @endphp
                                                                            @elseif($isHackneyPermitSelected)
                                                                                <p style="display: inline;">,</p>
                                                                                <p style="display: inline;">Police CMRIS</p>
                                                                            @else
                                                                                <p style="display: inline;">Police CMRIS</p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @elseif($item->model->numberplate == 'RPN')
                                                                    <p><b>Random Plate Number</b></p>
                                                                    @php
                                                                        $isHackneyPermitSelected = false;
                                                                    @endphp
                                                                    @foreach (['hackneypermit', 'policeCMRIS'] as $key)
                                                                        @if($item->model->$key)
                                                                            @if($key == 'hackneypermit')
                                                                                <p style="display: inline;">Hackney Permit</p>
                                                                                @php $isHackneyPermitSelected = true; @endphp
                                                                            @elseif($isHackneyPermitSelected)
                                                                                <p style="display: inline;">,</p>
                                                                                <p style="display: inline;">Police CMRIS</p>
                                                                            @else
                                                                                <p style="display: inline;">Police CMRIS</p>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>₦{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                
 
                                <div class="row">
                                    <div class="col-7 col-sm-10">
                                        <label for="">
                                        Value Added Tax (VAT)
                                        </label>
                                    </div>
                                    <div class="col-5 col-sm-2 text-center">
                                        <label for="">₦{{ Cart::tax()}}</label>
                                    
                                    </div><br><br>
                                    <hr>

                                </div>
                                <div class="row">
                                    <div class="col-7 col-sm-8">
                                        
                                        <label for="">Enter a promo code</label>
                                        <div class="input-group mb-3">
                                        
                                        <input type="text" class="form-control" placeholder="Enter promo code" aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="btn btn-primary" type="button" id="button-addon2">Apply</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            
                            
                                <div class="row">
                                    
                                    <hr>
                                    <div class="col-7 col-sm-10">
                                        <p> <b> Total Amount</b></p>
                                    </div>
                                    <div class="col-5 col-sm-2 text-center">
                                    <p>₦{{ Cart::total()}}</p>
                                    
                                    </div><br><br>
                                    <hr>

                                </div>
                                <form action="{{ route('home.payment.initiate')}}" method="POST">
                                    @csrf
                                    <div class="col-12 col-sm-8">
                                        <label for="">Delivery Option</label>
                                        <select id="selection" required name="delivery_option" class="form-select mb-3">
                                            <option disabled selected value="">Choose Delivery Option</option>
                                            <option data-type="email" value="Scan and Send to Mail">Scan and send to mail</option>
                                            <option data-type="pickup" value="Pick Up from nearest location">Pick Up from nearest location</option>
                                            <option data-type="delivery" value="Delivery to door step">Delivery to door step</option>
                                        </select>
                                    </div>
                                    <div id="elementToHide1" style="display: none;" class="col-sm-8 hidden mb-3">
                                        <label for="">Enter Email Address</label>
                                        <input type="text" name="scan_email" class="form-control" placeholder="email address" value="" >
                                    </div>
                                    <div id="elementToHide2" style="display: none;" class="col-sm-8 hidden mb-3">
                                        <label for="">Select Location</label>
                                        <select id="selection2"  name="location" id="location"class="form-select">
                                            <option disabled selected value="">Choose Preferred State</option>
                                            <option data-id="lagos" value="Lagos">Lagos</option>
                                            <option data-id="abuja" value="Abuja">Abuja</option>
                                            <option data-id="portharcourt" value="Port Harcourt">Port Harcourt</option>
                                            <option data-id="abeokuta" value="Abeokuta">Abeokuta</option>
                                            <option data-id="ibadan" value="Ibadan">Ibadan</option>
                                        </select>
                                        <div id="elementToHide21" style="display: none;" class="col-sm-8 hidden mt-3">
                                            <select id="lagos_address" name="lagos_address" class="form-select">
                                                <option disabled selected value="">Choose Lagos address</option>
                                                <option value="Lagos Office Address: 1st floor AMG Workspace, 22 Road, Lagos, Nigeria.">
                                                    Lagos Office Address: 1st floor AMG Workspace, 22 Road, Lagos, Nigeria.
                                                </option>
                                                <option value="Isheri Oshun Branch Address: Rilexgroups, Lilian Almaroof St, Ijegun, Ikotun/Ijegun 102213, Lagos, Nigeria.">
                                                    Isheri Oshun Branch Address: Rilexgroups, Lilian Almaroof St, Ijegun, Ikotun/Ijegun 102213, Lagos, Nigeria.
                                                </option>
                                            </select>
                                        </div>
                                        <div id="elementToHide22" class="col-sm-8 hidden mt-3">
                                            <p>
                                                <b>Abuja Office Address</b><br>
                                                V I O Office Mabushi Kado Express Way Eagle Square, Abuja Nigeria.
                                            </p>
                                        </div>
                                        <div id="elementToHide23" class="col-sm-8 hidden mt-3">
                                            <p>
                                                <b>Port Harcourt Office Address</b><br>
                                                Deborah Lawson House, Abacha road, GRA, Port Harcourt, Rivers.
                                            </p>
                                        </div>
                                        <div id="elementToHide24" class="col-sm-8 hidden mt-3">
                                            <p>
                                                <b>Abeokuta Office Address</b><br>
                                                5 Peter B somide street Onikoko Abeokuta Ogun NIgeria.
                                            </p>
                                        </div>
                                        <div id="elementToHide25" class="col-sm-8 hidden mt-3">
                                            <p>
                                                <b>Ibadan Office Address</b><br>
                                                Onireke licencing office dugbe, Ibadan Nigeria.
                                            </p>
                                        </div>                                    
                                    </div>
                                    <div id="elementToHide3" style="display: none;" class="col-sm-8 hidden">
                                        <label for="">Enter Address</label>
                                        <textarea  class="form-control" name="address" placeholder="Your address" ></textarea>
                                        <br>
                                    </div>
                                   
                                    <input type="hidden" name="process_type" id="process_type" value="{{$item->model->process_type}}">
                                    <input type="hidden" name="process_id" id="process_id" value="{{$item->model->process_id}}">
                                    <input type="hidden" name="fullname" id="fullname" value="{{$fullname}}">
                                    <input type="hidden" name="email" id="email" value="{{$email}}">
                                    <input type="hidden" name="orderNo" id="orderNo" value="{{$orderNumber}}">
                                    <input type="hidden" name="total" id="total" value="{{ Cart::total() }}">
                                    <div class="col-12 " text-center>
                                        <center>  
                                            <button type="submit" class="btn btn-primary px-5 text-center" >Make Payment</button>
                                        </center>
                                    </div>
                                </form>
                             
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page-content-wrapper-->
</div>

<!--end page-wrapper-->
<script>
    const selection1 = document.getElementById("selection2");
    const elementToHide21 = document.getElementById("elementToHide21");
    const elementToHide22 = document.getElementById("elementToHide22");
    const elementToHide23 = document.getElementById("elementToHide23");
    const elementToHide24 = document.getElementById("elementToHide24");
    const elementToHide25 = document.getElementById("elementToHide25");

    selection1.addEventListener("change", function () {
        const selectedOption = selection1.options[selection1.selectedIndex];
        const selectedId = selectedOption.dataset.id;

        // Hide all elements initially
        elementToHide21.style.display = "none";
        elementToHide22.style.display = "none";
        elementToHide23.style.display = "none";
        elementToHide24.style.display = "none";
        elementToHide25.style.display = "none";

        // Show the relevant element based on data-id
        if (selectedId === "lagos") {
            elementToHide21.style.display = "block";
        } else if (selectedId === "abuja") {
            elementToHide22.style.display = "block";
        } else if (selectedId === "portharcourt") {
            elementToHide23.style.display = "block";
        } else if (selectedId === "abeokuta") {
            elementToHide24.style.display = "block";
        } else if (selectedId === "ibadan") {
            elementToHide25.style.display = "block";
        }
    });

</script>
<script>
    const selection = document.getElementById("selection");
    const elementToHide1 = document.getElementById("elementToHide1");
    const elementToHide2 = document.getElementById("elementToHide2");
    const elementToHide3 = document.getElementById("elementToHide3");

    selection.addEventListener("change", function () {
        const selectedOption = selection.options[selection.selectedIndex];
        const selectedType = selectedOption.dataset.type;

        // Hide all elements initially
        elementToHide1.style.display = "none";
        elementToHide2.style.display = "none";
        elementToHide3.style.display = "none";

        // Show the corresponding element based on data-type
        if (selectedType === "email") {
            elementToHide1.style.display = "block";
        } else if (selectedType === "pickup") {
            elementToHide2.style.display = "block";
        } else if (selectedType === "delivery") {
            elementToHide3.style.display = "block";
        }
    });

</script>


@endsection