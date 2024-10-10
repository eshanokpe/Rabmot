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
                                <h3 class="card-title">Edit Userc Account 
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
                            <div class="col-12 mt-2 ps-2">
                                <form method="POST" action="{{ route('admin.users.updateStatus', $items->id) }}" class="form-fieldset" id="statusForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" value="{{ $items->fullname }}" name="fullname" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" value="{{ $items->email }}" name="email" class="form-control" autocomplete="off"/>
                                        </div> 
                                        
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" value="{{ $items->phone }}" name="phone_no" class="form-control" autocomplete="off"/>
                                        </div>
                                        
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Address</label>
                                            <input type="text" value="{{ $items->address }}" class="form-control" name="address" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="male" {{ $items->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ $items->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ $items->gender == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" id="status-select">
                                                <option value="active" {{ $items->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="disable" {{ $items->status == 'disable' ? 'selected' : '' }}>Disable</option>
                                                <option value="delete" {{ $items->status == 'delete' ? 'selected' : '' }}>Delete</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label class="form-label">.</label>
                                            <button type="submit" class="btn btn-primary ms-auto">Update Account</button>    
                                        </div>
                                    </div>
                                </form>
                                
                                <script>
                                    document.getElementById('status-select').addEventListener('change', function() {
                                        if (this.value === 'delete') {
                                            if (!confirm('Are you sure you want to delete this user?')) {
                                                // If the user clicks "Cancel", reset the dropdown to its previous value.
                                                this.value = '{{ $items->status }}';
                                            }
                                        }
                                    });
                                
                                    document.getElementById('statusForm').addEventListener('submit', function(event) {
                                        const status = document.getElementById('status-select').value;
                                        if (status === 'delete' && !confirm('Are you sure you want to delete this user?')) {
                                            event.preventDefault(); // Prevent form submission if the user clicks "Cancel".
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