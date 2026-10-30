{{-- Client Vehicles table body; returned on its own for in-place tab/search/page changes.
     Expects: $vehicles, $services, $service, $search --}}
@php
    $badges = ['renewal' => 'bg-blue-lt', 'registration' => 'bg-green-lt', 'ownership' => 'bg-purple-lt'];
    $canManage = Auth::guard('admin')->user()->hasPermission('manage-vehicles');
@endphp
<div class="table-responsive">
    <table class="table table-vcenter card-table">
        <thead>
            <tr>
                <th></th>
                <th>Service</th>
                <th>Owner</th>
                <th>Vehicle</th>
                <th>Plate No.</th>
                <th>Chassis No.</th>
                <th>Added By</th>
                <th>Date Added</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $vehicle)
                <tr>
                    <td>
                        <a href="{{ route($services[$vehicle->service]['view_route'], encrypt($vehicle->id)) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </td>
                    <td><span class="badge {{ $badges[$vehicle->service] }}">{{ $services[$vehicle->service]['label'] }}</span></td>
                    <td>
                        {{ $vehicle->owner_name ?: '—' }}
                        <div class="small text-muted">{{ $vehicle->phone ?: 'No phone' }}</div>
                        <div class="small text-muted">{{ $vehicle->email ?: 'No email' }}</div>
                    </td>
                    <td>
                        {{ trim($vehicle->vehiclemake . ' ' . $vehicle->vehiclemodel . ' ' . $vehicle->year) ?: '—' }}
                        <div class="small text-muted">{{ collect([$vehicle->vehiclecolor, $vehicle->category_name])->filter()->implode(' · ') }}</div>
                    </td>
                    <td class="fw-bold text-nowrap">{{ $vehicle->platenumber ?: '—' }}</td>
                    <td class="text-nowrap">{{ $vehicle->chassisnumber ?: '—' }}</td>
                    <td>
                        {{ $vehicle->userType ? ucfirst(strtolower($vehicle->userType)) : '—' }}
                        <div class="small text-muted">{{ $vehicle->user_email }}</div>
                    </td>
                    <td class="text-nowrap">
                        @if($vehicle->created_at)
                            {{ \Carbon\Carbon::parse($vehicle->created_at)->timezone(config('app.display_timezone'))->format('d M Y') }}
                            <div class="small text-muted">{{ \Carbon\Carbon::parse($vehicle->created_at)->timezone(config('app.display_timezone'))->format('g:i A') }}</div>
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        @if($vehicle->service === 'renewal' && $canManage)
                            <a href="{{ route('admin.vehicle.renewals.delete', encrypt($vehicle->id)) }}" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this vehicle renewal?')">Delete</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4 text-muted">
                        {{ $search !== '' ? 'No vehicles match your search.' : 'No vehicles yet.' }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($vehicles->hasPages())
    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">Showing {{ $vehicles->firstItem() }}–{{ $vehicles->lastItem() }} of {{ $vehicles->total() }}</p>
        <div class="ms-auto">{{ $vehicles->links('pagination::bootstrap-5') }}</div>
    </div>
@endif
