@extends('admin.layouts.app') 
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
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Master Admin
                        </h2>
                    </div>                   
               </div>
            </div> 
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                  NGN {{ number_format($totalAmount,2, '.', ',') }}
                                                </div>
                                                <div class="text-muted">
                                                   Total Withdraw
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Withdraw History</h3>
                                
                            </div>

                          
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">S/N
                                                <i class="fa fa-arrow-up"></i>
                                            </th>
                                            <th>Email Address</th>
                                            <th>Amount(NGN)</th>
                                            <th>Account Number</th>
                                            <th>Bank Name</th>
                                            <th>Account Name</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>{{$serial ++}}</td>
                                                <td>{{$item->user_email}}</td>
                                                <td>₦{{ number_format($item->amount,2, '.', ',') }}</td>
                                                <td>{{$item->account_number}}</td>
                                                <td>{{$item->bank}}</td>
                                                <td>{{$item->account_name}}</td>
                                                
                                                <td>
                                                    @if( $item->status == '0')
                                                        <h4><center><span class="badge badge-secondary pending">Pending</span></center></h4>
                                                        {{-- <div class="order-status pending">Pending</div> --}}
                                                    @endif
                                                    @if( $item->status == '1')
                                                        <h4><center><span class="badge badge-secondary processing">Processing</span></center></h4>
                                                    @endif
                                                    @if( $item->status == '2')
                                                    <h4><center><span class="badge badge-primary delivery">Paid</span></center></h4>
                                                 @endif
                                                </td>

                                                <td>
                                                    @php							
                                                        $date = \Carbon\Carbon::parse($item->created_at);							
                                                    @endphp							
                                                    {{ $date->format('F j, Y H:i:s A') }}							
                                                </td>
                                                <td class="text-end">
                                                    <span class="dropdown">
                                                       <a href="{{route('admin.transactions.editAgentWithdraw', encrypt($item->id))}}" class="btn ">Edit</a> 
                                                         
                                                     </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <p class="text-danger">No data found</p>
                                        @endforelse
                                                                           
                                    </tbody>
                                </table>
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection