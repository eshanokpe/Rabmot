@extends('admin.layouts.app') 

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
        background-color: yellow;
        color: black;
    }

    .processing {
        background-color: orange;
        color: white;
    }

    .ready {
        background-color: green;
        color: white;
    }

    .delivered {
        background-color: blue;
        color: white;
    }

</style>
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
                                                <i class="fa-solid fa-car-side"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countprocesshistory}} Document
                                                </div>
                                                <div class="text-muted">
                                                    All Processess
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{route('admin.delivered')}}">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                            <i class="fa-solid fa-car-side"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-medium">
                                                            {{$countdelivered}} Document
                                                        </div>
                                                        <div class="text-muted">
                                                            Delivered Paper
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                             <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{route('admin.deliveryinprogress')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-car-side"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countdeliveryinprogress}} Document
                                                </div>
                                                <div class="text-muted">
                                                     Delivery in Progress
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{route('admin.readyfordelivery')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-car-side"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countreadyfordelivery}} Document
                                               </div>
                                                <div class="text-muted">
                                                    Ready for Delivery
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                           
                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{route('admin.processedpaper')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-car-side"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countprocessing}} Document
                                                </div>
                                                <div class="text-muted">
                                                    Processing Papers
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{route('admin.pendingpaper')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-car-side"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countpending}} Document
                                                </div>
                                                <div class="text-muted">
                                                    Pending Papers
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div> 
                       </div>
                    </div>

                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countVehiclepaperrenewal}} Document
                                                </div>
                                                <div class="text-muted">
                                                    Vehicle Paper Renewal
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countVehicleRegistration}} Document
                                                </div>
                                                <div class="text-muted">
                                                   New Vehicle Registration
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            </div>
                           
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>

                                           </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countChangeofownership}} Document
                                                </div>
                                                <div class="text-muted">
                                                   Change Of Ownership
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>
                                           </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countNewdriverlicense}} Document
                                               </div>
                                                <div class="text-muted">
                                                    New Driver License
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>

                                           </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$countDriverlicenserenewal}} Document
                                                </div>
                                                <div class="text-muted">
                                                    Driver License Renewal
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                               <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>

                                           </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$counInternationadriverlicense}} Process
                                                </div>
                                                <div class="text-muted">
                                                    Inter. Driver License
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div> 
                            
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                               <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>

                                           </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$counVehiclePlatenumber}} Document
                                                </div>
                                                <div class="text-muted">
                                                    Dealers' Plate Number
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-dark text-white avatar">
                                                <i class="fa-solid fa-file"></i>
                                                </span>

                                           </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{$counOtherpermit}} Process
                                                </div>
                                                <div class="text-muted">
                                                    Other Permit
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

                                <h3 class="card-title">New Processess</h3>

                            </div>

                            

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">S/N
                                                <i class="fa fa-arrow-up"></i>

                                           </th>
                                            <th>Process ID</th>
                                            <th>User Email</th>
                                            <th>Process Type</th>
                                            <th>Amount (NGN)</th>
                                            <th>Status</th>

                                           <th>Date</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($items as $item)
                                            <tr>
                                                <td><span class="text-muted">{{ $serial++ }}</span></td>
                                                <td>{{$item->process_id}}</td>
                                                <td>{{ $item->user_email }}</td>
                                                <td> {{ $item->process_type}} </td>
                                                <td>₦{{ number_format($item->totalamount, 2, '.',',') }} </td>
                                                <td>
                                                    @if( $item->status == '0')
                                                        <h4><center><span class="badge badge-secondary pending">Pending</span></center></h4>
                                                        {{-- <div class="order-status pending">Pending</div> --}}
                                                    @endif
                                                    @if( $item->status == '1')
                                                        <h4><center><span class="badge badge-secondary processing">Processing</span></center></h4>
                                                    @endif
                                                    @if( $item->status == '2')
                                                        <h4><center><span class="badge badge-success delivered">Ready for Delivery</span></center></h4>
                                                    @endif
                                                    @if( $item->status == '3')
                                                        <h4><center><span class="badge badge-primary ready">Delivered</span></center></h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $date = \Carbon\Carbon::parse($item->created_at);
                                                    @endphp
                                                    {{ $date->format('F j, Y') }}
                                                </td>
                                                <td class="text-end">
                                                    <span class="dropdown">
                                                        <a href="{{ route('admin.viewpendingpaper', $item->id) }}" class="btn align-text-top">Actions</a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <p class="text-danger">No Data found</p>
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