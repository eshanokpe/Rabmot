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
                        Manage Admins
                    </h2>
                </div>
                <div class="text-end col-6">
                    <a href="{{ route('admin.admins.create') }}">
                        <button type="button" class="btn btn-primary">+ Add New Admin</button>
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
                            <h3 class="card-title">List of Administrators</h3>
                        </div>
                        
                        <br/>
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

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable two-sided-header">
                                <thead>
                                    <tr>
                                        <th class="w-1">S/N <i class="fa fa-arrow-up"></i></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Last Login</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $serial = 1 @endphp
                                    @forelse ($admins as $admin)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++ }}</span></td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone ?? 'N/A' }}</td>
                                            <td>
                                                @if($admin->role === 'super_admin')
                                                    <span class="badge bg-danger">Super Admin</span>
                                                @else
                                                    <span class="badge bg-primary">Regular Admin</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $admin->last_login ? \Carbon\Carbon::parse($admin->last_login)->format('F j, Y H:i A') : 'Never' }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($admin->created_at)->format('F j, Y H:i A') }}
                                            </td>
                                            <td>
                                                <span class="dropdown">
                                                    <a href="{{ route('admin.admins.edit', encrypt($admin->id)) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                                    <form action="{{ route('admin.admins.destroy', encrypt($admin->id)) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-danger">No Administrators found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection