@extends('admin.layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col-6">
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Staff Accounts
                        </h2>
                    </div>
                    <div class="text-end col-6">
                        <a href="{{ route('admin.staff.create') }}">
                            <button type="submit" class="btn btn-primary">+Add Admin</button>
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
                                <h3 class="card-title">Admin Accounts</h3>
                            </div>
                            <br>
                            @if(session('error'))
                                <div class="alert alert-danger">
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
                                    var successAlert = document.getElementById('success-alert');
                                    if (successAlert) {
                                        setTimeout(function() {
                                            successAlert.style.display = 'none';
                                        }, 10000);
                                    }
                                });
                            </script>
                            <br>

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-1">S/N</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Last Login</th>
                                            <th>Last Login IP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $serial = 1 @endphp
                                        @forelse ($items as $item)
                                        <tr>
                                            <td><span class="text-muted">{{ $serial++}}</span></td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.staff.edit', ['id' => encrypt($item->id)]) }}" class="btn btn-sm">Edit</a>
                                                @if ($item->id !== Auth::guard('admin')->user()->id)
                                                    <form method="POST" action="{{ route('admin.staff.toggleStatus', ['id' => encrypt($item->id)]) }}" class="d-inline" onsubmit="return confirm('{{ $item->status === 'active' ? 'Deactivate' : 'Activate' }} this admin account?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm {{ $item->status === 'active' ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                            {{ $item->status === 'active' ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge text-bg-secondary">You</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                @if ($item->status === 'active')
                                                    <span class="badge text-bg-success">Active</span>
                                                @else
                                                    <span class="badge text-bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->role === 'super_admin')
                                                    <span class="badge text-bg-primary">Super Admin</span>
                                                @elseif ($item->role === 'finance_admin')
                                                    <span class="badge text-bg-success">Finance Admin</span>
                                                @elseif ($item->role === 'operations_admin')
                                                    <span class="badge text-bg-warning">Operations Admin</span>
                                                @elseif ($item->role === 'support_admin')
                                                    <span class="badge text-bg-info">Support Admin</span>
                                                @else
                                                    <span class="badge text-bg-secondary">{{ ucfirst($item->role) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->last_login ? \Carbon\Carbon::parse($item->last_login)->format('F j, Y g:i A') : 'Never' }}</td>
                                            <td>{{ $item->login_ip ?? '—' }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9"><p class="text-danger mb-0">No admin accounts found</p></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
