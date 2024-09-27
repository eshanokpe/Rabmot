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
        background-color: blue;
        color: white;
    }

    .delivery {
        background-color: green;
        color: white;
    }

    .delivered {
        background-color: teal;
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
                            Ready for delivered Paper 
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                   

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ready for delivered Document</h3>
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
                                                        <h4><center><span class="badge badge-success ready">Ready for Delivery</span></center></h4>
                                                    @endif
                                                    @if( $item->status == '3')
                                                        <h4><center><span class="badge badge-primary delivery">Delivery in progress</span></center></h4>
                                                    @endif
                                                    @if( $item->status == '4')
                                                        <h4><center><span class="badge badge-primary delivered">Delivered</span></center></h4>
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
                                                        <a href="{{ route('admin.viewdeliveredPaper', encrypt( $item->id) ) }}" class="btn align-text-top">Actions</a>
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