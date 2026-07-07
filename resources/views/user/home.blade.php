@extends('user.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 wrapper">
    <div class="page-wrapper">
        <div class="page-content-wrapper">  
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                
                <!-- Welcome Section with CTA -->
                <div class="bg-gradient-to-r from-[#142444] to-[#1a2d5a] rounded-2xl shadow-xl overflow-hidden mb-8">
                    <div class="px-6 py-8 md:px-8 md:py-10">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-white">
                                    Welcome back, {{ Auth::user()->fullname }}! 👋
                                </h1>
                                <p class="text-white/80 text-sm mt-1">
                                    Here's what's happening with your vehicles today
                                </p>
                            </div>
                            <a href="{{ route('home.addVehicleRenewal') }}" 
                               class="inline-flex items-center px-6 py-3 bg-white text-[#142444] font-semibold rounded-xl hover:bg-gray-100 transition duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl whitespace-nowrap">
                                <i class="bx bx-plus-circle mr-2 text-xl"></i>
                                New Request
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <!-- Total Vehicles -->
                    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Total Vehicles</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $vehicleCount }}</h3>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="bx bx-car text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Expired Documents -->
                    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Expired</p>
                                <h3 class="text-2xl font-bold text-red-600">
                                    {{ $getaddvehicle->filter(function($v) {
                                        foreach(['vehiclelicenseexpiry', 'roadworthinessexpiry', 'insuranceexpiry', 'hackneypermitexpiry', 'statecarriagepermitexpiry', 'hackneydutypermitexpiry', 'localgovernmentpermitexpiry'] as $field) {
                                            if($v->$field && \Carbon\Carbon::parse($v->$field)->isPast()) {
                                                return true;
                                            }
                                        }
                                        return false;
                                    })->count() }}
                                </h3>
                            </div>
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="bx bx-error-circle text-red-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Expiring Soon -->
                    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Expiring Soon</p>
                                <h3 class="text-2xl font-bold text-yellow-600">
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
                            </div>
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="bx bx-time text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- All Valid -->
                    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">All Valid</p>
                                <h3 class="text-2xl font-bold text-green-600">
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
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="bx bx-check-shield text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Cards Section -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Our Services</h2>
                                <p class="text-sm text-gray-500">Select a service to get started</p>
                            </div>
                            <span class="text-xs text-gray-400">6 services available</span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                            <!-- Driver's License -->
                            <a href="{{ route('home.newdriverlicense') }}" 
                               class="group bg-gray-50 hover:bg-[#142444] rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-blue-100 group-hover:bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                                    <i class="bx bx-id-card text-blue-600 group-hover:text-white text-2xl transition-all duration-300"></i>
                                </div>
                                <h6 class="text-sm font-semibold text-gray-700 group-hover:text-white transition-colors duration-300">
                                    Driver's License
                                </h6>
                                <p class="text-xs text-gray-400 group-hover:text-white/70 mt-1 hidden md:block">
                                    Get your driver's license processed quickly
                                </p>
                            </a>

                            <!-- Vehicle Registration -->
                            <a href="{{ route('home.newVehicleRegistration') }}" 
                               class="group bg-gray-50 hover:bg-[#142444] rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-green-100 group-hover:bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                                    <i class="bx bx-car text-green-600 group-hover:text-white text-2xl transition-all duration-300"></i>
                                </div>
                                <h6 class="text-sm font-semibold text-gray-700 group-hover:text-white transition-colors duration-300">
                                    Vehicle Registration
                                </h6>
                                <p class="text-xs text-gray-400 group-hover:text-white/70 mt-1 hidden md:block">
                                    Register your vehicle with ease
                                </p>
                            </a>

                            <!-- Change Ownership -->
                            <a href="{{ route('home.changeofOwnership') }}" 
                               class="group bg-gray-50 hover:bg-[#142444] rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-purple-100 group-hover:bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                                    <i class="bx bx-transfer-alt text-purple-600 group-hover:text-white text-2xl transition-all duration-300"></i>
                                </div>
                                <h6 class="text-sm font-semibold text-gray-700 group-hover:text-white transition-colors duration-300">
                                    Change Ownership
                                </h6>
                                <p class="text-xs text-gray-400 group-hover:text-white/70 mt-1 hidden md:block">
                                    Transfer vehicle ownership smoothly
                                </p>
                            </a>

                            <!-- International License -->
                            <a href="{{ route('home.internationaldriverlicense') }}" 
                               class="group bg-gray-50 hover:bg-[#142444] rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-yellow-100 group-hover:bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                                    <i class="bx bx-globe text-yellow-600 group-hover:text-white text-2xl transition-all duration-300"></i>
                                </div>
                                <h6 class="text-sm font-semibold text-gray-700 group-hover:text-white transition-colors duration-300">
                                    International License
                                </h6>
                                <p class="text-xs text-gray-400 group-hover:text-white/70 mt-1 hidden md:block">
                                    Get your international driving permit
                                </p>
                            </a>

                            <!-- Dealer Plate Number -->
                            <a href="{{ route('home.platenumber') }}" 
                               class="group bg-gray-50 hover:bg-[#142444] rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-red-100 group-hover:bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                                    <i class="bx bx-purchase-tag-alt text-red-600 group-hover:text-white text-2xl transition-all duration-300"></i>
                                </div>
                                <h6 class="text-sm font-semibold text-gray-700 group-hover:text-white transition-colors duration-300">
                                    Dealer Plate Number
                                </h6>
                                <p class="text-xs text-gray-400 group-hover:text-white/70 mt-1 hidden md:block">
                                    Get dealer plate numbers for your business
                                </p>
                            </a>

                            <!-- Vehicle Renewal -->
                            <a href="{{ route('home.vehicleRenewalPaper') }}" 
                               class="group bg-gray-50 hover:bg-[#142444] rounded-xl p-4 text-center transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-indigo-100 group-hover:bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 transition-all duration-300">
                                    <i class="bx bx-refresh text-indigo-600 group-hover:text-white text-2xl transition-all duration-300"></i>
                                </div>
                                <h6 class="text-sm font-semibold text-gray-700 group-hover:text-white transition-colors duration-300">
                                    Vehicle Renewal
                                </h6>
                                <p class="text-xs text-gray-400 group-hover:text-white/70 mt-1 hidden md:block">
                                    Renew your vehicle registration
                                </p>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content - Vehicles Section -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        @if($vehicleCount == 0)
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="bx bx-car text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Vehicles Registered Yet</h3>
                                <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">
                                    Add your first vehicle to start tracking document expiries and receive renewal reminders.
                                </p>
                                <a href="{{ route('home.addVehicleRenewal') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-[#142444] hover:bg-[#0f1c38] text-white font-medium rounded-lg transition duration-200">
                                    <i class="bx bx-plus-circle mr-2"></i>
                                    Add Your First Vehicle
                                </a>
                            </div>
                        @else
                            <!-- Header -->
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">Your Vehicles</h2>
                                    <p class="text-sm text-gray-500">{{ $vehicleCount }} vehicle(s) registered</p>
                                </div>
                                <a href="{{ route('home.addVehicleRenewal') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-[#142444] hover:bg-[#0f1c38] text-white text-sm font-medium rounded-lg transition duration-200">
                                    <i class="bx bx-plus-circle mr-2"></i>
                                    Add New Vehicle
                                </a>
                            </div>

                            <!-- Active Orders Alert -->
                            @if($activeOrders ?? false)
                                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                                    <i class="bx bx-package text-blue-500 text-xl mt-0.5"></i>
                                    <div>
                                        <h6 class="font-medium text-blue-800">Active Orders</h6>
                                        <p class="text-sm text-blue-600">
                                            You have {{ $activeOrders }} active order(s) in progress.
                                            <a href="{{ route('home.processHistory') }}" class="text-[#142444] font-medium hover:underline">
                                                View orders →
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <!-- Vehicle Cards -->
                            <div class="space-y-4">
                                @foreach ($getaddvehicle as $vehicle)
                                    @php
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
                                        
                                        $borderColor = $hasExpired ? 'border-red-500' : ($hasExpiringSoon ? 'border-yellow-500' : 'border-green-500');
                                        $statusBadge = $hasExpired ? 'bg-red-100 text-red-700' : ($hasExpiringSoon ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700');
                                        $statusText = $hasExpired ? 'Expired' : ($hasExpiringSoon ? 'Expiring Soon' : 'All Valid');
                                    @endphp
                                    
                                    <div class="border-l-4 {{ $borderColor }} bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                                        <div class="p-4 md:p-5">
                                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                <!-- Vehicle Icon & Status -->
                                                <div class="md:col-span-1 flex items-center">
                                                    <div class="relative">
                                                        <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                            <i class="bx bxs-car text-3xl {{ $hasExpired ? 'text-red-500' : ($hasExpiringSoon ? 'text-yellow-500' : 'text-green-500') }}"></i>
                                                        </div>
                                                        <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full {{ $hasExpired ? 'bg-red-500' : ($hasExpiringSoon ? 'bg-yellow-500' : 'bg-green-500') }} text-white text-xs flex items-center justify-center">
                                                            {{ $hasExpired ? '!' : ($hasExpiringSoon ? '⚠' : '✓') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <!-- Vehicle Info -->
                                                <div class="md:col-span-3">
                                                    <h6 class="font-semibold text-gray-900 text-lg">{{ $vehicle->vehiclemake ?? 'N/A' }}</h6>
                                                    <div class="space-y-1 mt-2">
                                                        <div class="flex items-center text-sm">
                                                            <i class="bx bx-registered text-gray-400 mr-2"></i>
                                                            <span class="text-gray-600">Plate: <strong class="text-gray-900">{{ $vehicle->platenumber ?? 'N/A' }}</strong></span>
                                                        </div>
                                                        <div class="flex items-center text-sm">
                                                            <i class="bx bx-category text-gray-400 mr-2"></i>
                                                            <span class="text-gray-600">Type: <strong class="text-gray-900">{{ $vehicle->vehicleTypeInfo->name ?? 'Not specified' }}</strong></span>
                                                        </div>
                                                        @if($vehicle->vehiclemodel)
                                                            <div class="flex items-center text-sm">
                                                                <i class="bx bx-car text-gray-400 mr-2"></i>
                                                                <span class="text-gray-600">Model: <strong class="text-gray-900">{{ $vehicle->vehiclemodel }}</strong></span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <!-- Expiry Information -->
                                                <div class="md:col-span-4">
                                                    <div class="flex items-center mb-2">
                                                        <i class="bx bx-calendar text-gray-400 mr-2"></i>
                                                        <span class="text-sm font-medium text-gray-700">Document Expiries</span>
                                                        <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-medium {{ $statusBadge }}">
                                                            {{ $statusText }}
                                                        </span>
                                                    </div>
                                                    <div class="expiry-list max-h-32 overflow-y-auto space-y-1 pr-2">
                                                        @foreach($documents as $field => $label)
                                                            @if($vehicle->$field)
                                                                @php
                                                                    $expiryDate = \Carbon\Carbon::parse($vehicle->$field);
                                                                    $daysLeft = now()->startOfDay()->diffInDays($expiryDate, false);
                                                                    
                                                                    if($daysLeft < 0) {
                                                                        $statusClass = 'text-red-600';
                                                                        $icon = 'bx-error-circle';
                                                                        $statusTextDisplay = 'Expired';
                                                                    } elseif($daysLeft == 0) {
                                                                        $statusClass = 'text-red-600';
                                                                        $icon = 'bx-error';
                                                                        $statusTextDisplay = 'Expires today';
                                                                    } elseif($daysLeft <= 7) {
                                                                        $statusClass = 'text-red-500';
                                                                        $icon = 'bx-time';
                                                                        $statusTextDisplay = $daysLeft . ' days';
                                                                    } elseif($daysLeft <= 15) {
                                                                        $statusClass = 'text-yellow-500';
                                                                        $icon = 'bx-time';
                                                                        $statusTextDisplay = $daysLeft . ' days';
                                                                    } else {
                                                                        $statusClass = 'text-green-500';
                                                                        $icon = 'bx-check-circle';
                                                                        $statusTextDisplay = $daysLeft . ' days';
                                                                    }
                                                                @endphp
                                                                
                                                                <div class="flex justify-between items-center text-sm">
                                                                    <span class="text-gray-600">{{ $label }}</span>
                                                                    <span class="{{ $statusClass }} font-medium">
                                                                        <i class="bx {{ $icon }} mr-1"></i>
                                                                        {{ $statusTextDisplay }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    
                                                    @if($hasExpired)
                                                        <div class="mt-2 p-1.5 bg-red-50 border border-red-200 rounded-lg text-xs text-red-700 flex items-center">
                                                            <i class="bx bx-error mr-1"></i>
                                                            Some documents have expired. Please renew immediately.
                                                        </div>
                                                    @elseif($hasExpiringSoon)
                                                        <div class="mt-2 p-1.5 bg-yellow-50 border border-yellow-200 rounded-lg text-xs text-yellow-700 flex items-center">
                                                            <i class="bx bx-time mr-1"></i>
                                                            Some documents are expiring soon. Please renew.
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <!-- Actions -->
                                                <div class="md:col-span-4 lg:col-span-3 flex flex-col justify-center">
                                                    <div class="grid grid-cols-2 gap-2">
                                                        <a href="{{ route('edit.vehiclePaperRenewal', ['encryptedId' => encrypt($vehicle->id) ]) }}" 
                                                           class="px-3 py-2 bg-[#142444] hover:bg-[#0f1c38] text-white text-center text-sm font-medium rounded-lg transition duration-200">
                                                            <i class="bx bx-edit mr-1"></i>
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('delete.vehiclePaperRenewal', ['encryptedId' => encrypt($vehicle->id) ]) }}" 
                                                           class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-center text-sm font-medium rounded-lg transition duration-200"
                                                           onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                            <i class="bx bx-trash mr-1"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                    @if($hasExpired || $hasExpiringSoon)
                                                        <a href="{{ route('edit.vehiclePaperRenewal', ['encryptedId' => encrypt($vehicle->id)]) }}" 
                                                           class="mt-2 px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-center text-sm font-medium rounded-lg transition duration-200">
                                                            <i class="bx bx-refresh mr-1"></i>
                                                            Renew Documents
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Custom scrollbar for expiry list */
    .expiry-list::-webkit-scrollbar {
        width: 4px;
    }
    
    .expiry-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .expiry-list::-webkit-scrollbar-thumb {
        background: #c1c7cd;
        border-radius: 10px;
    }
    
    .expiry-list::-webkit-scrollbar-thumb:hover {
        background: #a0a7ae;
    }
    
    /* Smooth transitions */
    .transition-shadow {
        transition: box-shadow 0.2s ease;
    }
    
    /* Focus styles */
    *:focus-visible {
        outline: 2px solid #142444;
        outline-offset: 2px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush