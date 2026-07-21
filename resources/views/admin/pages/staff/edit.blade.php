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
                            Edit Admin Account
                            @if ($item->status === 'active')
                                <span class="badge text-bg-success">Active</span>
                            @else
                                <span class="badge text-bg-secondary">Inactive</span>
                            @endif
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
                                <h3 class="card-title">Edit Admin Account</h3>
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
                                <form class="form-fieldset" method="POST" action="{{ route('admin.staff.update', ['id' => encrypt($item->id)]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Full Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $item->email) }}" autocomplete="off" required/>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Phone Number</label>
                                            <input type="tel" name="phone" class="form-control" value="{{ old('phone', $item->phone) }}" autocomplete="off" required/>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label required">Role</label>
                                            <select name="role" class="form-select" required>
                                                <option value="super_admin" {{ old('role', $item->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="finance_admin" {{ old('role', $item->role) == 'finance_admin' ? 'selected' : '' }}>Finance Admin</option>
                                                <option value="operations_admin" {{ old('role', $item->role) == 'operations_admin' ? 'selected' : '' }}>Operations Admin</option>
                                                <option value="support_admin" {{ old('role', $item->role) == 'support_admin' ? 'selected' : '' }}>Support Admin</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off"/>
                                            <small class="form-hint">Leave blank to keep the current password.</small>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" autocomplete="off"/>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <button type="submit" class="btn btn-primary ms-auto">Update Account</button>
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
