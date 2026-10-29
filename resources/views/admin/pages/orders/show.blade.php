@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
    @php
        $statusLabels = [
            'submitted' => 'Submitted',
            'agent_assigned' => 'Agent Assigned',
            'processing' => 'Processing',
            'ready' => 'Ready',
            'delivered' => 'Delivered',
            'pending' => 'Pending',
            '0' => 'Submitted',
            '1' => 'Agent Assigned',
            '2' => 'Processing',
            '3' => 'Ready',
            '4' => 'Delivered',
        ];
        $statusOptions = [
            'submitted' => 'Submitted',
            'agent_assigned' => 'Agent Assigned',
            'processing' => 'Processing',
            'ready' => 'Ready',
            'delivered' => 'Delivered',
        ];
        $processDetails = [
            'process_DLR_lengthofyears' => 'Driver license validity (years)',
            'process_NDL_lengthofyear' => 'New driver license validity (years)',
            'process_CO_vc' => 'Vehicle category',
            'process_CO_vl' => 'Vehicle license',
            'process_VR_name' => 'Vehicle owner name',
            'process_VR_vehicleregistrationType' => 'Registration type',
            'process_VR_numberplate' => 'Number plate',
            'process_VR_preferrednumber' => 'Preferred number plate',
            'process_VPR_vehicleType' => 'Vehicle type',
            'process_VPR_vehicleLicense' => 'Vehicle license',
            'process_DPN_processtype' => 'Plate process type',
            'process_DPN_fullname' => 'Applicant name',
        ];
    @endphp

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Order Management</div>
                        <h2 class="page-title">Order Details</h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back to Orders</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row row-cards">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order {{ $order->process_number ?: $order->process_id ?: '#'.$order->id }}</h3>
                                <div class="card-actions">
                                    <span class="badge bg-primary">{{ $statusLabels[(string) $order->status] ?? ucfirst(str_replace('_', ' ', (string) $order->status)) }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-muted">Service</div>
                                        <div class="mb-3">{{ $order->process_type ?: 'Not specified' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">Order ID</div>
                                        <div class="mb-3">{{ $order->process_id ?: '—' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">Customer</div>
                                        <div class="mb-3">{{ $order->user->fullname ?? 'Not available' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">Email</div>
                                        <div class="mb-3">{{ $order->user->email ?? $order->user_email ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">Customer type</div>
                                        <div class="mb-3">{{ ucfirst($order->userType ?: '—') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">Amount</div>
                                        <div class="mb-3">₦{{ number_format((float) $order->totalamount, 2) }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">Submitted</div>
                                        <div class="mb-3">{{ $order->created_at?->format('M j, Y g:i A') ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">Estimated completion</div>
                                        <div class="mb-3">{{ $order->estimated_completion_date?->format('M j, Y') ?? 'Not set' }}</div>
                                    </div>
                                </div>

                                @if ($order->address || $order->location || $order->delivery_option)
                                    <h4 class="mt-3">Delivery Details</h4>
                                    <dl class="row mb-0">
                                        @if ($order->delivery_option)
                                            <dt class="col-sm-4">Delivery option</dt><dd class="col-sm-8">{{ $order->delivery_option }}</dd>
                                        @endif
                                        @if ($order->location)
                                            <dt class="col-sm-4">Location</dt><dd class="col-sm-8">{{ $order->location }}</dd>
                                        @endif
                                        @if ($order->address || $order->lagos_address)
                                            <dt class="col-sm-4">Address</dt><dd class="col-sm-8">{{ $order->address ?: $order->lagos_address }}</dd>
                                        @endif
                                    </dl>
                                @endif

                                @php
                                    $availableProcessDetails = collect($processDetails)
                                        ->filter(fn ($label, $field) => filled($order->{$field}));
                                @endphp
                                @if ($availableProcessDetails->isNotEmpty())
                                    <h4 class="mt-4">Service Details</h4>
                                    <dl class="row mb-0">
                                        @foreach ($availableProcessDetails as $field => $label)
                                            <dt class="col-sm-5">{{ $label }}</dt>
                                            <dd class="col-sm-7">{{ $order->{$field} }}</dd>
                                        @endforeach
                                    </dl>
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header"><h3 class="card-title">Status History</h3></div>
                            <div class="card-body">
                                @forelse ($order->status_history ?? [] as $entry)
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="fw-semibold">
                                            {{ $statusLabels[(string) ($entry['to'] ?? '')] ?? ucfirst(str_replace('_', ' ', (string) ($entry['to'] ?? 'Status updated'))) }}
                                        </div>
                                        <div class="text-muted small">
                                            {{ $entry['by_admin_name'] ?? 'Administrator' }}
                                            @if (!empty($entry['created_at']))
                                                · {{ \Carbon\Carbon::parse($entry['created_at'])->format('M j, Y g:i A') }}
                                            @endif
                                        </div>
                                        @if (!empty($entry['note']))
                                            <div class="mt-1">{{ $entry['note'] }}</div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">No status updates have been recorded.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Manage Order</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="mb-4">
                                    @csrf
                                    @method('PUT')
                                    <label for="status" class="form-label">Update status</label>
                                    <select name="status" id="status" class="form-select mb-2" required>
                                        @foreach ($statusOptions as $value => $label)
                                            <option value="{{ $value }}" @selected((string) $order->status === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <label for="status-note" class="form-label">Update note</label>
                                    <textarea name="note" id="status-note" class="form-control mb-2" rows="2" maxlength="1000" placeholder="Optional note for the status history"></textarea>
                                    <button type="submit" class="btn btn-primary w-100">Save Status</button>
                                </form>

                                <form method="POST" action="{{ route('admin.orders.set-eta', $order->id) }}" class="mb-4">
                                    @csrf
                                    @method('PUT')
                                    <label for="estimated_completion_date" class="form-label">Estimated completion date</label>
                                    <input type="date" name="estimated_completion_date" id="estimated_completion_date" class="form-control mb-2" value="{{ old('estimated_completion_date', $order->estimated_completion_date?->format('Y-m-d')) }}" required>
                                    <button type="submit" class="btn btn-outline-primary w-100">Save Estimate</button>
                                </form>

                                <form method="POST" action="{{ route('admin.orders.assign', $order->id) }}" class="mb-4">
                                    @csrf
                                    @method('PUT')
                                    <label for="assigned_admin_id" class="form-label">Assigned administrator</label>
                                    <select name="assigned_admin_id" id="assigned_admin_id" class="form-select mb-2" required>
                                        <option value="">Select an administrator</option>
                                        @foreach ($admins as $admin)
                                            <option value="{{ $admin->id }}" @selected($order->assigned_admin_id == $admin->id)>{{ $admin->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary w-100">Assign Order</button>
                                </form>

                                <form method="POST" action="{{ route('admin.orders.add-notes', $order->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <label for="internal_admin_notes" class="form-label">Internal notes</label>
                                    <textarea name="internal_admin_notes" id="internal_admin_notes" class="form-control mb-2" rows="4" required>{{ old('internal_admin_notes', $order->internal_admin_notes) }}</textarea>
                                    <button type="submit" class="btn btn-outline-secondary w-100">Save Internal Notes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
