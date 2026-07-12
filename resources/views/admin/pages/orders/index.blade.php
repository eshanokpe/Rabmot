@extends('admin.layouts.app')

@section('title', 'Order List')
 
@section('content')
<style>
    .order-status {
        padding: 5px;
        border: 1px solid #ccc;
        margin: 5px;
        border-radius: 4px;
        align-items: center;
    }

    .pending {
        background-color: yellow;
        color: black;
    }

    .processing {
        background-color: orange;
        color: white;
    }

    .ready {
        background-color: blue;
        color: white;
    }

    .delivery {
        background-color: green;
        color: white;
    }

    .delivered {
        background-color: teal;
        color: white;
    }
</style>
<div class="page-wrapper">
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Order Management
                </h2>
                <div class="text-muted mt-1">
                    All orders across users and agents
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-fluid">

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Submitted</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Agent Assigned</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Processing</option>
                            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Ready</option>
                            <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Service Type</label>
                        <select name="process_type" class="form-select">
                            <option value="">All Services</option>
                            @foreach($serviceTypes as $type)
                                <option value="{{ $type }}" {{ request('process_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">User Type</label>
                        <select name="user_type" class="form-select">
                            <option value="">All Types</option>
                            <option value="consumer" {{ request('user_type') == 'consumer' ? 'selected' : '' }}>Consumer</option>
                            <option value="agent" {{ request('user_type') == 'agent' ? 'selected' : '' }}>Agent</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Date From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Date To</label>
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Assigned Admin</label>
                        <select name="assigned_admin_id" class="form-select">
                            <option value="">All Admins</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id }}" {{ request('assigned_admin_id') == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fa fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                            <i class="fa fa-refresh me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>S/N ID</th>
                            <th>Order ID</th>
                            <th>Service Type</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>
                                <span class="text-muted">#{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $order->process_id }}</span>
                            </td>
                            <td>
                                {{ $order->process_type }}
                            </td>
                            <td>
                                <div>{{ $order->user->fullname ?? $order->user_email ?? 'N/A' }}</div>
                                <div class="text-muted small">{{ $order->user->email ?? '' }}</div>
                            </td>
                            <td>
                                {{-- ✅ Map integer status to text label and colour --}}
                                @switch($order->status)
                                    @case(0)
                                        <span class="badge bg-secondary">Submitted</span>
                                        @break
                                    @case(1)
                                        <span class="badge bg-info">Agent Assigned</span>
                                        @break
                                    @case(2)
                                        <span class="badge bg-warning">Processing</span>
                                        @break
                                    @case(3)
                                        <span class="badge bg-primary">Ready</span>
                                        @break
                                    @case(4)
                                        <span class="badge bg-success">Delivered</span>
                                        @break
                                    @default
                                        <span class="badge bg-light text-dark">Unknown</span>
                                @endswitch
                            </td>
                            <td>
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">No orders found matching your filters</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center">
                {{ $orders->links() }}
            </div>
        </div>

    </div>
</div>
</div>
@endsection