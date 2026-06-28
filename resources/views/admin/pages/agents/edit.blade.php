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
                            Edit Agent Account
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
                                <h3 class="card-title">Edit  Agent Account 
                                    @if ($items->status == 'active')
                                        <span class="badge text-bg-success">Active</span>
                                    @elseif ($items->status == 'disable')
                                        <span class="badge text-bg-secondary">Disable</span>
                                    @elseif ($items->status == 'delete')
                                        <span class="badge text-bg-danger">Delete</span>
                                    @else
                                        <span class="badge text-bg-warning">Status Not Set</span>
                                    @endif
                                </h3>
                            </div>
                            @if(session('error'))
                               <div class="alert alert-danger" id="error-alert">
                                   {{ session('error') }}
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
                           @if(session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var successAlert = document.getElementById('success-alert');
                            
                                    if (successAlert) {
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 5000); 
                                    }
                                });
                            </script>
        
                            <div class="col-12 mt-2 ps-2">
                                
                                <form class="form-fieldset"  method="POST" action="{{ route('admin.agent.update',['id' => $items->id]) }}" id="statusForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-2 col-6">
                                            <label class="form-label required">Username</label>
                                            <input type="text" name="username" class="form-control" autocomplete="off" required value="{{$items->username}}"/>
                                        </div>
                                        <div class="mb-2 col-6">
                                            <label class="form-label required">Emall Address</label>
                                            <input type="email" name="email" class="form-control"  autocomplete="off"value="{{$items->email}}"  required/>
                                        </div>

                                        <div class="mb-2 col-6">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" name="fullname" class="form-control"  autocomplete="off" value="{{$items->fullname}}" required/>
                                        </div>

                                        <div class="mb-2 col-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" name="phone_no" class="form-control" autocomplete="off" required value="{{$items->phone_no}}"/>
                                        </div>

                                        <div class="mb-2 col-6">
                                            <label class="form-label">Location</label>
                                            <input type="text" class="form-control" name="location" autocomplete="off" required value="{{$items->location}}"/>
                                        </div>

                                        <div class="mb-2 col-6">
                                            <label class="form-label">Gender</label>
                                            <select  class="form-select" id="select-option" name="gender">
                                                <option value="male" @if ($items->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if ($items->gender == 'female') selected @endif>Female</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">Status</label>
                                            <select  class="form-select" name="status" id="status-select">
                                                <option value="active" @if ($items->status == 'active') selected @endif>Active</option>
                                                <option value="disable" @if ($items->status == 'disable') selected @endif>Disable</option>
                                                <option value="delete" @if ($items->status == 'delete') selected @endif>Delete</option>
                                            </select>
                                        </div> 
                                       
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <button type="submit" class="btn btn-primary ms-auto">Update Account</button> 
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    document.getElementById('status-select').addEventListener('change', function() {
                                        if (this.value === 'delete') {
                                            if (!confirm('Are you sure you want to delete this user?')) {
                                                this.value = '{{ $items->status }}';
                                            }
                                        }
                                    });
                                
                                    document.getElementById('statusForm').addEventListener('submit', function(event) {
                                        const status = document.getElementById('status-select').value;
                                        if (status === 'delete' && !confirm('Are you sure you want to delete this user?')) {
                                            event.preventDefault(); 
                                        }
                                    });
                                </script>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection