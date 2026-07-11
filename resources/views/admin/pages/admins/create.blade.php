@extends('admin.layouts.app') 
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Admin Management
                        </div>
                        <h2 class="page-title">
                            Add New Administrator
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
                                <h3 class="card-title">Create New Admin Account</h3>
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
                                <form class="form-fieldset" action="{{ route('admin.admins.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" autocomplete="off"/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Role</label>
                                            <select name="role" class="form-control" required>
                                                <option value="">-- Select Role --</option>
                                                <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Regular Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Password</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-3"></div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label d-block">&nbsp;</label>
                                            <button type="submit" class="btn btn-primary">Create Admin</button>    
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