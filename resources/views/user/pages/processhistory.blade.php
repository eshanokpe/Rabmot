@extends('user.layouts.app') 

@section('content')
<style>
    .order-status {
        padding: 5px;
        border: 1px solid #ccc;
        margin: 5px;
        border-radius: 4px;
        align-items: center;
    }
     
    .pending {
        background-color: yellow  !important;
        color: black  !important;
    }

    .processing {
        background-color: orange  !important;
        color: white  !important;
    }

    .ready {
        background-color: blue !important; 
        color: white  !important;
    }

    .delivery {
        background-color: green  !important;
        color: white  !important;
    }

    .delivered {
        background-color: teal  !important;
        color: white  !important;
    }

</style>

<!-- wrapper -->
<div class="wrapper">
    
    <!--page-wrapper-->
    <div class="page-wrapper">

        <!--page-content-wrapper-->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-md-flex align-historys-center mb-3">
                    <div class="breadcrumb-title pe-3">History</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-history"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                                </li>
                                <li class="breadcrumb-history active" aria-current="page">Process<i class='bx bx-file'></i></li>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
                <!--end breadcrumb-->
                <div class="user-profile-page">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="mb-0">Process History</h4>
                        </div>
                        <div id="successMessage" style="display: none; ">
                            <div class="col-xl-12 mx-auto">
                                <div class="col-sm-12">
                                    <div   class="alert alert-success alert-dismissible fade show" role="alert">
                                        Item deleted successfully!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Process ID</th>
                                        <th>Process Type</th>
                                        <th>Process Description</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($processhistory as $history)
                                        <tr> 
                                            <td> {{ $loop->iteration }} </td>
                                            <td> {{ $history->process_id }} </td>
                                            <td> {{ $history->process_type }}  </td>
                                            <td>
                                                @if( $history->process_type == 'International Driver License')
                                                    Validity: {{ $history->process_NDL_lengthofyear }} Years
                                                @endif
                                                @if( $history->process_type == 'Vehicle Paper Renewal')
                                                        {{ $history->process_type }}
                                                @endif
                                                @if( $history->process_type == 'Vehicle Registration')
                                                    {{ $history->process_VR_name }},
                                                    {{ $history->process_VR_vehicleregistrationType }},<br>
                                                    
                                                    @if( $history->process_VR_numberplate == 'PCN')
                                                        Personalized/Customize Number<br> 
                                                        {{ $history->process_VR_preferrednumber }} 
                                                    @elseif($history->process_VR_numberplate == 'RPN,')
                                                        Random Plate Number<br>
                                                    @endif
                                                @endif
                                                @if( $history->process_type == 'Change of Ownership')
                                                    {{ $history->process_CO_vc }}, <br>
                                                    {{ $history->process_CO_vl }} of Vehicle Expiring Date
                                                @endif
                                                @if( $history->process_type == 'Dealer`s Plate Number')
                                                    {{ $history->process_DPN_processtype }}, <br>
                                                    {{ $history->process_DPN_fullname }} 
                                                @endif
                                                @if( $history->process_type == 'New Driver License')
                                                    Validity: {{ $history->process_NDL_lengthofyear }} 
                                                @endif
                                                @if( $history->process_type == 'Driver License Renewal')
                                                    Validity: {{ $history->process_DLR_lengthofyears }} Years
                                                @endif
                                                @if( $history->process_type == 'International Driver’s License')
                                                    Validity: {{ $history->process_DLR_lengthofyears }} Years
                                                @endif
                                            </td>
                                            <td > ₦{{ number_format($history->totalamount) }}</td>
                                            
                                                @if( $history->status == 0 )
                                                    <td class="badge badge-success pending"> Pending </td>
                                                @elseif ( $history->status == 1 )
                                                    <td  class="badge badge-success processing"> Process </td>
                                                @elseif ( $history->status == 2 )
                                                    <td style="align-items: center"  class=" badge badge-success ready">Ready for Delivery</td>
                                                @elseif ( $history->status == 3 )
                                                    <td  class="badge badge-success delivery">Delivery in progress</td>
                                                @elseif ( $history->status == 4 )
                                                    <td  class="badge badge-success delivered">Delivered</td>
                                                @endif
                                            </td> 
                                            <td>
                                                @php
                                                    $date = \Carbon\Carbon::parse($history->created_at);
                                                @endphp
                                                {{ $date->format('F j, Y H:i:s A') }}
                                            </td>

                                            {{-- <td>
                                                <div class="icon-base">
                                                    <button class="delete-item" data-item-id="{{$history->id}}">
                                                        <i class=" fadeIn animated bx bx-trash" style="font-size:24px"></i>
                                                    </button>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @empty
                                        <p class="text-danger"> No Process History</p>
                                    @endforelse
                                    
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
                                                url:"{{ route('home.deleteprocesshistory') }}",
                                                data:{
                                                    itemId: itemId,
                                                },
                                                success:function(data){
                                                    var result = data.message;
                                                    // $('#successMessage').show();
                                                    location.reload();
                                                    setTimeout(function() {
                                                        $('#successMessage').hide();
                                                    }, 500); //
                                                    },
                                                error: function(xhr, status, error) {
                                                    alert('error');
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
        </div>
        <!--end page-content-wrapper-->
    </div>
    <!--end page-wrapper-->
</div>
@endsection