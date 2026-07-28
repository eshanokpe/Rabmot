@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Create Admin Account
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-secondary">
                            Back to List
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
                                <h3 class="card-title">Create Admin Account</h3>
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

                            <div class="col-12 mt-2 ps-2">
                                <form class="form-fieldset" method="POST" action="{{ route('admin.staff.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off" required/>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Phone Number</label>
                                            <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Role</label>
                                            <select name="role" class="form-select" required>
                                                <option value="" selected disabled>Choose Role</option>
                                                <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="finance_admin" {{ old('role') == 'finance_admin' ? 'selected' : '' }}>Finance Admin</option>
                                                <option value="operations_admin" {{ old('role') == 'operations_admin' ? 'selected' : '' }}>Operations Admin</option>
                                                <option value="support_admin" {{ old('role') == 'support_admin' ? 'selected' : '' }}>Support Admin</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Password</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" autocomplete="off" required/>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <button type="submit" class="btn btn-primary ms-auto">Create Account</button>
                                        </div>
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
