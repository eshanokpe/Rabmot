@extends('admin.layouts.app') 

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
                    <div class="text-end col-6">
                        <a href="{{route("admin.transactions")}}" class="btn btn-primary">
                            Transaction
                        </a> 
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
                                                   NGN {{ number_format($totalAmountOP,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                    Total Transaction
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
                                <h3 class="card-title">Transaction History</h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">S/N
                                                <i class="fa fa-arrow-up"></i>
                                            </th>
                                            <th>View</th>
                                            <th>Order ID</th>
                                            <th>Email Address</th>
                                            <th>Process Type</th>
                                            <th>Amount(NGN)</th>
                                            <th>Payment Reference</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($items as $item )
                                            <tr>
                                                <td><span class="text-muted">{{$serial++ }}</span></td>
                                                <td class="text-end">
                                                    <span class="dropdown">
                                                    <a href="{{ route('admin.transactions.showOtherPermit', encrypt($item->id))}}" class="btn ">View</a> 
                                                        
                                                    </span>
                                                </td>
                                                <td>{{$item->process_id}}</td>
                                                <td>{{ $item->email}}</td>
                                                <td>{{ $item->process_type}}</td>
                                                <td>₦{{ number_format($item->amount, 2, '.',',') }}</td>
                                                <td>{{ $item->paymentReference}}</td>
                                                {{-- <td>{{ $item->status}}</td> --}}
                                                <td class="text-success">Successful</td>
                                                <td>
                                                    @php
                                                        $date = \Carbon\Carbon::parse($item->created_at);
                                                    @endphp
                                                    {{ $date->format('F j, Y') }}
                                                </td>
                                                
                                            </tr> 
                                        @empty
                                            <p class="text-danger"> No data founds</p>
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