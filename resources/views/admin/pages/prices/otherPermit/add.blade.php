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
                        <a class="btn btn-primary" href="{{route("admin.otherPermit.index")}}">
                            View Other Permit
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
                                <h3 class="card-title">Add Other Permit Price</h3>
                            </div>
                            <div class="col-12 mt-2 ps-2">
                                 @if(session('success')) 
                                    <div class="alert alert-success" id="success-alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger" id="success-alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                       
                                        <form class="form-fieldset" action="{{ route("admin.otherPermit.store") }}" method="POST">
                                            @csrf 
                                            <div class="mb-3 col">
                                                <label class="form-label"> Permit type </label>
                                                <select required name="permitTypeId" class="form-select">
                                                    <option disabled selected>-select-</option>
                                                    @foreach ($permitTypes as $permitType)
                                                        <option value="{{ $permitType->id }}">{{ $permitType->name }}</option>  
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 col">
                                                <label class="form-label required">Amount</label>
                                                <input type="number" name="amount" class="form-control" placeholder="Cost"  autocomplete="off"/>
                                            </div> 
                                            
                                            <div class="mb-3 col">
                                            <label class="form-label">   .</label>
                                                <button type="submit" class="btn btn-primary ms-auto">Add Price</button>    
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="card-title">Add Permit Type</h3>
                                       
                                        
                                         <form class="form-fieldset" action="{{ route("admin.otherPermit.storeType") }}" method="POST">
                                            @csrf 
                                            <div class="mb-3 col">
                                                <label class="form-label required">Permit Type </label>
                                                <input type="text" name="permitType" class="form-control" placeholder="Permit type"  autocomplete="off"/>
                                            </div>
                                            
                                            
                                            <div class="mb-3 col">
                                            <label class="form-label">   .</label>
                                                <button type="submit" class="btn btn-primary ms-auto">Add Permit type</button>    
                                            </div>
                                        </form>
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