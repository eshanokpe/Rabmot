<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Invoice - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('public/assets/invoice/css/style.css')}}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style type="text/css">
    	body{
        background:#eee;
        margin-top:20px;
        }
        .text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #142444;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		table {
            border-collapse: collapse;
            width: 100%;
        }
        td {
            padding: 10px;
            vertical-align: top;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
		
		#container {
			background-color: #dcdcdc;
		}
    </style>
    

</head> 
<body>
<div class="container">
    <div class="row">
        <div class="receipt-main">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <!-- Left aligned image -->
                        <td class="text-left" style="text-align: left;">
                            <img alt="iamgurdeeposahan" src="https://rabmotlicensing.com/rabmot22.PNG" width="50px">
                        </td>
                        <!-- Right aligned text -->
                        <td class="text-right" style="text-align: right;">
                            <p style="font-size: 12px; margin: 0;"><b>Invoice {{ $invoiceNumber }}</b></p>
                            <p style="font-size: 12px; margin: 0;">Issue Date: {{ $saleDate }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

        
            <br>
            <div class="row">
                <div class="receipt-header">
                   
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <div class="receipt-right">
                            <p><b>Rabmot Automoblie and Licensing Agency.</b></p>
                            <p>CAC RC Number: RC 7488687 </p>
                            <p>TAX ID: 31717032-0001</p>
                            <p>1st floor AMG Workspace 22 Road, Festac Town, Lagos Nigeria</p>
                            <p>info@rabmotlicensing.com, suppport@rabmotlicensing.com</p>
                            <p>Phone: +234815 520 6810, +234708 817 3662, 07088173662</p>
                            <p>Company ID: BN 3510510</p>
                            <p>Website: www.rabmotlicensing.com</p>
                        </div>
                    </div>
                </div>
            </div>
           <br>
            <div class="row">
                <div class="receipt-header">
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <div class="receipt-right">
                            <p>Bill to:</p>
                            <p>{{ $fullname }}  </p>
                            <p>Phone:  {{ $phone }} </p>
                            <p>Email:  {{ $email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        <div>
        <br>    
        <p> 
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
        </p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @if ($cartItems && count($cartItems) > 0)
                    @foreach ($cartItems as $item)
                        <tr>
                            <td class="col-md-9">
                                @if($item->model->process_type == 'Other Permit')
                                    {{$item->model->permittype}}
                                @endif
                                
                                @if($item->model->process_type == 'New Driver License')
                                    Validity:{{$newdriverlicense->lengthofyear}}
                                @endif
                                 
                                @if($item->model->process_type == 'Change of Ownership')
                                   {{ $item->model->vehicle_category }}<br>
                                    @if($item->model->vehiclelicenseexpiry != null)
                                        Vehicle Expiring Date<br>
                                    @endif
                                    @if($item->model->insuranceexpiry != null)
                                        Insurance Expiring Date<br>
                                    @endif
                                    
                                    @if($item->model->roadworthinessexpiry != null)
                                        Roadworthiness Expiring Date <br>
                                    @endif
                                    @if($item->model->hackneypermitexpiry != null)
                                        Hackney Permit Expiring Date <br>
                                    @endif
                                    @if($item->model->localgovernmentpermitexpiry != null)
                                        Local Government Permit Expiring Date <br>
                                    @endif
                                    @if($item->model->policeCMRIS != null)
                                        <b>Police CMRIS</b>
                                    @endif
                                @endif
                                
                                 @if($item->model->process_type == 'Vehicle Paper Renewal')
                                    @foreach ($item->model->getAttributes() as $key => $value)
                                        @if ($key === 'vehicleLicense' && $value !== null)
                                            <div style="display: inline;">Vehicle License: ₦{{ number_format($value, 2)  }}</div>,
                                        @endif
                                    @endforeach
                                    @foreach ($item->model->getAttributes() as $key => $value)
                                        @if ($key === 'roadWorthiness' && $value !== null)
                                            <div style="display: inline;">Road Worthiness: ₦{{ number_format($value, 2)  }}</div>,
                                        @endif
                                    @endforeach
                                    @foreach ($item->model->getAttributes() as $key => $value)
                                        @if ($key === 'vehicleInspectionPickanddrop' && $value !== null)
                                            <div style="display: inline;">Vehicle Inspection Pick and drop: ₦{{ number_format($value, 2)  }}</div>,
                                        @endif
                                    @endforeach
                                    @foreach ($item->model->getAttributes() as $key => $value)
                                        @if ($key === 'hackneyPermit' && $value !== null)
                                            <div style="display: inline;">Hackney Permit: ₦{{ number_format($value, 2)  }}</div>,
                                        @endif
                                    @endforeach
                                   
                                    @foreach ($item->model->getAttributes() as $key => $value)
                                        @if ($key === 'thirdPartyInsurance' && $value !== null)
                                            <div style="display: inline;">Third Party Insurance: ₦{{ number_format($value, 2)  }}</div>,
                                        @endif
                                    @endforeach
                                    
                                    @foreach ($item->model->getAttributes() as $key => $value)
                                        @if ($key === 'policeCMRIS' && $value !== null)
                                            <div style="display: inline;">Police CMRIS: ₦{{ number_format($value, 2)  }}</div>
                                        @endif
                                    @endforeach 
                                    @foreach ($item->model->getAttributes() as $key => $value)
                                        @if ($key === 'proofOfOwnership' && $value !== null)
                                            <div style="display: inline;"> Proof of Ownership: ₦{{ number_format($value, 2)  }}</div>
                                        @endif
                                    @endforeach 

                                @endif
                                
                                @if($item->model->process_type == 'Vehicle Registration')
                                
                                    {{ $item->model->categoryInfo->name }},<br>
                                    <span class="mb-3">{{ $item->model->vehicleregistrationType->name }}<br></span>
                                    @if($item->model->numberplate == 'PCN')
                                        <p><b>Personalized/Customize Number</b>,<br> (<b>{{$item->model->preferrednumber}}</b>)</p>
                                         @php
                                            $isHackneyPermitSelected = false;
                                        @endphp
                                        
                                        @foreach ($item->model->getAttributes() as $key => $value)
                                            @if ($key === 'hackneypermit' && $value !== null)
                                                <p style="display: inline;">Hackney Permit</p>
                                                @php
                                                    $isHackneyPermitSelected = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        
                                        @foreach ($item->model->getAttributes() as $key => $value)
                                            @if ($key === 'policeCMRIS' && $value !== null)
                                                @if ($isHackneyPermitSelected)
                                                    <p style="display: inline;">,</p>
                                                @endif
                                                <p style="display: inline;">Police CMRIS</p>
                                            @endif
                                        @endforeach
                                                                        
                                        @elseif($item->model->numberplate == 'RPN')
                                            <p><b>Random Plate Number</b></p>
                                            @php
                                                $isHackneyPermitSelected = false;
                                            @endphp
                                            
                                            @foreach ($item->model->getAttributes() as $key => $value)
                                                @if ($key === 'hackneypermit' && $value !== null)
                                                    <p style="display: inline;">Hackney Permit</p>
                                                    @php
                                                        $isHackneyPermitSelected = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            
                                            @foreach ($item->model->getAttributes() as $key => $value)
                                                @if ($key === 'policeCMRIS' && $value !== null)
                                                    @if ($isHackneyPermitSelected)
                                                        <p style="display: inline;">,</p>
                                                    @endif
                                                    <p style="display: inline;">Police CMRIS</p>
                                                @endif
                                            @endforeach
    
                                        @endif
                                        
                                    @endif
                            </td> 
                            <td class="col-md-3">₦{{ number_format($item->subtotal, 2, '.',',') }}</td>
                        </tr>
                    @endforeach
                @else 
                    <p>No items in cart.</p>
                @endif
                
            </tbody>
        </table>
         <hr>
        <div>
            
            <p><strong>Value Added Tax (VAT): </strong></p>
            <p class="text-left text-danger"> ₦{{ Cart::tax()}} </p>
       
            <p>Total Amount: </strong></p>
            <p> ₦{{ Cart::total()}}</p>
            
        </div>
        {{-- <p>GAPhub link, <a href="https://appstaging.mygaphub.com/home" class="btn btn-primary">click here</a>.</p> --}}
        
</div>


</div>
</div>
</div>
<script data-cfasync="false" src="https://cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>