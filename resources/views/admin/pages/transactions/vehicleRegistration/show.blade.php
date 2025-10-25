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
                            Transaction New Vehicle Registration Details
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
                                <h3 class="card-title">Transaction New Vehicle Registration Details</h3>                           
                            </div>
                            @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var successAlert = document.getElementById('error-alert');
                            
                                    if (successAlert) {
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); 
                                    }
                                });
                            </script>

                            <div class="col-12 mt-2 ps-2">
                                <fieldset class="form-fieldset">
                                    <div class="row">
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Full name</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->full_name}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Email</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->email}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Process ID</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->process_id}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Process Type</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->process_type}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Payment Reference</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->paymentReference}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Transaction ID</label>
                                            <input type="text" class="form-control" autocomplete="off" value="{{ $items->trans_id}}" disabled/>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label required">Process ID</label>
                                            <input type="text" class="form-control"  autocomplete="off" value="{{ $items->process_id}}" disabled/>
                                        </div>                   
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Payment Date</label>
                                            @php

                                                $date = \Carbon\Carbon::parse($items->created_at);
 
                                            @endphp
                                            <input type="text" class="form-control" autocomplete="off"  value="{{ $date->format('F j, Y') }}" disabled/>
                                        </div>                     

                                        <div class="mb-3 col-3">
                                            <label class="form-label">Amount</label>
                                            <input type="text" class="form-control" autocomplete="off"  value="₦{{ number_format($items->amount, 2, '.',',') }}" disabled/>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <a href="{{route('admin.transaction.vehicleRegistration')}}" class="btn btn-primary">Back</a>    
                                        </div>
                                    </div>                                   
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection