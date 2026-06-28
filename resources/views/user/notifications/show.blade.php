@extends('user.layouts.app') 

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
        background-color: yellow  !important;
        color: black  !important;
    }

    .processing {
        background-color: orange  !important;
        color: white  !important;
    }

    .ready {
        background-color: blue !important; 
        color: white  !important;
    }

    .delivery {
        background-color: green  !important;
        color: white  !important;
    }

    .delivered {
        background-color: teal  !important;
        color: white  !important;
    }

    /* Vehicle expiry specific styling */
    .expiry-alert {
        border-left: 5px solid;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    
    .expiry-urgent {
        border-left-color: #dc3545;
        background-color: #f8d7da;
    }
    
    .expiry-reminder {
        border-left-color: #ffc107;
        background-color: #fff3cd;
    }
    
    .expiry-headsup {
        border-left-color: #0dcaf0;
        background-color: #cff4fc;
    }
    
    .vehicle-details-table th {
        width: 40%;
        background-color: #f8f9fa;
    }
    
    .document-status-badge {
        font-size: 0.85rem;
        padding: 5px 10px;
    }
    
    .status-expired {
        background-color: #dc3545;
        color: white;
    }
    
    .status-urgent {
        background-color: #fd7e14;
        color: white;
    }
    
    .status-warning {
        background-color: #ffc107;
        color: #000;
    }
    
    .status-info {
        background-color: #0dcaf0;
        color: #000;
    }
    
    .status-valid {
        background-color: #198754;
        color: white;
    }
</style>

<!-- wrapper -->
<div class="wrapper">
    
    <!--page-wrapper-->
    <div class="page-wrapper">

        <!--page-content-wrapper-->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-md-flex align-historys-center mb-3">
                    <div class="breadcrumb-title pe-3">Notification</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('home.notifications.index') }}">Notifications</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Notification Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                
                <div class="user-profile-page">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    @if($notification->type === 'vehicle_expiry')
                                        <i class="bx bxs-car me-2"></i>
                                    @else
                                        <i class="bx bxs-bell me-2"></i>
                                    @endif
                                    Notification Details
                                </h5>
                                <div>
                                    @if($notification->type === 'vehicle_expiry')
                                        @if($notification->days_threshold == 1)
                                            <span class="badge bg-danger">🔴 URGENT</span>
                                        @elseif($notification->days_threshold == 7)
                                            <span class="badge bg-warning text-dark">🟠 REMINDER</span>
                                        @elseif($notification->days_threshold == 15)
                                            <span class="badge bg-info">🟡 HEADS UP</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            
                            <hr>
                        
                            <div class="card-body">
                                <!-- Basic Notification Info -->
                                <div class="row mb-4">
                                    <div class="col-md-8">
                                        <p><strong>Title:</strong> {{ $notification->title ?? 'Notification' }}</p>
                                        <p><strong>Date:</strong> {{ $notification->created_at->format('F j, Y, g:i a') }}</p>
                                        <p><strong>Status:</strong> 
                                            @if($notification->read_at)
                                                <span class="badge bg-success">Read ({{ $notification->read_at->diffForHumans() }})</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Unread</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="{{ route('home.notifications.index') }}" class="btn btn-outline-secondary">
                                            <i class="bx bx-arrow-back me-1"></i>Back to Notifications
                                        </a>
                                    </div>
                                </div>

                                <!-- Alert Message Box -->
                                @if($notification->type === 'vehicle_expiry')
                                    @php
                                        $alertClass = '';
                                        if($notification->days_threshold == 1) {
                                            $alertClass = 'expiry-urgent';
                                        } elseif($notification->days_threshold == 7) {
                                            $alertClass = 'expiry-reminder';
                                        } elseif($notification->days_threshold == 15) {
                                            $alertClass = 'expiry-headsup';
                                        }
                                    @endphp
                                    <div class="expiry-alert {{ $alertClass }}">
                                        <h5 class="alert-heading">
                                            <i class="bx bx-info-circle me-2"></i>
                                            {{ $notification->title }}
                                        </h5>
                                        <p class="mb-0">{!! $notification->message ?? 'No details available' !!}</p>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <p class="mb-0"><strong>Message:</strong> {{ $notification->message ?? 'No details available' }}</p>
                                    </div>
                                @endif

                                <!-- Vehicle Expiry Specific Details -->
                                @if($notification->type === 'vehicle_expiry')
                                    @php
                                        $vehicle = $notification->vehicle;
                                        $documentLabels = [
                                            'vehiclelicenseexpiry' => 'Vehicle License',
                                            'roadworthinessexpiry' => 'Road Worthiness',
                                            'insuranceexpiry' => 'Insurance',
                                            'hackneypermitexpiry' => 'Hackney Permit',
                                            'statecarriagepermitexpiry' => 'State Carriage Permit',
                                            'hackneydutypermitexpiry' => 'Mid-Year (Hackney Duty) Permit',
                                            'localgovernmentpermitexpiry' => 'Local Government Permit',
                                        ];
                                    @endphp

                                    @if($vehicle)
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h5 class="mb-3">
                                                    <i class="bx bx-car me-2"></i>Vehicle Information
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered vehicle-details-table">
                                                    <tr>
                                                        <th>Plate Number</th>
                                                        <td><strong>{{ $vehicle->platenumber ?? 'N/A' }}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Make</th>
                                                        <td>{{ $vehicle->vehiclemake ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Model</th>
                                                        <td>{{ $vehicle->vehiclemodel ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Year of Manufacture</th>
                                                        <td>{{ $vehicle->yearofmanufacture ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Type</th>
                                                        <td>{{ $vehicle->vehicletype ?? 'N/A' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-bordered vehicle-details-table">
                                                    <tr>
                                                        <th>Chassis Number</th>
                                                        <td>{{ $vehicle->chassisnumber ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Engine Number</th>
                                                        <td>{{ $vehicle->enginenumber ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fuel Type</th>
                                                        <td>{{ $vehicle->fueltype ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Color</th>
                                                        <td>{{ $vehicle->color ?? 'N/A' }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Current Expiring Document -->
                                        @if($notification->document_field && isset($vehicle->{$notification->document_field}))
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <h5 class="mb-3">
                                                        <i class="bx bx-file me-2"></i>Current Expiring Document
                                                    </h5>
                                                    <div class="card border">
                                                        <div class="card-body">
                                                            @php
                                                                $documentName = $documentLabels[$notification->document_field] ?? $notification->document_field;
                                                                $expiryDate = \Carbon\Carbon::parse($vehicle->{$notification->document_field});
                                                                $daysLeft = now()->startOfDay()->diffInDays($expiryDate, false);
                                                            @endphp
                                                            
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <h6 class="mb-2">{{ $documentName }}</h6>
                                                                    <p class="mb-0">
                                                                        Expiry Date: <strong>{{ $expiryDate->format('d M, Y') }}</strong>
                                                                    </p>
                                                                </div>
                                                                <div>
                                                                    @if($daysLeft < 0)
                                                                        <span class="badge document-status-badge status-expired">Expired</span>
                                                                    @elseif($daysLeft == 0)
                                                                        <span class="badge document-status-badge status-urgent">Expires Today</span>
                                                                    @elseif($daysLeft <= 7)
                                                                        <span class="badge document-status-badge status-urgent">{{ $daysLeft }} days left</span>
                                                                    @elseif($daysLeft <= 15)
                                                                        <span class="badge document-status-badge status-warning">{{ $daysLeft }} days left</span>
                                                                    @else
                                                                        <span class="badge document-status-badge status-valid">{{ $daysLeft }} days left</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- All Document Expiries -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h5 class="mb-3">
                                                    <i class="bx bx-calendar me-2"></i>All Document Expiry Dates
                                                </h5>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Document Type</th>
                                                                <th>Expiry Date</th>
                                                                <th>Days Remaining</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($documentLabels as $field => $label)
                                                                @if(isset($vehicle->$field) && $vehicle->$field)
                                                                    @php
                                                                        $docExpiryDate = \Carbon\Carbon::parse($vehicle->$field);
                                                                        $daysLeft = now()->startOfDay()->diffInDays($docExpiryDate, false);
                                                                        
                                                                        if($daysLeft < 0) {
                                                                            $statusText = 'Expired';
                                                                            $statusClass = 'status-expired';
                                                                            $daysText = 'Expired';
                                                                        } elseif($daysLeft == 0) {
                                                                            $statusText = 'Expires Today';
                                                                            $statusClass = 'status-urgent';
                                                                            $daysText = 'Today';
                                                                        } elseif($daysLeft <= 7) {
                                                                            $statusText = 'Urgent';
                                                                            $statusClass = 'status-urgent';
                                                                            $daysText = $daysLeft . ' days';
                                                                        } elseif($daysLeft <= 15) {
                                                                            $statusText = 'Warning';
                                                                            $statusClass = 'status-warning';
                                                                            $daysText = $daysLeft . ' days';
                                                                        } elseif($daysLeft <= 30) {
                                                                            $statusText = 'Info';
                                                                            $statusClass = 'status-info';
                                                                            $daysText = $daysLeft . ' days';
                                                                        } else {
                                                                            $statusText = 'Valid';
                                                                            $statusClass = 'status-valid';
                                                                            $daysText = $daysLeft . ' days';
                                                                        }
                                                                    @endphp
                                                                    <tr @if($field == $notification->document_field) class="table-active fw-bold" @endif>
                                                                        <td>
                                                                            {{ $label }}
                                                                            @if($field == $notification->document_field)
                                                                                <span class="badge bg-primary ms-2">Current</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $docExpiryDate->format('d M, Y') }}</td>
                                                                        <td>{{ $daysText }}</td>
                                                                        <td>
                                                                            <span class="badge document-status-badge {{ $statusClass }}">
                                                                                {{ $statusText }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="bx bx-error me-2"></i>
                                            Vehicle details not found for this notification.
                                        </div>
                                    @endif

                                @else
                                    <!-- For non-vehicle notifications, try to display data if it exists -->
                                    @if($notification->data)
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <h5 class="mb-3">Additional Details</h5>
                                                <div class="card border">
                                                    <div class="card-body">
                                                        @if(is_array($notification->data))
                                                            <ul class="list-unstyled">
                                                                @foreach($notification->data as $key => $value)
                                                                    @if(!is_array($value))
                                                                        <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p>{{ $notification->data }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <hr>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bx bx-time me-1"></i>
                                    Received {{ $notification->created_at->diffForHumans() }}
                                    @if($notification->read_at)
                                        <span class="ms-3">
                                            <i class="bx bx-check-double me-1"></i>
                                            Read {{ $notification->read_at->diffForHumans() }}
                                        </span>
                                    @endif
                                </small>
                                <div>
                                    @if(!$notification->read_at)
                                        <form action="{{ route('home.notifications.markAsRead', $notification->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="bx bx-check-circle me-1"></i>Mark as Read
                                            </button>
                                        </form>
                                    @endif
                                    <!-- <form action="{{ route('home.notifications.destroy', $notification->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm ms-2">
                                            <i class="bx bx-trash me-1"></i>Delete
                                        </button>
                                    </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page-content-wrapper-->
    </div>
    <!--end page-wrapper-->
</div>
<!-- end wrapper -->
@endsection