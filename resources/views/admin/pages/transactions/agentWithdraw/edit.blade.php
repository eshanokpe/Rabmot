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
                        <a href="{{route("admin.transactions.agent")}}" class="btn btn-primary">
                            Agent Transaction
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
                                <h3 class="card-title">Edit Withdraw</h3>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success" id="error-message">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger" id="error-message">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="col-12 mt-2 ps-2">
                               
                                    <form class="form-fieldset" action="{{ route('admin.transactions.updateAgentWithdraw', $items->id ) }}" method="POST">
                                        @csrf
                                        @method('PUT')  
                                        <div class="row mb-3">
                                            <div class="mb-3 col-3">
                                                <label class="form-label required">Emall Address</label>
                                                <input type="email" value="{{$items->user_email}}" name="email" disabled class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label class="form-label required">Amount</label>
                                                <input type="text" value="₦{{ number_format($items->amount,2, '.', ',') }}" disabled name="Amount" class="form-control"  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label class="form-label required">Bank Name</label>
                                                <input type="text" value="{{$items->bank}}"  name="bank" class="form-control" disabled  autocomplete="off"/>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label class="form-label">Account Number</label>
                                                <input type="text" name="acct_no" value="{{$items->account_number}}" disabled class="form-control" autocomplete="off"/>
                                            </div>
                                            
                                            <div class="mb-3 col-3">
                                                <label class="form-label">Account Name</label>
                                                <input type="text" value="{{$items->account_name}}"  disabled class="form-control" name="acct_name" autocomplete="off"/>
                                            </div>
                                            
                                            <div class="mb-3 col-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" id="select-option" name="status">
                                                    <option value="0" @if ($items->status == 0) disabled selected @endif>Pending</option>
                                                    <option value="1" @if ($items->status == 1) selected @endif>Processing</option>
                                                    <option value="2" @if ($items->status == 2) selected @endif>Paid</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 ">
                                                <button type="submit" class="btn btn-primary ms-auto">Update Account</button>    
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