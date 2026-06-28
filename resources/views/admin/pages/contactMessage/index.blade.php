
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Contact Message</h3>
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
                                            <th>Date</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>SUbject</th>
                                            <th>Message</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($contactMsgs as $contactMsg)
                                            <tr>
                                                <td><span class="text-muted">{{ $serial++ }}</span></td>
                                                <td class="">
                                                    <span class="dropdown">
                                                        <a href="{{ route('admin.contactMessages.show', encrypt($contactMsg->id) ) }}" class="btn align-text-top">View</a>
                                                    </span>
                                                </td>
                                                <td>
                                                    @php							
                                                        $date = \Carbon\Carbon::parse($contactMsg->created_at);							
                                                    @endphp							
                                                    {{ $date->format('F j, Y H:i:s A') }}							
                                                </td>
                                                <td>{{$contactMsg->fullname}}</td>
                                                <td>{{$contactMsg->email }}</td>
                                                <td>{{$contactMsg->phone}} </td>
                                                <td>{{$contactMsg->subject }}</td>
                                                <td>{{$contactMsg->message}} </td>
                                                
                                                
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