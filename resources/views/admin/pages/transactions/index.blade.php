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
                                                   NGN {{ number_format($totalAmount,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                    All Transaction
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{ route('admin.withdrawalQueue.index') }}">
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
                                                   NGN {{ number_format($totalAmountwithdraw,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                   Agent Withdrawal
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
                                <a href="{{ route('admin.transaction.paperRenewal') }}">
                                    <div class="card card-sm">
                                        <div class="card-body">                                     
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                            NGN {{ number_format($totalAmountVPR,2,'.',',') }}
                                                    </div>
                                                    <div class="text-muted">
                                                        Vehicle Paper Renewal
                                                    </div>
                                                </div>
                                            </div>                                          
                                        </div>
                                    </div>
                                </a>
                            </div>
                           
                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{ route('admin.transaction.vehicleRegistration')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                   NGN {{ number_format($totalAmountVNR,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                     New Vehicle Registration
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>

                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{ route('admin.transaction.changeOfOwnership')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    NGN {{ number_format($totalAmountCO,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                    Change Of Ownership
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>                          

                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{route('admin.transactions.newDriverLicense') }}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    NGN {{ number_format($totalAmountNDL,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                    New Driver License
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>

                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{ route('admin.transactions.driverLicenseRenewal')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                   NGN {{ number_format($totalAmountDLR,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                    Driver License Renewal
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div> 
                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{ route('admin.transactions.internationalDriverLicense')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                   NGN {{ number_format($totalAmountIDL,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                   Inter. Driver License 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               </a>
                           </div> 

                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{ route('admin.transactions.dealerPlateNumber')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                   NGN {{ number_format($totalAmountDPN,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                    Dealers Plate Number
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div> 
                            <div class="col-6 col-sm-6 col-lg-3">
                                <a href="{{ route('admin.transactions.otherPermit')}}">
                                    <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                   <i class="fa-solid fa-money-bill-transfer"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                   NGN {{ number_format($totalAmountOP,2,'.',',') }}
                                                </div>
                                                <div class="text-muted">
                                                    Other Permit
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
                        <div class="card">
                            <div class="card-body border-bottom">
                                <form method="GET" action="{{ route('admin.transactions') }}" class="row g-3 align-items-end">
                                    <div class="col-sm-6 col-md-4">
                                        <label for="date_from" class="form-label">Start date</label>
                                        <input type="date" name="date_from" id="date_from" class="form-control" value="{{ $dateFrom }}">
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <label for="date_to" class="form-label">End date</label>
                                        <input type="date" name="date_to" id="date_to" class="form-control" value="{{ $dateTo }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                                        <a href="{{ route('admin.transactions') }}" class="btn btn-outline-secondary">Reset</a>
                                    </div>
                                    @if ($errors->has('date_to'))
                                        <div class="col-12">
                                            <div class="text-danger">{{ $errors->first('date_to') }}</div>
                                        </div>
                                    @endif
                                    @if ($errors->has('date_from'))
                                        <div class="col-12">
                                            <div class="text-danger">{{ $errors->first('date_from') }}</div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">Transaction History</h3>
                                @if ($dateFrom || $dateTo)
                                    <div class="card-actions text-muted">
                                        {{ $dateFrom ? \Carbon\Carbon::parse($dateFrom)->format('M j, Y') : 'Beginning' }}
                                        – {{ $dateTo ? \Carbon\Carbon::parse($dateTo)->format('M j, Y') : 'Today' }}
                                    </div>
                                @endif
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
                                                    <a href="{{ route('admin.transactions.show', encrypt($item->id))}}" class="btn ">View</a>                                                         
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
                                            <tr><td colspan="9" class="text-center text-muted py-4">No transactions found for the selected date range.</td></tr>
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