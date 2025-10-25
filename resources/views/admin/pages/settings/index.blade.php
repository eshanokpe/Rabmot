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
                </div>
            </div> 
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Settings</h3>
                            </div>
                            <br>
                            <!-- Display Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success " id="success-message">
                                    {{ session('success') }}
                                </div>
                            @endif
                           
                            @if($errors->any())
                                <div class="alert alert-danger" id="error-message">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <script>
                                function displayErrorMessage(message) {
                                    const errorMessage = document.getElementById('success-message');
                                    errorMessage.textContent = message;
                                    errorMessage.style.display = 'block';
                                    
                                    setTimeout(function () {
                                        errorMessage.style.display = 'none';
                                    }, 4000); 
                                }
                            </script>
                            <script>
                                function displayErrorMessage(message) {
                                    const errorMessage = document.getElementById('error-message');
                                    errorMessage.textContent = message;
                                    errorMessage.style.display = 'block';
                                    
                                    setTimeout(function () {
                                        errorMessage.style.display = 'none';
                                    }, 4000); 
                                }
                            </script>

                            <div class="card-body">

                                <form class="form-fieldset"  method="POST" action="{{ route('admin.settings.update')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Old Password</label>
                                            <input type="password" name="oldpassword" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" autocomplete="off" required/>
                                        </div>   
                                        <div class="mb-3 col-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <button type="submit" class="btn btn-primary ms-auto">Change Password</button>    
                                        </div>
                                        <div class="mb-3 col-3"></div>

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