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
                        <a href="{{route("admin.dealersPlateNumber.index")}}">
                            <button type="submit" class="btn btn-primary">View Dealers Plate Number Price</button>
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
                                <h3 class="card-title">Add Dealers Plate Number Price</h3>
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
                                <form action="{{ route("admin.dealersPlateNumber.store") }}" method="POST" >
                                    @csrf 
                                    <div class="row">
                                            <div class="col-3">
                                                
                                            </div>
                                            <div class="col-8">
                                                <div class="mb-3 col-8">
                                                            <label class="form-label required">State</label>
                                                    <select required name="stateId" class="form-select">
                                                    <option disabled selected>-select-</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}</option>  
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="mb-3 col-8">
                                                    <label class="form-label required">Amount</label>
                                                    <input type="number" name="amount" class="form-control" placeholder="Cost"  autocomplete="off"/>
                                                </div>
                                                
                                                <div class="mb-3 col-4">
                                                    <button type="submit" class="btn btn-primary ms-auto">Add  Price</button>    
                                                </div>
                                            </div>
                                            <div class="col-4"></div>
                                        
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

@endsection