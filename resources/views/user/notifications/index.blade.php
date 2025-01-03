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
                            <h4 class="mb-0">Notification History</h4>
                        </div>
                       
                        <hr/>
                        <div class="card-body">
                            @if($notificationsIndex->isEmpty())
                                <p>No notifications available.</p>
                            @else
                                <ul class="list-group">
                                    @foreach($notificationsIndex as $notification)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">{{ $notification->data['title'] ?? 'Notification' }}</h6>
                                                <p class="mb-1">{{ Str::limit($notification->data['message'] ?? 'No details available', 100) }}</p>
                                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <a href="{{ route('home.notifications.show', $notification->id) }}" class="btn btn-sm btn-primary">View</a>
                                        </li>
                                    @endforeach
                                </ul>
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
@endsection