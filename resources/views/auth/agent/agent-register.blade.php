@extends('layouts.app')

@section('content')
<style>
    .agent-register-page {
        background: #f4f6fb;
        padding: 3rem 0 4rem;
    }
    .agent-register-card {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 1rem 3rem rgba(20, 36, 68, 0.12);
    }
    .agent-register-header {
        background: linear-gradient(135deg, #142444 0%, #1c3563 100%);
        color: #fff;
        padding: 2.5rem 2.5rem 2rem;
        text-align: center;
    }
    .agent-register-header .icon-badge {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(250, 204, 21, 0.15);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: #facc15;
        font-size: 1.5rem;
    }
    .agent-register-header h2 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .agent-register-header p {
        color: rgba(255, 255, 255, 0.75);
        max-width: 520px;
        margin: 0 auto;
    }
    .agent-register-body {
        padding: 2.5rem;
    }
    .agent-register-section-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #142444;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e9edf5;
    }
    .agent-register-body .form-control,
    .agent-register-body .form-select {
        border-radius: 0.5rem;
        border-color: #dde2ec;
        padding: 0.55rem 0.85rem;
    }
    .agent-register-body .form-control:focus,
    .agent-register-body .form-select:focus {
        border-color: #142444;
        box-shadow: 0 0 0 3px rgba(20, 36, 68, 0.1);
    }
    .agent-register-body .form-label {
        font-weight: 500;
        font-size: 0.875rem;
        color: #344054;
    }
    .agent-register-submit {
        background-color: #142444;
        border-color: #142444;
        border-radius: 0.5rem;
        padding: 0.6rem 2.5rem;
        font-weight: 600;
        transition: background-color .15s ease;
    }
    .agent-register-submit:hover {
        background-color: #1c3563;
        border-color: #1c3563;
    }
</style>

<div class="agent-register-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-11">
                <div class="card agent-register-card">

                    <div class="agent-register-header">
                        <div class="icon-badge">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <h2>Agent Registration</h2>
                        <p>Submit your details and documents below. Your application will be reviewed by our team before your account is activated.</p>
                    </div>

                    <div class="agent-register-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('agent.register.submit') }}" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
                            @csrf

                            <div class="agent-register-section-label">Personal Information</div>
                            <div class="row">
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Username</label>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" autocomplete="off">
                                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Full Name</label>
                                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}" autocomplete="off">
                                    @error('fullname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Email address</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="off">
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Phone Number</label>
                                    <input type="tel" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" value="{{ old('phone_no') }}" autocomplete="off">
                                    @error('phone_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" autocomplete="off">
                                    @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Gender</label>
                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                        <option value="" selected disabled>Choose Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="agent-register-section-label mt-2">Referral (Optional)</div>
                            <div class="row">
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label">Referral Code</label>
                                    <input type="text" name="referral_code" class="form-control @error('referral_code') is-invalid @enderror" value="{{ old('referral_code', request()->input('ref')) }}" autocomplete="off">
                                    <small class="form-hint">If another agent referred you, enter their referral code.</small>
                                    @error('referral_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="agent-register-section-label mt-2">Account Security</div>
                            <div class="row">
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off">
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" autocomplete="off">
                                </div>
                            </div>

                            <div class="agent-register-section-label mt-2">Identity Verification</div>
                            <div class="row">
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Means of Identification</label>
                                    <select name="means_of_identification_type" class="form-select @error('means_of_identification_type') is-invalid @enderror">
                                        <option value="" selected disabled>Choose ID Type</option>
                                        <option value="national_id" {{ old('means_of_identification_type') == 'national_id' ? 'selected' : '' }}>National ID</option>
                                        <option value="drivers_license" {{ old('means_of_identification_type') == 'drivers_license' ? 'selected' : '' }}>Driver's License</option>
                                        <option value="voters_card" {{ old('means_of_identification_type') == 'voters_card' ? 'selected' : '' }}>Voter's Card</option>
                                        <option value="international_passport" {{ old('means_of_identification_type') == 'international_passport' ? 'selected' : '' }}>International Passport</option>
                                    </select>
                                    @error('means_of_identification_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Upload ID Document</label>
                                    <input type="file" name="means_of_identification" class="form-control @error('means_of_identification') is-invalid @enderror" accept=".jpg,.jpeg,.png,.pdf">
                                    <small class="form-hint">JPG, PNG or PDF. Max 9MB.</small>
                                    @error('means_of_identification') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3 col-6 col-md-4 col-lg-3">
                                    <label class="form-label required">Upload Passport Photograph</label>
                                    <input type="file" name="passport_photograph" class="form-control @error('passport_photograph') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                                    <small class="form-hint">JPG or PNG. Max 9MB.</small>
                                    @error('passport_photograph') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-footer text-center mt-2">
                                <button type="submit" class="btn btn-primary agent-register-submit">Submit Application</button>
                            </div>

                        </form>

                        <div class="text-center text-muted mt-4">
                            Already have an account? <a href="{{ route('agent.login') }}">Sign in</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
