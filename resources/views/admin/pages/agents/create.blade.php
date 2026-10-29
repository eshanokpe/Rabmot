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
                            Create Agent Account
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route("admin.agents") }}" class="btn btn-primary">
                            View Agent
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
                                <h3 class="card-title">Create Agent Account</h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var errorAlert = document.getElementById('error-alert');
                            
                                    if (errorAlert) {
                                        setTimeout(function() {
                                            errorAlert.style.display = 'none';
                                        }, 5000); 
                                    }
                                });
                            </script>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var successAlert = document.getElementById('success-alert');
                            
                                    if (successAlert) {
                                         setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); 
                                    }
                                });
                            </script>
                            

                            <div class="col-12 mt-2 ps-2">
                                <form class="form-fieldset"  method="POST" action="{{ route('admin.agent.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Username</label>
                                            <input type="text" name="username" class="form-control" autocomplete="off" autofocus="off"  required/>
                                        </div>
                                         <div class="mb-3 col-6">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" name="fullname" class="form-control"  autocomplete="off" required/>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Emall Address</label>
                                            <input type="email" name="email" class="form-control"  autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" name="phone_no" class="form-control" autocomplete="off" required/>
                                        </div>
                                         <div class="mb-3 col-6">
                                            <label class="form-label">Location</label>
                                            <input type="text" class="form-control" name="location" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Gender</label>
                                            <select name="gender" class="form-select" id="select-option" required>
                                                <option value="" selected disabled>Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" required/>
                                        </div>
                                        
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="cpassword" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Referred By (Referral Code)</label>
                                            <input type="text" name="referral_code" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="commission_tier_id" class="form-label">Commission Tier</label>
                                            <select name="commission_tier_id" id="commission_tier_id" class="form-select">
                                                <option value="">Automatic (referral-count tier or base rate)</option>
                                                @foreach ($tiers as $tier)
                                                    <option value="{{ $tier->id }}" @selected(old('commission_tier_id') == $tier->id)>
                                                        {{ $tier->name }} — {{ number_format((float) $tier->rate, 2) }}%
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-hint">
                                                @if ($tiers->isEmpty())
                                                    No shared tiers are configured. Create one in <a href="{{ route('admin.commission.index') }}">Commission Management</a>.
                                                @else
                                                    Optional. Assign an existing shared tier now, or manage tiers in <a href="{{ route('admin.commission.index') }}">Commission Management</a>.
                                                @endif
                                            </small>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <input type="submit" class="btn btn-primary ms-auto" value="Create Account"/>
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