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

    /* Notification list styling */
    .notification-item {
        transition: background-color 0.3s ease;
    }
    
    .notification-item:hover {
        background-color: #f8f9fa;
    }
    
    .notification-item.unread {
        background-color: #f0f8ff;
        border-left: 4px solid #007bff;
    }
    
    .notification-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 15px;
    }
    
    .notification-icon.vehicle {
        background-color: #fff3cd;
    }
    
    .notification-icon.system {
        background-color: #cfe2ff;
    }
    
    .notification-content {
        flex: 1;
    }
    
    .notification-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .notification-message {
        color: #6c757d;
        margin-bottom: 5px;
    }
    
    .notification-meta {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .badge-vehicle {
        background-color: #ffc107;
        color: #000;
        font-size: 0.7rem;
        padding: 3px 8px;
    }
    
    .filter-tabs {
        margin-bottom: 20px;
    }
    
    .filter-tabs .nav-link {
        color: #495057;
        border: none;
        padding: 10px 20px;
    }
    
    .filter-tabs .nav-link.active {
        background-color: transparent;
        border-bottom: 3px solid #007bff;
        color: #007bff;
        font-weight: 600;
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
                <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Notifications</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Notification History</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                
                <div class="user-profile-page">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="card-title mb-0">
                                    <h4 class="mb-0">
                                        <i class="bx bx-bell me-2"></i>Notification History
                                    </h4>
                                </div>
                                <div>
                                    @if($unreadCount > 0)
                                        <form action="{{ route('home.notifications.read-all') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                                <i class="bx bx-check-double me-1"></i>Mark All as Read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Filter Tabs -->
                            <div class="filter-tabs">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link {{ !request()->has('filter') || request()->filter == 'all' ? 'active' : '' }}" 
                                           href="{{ route('home.notifications.index') }}">
                                            All Notifications
                                            <span class="badge bg-secondary ms-1">{{ $notificationsIndex->total() }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->filter == 'unread' ? 'active' : '' }}" 
                                           href="{{ route('home.notifications.index', ['filter' => 'unread']) }}">
                                            Unread
                                            <span class="badge bg-warning ms-1">{{ $unreadCount }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->filter == 'vehicle' ? 'active' : '' }}" 
                                           href="{{ route('home.notifications.index', ['filter' => 'vehicle']) }}">
                                            Vehicle Expiry
                                        </a>
                                    </li>
                                </ul>
                            </div>
                       
                            <hr class="mt-0"/>
                            
                            <div class="card-body p-0">
                                @if($notificationsIndex->isEmpty())
                                    <div class="text-center py-5">
                                        <i class="bx bx-bell-off fs-1 text-muted mb-3"></i>
                                        <h5 class="text-muted">No notifications available</h5>
                                        <p class="text-muted">You're all caught up! New notifications will appear here.</p>
                                    </div>
                                @else
                                    <div class="list-group list-group-flush">
                                        @foreach($notificationsIndex as $notification)
                                            @php
                                                $isUnread = is_null($notification->read_at);
                                                $isVehicle = $notification->type === 'vehicle_expiry';
                                                
                                                // Determine urgency class for vehicle notifications
                                                $urgencyBadge = '';
                                                if($isVehicle) {
                                                    if($notification->days_threshold == 1) {
                                                        $urgencyBadge = '<span class="badge bg-danger ms-2">URGENT</span>';
                                                    } elseif($notification->days_threshold == 7) {
                                                        $urgencyBadge = '<span class="badge bg-warning text-dark ms-2">REMINDER</span>';
                                                    } elseif($notification->days_threshold == 15) {
                                                        $urgencyBadge = '<span class="badge bg-info ms-2">HEADS UP</span>';
                                                    }
                                                }
                                            @endphp
                                            
                                            <div class="list-group-item notification-item p-3 {{ $isUnread ? 'unread' : '' }}">
                                                <div class="d-flex align-items-start">
                                                    <!-- Icon -->
                                                    <div class="notification-icon {{ $isVehicle ? 'vehicle' : 'system' }}">
                                                        @if($isVehicle)
                                                            <i class="bx bxs-car fs-5 
                                                                @if($notification->days_threshold == 1) text-danger
                                                                @elseif($notification->days_threshold == 7) text-warning
                                                                @elseif($notification->days_threshold == 15) text-info
                                                                @else text-primary
                                                                @endif">
                                                            </i>
                                                        @else
                                                            <i class="bx bxs-bell text-primary fs-5"></i>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Content -->
                                                    <div class="notification-content">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div class="notification-title">
                                                                @if($isVehicle)
                                                                    <span class="badge badge-vehicle me-2">Vehicle</span>
                                                                @endif
                                                                {{ $notification->title ?? 'Notification' }}
                                                                {!! $urgencyBadge !!}
                                                            </div>
                                                            <small class="text-muted ms-2">
                                                                {{ $notification->created_at->diffForHumans() }}
                                                            </small>
                                                        </div>
                                                        
                                                        <div class="notification-message">
                                                            {!! Str::limit(strip_tags($notification->message ?? 'No details available'), 150) !!}
                                                        </div>
                                                        
                                                        <div class="notification-meta">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    @if($isVehicle && $notification->vehicle)
                                                                        <span class="me-3">
                                                                            <i class="bx bx-car me-1"></i>
                                                                            {{ $notification->vehicle->platenumber ?? 'N/A' }}
                                                                        </span>
                                                                        @if($notification->document_field)
                                                                            @php
                                                                                $docLabels = [
                                                                                    'vehiclelicenseexpiry' => 'License',
                                                                                    'roadworthinessexpiry' => 'Road Worthiness',
                                                                                    'insuranceexpiry' => 'Insurance',
                                                                                    'hackneypermitexpiry' => 'Hackney Permit',
                                                                                ];
                                                                                $docShort = $docLabels[$notification->document_field] ?? $notification->document_field;
                                                                            @endphp
                                                                            <span class="me-3">
                                                                                <i class="bx bx-file me-1"></i>
                                                                                {{ $docShort }}
                                                                            </span>
                                                                        @endif
                                                                    @endif
                                                                    
                                                                    @if($isUnread)
                                                                        <span class="badge bg-primary">
                                                                            <i class="bx bx-envelope me-1"></i>New
                                                                        </span>
                                                                    @else
                                                                        <span class="text-success">
                                                                            <i class="bx bx-check-circle me-1"></i>Read
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                
                                                                <a href="{{ route('home.notifications.show', encrypt($notification->id)) }}" 
                                                                   class="btn btn-sm btn-outline-primary">
                                                                    View Details
                                                                    <i class="bx bx-chevron-right ms-1"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $notificationsIndex->appends(request()->query())->links() }}
                                    </div>
                                @endif
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

@push('scripts')
<script>
    // Optional: Add any JavaScript for real-time updates or actions
    $(document).ready(function() {
        // You can add AJAX calls here for marking as read, etc.
    });
</script>
@endpush