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
                        <a href="{{route("admin.promocode.create")}}">
                            <button type="submit" class="btn btn-primary">+Add Promo code</button>
                        </a> 
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
                                <h3 class="card-title">Promo Code</h3>
                            </div>
                            <br>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">S/N
                                                <i class="fa fa-arrow-up"></i>

                                           </th>
                                            <th>Actions</th>
                                            <th>Created Date</th>
                                            <th>Code</th>
                                            <th>Discount Percentage</th>
                                            <th>Start datetime</th>
                                            <th>End datetime<</th>
                                            <th>Usage limit</th>
                                            <th>Times used</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($promoCodes as $promoCode)
                                            <tr>
                                                <td><span class="text-muted">{{ $serial++ }}</span></td>
                                                <td class="">
                                                    <span class="dropdown">
                                                        <a href="{{ route('admin.promocode.edit', encrypt($promoCode->id) ) }}" class="btn align-text-top">Edit</a>
                                                    </span>
                                                </td>
                                                <td>
                                                    @php							
                                                        $date = \Carbon\Carbon::parse($promoCode->created_at);							
                                                    @endphp							
                                                    {{ $date->format('F j, Y') }}							
                                                </td>
                                                <td>{{$promoCode->code}}</td>
                                                <td>{{$promoCode->discount_percentage }}%</td>
                                                <td>
                                                    @php							
                                                        $date = \Carbon\Carbon::parse($promoCode->start_datetime);							
                                                    @endphp							
                                                    {{ $date->format('F j, Y H:i:s A') }}
                                                </td>
                                                <td>
                                                    @php							
                                                        $date = \Carbon\Carbon::parse($promoCode->end_datetime);							
                                                    @endphp							
                                                    {{ $date->format('F j, Y H:i:s A') }}
                                                </td>
                                                <td>{{$promoCode->usage_limit ?? 'Unlimited'}} </td>
                                                <td>{{$promoCode->times_used}} </td>
                                                <td>{{$promoCode->status}} </td>
                                                
                                                
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