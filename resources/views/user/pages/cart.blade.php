@extends('user.layouts.app')

@section('content')

<div class="wrapper">
	<div class="page-wrapper">
		<div class="page-content-wrapper">
            <div class="min-h-screen bg-gray-50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    
                    <!-- Page Header -->
                    <div class="mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">My Cart</h1>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $cartCount > 0 ? $cartCount . ' item(s) in your cart' : 'Your cart is empty' }}
                                </p>
                            </div>
                            <a href="{{ route('home') }}" 
                            class="inline-flex items-center px-4 py-2 bg-[#142444] hover:bg-[#0f1c38] text-white rounded-lg transition duration-200 text-sm font-medium">
                                <i class="bx bx-arrow-back mr-2"></i>
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                    <!-- Alerts -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="bx bx-check-circle text-green-500 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                                <button onclick="this.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-600">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    @if($cartCount > 0)
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Cart Items -->
                            <div class="lg:col-span-2">
                                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Cart Items</h2>
                                        
                                        <div class="space-y-4">
                                            @foreach($cartContent as $item)
                                                <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition-shadow">
                                                    <div class="flex flex-col md:flex-row md:items-start gap-4">
                                                        <!-- Item Icon -->
                                                        <div class="flex-shrink-0">
                                                            <div class="w-12 h-12 bg-[#142444]/10 rounded-lg flex items-center justify-center">
                                                                <i class="bx bx-file text-[#142444] text-2xl"></i>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Item Details -->
                                                        <div class="flex-1 min-w-0">
                                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                                                <div>
                                                                    <h6 class="font-semibold text-gray-900 text-sm">
                                                                        {{ $item->model->process_type }}
                                                                    </h6>
                                                                    <p class="text-xs text-gray-500 mt-0.5">
                                                                        Process ID: {{ $item->model->process_id }}
                                                                    </p>
                                                                </div>
                                                                <span class="text-sm font-bold text-gray-900 whitespace-nowrap">
                                                                    ₦{{ number_format($item->subtotal) }}
                                                                </span>
                                                            </div>
                                                            
                                                            <!-- Process Details -->
                                                            <div class="mt-2 text-xs text-gray-600 bg-gray-50 rounded-lg p-3">
                                                                @if($item->model->process_type == 'Driver License Renewal')
                                                                    <span class="text-gray-500">Validity:</span> {{ $item->model->lengthofyear }} Years
                                                                @elseif($item->model->process_type == 'International Driver License')
                                                                    <span class="text-gray-500">Validity:</span> {{ $item->model->lengthofyear }} Year
                                                                @elseif($item->model->process_type == 'New Driver License')
                                                                    <span class="text-gray-500">Validity:</span> {{ $item->model->lengthofyear }} Years
                                                                @elseif($item->model->process_type == 'Change of Ownership')
                                                                    <div class="space-y-0.5">
                                                                        <div><span class="text-gray-500">Vehicle:</span> {{ $item->model->vehicle_category }}</div>
                                                                        @if($item->model->vehiclelicenseexpiry) <div>✓ Vehicle License Expiring</div> @endif
                                                                        @if($item->model->insuranceexpiry) <div>✓ Insurance Expiring</div> @endif
                                                                        @if($item->model->roadworthinessexpiry) <div>✓ Roadworthiness Expiring</div> @endif
                                                                        @if($item->model->hackneypermitexpiry) <div>✓ Hackney Permit Expiring</div> @endif
                                                                        @if($item->model->localgovernmentpermitexpiry) <div>✓ Local Government Permit Expiring</div> @endif
                                                                        @if($item->model->policeCMRIS) <div>✓ Police CMRIS</div> @endif
                                                                    </div>
                                                                @elseif($item->model->process_type == 'Vehicle Registration')
                                                                    <div>
                                                                        <span class="text-gray-500">Vehicle:</span> {{ $item->model->categoryInfo->name ?? 'N/A' }}
                                                                        <br>
                                                                        <span class="text-gray-500">Type:</span> {{ $item->model->vehicleregistrationType->name ?? 'N/A' }}
                                                                        @if($item->model->numberplate == 'PCN')
                                                                            <div class="mt-1">
                                                                                <span class="text-gray-500">Plate:</span> Personalized/Customize 
                                                                                <span class="font-medium">({{ $item->model->preferrednumber }})</span>
                                                                            </div>
                                                                        @elseif($item->model->numberplate == 'RPN')
                                                                            <div class="mt-1">
                                                                                <span class="text-gray-500">Plate:</span> Random Plate Number
                                                                            </div>
                                                                        @endif
                                                                        @if($item->model->hackneypermit || $item->model->policeCMRIS)
                                                                            <div class="mt-1">
                                                                                <span class="text-gray-500">Add-ons:</span>
                                                                                @if($item->model->hackneypermit) Hackney Permit @endif
                                                                                @if($item->model->policeCMRIS) @if($item->model->hackneypermit), @endif Police CMRIS @endif
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @elseif($item->model->process_type == 'Vehicle Paper Renewal')
                                                                    <div class="space-y-0.5">
                                                                        <span class="text-gray-500">Vehicle:</span> {{ $item->model->vehicleType }}
                                                                        <div class="flex flex-wrap gap-1 mt-1">
                                                                            @if($item->model->vehicleLicense) <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs">Vehicle License</span> @endif
                                                                            @if($item->model->roadWorthiness) <span class="inline-block px-2 py-0.5 bg-green-50 text-green-700 rounded text-xs">Road Worthiness</span> @endif
                                                                            @if($item->model->thirdPartyInsurance) <span class="inline-block px-2 py-0.5 bg-purple-50 text-purple-700 rounded text-xs">Insurance</span> @endif
                                                                            @if($item->model->proofOfOwnership) <span class="inline-block px-2 py-0.5 bg-yellow-50 text-yellow-700 rounded text-xs">Proof of Ownership</span> @endif
                                                                            @if($item->model->vehicleInspectionPickanddrop) <span class="inline-block px-2 py-0.5 bg-pink-50 text-pink-700 rounded text-xs">Inspection</span> @endif
                                                                            @if($item->model->hackneyPermit) <span class="inline-block px-2 py-0.5 bg-orange-50 text-orange-700 rounded text-xs">Hackney Permit</span> @endif
                                                                            @if($item->model->policeCMRIS) <span class="inline-block px-2 py-0.5 bg-red-50 text-red-700 rounded text-xs">Police CMRIS</span> @endif
                                                                        </div>
                                                                    </div>
                                                                @elseif($item->model->process_type == 'Dealer`s Plate Number')
                                                                    <span class="text-gray-500">Dealer:</span> {{ $item->model->fullname }}
                                                                @elseif($item->model->process_type == 'Other Permit')
                                                                    <span class="text-gray-500">Permit:</span> {{ $item->model->permitInfo->name ?? 'N/A' }}
                                                                @elseif($item->model->process_type == 'policeCMRIS')
                                                                    <span class="text-gray-500">Type:</span> {{ $item->model->permittype }}
                                                                @endif
                                                            </div>
                                                            
                                                            <!-- Quantity & Actions -->
                                                            <div class="mt-3 flex items-center justify-between">
                                                                <div class="flex items-center gap-3">
                                                                    <span class="text-xs text-gray-500">Qty: <span class="font-medium text-gray-700">{{ $item->qty }}</span></span>
                                                                </div>
                                                                <button class="delete-item text-red-500 hover:text-red-700 transition-colors" 
                                                                        data-item-id="{{ $item->rowId }}"
                                                                        onclick="confirmDelete('{{ $item->rowId }}')">
                                                                    <i class="bx bx-trash text-xl"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="lg:col-span-1">
                                <div class="bg-white rounded-2xl shadow-sm overflow-hidden sticky top-20">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                                        
                                        <div class="space-y-3">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Subtotal</span>
                                                <span class="font-medium text-gray-900">₦{{ Cart::subtotal() }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">VAT</span>
                                                <span class="font-medium text-gray-900">₦{{ Cart::tax() }}</span>
                                            </div>
                                            <div class="border-t border-gray-200 pt-3">
                                                <div class="flex justify-between">
                                                    <span class="text-base font-semibold text-gray-900">Total</span>
                                                    <span class="text-xl font-bold text-[#142444]">₦{{ Cart::total() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delivery Note -->
                                        <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-lg">
                                            <p class="text-xs text-blue-700 flex items-start gap-2">
                                                <i class="bx bx-info-circle text-blue-500 mt-0.5"></i>
                                                <span>Free doorstep delivery on orders above ₦20,000 only.</span>
                                            </p>
                                        </div>

                                        <!-- Checkout Button -->
                                        <a href="{{ route('home.checkout') }}" 
                                        class="mt-4 w-full inline-flex items-center justify-center px-6 py-3 bg-[#142444] hover:bg-[#0f1c38] text-white font-semibold rounded-xl transition duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                                            <i class="bx bx-lock-alt mr-2"></i>
                                            Proceed to Checkout
                                        </a>

                                        <!-- Continue Shopping -->
                                        <a href="{{ route('home') }}" 
                                        class="mt-2 w-full inline-flex items-center justify-center text-sm text-gray-500 hover:text-[#142444] transition-colors">
                                            <i class="bx bx-arrow-back mr-1"></i>
                                            Continue Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Empty Cart -->
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                            <div class="p-12 text-center">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="bx bx-cart text-4xl text-gray-400"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Your Cart is Empty</h3>
                                <p class="text-gray-500 text-sm max-w-md mx-auto mb-6">
                                    Looks like you haven't added any items to your cart yet. 
                                    Browse our services and start your application today.
                                </p>
                                <a href="{{ route('home') }}" 
                                class="inline-flex items-center px-6 py-3 bg-[#142444] hover:bg-[#0f1c38] text-white font-medium rounded-lg transition duration-200">
                                    <i class="bx bx-plus-circle mr-2"></i>
                                    Browse Services
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
	</div>
</div>

@push('styles')
<style>
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: #c1c7cd;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #a0a7ae;
    }
    
    /* Hover effects */
    .cart-item:hover {
        border-color: #142444;
    }
    
    /* Toastr customization */
    .toast-success {
        background-color: #142444 !important;
    }
    
    /* Print styles */
    @media print {
        .container {
            max-width: 100% !important;
            padding: 0 !important;
        }
        .bg-gray-50 {
            background: white !important;
        }
        button, .no-print {
            display: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function confirmDelete(itemId) {
        if (confirm('Do you really want to delete this item from your cart?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type: 'POST',
                url: "{{ route('cart.delete') }}",
                data: { itemId: itemId },
                success: function(data) {
                    toastr.success('Item deleted successfully!', 'Success');
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to delete item. Please try again.', 'Error');
                }
            });
        }
    }

    // Initialize Toastr
    $(document).ready(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3000,
        };
    });
</script>
@endpush
@endsection