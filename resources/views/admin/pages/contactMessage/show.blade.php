
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
                            View Contact Message
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card p-3">
                            <div class="card-header">
                                <h3 class="card-title">Contact Message</h3>
                            </div>
                           <br/>
                           {{-- <form class="form-fieldset" method="POST" action="{{ route('admin.updateUserStatus', ['id' => $items->id]) }}"> --}}
                            <form class="form-fieldset" method="POST" action="#">

                                    @csrf

                                    <div class="row">
                                        <div class="mb-3 col-12 col-sm-3">

                                            <label class="form-label required">Fullname</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->fullname}}" disabled/>

                                        </div>
                                        <div class="mb-3 col-12 col-sm-3">

                                            <label class="form-label required">User Email</label>

                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->email}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-12 col-sm-3">

                                            <label class="form-label required">Phone Number</label>

                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->phone}}" disabled/>

                                        </div>

                                        <div class="mb-3 col-12 col-sm-3">

                                            <label class="form-label"> Date Created</label>
                                            @php
                                                $date = \Carbon\Carbon::parse($items->create_at);
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>

                                        </div>
                                        
                                        <div class="mb-3 col-12 col-sm-3">

                                            <label class="form-label required">Subject</label>

                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->subject}}" disabled/>

                                        </div>
                                        <div class="mb-3 col-12 col-sm-9">

                                            <label class="form-label required">Message</label>
                                            <textarea class="form-control" id="message" name="message" rows="5" disabled>{{ $items->message }}</textarea>

                                            
                                        </div>
                                        
                                         

                                    </div>
                                    
                                </form>

                            <div class="col-12 mt-2 ps-2">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <a href="{{route('admin.contactMessages.index')}}" class="btn btn-primary ms-auto"> Back </a>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection