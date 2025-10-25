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
                                <h3 class="card-title">Edit Other Permit Price</h3>
                            </div>
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
                            <div class="col-12 mt-2 ps-2">
                                <form action="{{ route("admin.otherPermit.update", $data->id) }}" method="POST">
                                     @csrf 
                                     @method('PUT')
                                    <div class="row">
                                        <div class="col-2">
                                            
                                        </div>
                                        <div class="col-8">
                                            <input type="hidden" name="id" class="form-control" value="{{ $data->id}}"  autocomplete="off"/>
                                            <div class=" mb-3">
                                                <label class="form-label">Permit type</label>
                                                <select class="form-select" name="permitTypeId">
                                                    <option selected disabled>-select permit type-</option>
                                                    @foreach ($permitTypes as $permitType)
                                                    <option value="{{ $permitType->id }}" {{  $data->permit_type_id == $permitType->id ? 'selected' : '' }}>{{ $permitType->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Cost</label>
                                                <input type="number" name="amount" class="form-control"  value="{{ $data->amount}}" autocomplete="off"/>
                                            </div>
                                            
                                            <div class="mb-3">
                                            <label class="form-label">   </label>
                                                <button type="submit" class="btn btn-primary ms-auto">Update Price</button>    
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            
                                        </div>
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