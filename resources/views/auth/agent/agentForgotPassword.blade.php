<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{ asset('/assets/img/fav.png')}}">
        <title>Rabmot Licensing | Agent</title>
        <!-- CSS files -->
        <link href="{{ asset('/assets/dist/css/tabler.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('/assets/dist/css/tabler-flags.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('/assets/dist/css/tabler-payments.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('/assets/dist/css/tabler-vendors.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('/assets/dist/css/demo.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('/assets/dist/fontawesome/css/fontawesome.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('/assets/dist/fontawesome/css/solid.min.css')}}" rel="stylesheet" />
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }
    
            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            } 
        </style>
        <script src="{{ asset('/assets/dist/js/demo-theme.min.js')}}"></script>
    </head>

<body>
    <div class="page">
        <div class="page page-center">

            <div class="container container-tight py-4">
      
      
              <div class="card card-md">
      
              <div class="text-center  mt-4">
      
                  <a href="https://rabmotlicensing.com/">
      
                      <img src="{{ asset('/assets/dist/img/rabmotLogo.png')}}" alt="Rabmot licensing" class="imagefluid w-50">
      
                  </a>
      
              </div>
      
                <div class="card-body">
      
                  <h2 class="h2 text-center mb-4">Agent Forgot Password</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <script>
                        // Wait for the document to be ready
                        document.addEventListener("DOMContentLoaded", function() {
                            // Select the success alert element by its ID
                            var successAlert = document.getElementById('success-alert');
                    
                            // Check if the alert element exists
                            if (successAlert) {
                                // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                setTimeout(function() {
                                    successAlert.style.display = 'none';
                                }, 5000); // 5000 milliseconds = 5 seconds
                            }
                        });
                    </script>
                    <br>
                  

      
                  <form action="{{route('agent.forgotpassword.submit')}}" method="POST" autocomplete="off" >
                    @csrf
                    <div class="mb-5">
                        <label class="form-label">Email address</label>
                        <input required type="email" class="form-control" name="email" placeholder="Email" autocomplete="off">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <div class="form-footer">
      
                      <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
      
                    </div>
      
                  </form>
                  <div class="text-center pt-3">
                     <a href="https://rabmotlicensing.com/agent/login">
                         <small> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M5 12l14 0" />
                              <path d="M5 12l6 -6" />
                              <path d="M5 12l6 6" />
                            </svg>
    
                            Back to Login
                        </small>
                    </a>
                  </div>
                  
      
                </div>
      
                
      
              </div>
      
              
      
            </div>
      
      </div>
        @include('agent.layouts.footerLogin')
    </div>
</body>



