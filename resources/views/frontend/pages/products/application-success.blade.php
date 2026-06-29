@extends('layouts.app')

@section('title', 'Application Submitted Successfully')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 md:py-16 lg:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl">
                <!-- Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden" id="receipt-content">
                    <div class="p-6 sm:p-8 md:p-10 text-center">

                        <!-- Header / Logo -->
                        <div class="mb-6">
                            <img src="{{ asset('assets/img/rab.png') }}" alt="Rabmot Licensing" class="h-12 mx-auto">
                        </div>

                        <!-- Success Icon -->
                        <div class="mx-auto mb-6 w-24 h-24 bg-green-50 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-500 text-5xl"></i>
                        </div>

                        <!-- Title -->
                        <h2 class="text-2xl sm:text-3xl font-bold mb-3" style="color: #142444;">
                            Payment & Application Successful!
                        </h2>
                        <p class="text-gray-500 text-sm sm:text-base mb-6">
                            Thank you for choosing Rabmot Licensing. Your application has been received and is now being processed.
                        </p>

                        @php
                            // Get service type from order
                            $serviceType = $order->product_name ?? 'Service Request';

                            // Set processing time and next steps based on service
                            if ($serviceType === 'New Driver License') {
                                $processingTime = '5 – 10 Working Days';
                                $nextSteps = [
                                    'We will verify your details and documents.',
                                    'An agent will contact you via email or phone within 24 hours if we need more information.',
                                    'You will receive updates and your license details via email once ready.'
                                ];
                            } elseif ($serviceType === 'New Vehicle Registration (Lagos)') {
                                $processingTime = '5 – 7 Working Days';
                                $nextSteps = [
                                    'We will verify your vehicle and ownership documents.',
                                    'Our team will submit your application to the Lagos State authorities.',
                                    'You will receive your new vehicle registration papers and plate number details via email once approved.'
                                ];
                            } elseif ($serviceType === 'Change of Ownership & Re-Registration') {
                                $processingTime = '5 – 7 Working Days';
                                $nextSteps = [
                                    'We will verify the transfer agreement and all supporting documents.',
                                    'We will process the change of ownership and re-register the vehicle in your name.',
                                    'You will receive the updated registration certificate and new ownership documents via email once completed.'
                                ];
                            } else {
                                $processingTime = '5 – 10 Working Days';
                                $nextSteps = [
                                    'We will verify your details and documents.',
                                    'An agent will contact you if we need more information.',
                                    'You will receive updates via email once processing is complete.'
                                ];
                            }
                        @endphp

                        <!-- Reference Details -->
                        <div class="bg-gray-50 rounded-xl p-4 sm:p-6 mb-6 text-left">
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="text-gray-500 text-sm">Order Reference:</span>
                                <span class="font-semibold text-gray-900 text-sm">{{ $reference ?? $order->order_number ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="text-gray-500 text-sm">Service Type:</span>
                                <span class="font-semibold text-gray-900 text-sm">{{ $serviceType }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="text-gray-500 text-sm">Payment Status:</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Paid
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="text-gray-500 text-sm">Payment Date:</span>
                                <span class="font-semibold text-gray-900 text-sm">{{ now()->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-gray-500 text-sm">Amount Paid:</span>
                                <span class="font-semibold text-gray-900 text-sm">₦{{ number_format($order->total ?? 0, 2) }}</span>
                            </div>
                        </div>

                        <!-- Estimated Processing -->
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 text-center">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>
                                <strong>Estimated Processing Time:</strong> {{ $processingTime }}
                            </p>
                        </div>

                        <!-- Next Steps Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 sm:p-6 mb-6 text-left">
                            <h6 class="font-semibold text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                What happens next?
                            </h6>
                            <ul class="space-y-2 text-gray-600 text-sm">
                                @foreach($nextSteps as $step)
                                <li class="flex items-start">
                                    <span class="text-blue-500 mr-2">•</span>
                                    {{ $step }}
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Footer -->
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <p class="text-xs text-gray-400">
                                &copy; {{ date('Y') }} Rabmot Licensing Agency. All rights reserved.
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-envelope mr-1"></i> support@rabmotlicensing.com
                                <span class="mx-2">|</span>
                                <i class="fas fa-phone mr-1"></i> +2348155206810
                            </p>
                        </div>

                        <!-- Optional: Create Account Prompt (Hidden in Print) -->
                        @guest
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 sm:p-6 mb-6 text-left no-print">
                            <h6 class="font-semibold text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-user-plus text-yellow-600 mr-2"></i>
                                Want to track your application easily?
                            </h6>
                            <p class="text-gray-600 text-sm mb-4">
                                Create a free account to view status, save details, and manage future applications.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('signup', ['ref' => $reference ?? $order->order_number ?? '']) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-[#142444] hover:bg-[#0f1c38] text-white font-medium rounded-lg transition duration-200">
                                    <i class="fas fa-user-plus mr-2"></i> Create My Account
                                </a>
                                <a href="{{ route('home') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition duration-200">
                                    Skip for Now
                                </a>
                            </div>
                        </div>
                        @endguest

                        <!-- Action Buttons (Hidden in Print) -->
                        <div class="flex flex-wrap justify-center gap-3 mt-4 no-print">
                            <a href="{{ route('home') }}" 
                               class="inline-flex items-center px-6 py-3 bg-[#142444] hover:bg-[#0f1c38] text-white font-semibold rounded-lg transition duration-200">
                                <i class="fas fa-home mr-2"></i> Back to Home
                            </a>
                            <button onclick="window.print()" 
                                    class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition duration-200">
                                <i class="fas fa-download mr-2"></i> Download Receipt
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hide print button and navigation when printing */
@media print {
    /* Hide everything except the receipt */
    nav, footer, .no-print {
        display: none !important;
    }
    
    body {
        background: white !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    .min-h-screen {
        min-height: auto !important;
        padding: 0 !important;
        background: white !important;
    }
    
    .container {
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    .max-w-2xl {
        max-width: 100% !important;
    }
    
    .bg-white {
        background: white !important;
        box-shadow: none !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 0 !important;
    }
    
    .rounded-2xl {
        border-radius: 0 !important;
    }
    
    .shadow-lg {
        box-shadow: none !important;
    }
    
    /* Ensure everything fits on one page */
    #receipt-content {
        max-height: 100vh !important;
        overflow: visible !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    
    /* Reduce padding for print */
    .p-6, .sm\:p-8, .md\:p-10 {
        padding: 1.5rem !important;
    }
    
    /* Ensure text is readable */
    .text-gray-500 {
        color: #6b7280 !important;
    }
    
    .text-gray-900 {
        color: #111827 !important;
    }
    
    /* Keep colors for print */
    .bg-green-50 {
        background-color: #f0fdf4 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    .bg-gray-50 {
        background-color: #f9fafb !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    .bg-blue-50 {
        background-color: #eff6ff !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    .bg-green-100 {
        background-color: #dcfce7 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    .text-green-800 {
        color: #166534 !important;
    }
    
    .border {
        border-color: #e5e7eb !important;
    }
    
    .border-b {
        border-bottom-color: #e5e7eb !important;
    }
    
    /* Ensure the receipt fits on one page */
    @page {
        size: A4 portrait;
        margin: 0.5cm;
    }
}

/* Screen styles for no-print elements */
@media screen {
    .no-print {
        display: block !important;
    }
}
</style>
@endsection