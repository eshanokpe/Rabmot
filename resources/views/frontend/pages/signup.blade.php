
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <style> 
     .toast-error {
         background-color: red !important;
     }
 </style>
 
@extends('layouts.app')

@section('content')
    <!-- Sign Up Page -->
    <div class="sign padding-50" style="padding-top: 80px;">
        <div class="container"> 
            <div class="row"> 
                <div class="col-lg-5 offset-lg-1">
                    <div class="sign-register-area" style="background-image: url('{{ asset('assets/img/Car_11.png')}}')">
                        <div class="sign-register-area-inner">
                            <h4 class="title">Existing User</h4>
                            <p style="color:white;">Already Have an Account? Sign In.</p>
                            <div class="main-btn-wrap text-center">
                                <a href="{{ url('processpapers') }}" class="main-btn white uppercase">SIGN IN</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="sign-in-area">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('error'))
                            <div id="error-message" class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            <script>
                                setTimeout(function() {
                                    var errorMessage = document.getElementById('error-message');
                                    if (errorMessage) {
                                        errorMessage.parentNode.removeChild(errorMessage);
                                    }
                                }, 3000);
                            </script>
                        @endif

                        <!-- Form -->
                        <form method="POST" action="{{ route('register') }}" id="signUpForm" onsubmit="return validateForm()">
                            @csrf
                            <label for="fullname">Full Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon flaticon-man-user"></i>
                                    </span>
                                </div>
                                <input id="fullname" placeholder="Enter Your Name" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Email -->
                            <label for="email" class="padding-top-20">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon flaticon-black-back-closed-envelope-shape"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" placeholder="Enter Your Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Phone Number -->
                            <label for="phone" class="padding-top-20">Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon flaticon-phone-call"></i>
                                    </span>
                                </div>
                                <input id="phone" type="text" placeholder="Enter Your Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password -->
                            <label for="password" class="padding-top-20">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon flaticon-lock"></i>
                                    </span>
                                </div>
                                <input id="password" placeholder="Enter Your Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn-show-pass">
                                        <i class="show-hide-icon fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- Confirm Password -->
                            <label for="password_confirmation" class="padding-top-20">Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon flaticon-lock"></i>
                                    </span>
                                </div>
                                <input id="password_confirmation" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn-show-pass">
                                        <i class="show-hide-icon fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- How did you hear about us? -->
                            <label for="know_us" class="padding-top-20">How did you hear about us?</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                </div>
                                <select required name="know_us" id="know_us" class="form-select">
                                    <option disabled selected value="">Select Option</option>
                                    <option value="YouTube">YouTube</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Tiktok">Tiktok</option>
                                    <option value="Linkedin">Linkedin</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="Google">Google</option>
                                    <option value="Physical">Physical</option>
                                    <option value="Friend and Family">Friend and Family</option>
                                    <option value="Social Gathering">Social Gathering</option>
                                    <option value="Flyers">Flyers</option>
                                </select>
                                @error('know_us')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Referral Link -->
                            <label for="referral_code" class="padding-top-20">Referral Link</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-link"></i>
                                    </span>
                                </div>
                                <input id="referral_code" placeholder="Referral link" type="text" class="form-control" name="referral_code" value="{{ old('referral_code', request()->input('ref')) }}">
                            </div>
                            <!-- Agreed to Terms & Conditions -->
                            <div class="form-bottom-area padding-top-30">
                                <div class="remember-me">
                                    <label class="sign-in-area-switch">
                                        <input type="checkbox" name="agreed" id="agreed" required>
                                        <span class="slider round"></span>
                                    </label>
                                    <label> <a href="terms">Agree to <span style="color:red;"> Terms & Conditions</span></a></label>
                                    @error('agreed')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 
                            <!-- Submit Button with reCAPTCHA -->
                            <div class="main-btn-wrap text-center padding-top-20">
                                <button type="submit" class="g-recaptcha main-btn uppercase"
                                        data-sitekey="{{ config('services.recaptcha.siteKey') }}"
                                        data-callback='onSubmit'
                                        data-action='submit'>SIGN UP</button>
                            </div>
                        </form>
                        <!-- JavaScript for reCAPTCHA callback -->
                        <script>
                            function validateForm() {
                                const agreedCheckbox = document.getElementById('agreed');
                                if (!agreedCheckbox.checked) {
                                    alert('Please agree to the Terms & Conditions before submitting.');
                                    return false; // Prevent form submission
                                }
                                return true; // Allow form submission
                            }
                            function onSubmit(token) {
                                if (validateForm()) {
                                    document.getElementById("signUpForm").submit();
                                }
                            }
                        </script>
                        <!--// Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Sign Up Page -->
@endsection
