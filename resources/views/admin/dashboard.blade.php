@extends('admin.layouts.app') 

@section('content')
<style>
    .order-status {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
        text-align: center;
    }
    .pending { background-color: #fef3c7; color: #92400e; }
    .processing { background-color: #fed7aa; color: #92400e; }
    .ready { background-color: #bbf7d0; color: #166534; }
    .delivered { background-color: #bfdbfe; color: #1e40af; }
    .delta-positive { color: #16a34a; font-weight: 500; }
    .delta-negative { color: #dc2626; font-weight: 500; }
    .delta-neutral { color: #6b7280; }
    .high-pending { border-left: 4px solid #dc2626; }
</style>

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Overview</div>
                    <h2 class="page-title">Master Admin Dashboard</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <!-- ✅ NEW TOP STATS BAR -->
            <div class="row row-cards mb-4">
                <!-- Total Orders Today -->
                <div class="col-6 col-sm-6 col-lg-2">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <i class="fa-solid fa-calendar-day"></i>
                                    </span>
                                </div> -->
                                <div class="col">
                                    <div class="font-weight-medium fs-4">{{ $ordersToday }}</div>
                                    <div class="text-muted">Orders Today</div>
                                    <small class="{{ $ordersTodayDelta >= 0 ? 'delta-positive' : 'delta-negative' }}">
                                        {{ $ordersTodayDelta >= 0 ? '+' : '' }}{{ $ordersTodayDelta }}% vs yesterday
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Orders This Month -->
                <div class="col-6 col-sm-6 col-lg-2">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="font-weight-medium fs-4">{{ $ordersThisMonth }}</div>
                                    <div class="text-muted">Orders This Month</div>
                                    <small class="{{ $ordersMonthDelta >= 0 ? 'delta-positive' : 'delta-negative' }}">
                                        {{ $ordersMonthDelta >= 0 ? '+' : '' }}{{ $ordersMonthDelta }}% vs last month
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue This Month -->
                <div class="col-6 col-sm-6 col-lg-2">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="font-weight-medium fs-4">₦{{ number_format($revenueThisMonth, 2) }}</div>
                                    <div class="text-muted">Revenue This Month</div>
                                    <small class="{{ $revenueDelta >= 0 ? 'delta-positive' : 'delta-negative' }}">
                                        {{ $revenueDelta >= 0 ? '+' : '' }}{{ $revenueDelta }}% vs last month
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="col-6 col-sm-6 col-lg-2">
                    <div class="card card-sm {{ $countpending > 20 ? 'high-pending' : '' }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="font-weight-medium fs-4">{{ $countpending }}</div>
                                    <div class="text-muted">Pending Orders</div>
                                    <small class="text-muted">Awaiting processing</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Users -->
                <div class="col-6 col-sm-6 col-lg-2">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="font-weight-medium fs-4">{{ $activeUsersTotal }}</div>
                                    <div class="text-muted">Active Users</div>
                                    <small class="text-muted">Consumers + Agents</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Expiring -->
                <div class="col-6 col-sm-6 col-lg-2">
                    <div class="card card-sm {{ $expiringDocs > 10 ? 'high-pending' : '' }}">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="font-weight-medium fs-4">{{ $expiringDocs }}</div>
                                    <div class="text-muted">Expiring This Month</div>
                                    <small class="text-muted">Within 30 days</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ✅ Existing Process Status Cards -->
            <div class="row row-cards mb-4">
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar">
                                        <i class="fa-solid fa-car-side"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$countprocesshistory}} Document</div>
                                    <div class="text-muted">All Processes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <a href="{{route('admin.delivered')}}">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <i class="fa-solid fa-check-circle"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{$countdelivered}} Document</div>
                                        <div class="text-muted">Delivered</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <a href="{{route('admin.deliveryinprogress')}}">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar">
                                            <i class="fa-solid fa-truck"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{$countdeliveryinprogress}} Document</div>
                                        <div class="text-muted">In Delivery</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <a href="{{route('admin.readyfordelivery')}}">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-info text-white avatar">
                                            <i class="fa-solid fa-box"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">{{$countreadyfordelivery}} Document</div>
                                        <div class="text-muted">Ready for Delivery</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ✅ Order Queue Table -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Queue (Oldest First)</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">S/N</th>
                                    <th>Order Ref</th>
                                    <th>User/Agent</th>
                                    <th>Service Type</th>
                                    <th>Vehicle</th>
                                    <th>Date Placed</th>
                                    <th>Status</th>
                                    <th>Assign To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $serial = 1 @endphp
                                @forelse ($items as $item)
                                    <tr>
                                        <td><span class="text-muted">{{ $serial++ }}</span></td>
                                        <td><code>{{ $item->process_number }}</code></td>
                                        <td>{{ $item->user_email }}</td>
                                        <td>{{ $item->process_type }}</td>
                                        <td>{{ $item->location ?? 'N/A' }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <span class="order-status pending">Pending</span>
                                            @elseif($item->status == 1)
                                                <span class="order-status processing">Processing</span>
                                            @elseif($item->status == 2)
                                                <span class="order-status ready">Ready</span>
                                            @elseif($item->status == 3)
                                                <span class="order-status delivered">Delivered</span>
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm" onchange="assignAdmin(this.value, '{{ $item->id }}')">
                                                <option value="">-- Select Admin --</option>
                                                @foreach(\App\Models\Admin::where('role', 'super_admin')->orWhere('role', 'admin')->get() as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.viewpendingpaper', encrypt($item->id)) }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No pending orders found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ✅ Existing Service Count Cards -->
            <div class="row row-cards mt-4">
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$countVehiclepaperrenewal}} Document</div>
                                    <div class="text-muted">Vehicle Paper Renewal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$countVehicleRegistration}} Document</div>
                                    <div class="text-muted">New Vehicle Registration</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$countChangeofownership}} Document</div>
                                    <div class="text-muted">Change Of Ownership</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$countNewdriverlicense}} Document</div>
                                    <div class="text-muted">New Driver License</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$countDriverlicenserenewal}} Document</div>
                                    <div class="text-muted">Driver License Renewal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$counInternationadriverlicense}} Process</div>
                                    <div class="text-muted">Inter. Driver License</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$counVehiclePlatenumber}} Document</div>
                                    <div class="text-muted">Dealers' Plate Number</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-dark text-white avatar"><i class="fa-solid fa-file"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{$counOtherpermit}} Process</div>
                                    <div class="text-muted">Other Permit</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function assignAdmin(adminId, processId) {
    if (!adminId) return;
    if (confirm('Assign this order to selected admin?')) {
        fetch(`/admin/assign-process/${processId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ admin_id: adminId })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) alert('Assigned successfully!');
            else alert('Failed to assign.');
        })
        .catch(err => alert('Error occurred.'));
    }
}
</script>

@endsection