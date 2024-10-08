@extends('admin.layouts.header') 
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
                            Create State and Vehicle type

                        </h2>

                    </div>

                </div>

            </div>

        </div>

        <div class="page-body">
            <div class="container">
                <div class="row row-deck row-cards">
                    <div class="col-2 mt-2 ps-3 ml-3">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add State </h3>
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

                            @if(session('stateerror'))
                                <div class="alert alert-danger" id="error-alert">
                                    {{ session('stateerror') }}
                                </div>
                            @endif
                            @if(session('statesuccess'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('statesuccess') }}
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
                                        }, 15000); 
                                    }
                                });
                            </script>
                            
                            <div class="row">
                                <div class="col-2 mt-2 ps-3 ml-3">
                                </div>
                                <div class="col-8 mt-2 ps-3 ml-3">
                                    <form class="form-fieldset"  method="POST" action="{{ route('admin.state.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">State Name </label>
                                                <input type="text" name="statename" class="form-control" placeholder="State Name" autocomplete="off" required/>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <input type="submit" class="btn btn-primary ms-auto" value="Create State"/>    
                                        </div>
                                    </form>
                                </div>
                                <div class="col-2 mt-2 ps-3 ml-3">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-2 mt-2 ps-3 ml-3">
                    </div>
                    
                </div>
               
                
            </div>
        </div>

    </div>

</div>




@endsection