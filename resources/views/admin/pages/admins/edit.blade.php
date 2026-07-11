@extends('admin.layouts.app') 
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Admin Management
                        </div>
                        <h2 class="page-title">
                            Edit Administrator
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">
                            Back to Admins List
                        </a> 
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
                                <h3 class="card-title">Update Admin Details</h3>
                            </div>

                            @if (session('success'))
                            <div class="col-sm-12 mt-3">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif

                            @if (session('error'))
                                <div class="col-sm-12 mt-3">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="col-sm-12 mt-3">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12 mt-4 ps-2">
                                <form class="form-fieldset" action="{{ route('admin.admins.update', encrypt($admin->id)) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Role</label>
                                            <select name="role" class="form-control" required>
                                                <option value="super_admin" {{ old('role', $admin->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Regular Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">New Password (leave blank to keep current)</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label d-block">&nbsp;</label>
                                            <button type="submit" class="btn btn-primary">Update Admin</button>    
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
@endsection