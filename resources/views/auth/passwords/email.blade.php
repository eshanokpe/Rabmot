@extends('layouts.app')

@section('content') 

    <!--Sign In Page-->
    <div class="sign padding-60" style="padding-top: 80px;">
        <div class="container-fluid">
            <div class="container">
                <h3 class="title text-center">Forgot Password</h3>
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
                        <div class="sign-register-area" style="background-image: url('{{ asset('/assets/img/Car_22.png')}}">
                            <div class="sign-register-area-inner">
                                <h4 class="title">Existing User!</h4>
                                <p style="color:white;">Already Have an Account? Sign In.</p>
                                <div class="main-btn-wrap text-center">
                                    <a href="{{ route('processpapers') }}" class="main-btn white uppercase">Sign Up</a>
                                </div>
                            </div>
                        </div>
                        <!--// Register Area-->
                    </div>
                    
                    <div class="col-lg-5 ">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="sign-in-area">
                            <!--Form-->
                            <form method="POST" action="{{ route('password.email') }}" id="signInForm">
                                @csrf
                                <!-- Email -->
                                <br>
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
                        
                                <!-- Remember Me and Forgot Password -->
                                <div class="form-bottom-area padding-top-30">
                                    
                                   
                                </div>
                                
                                <!--// Remember Me and Forgot Password -->
                        
                                <!-- Submit Button with reCAPTCHA -->
                                <div class="main-btn-wrap text-center padding-top-60">
                                    <!-- Add the g-recaptcha div here if needed -->
                                    <button type="submit" class="g-recaptcha main-btn uppercase"
                                        data-sitekey="{{ config('services.recaptcha.siteKey') }}"
                                        data-callback='onSubmit'  
                                        data-action='submit'>Send Password Resent link</button>
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
