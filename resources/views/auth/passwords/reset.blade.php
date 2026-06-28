@extends('layouts.app')

@section('content') 

    <!--Sign In Page-->
    <div class="sign padding-60" style="padding-top: 80px;">
        <div class="container-fluid">
            <div class="container">
                <h3 class="title text-center">Reset Password</h3>
                <div class="row">
                   
                    
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
                    <div class="col-lg-3 offset-lg-1"></div>
                    <div class="col-lg-5 ">
                        
                        <div class="sign-in-area">
                            <!--Form-->
                            <form method="POST" action="{{ route('reset.password.post') }}" id="signInForm">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

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
                         
                                    
                         
                                     <div class="input-group-prepend">
                                         <span class="input-group-text btn-show-pass">
                                             <i class="show-hide-icon fa fa-eye"></i>
                                         </span>
                                     </div>
                                     @error('password')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                     @enderror
                                 </div>
                                 <!--// Password-->
                        
                                 <!-- Confirm Password -->
                                 <label for="password" class="padding-top-30">Confirm Password</label>
                                 <div class="input-group">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text">
                                             <i class="icon flaticon-lock"></i>
                                         </span>
                                     </div>
                                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                         name="password_confirmation" required autocomplete="current-password" placeholder="Enter Confirm Password">
                         
                                     
                         
                                     <div class="input-group-prepend">
                                         <span class="input-group-text btn-show-pass">
                                             <i class="show-hide-icon fa fa-eye"></i>
                                         </span>
                                     </div>
                                     @error('password')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                     @enderror
                                 </div>
                                 <!--// Password-->
                        
                                <!-- Submit Button with reCAPTCHA -->
                                <div class="main-btn-wrap text-center padding-top-60">
                                    <!-- Add the g-recaptcha div here if needed -->
                                    <button type="submit" class="g-recaptcha main-btn uppercase"
                                        data-sitekey="{{ config('services.recaptcha.siteKey') }}"
                                        data-callback='onSubmit'  
                                        data-action='submit'> {{ __('Reset Password') }}</button>
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
                    <div class="col-lg-3 offset-lg-2"></div>
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
