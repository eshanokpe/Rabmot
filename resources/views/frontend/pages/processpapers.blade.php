@extends('layouts.app')

@section('content')
    <!-- Add these enhanced styles -->
    <style>
        /* Enhanced Sign Up Button Styles */
        .sign-register-area-inner .main-btn.white.uppercase {
            background-color: #142444 !important;
            color: white !important;
            border: 2px solid white !important;
            font-size: 18px !important;
            font-weight: bold !important;
            padding: 15px 40px !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
            display: inline-block !important;
            text-decoration: none !important;
            border-radius: 5px !important;
        }
        
        .sign-register-area-inner .main-btn.white.uppercase:hover {
            background-color: #142444 !important;
            transform: scale(1.05) !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4) !important;
        }
        
        /* Make the left panel more prominent */
        .sign-register-area {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .sign-register-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        
        .sign-register-area-inner {
            position: relative;
            z-index: 2;
        }
        
        .sign-register-area-inner .title {
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .sign-register-area-inner p {
            color: white !important;
            font-size: 16px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        /* Optional: Enhance the form submit button as well */
        .sign-in-area .main-btn.uppercase {
            background-color: #007bff !important;
            color: white !important;
            font-size: 16px !important;
            font-weight: bold !important;
            padding: 12px 30px !important;
            transition: all 0.3s ease !important;
        }
        
        .sign-in-area .main-btn.uppercase:hover {
            background-color: #0056b3 !important;
            transform: scale(1.02) !important;
        }
    </style>

    <!--Sign In Page-->
    <div class="sign padding-60" style="padding-top: 80px;">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    @if ($errors->has('verified'))
                        <div class="alert alert-danger alert-dismissible">
                            {{ $errors->first('verified') }}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    @endif 
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                   
                    @if(Session::has('flash-error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get('flash-error') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1">
                        <div class="sign-register-area" style="background-image: url('{{ asset('/assets/img/Car_22.png')}}')">
                            <div class="sign-register-area-inner">
                                <h4 class="title">New User!</h4>
                                <p style="color:white;">Don't Have an Account? Sign Up Now</p>
                                <div class="main-btn-wrap text-center">
                                    <a href="{{ route('signup') }}" class="main-btn white uppercase">Sign Up</a>
                                </div>
                            </div>
                        </div>
                        <!--// Register Area-->
                    </div>
                    
                    <div class="col-lg-5">
                        <div class="sign-in-area">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            
                            <!--Form-->
                            <form method="POST" action="{{ route('login') }}" id="signInForm">
                                @csrf
                         
                                <!-- Email -->
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icon flaticon-black-back-closed-envelope-shape"></i>
                                        </span>
                                    </div>
                                    <input required id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Enter Your Email">
                        
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--// Email-->
                        
                                <!-- Password -->
                                <label for="password" class="padding-top-30">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icon flaticon-lock"></i>
                                        </span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password" placeholder="Enter Your Password">
                        
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
                                <!--// Password-->
                        
                                <!-- Remember Me and Forgot Password -->
                                <div class="form-bottom-area padding-top-30">
                                    <div class="remember-me">
                                        <label class="sign-in-area-switch">
                                            <input required type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : 'checked' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <label>Remember Me</label>
                                    </div> 
                                    <div class="forgot-password">
                                        @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}"> 
                                            {{ __('Forgot Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                
                                <!--// Remember Me and Forgot Password -->
                        
                                <!-- Submit Button with reCAPTCHA -->
                                <div class="main-btn-wrap text-center padding-top-60">
                                    <!-- Add the g-recaptcha div here if needed -->
                                    <button type="submit" class="g-recaptcha main-btn uppercase"
                                        data-sitekey="{{ config('services.recaptcha.siteKey') }}"
                                        data-callback='onSubmit'  
                                        data-action='submit'>SIGN IN</button>
                                </div>
                            </form>
                            <!--// Form-->
                        </div>
                        
                        <!-- JavaScript for reCAPTCHA callback -->
                        <script>
                            function onSubmit(token) {
                                document.getElementById("signInForm").submit();
                            }
                        </script>

                        <!--// Sign In Area-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Sign In Page-->
     
    @if (session('recaptcha_error'))
    <script>
        $(document).ready(function() {
            toastr.error("{{ session('recaptcha_error') }}");
        });
    </script>
    @endif
@endsection