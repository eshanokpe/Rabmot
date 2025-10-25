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
      
                  <h2 class="h2 text-center mb-4">Agent Reset Password</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger" id="error-alert">
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
                            var errorAlert = document.getElementById('error-alert');
                    
                            // Check if the alert element exists
                            if (errorAlert) {
                                // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                setTimeout(function() {
                                    errorAlert.style.display = 'none';
                                }, 10000); // 10000 milliseconds = 5 seconds
                            }
                        });
                    </script>
                    <script>
                        // Wait for the document to be ready
                        document.addEventListener("DOMContentLoaded", function() {
                            // Select the success alert element by its ID
                            var successAlert = document.getElementById('success-alert');
                    
                            // Check if the alert element exists
                            if (successAlert) {
                                // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
                                setTimeout(function() {
                                    // Redirect to the desired link
                                    successAlert.style.display = 'none';
                                    window.location.href = "https://rabmotlicensing.com/agent/login";
                                }, 10000); // 10000 milliseconds = 10 seconds
                                
                            }
                        });
                    </script>
                    <br>
                  

      
                  <form action="{{ route('agent.password.update') }}" method="POST" autocomplete="off" novalidate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                     <div class="mb-2">
                      <label class="form-label">
                        New Password
                      </label>
                      <div class="input-group input-group-flat">
                        <input required type="password" class="form-control" name="password" id="passwordInput"  placeholder="New password"  autocomplete="off">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" onclick="togglePasswordVisibility()" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
      
                          </a>      
                        </span>
                        <script>
                            function togglePasswordVisibility() {
                                var passwordInput = document.getElementById("passwordInput");
                                if (passwordInput.type === "password") {
                                    passwordInput.type = "text";
                                } else {
                                    passwordInput.type = "password";
                                }
                            }
                        </script>
                      </div> 
                    </div> 
                     <div class="mb-2">
                      <label class="form-label">
                       Confirm Password
                      </label>
                      <div class="input-group input-group-flat">
                        <input required type="password" class="form-control" name="password_confirmation" id="passwordInput2"  placeholder="Confirm password"  autocomplete="off">
                        <span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" onclick="togglePasswordVisibility2()" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
      
                          </a>      
                        </span>
                        <script>
                            function togglePasswordVisibility2() {
                                var passwordInput2 = document.getElementById("passwordInput2");
                                if (passwordInput2.type === "password") {
                                    passwordInput2.type = "text";
                                } else {
                                    passwordInput2.type = "password";
                                }
                            }
                        </script>
                      </div> 
                    </div> 
                    
                     
                    
      
                    <div class="form-footer">
      
                      <button type="submit" class="btn btn-primary w-100">Reset Password</button>
      
                    </div>
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
      
                  </form>
      
                </div>
      
                
      
              </div>
      
              
      
            </div>
      
      </div>
        @include('agent.layouts.footerLogin')
    </div>
</body>



