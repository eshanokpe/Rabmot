@extends('user.layouts.app') 

@section('content')

<!-- wrapper -->
<div class="wrapper">
    <!--header-->

    <!--page-wrapper-->
    <div class="page-wrapper">
        <!--page-content-wrapper-->
        <div class="page-content-wrapper">  
            <div class="page-content">
                @include('user.pages.dashboard.index') 

                <div class="card radius-5 overflow-hidden p-2">
                    <div class="card-header pt-10 border-bottom-0">
                        @if($vehicleCount == 0)  
                            <div class="">
                                <div class="col-12 pb-2">
                                    <small class="mb-0 text-muted">
                                        <i class="bx bx-car me-1"></i>Registered Vehicles: {{ $vehicleCount }}
                                    </small>
                                </div>
                                <div class="col-12">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="bx bx-info-circle me-2"></i>
                                        <strong>No vehicles registered yet!</strong> Add your first vehicle to start tracking document expiries.
                                        <a href="{{ route('home.addVehicleRenewal') }}" class="alert-link ms-2">
                                            <i class="bx bx-plus-circle me-1"></i>Add Vehicle Now
                                        </a>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div> 
                        @else
                            <div class="">
                                <div class="d-flex justify-content-between align-items-center pb-3">
                                    <small class="mb-0 text-muted">
                                        <i class="bx bx-car me-1"></i>Registered Vehicles: {{ $vehicleCount }}
                                    </small>
                                    <a href="{{ route('home.addVehicleRenewal') }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-plus-circle me-1"></i>Add New Vehicle
                                    </a>
                                </div>
                                <div class="col-12">
                                    @foreach ($getaddvehicle as $vehicle)
                                        @php
                                            // Calculate overall vehicle status
                                            $hasExpiringSoon = false;
                                            $hasExpired = false;
                                            $documents = [
                                                'vehiclelicenseexpiry' => 'Vehicle License',
                                                'roadworthinessexpiry' => 'Road Worthiness',
                                                'insuranceexpiry' => 'Insurance',
                                                'hackneypermitexpiry' => 'Hackney Permit',
                                                'statecarriagepermitexpiry' => 'State Carriage Permit',
                                                'hackneydutypermitexpiry' => 'Mid-Year Permit',
                                                'localgovernmentpermitexpiry' => 'Local Government Permit',
                                            ];
                                            
                                            $expiryStatuses = [];
                                            foreach($documents as $field => $label) {
                                                if($vehicle->$field) {
                                                    $expiryDate = \Carbon\Carbon::parse($vehicle->$field);
                                                    $daysLeft = now()->startOfDay()->diffInDays($expiryDate, false);
                                                    
                                                    if($daysLeft < 0) {
                                                        $hasExpired = true;
                                                        $expiryStatuses[$field] = ['label' => $label, 'days' => $daysLeft, 'status' => 'expired'];
                                                    } elseif($daysLeft <= 15) {
                                                        $hasExpiringSoon = true;
                                                        $expiryStatuses[$field] = ['label' => $label, 'days' => $daysLeft, 'status' => 'expiring'];
                                                    }
                                                }
                                            }
                                            
                                            // Determine border color based on status
                                            $borderClass = '';
                                            if($hasExpired) {
                                                $borderClass = 'border-danger';
                                            } elseif($hasExpiringSoon) {
                                                $borderClass = 'border-warning';
                                            } else {
                                                $borderClass = 'border-success';
                                            }
                                        @endphp
                                        
                                        <div class="row border radius-2 p-3 mb-3 {{ $borderClass }}" style="border-left-width: 4px !important;">
                                            <!-- Vehicle Icon -->
                                            <div class="col-sm-1 d-flex align-items-center justify-content-center">
                                                <div class="vehicle-icon-wrapper">
                                                    @if($hasExpired)
                                                        <i class="bx bxs-car text-danger" style="font-size:48px"></i>
                                                        <span class="badge bg-danger position-absolute" style="top: 0; right: 0;">!</span>
                                                    @elseif($hasExpiringSoon)
                                                        <i class="bx bxs-car text-warning" style="font-size:48px"></i>
                                                    @else
                                                        <i class="bx bxs-car text-success" style="font-size:48px"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Vehicle Info -->
                                            <div class="col-sm-4">
                                                <h6 class="mb-2">{{ $vehicle->vehiclemake ?? 'N/A' }}</h6>
                                                <div class="vehicle-details">
                                                    <div class="mb-1">
                                                        <i class="bx bx-registered me-1 text-muted"></i>
                                                        <strong>Plate:</strong> {{ $vehicle->platenumber ?? 'N/A' }}
                                                    </div>
                                                    <div class="mb-1">
                                                        <i class="bx bx-category me-1 text-muted"></i>
                                                        <strong>Type:</strong> 
                                                        {{ $vehicle->vehicleTypeInfo->name ?? 'Not specified' }}
                                                    </div>
                                                    @if($vehicle->vehiclemodel)
                                                        <div class="mb-1">
                                                            <i class="bx bx-car me-1 text-muted"></i>
                                                            <strong>Model:</strong> {{ $vehicle->vehiclemodel }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Expiry Information -->
                                            <div class="col-sm-4">
                                                <div class="expiry-summary">
                                                    <h6 class="mb-2">
                                                        <i class="bx bx-calendar me-1"></i>Document Expiries
                                                    </h6>
                                                    <div class="expiry-list" style="max-height: 150px; overflow-y: auto;">
                                                        @foreach($documents as $field => $label)
                                                            @if($vehicle->$field)
                                                                @php
                                                                    $expiryDate = \Carbon\Carbon::parse($vehicle->$field);
                                                                    $daysLeft = now()->startOfDay()->diffInDays($expiryDate, false);
                                                                    
                                                                    if($daysLeft < 0) {
                                                                        $statusClass = 'text-danger';
                                                                        $icon = 'bx-error-circle';
                                                                        $statusText = 'Expired';
                                                                    } elseif($daysLeft == 0) {
                                                                        $statusClass = 'text-danger';
                                                                        $icon = 'bx-error';
                                                                        $statusText = 'Expires today';
                                                                    } elseif($daysLeft <= 7) {
                                                                        $statusClass = 'text-danger';
                                                                        $icon = 'bx-time';
                                                                        $statusText = $daysLeft . ' days';
                                                                    } elseif($daysLeft <= 15) {
                                                                        $statusClass = 'text-warning';
                                                                        $icon = 'bx-time';
                                                                        $statusText = $daysLeft . ' days';
                                                                    } else {
                                                                        $statusClass = 'text-success';
                                                                        $icon = 'bx-check-circle';
                                                                        $statusText = $daysLeft . ' days';
                                                                    }
                                                                @endphp
                                                                
                                                                <div class="d-flex justify-content-between align-items-center mb-1 font-11">
                                                                    <span class="text-muted">{{ $label }}:</span>
                                                                    <span class="{{ $statusClass }}">
                                                                        <i class="bx {{ $icon }} me-1"></i>
                                                                        {{ $statusText }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    
                                                    @if($hasExpired)
                                                        <div class="alert alert-danger py-1 px-2 mt-2 mb-0 font-11">
                                                            <i class="bx bx-error me-1"></i>Some documents have expired!
                                                        </div>
                                                    @elseif($hasExpiringSoon)
                                                        <div class="alert alert-warning py-1 px-2 mt-2 mb-0 font-11">
                                                            <i class="bx bx-time me-1"></i>Documents expiring soon!
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Actions -->
                                            <div class="col-sm-3">
                                                <div class="row">
                                                    <div class="col-6 p-1">
                                                        <a href="{{ route('edit.vehiclePaperRenewal', ['encryptedId' => encrypt($vehicle->id) ]) }}" 
                                                           class="btn btn-sm btn-primary text-center w-100">
                                                            Edit Vehicle
                                                        </a>
                                                    </div>
                                                    <div class="col-6 p-1">
                                                        <a href="{{ route('delete.vehiclePaperRenewal', ['encryptedId' => encrypt($vehicle->id) ]) }}" 
                                                           class="btn btn-sm btn-secondary text-center w-100" 
                                                           onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                            Delete Vehicle
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <!-- Quick Stats Summary -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h6 class="mb-3">
                                                        <i class="bx bx-bar-chart-alt-2 me-1"></i>Summary
                                                    </h6>
                                                    <div class="row text-center">
                                                        <div class="col-md-3 col-6 mb-2">
                                                            <div class="border-end">
                                                                <h3 class="mb-0 text-primary">{{ $vehicleCount }}</h3>
                                                                <small class="text-muted">Total Vehicles</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6 mb-2">
                                                            <div class="border-end">
                                                                <h3 class="mb-0 text-danger">
                                                                    {{ $getaddvehicle->filter(function($v) {
                                                                        foreach(['vehiclelicenseexpiry', 'roadworthinessexpiry', 'insuranceexpiry', 'hackneypermitexpiry', 'statecarriagepermitexpiry', 'hackneydutypermitexpiry', 'localgovernmentpermitexpiry'] as $field) {
                                                                            if($v->$field && \Carbon\Carbon::parse($v->$field)->isPast()) {
                                                                                return true;
                                                                            }
                                                                        }
                                                                        return false;
                                                                    })->count() }}
                                                                </h3>
                                                                <small class="text-muted">With Expired Docs</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6 mb-2">
                                                            <div class="border-end">
                                                                <h3 class="mb-0 text-warning">
                                                                    {{ $getaddvehicle->filter(function($v) {
                                                                        foreach(['vehiclelicenseexpiry', 'roadworthinessexpiry', 'insuranceexpiry', 'hackneypermitexpiry', 'statecarriagepermitexpiry', 'hackneydutypermitexpiry', 'localgovernmentpermitexpiry'] as $field) {
                                                                            if($v->$field) {
                                                                                $days = now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($v->$field), false);
                                                                                if($days >= 0 && $days <= 15) {
                                                                                    return true;
                                                                                }
                                                                            }
                                                                        }
                                                                        return false;
                                                                    })->count() }}
                                                                </h3>
                                                                <small class="text-muted">Expiring Soon</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6 mb-2">
                                                            <div>
                                                                <h3 class="mb-0 text-success">
                                                                    {{ $getaddvehicle->filter(function($v) {
                                                                        $allValid = true;
                                                                        foreach(['vehiclelicenseexpiry', 'roadworthinessexpiry', 'insuranceexpiry', 'hackneypermitexpiry', 'statecarriagepermitexpiry', 'hackneydutypermitexpiry', 'localgovernmentpermitexpiry'] as $field) {
                                                                            if($v->$field && \Carbon\Carbon::parse($v->$field)->isPast()) {
                                                                                $allValid = false;
                                                                            }
                                                                        }
                                                                        return $allValid;
                                                                    })->count() }}
                                                                </h3>
                                                                <small class="text-muted">All Valid</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                    <br>
                </div>
            </div>
            
            <script>
                var textToCopy = document.getElementById("textToCopy");
                if(textToCopy) {
                    textToCopy.addEventListener("click", function() {
                        // Select the text in the input element
                        textToCopy.select();
                        textToCopy.setSelectionRange(0, 99999); // For mobile devices
                    
                        // Copy the text to the clipboard
                        document.execCommand("copy");
                    
                        // Show a "Copied!" message
                        var copiedMessage = document.getElementById("copiedMessage");
                        copiedMessage.style.display = "block";
                    
                        // Hide the message after a short delay
                        setTimeout(function() {
                            copiedMessage.style.display = "none";
                        }, 2000); // 2 seconds (adjust as needed)
                    });
                }
            </script>
        </div>
        <!--end page-content-wrapper-->
    </div>
    <!--end page-wrapper-->

    <!--footer-->
    
    <!--end footer-->
</div>

@endsection

@push('styles')
<style>
    .vehicle-icon-wrapper {
        position: relative;
        display: inline-block;
    }
    
    .border-danger {
        border-color: #dc3545 !important;
    }
    
    .border-warning {
        border-color: #ffc107 !important;
    }
    
    .border-success {
        border-color: #198754 !important;
    }
    
    .font-11 {
        font-size: 11px;
    }
    
    .expiry-list::-webkit-scrollbar {
        width: 4px;
    }
    
    .expiry-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .expiry-list::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    
    .expiry-list::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    
    .vehicle-details {
        font-size: 0.9rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .w-100 {
        width: 100%;
    }
</style>
@endpush