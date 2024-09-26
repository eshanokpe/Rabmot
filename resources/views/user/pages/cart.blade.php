@extends('user.layouts.app')

@section('content')


<!-- wrapper -->
<div class="wrapper">
    <div class="page-wrapper">
        <!--page-content-wrapper-->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">My Cart</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart<i class='bx bx-cart'></i></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
                <div class="col-xl-10 mx-auto">
                    @if (session('success'))
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>

                <!--end breadcrumb-->
                <div class="user-profile-page">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="mb-0">Cart (Processes)</h4>
                            </div>
                            
                            <!-- Success message -->
                            <div id="successMessage" style="display: none;">
                                <div class="col-xl-12 mx-auto">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Item deleted successfully!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Process ID</th>
                                                    <th>Process Type</th>
                                                    <th>Process Details</th>
                                                    <th>Amount</th>
                                                    <th>Qty</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($cartCount > 0)
                                                    @foreach($cartContent as $item)
                                                        <tr>
                                                            <td>{{ $item->model->process_id }}</td>
                                                            <td>{{ $item->model->process_type }}</td>

                                                            @if($item->model->process_type == 'Driver License Renewal')
                                                                <td>Validity: {{ $item->model->lengthofyear }} Years</td>
                                                            @elseif($item->model->process_type == 'International Driver License')
                                                                <td>Validity: {{ $item->model->lengthofyear }} Year</td>
                                                            @elseif($item->model->process_type == 'New Driver License')
                                                                <td>Validity: {{ $item->model->lengthofyear }} Years</td>
                                                            @elseif($item->model->process_type == 'Change of Ownership')
                                                                <td>
                                                                    {{ $item->model->vehicle_category }}<br>
                                                                    @if($item->model->vehiclelicenseexpiry != null) Vehicle Expiring Date<br> @endif
                                                                    @if($item->model->insuranceexpiry != null) Insurance Expiring Date<br> @endif
                                                                    @if($item->model->roadworthinessexpiry != null) Roadworthiness Expiring Date <br> @endif
                                                                    @if($item->model->hackneypermitexpiry != null) Hackney Permit Expiring Date <br> @endif
                                                                    @if($item->model->localgovernmentpermitexpiry != null) Local Government Permit Expiring Date <br> @endif
                                                                    @if($item->model->policeCMRIS != null) <b>Police CMRIS</b> @endif
                                                                </td>
                                                            @elseif($item->model->process_type == 'Vehicle Registration')
                                                                <td>
                                                                    {{ $item->model->categoryInfo->name }},
                                                                    <span class="mb-3">{{ $item->model->vehicleregistrationType->name }}</span>
                                                                    @if($item->model->numberplate == 'PCN')
                                                                        <p><b>Personalized/Customize Number</b>, (<b>{{ $item->model->preferrednumber }}</b>)</p>
                                                                        @if($item->model->hackneypermit) <p style="display: inline;">Hackney Permit</p> @endif
                                                                        @if($item->model->policeCMRIS) @if($item->model->hackneypermit) <p style="display: inline;">,</p> @endif <p style="display: inline;">Police CMRIS</p> @endif
                                                                    @elseif($item->model->numberplate == 'RPN')
                                                                        <p><b>Random Plate Number</b></p>
                                                                        @if($item->model->hackneypermit) <p style="display: inline;">Hackney Permit</p> @endif
                                                                        @if($item->model->policeCMRIS) @if($item->model->hackneypermit) <p style="display: inline;">,</p> @endif <p style="display: inline;">Police CMRIS</p> @endif
                                                                    @endif
                                                                </td>
                                                            @elseif($item->model->process_type == 'Vehicle Paper Renewal')
                                                                <td>
                                                                    {{ $item->model->vehicleType }}:
                                                                    @if($item->model->vehicleLicense) Vehicle License, @endif
                                                                    @if($item->model->roadWorthiness) Road Worthiness, @endif
                                                                    @if($item->model->thirdPartyInsurance) Third Party Insurance, @endif
                                                                    @if($item->model->proofOfOwnership) Proof Of Ownership, @endif
                                                                    @if($item->model->vehicleInspectionPickanddrop) Vehicle Inspection Pickanddrop, @endif
                                                                    @if($item->model->hackneyPermit) Hackney Permit, @endif
                                                                    @if($item->model->policeCMRIS) Police CMRIS, @endif
                                                                </td>
                                                            @elseif($item->model->process_type == 'Dealer`s Plate Number')
                                                                <td>{{ $item->model->process_type }}, {{ $item->model->fullname }}</td>
                                                            @elseif($item->model->process_type == 'Other Permit')
                                                                <td>{{ $item->model->permitInfo->name }}</td> 
                                                            @elseif($item->model->process_type == 'policeCMRIS')
                                                                <td>{{ $item->model->permittype }}</td>
                                                            @endif

                                                            <td>₦{{ number_format($item->subtotal) }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>
                                                                <div class="icon-base">
                                                                    <button class="delete-item" data-item-id="{{$item->rowId}}">
                                                                        <i class=" fadeIn animated bx bx-trash" style="font-size:24px"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="6"><span class="text-danger">No Item in cart</span></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <script type="text/javascript">
                                            jQuery(document).ready(function ($) {
                                                $('.delete-item').on('click', function() { 
                                                    $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        }
                                                    });
                                        
                                                    var itemId = $(this).data('item-id');
                                                    if(confirm("Do you really want to delete?")) {
                                                        $.ajax({
                                                            type:'POST',
                                                            url:"{{ route('cart.delete') }}",
                                                            data:{
                                                                itemId: itemId,
                                                            },
                                                            success:function(data){
                                                                // Display a success toast, with a title
                                                                toastr.success('Delete Item', 'Item Deleted SUccessfully');
                                        
                                                                var result = data.message;
                                                                $('#successMessage').show();
                                                                location.reload();
                                                                setTimeout(function() {
                                                                    $('#successMessage').hide();
                                                                }, 100); //
                                                                },
                                                            error: function(xhr, status, error) {
                                                                toastr.error(xhr.responseText, 'Error');

                                                            }
                                                        });
                                                    };
                                                });
                                                    
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Cart::count() > 0)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6"></div>
                                    <div class="col-12 col-sm-6">
                                        <div class="total-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr class="sa-subtotal">
                                                        <td><b>Subtotal</b></td>
                                                        <td>₦{{ Cart::subtotal() }}</td>
                                                    </tr>
                                                    <tr class="sa-subtotal">
                                                        <td><b>VAT</b></td>
                                                        <td>₦{{ Cart::tax() }}</td>
                                                    </tr>
                                                    <tr class="sa-total">
                                                        <td><b>Total</b></td>
                                                        <td><b>₦{{ Cart::total() }}</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div><small style="font-size:12px;">NOTE: Free doorstep delivery on order above N20,000 only.</small></div>
                                            <br/>
                                            <a href="{{ route('home.checkout') }}" class="btn btn-primary btn-block">Proceed to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
