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
                           
                        </nav>
                    </div>
                    
                </div>
                <!--end breadcrumb-->
                <div class="user-profile-page">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h5 class="mb-0">Notification Details</h5>
                        </div>
                        
                        <div class="card-body">
                            <p><strong>Title:</strong> {{ $notification->data['title'] ?? 'Notification' }}</p>
                            <p><strong>Message:</strong> {{ $notification->data['message'] ?? 'No details available' }}</p>
                            <p><strong>Date:</strong> {{ $notification->created_at->format('F j, Y, g:i a') }}</p>
                            <p><strong>Status:</strong> 
                                @if($notification->read_at)
                                    <span class="badge bg-success">Read</span>
                                @else
                                    <span class="badge bg-warning">Unread</span>
                                @endif
                            </p>
                            <p><strong>Expiries:</strong></p>
                            <ul>
                                @if(!empty($notification->data['expiries']))
                                    @foreach($notification->data['expiries'] as $field => $date)
                                        @php
                                            // Map the field keys to user-friendly labels
                                            $fieldLabels = [
                                                'vehiclelicenseexpiry' => 'Vehicle License',
                                                'insuranceexpiry' => 'Insurance',
                                                'roadworthinessexpiry' => 'Road Worthiness',
                                                'hackneypermitexpiry' => 'Hackney Permit',
                                                'statecarriagepermitexpiry' => 'State Carriage Permit',
                                                'hackneydutypermitexpiry' => 'Mid-Year Permit',
                                                'localgovernmentpermitexpiry' => 'Local Government Permit',
                                            ];
                
                                            // Use the mapped label if available, otherwise fallback to formatted key
                                            $label = $fieldLabels[$field] ?? ucfirst(str_replace('_', ' ', $field));
                                        @endphp
                                        <li>{{ $label }}: {{ $date }}</li>
                                    @endforeach
                                @else
                                    <li>No expiry details available.</li>
                                @endif
                            </ul>
                            <a href="{{ route('home.notifications.index') }}" class="btn btn-primary">Back to Notifications</a>
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
@endsection