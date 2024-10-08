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
                            Edit State 

                        </h2>

                    </div>
                     <div class="text-end col-6">
                        <a href="{{route('admin.states')}}" class="btn btn-primary">View State
                        </a> 
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
                                <h3 class="card-title">Edit State  </h3>
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
                                        }, 15000); 
                                    }
                                });
                            </script>
                            
                            <div class="row">
                                <div class="col-2 mt-2 ps-3 ml-3">
                                </div>
                                <div class="col-8 mt-2 ps-3 ml-3">
                                    <form class="form-fieldset"  method="POST" action="{{ route('admin.state.update') }}">
                                        @csrf 
                                         <input type="hidden" value="{{ $data->id }}" name="id" class="form-control" autocomplete="off" required/>
                                        <div class="row">
                                            <div class="mb-3 col-12">
                                                <label class="form-label required">State name </label>
                                                <input type="text" value="{{$data->name}}" name="statename" class="form-control" placeholder="Vehicle Name" autocomplete="off" required/>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <input type="submit" class="btn btn-primary ms-auto" value="Update State"/>    
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