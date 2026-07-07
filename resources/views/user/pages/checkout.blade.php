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
                                <h1 class="text-2xl font-bold text-gray-900">Checkout</h1>
                                <p class="text-sm text-gray-500 mt-1">Review your order and complete payment</p>
                            </div>
                            <a href="{{ route('home.cart') }}" 
                            class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg transition duration-200 text-sm font-medium">
                                <i class="bx bx-arrow-back mr-2"></i>
                                Back to Cart
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

                    @if (session('error'))
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="bx bx-error-circle text-red-500 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                                <button onclick="this.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            <!-- User Info -->
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Customer Information</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Full Name</p>
                                            <p class="font-medium text-gray-900">{{ $fullname ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Email Address</p>
                                            <p class="font-medium text-gray-900">{{ $email ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h2>
                                    
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead>
                                                <tr class="border-b border-gray-200">
                                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Order ID</th>
                                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Process ID</th>
                                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Process Details</th>
                                                    <th class="text-right text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($cartItems) && $cartItems->count() > 0)
                                                    @foreach($cartItems as $item)
                                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                                        <td class="py-3 px-2 text-sm font-medium text-gray-900">{{ $orderNumber ?? 'N/A' }}</td>
                                                        <td class="py-3 px-2 text-sm text-gray-600">{{ $item->model->process_id ?? 'N/A' }}</td>
                                                        <td class="py-3 px-2 text-sm text-gray-600">
                                                            @if($item->model->process_type == 'Other Permit')
                                                                {{ $item->model->permitInfo->name ?? 'N/A' }}
                                                            @elseif($item->model->process_type == 'Dealer`s Plate Number')
                                                                {{ $item->model->process_type }}, {{ $item->model->fullname ?? 'N/A' }}
                                                            @elseif($item->model->process_type == 'International Driver License')
                                                                Validity: {{ $internationalDL->lengthofyear ?? 'N/A' }} Years
                                                            @elseif($item->model->process_type == 'Driver License Renewal')
                                                                Validity: {{ $driverlicenserenewal->lengthofyear ?? 'N/A' }} Years
                                                            @elseif($item->model->process_type == 'New Driver License')
                                                                Validity: {{ $newdriverlicense->lengthofyear ?? 'N/A' }} Years
                                                            @elseif($item->model->process_type == 'Change of Ownership')
                                                                <div class="space-y-0.5">
                                                                    <div>{{ $item->model->vehicle_category ?? 'N/A' }}</div>
                                                                    @if($item->model->vehiclelicenseexpiry)
                                                                        <div class="text-xs text-gray-500">✓ Vehicle License Expiring</div>
                                                                    @endif
                                                                    @if($item->model->insuranceexpiry)
                                                                        <div class="text-xs text-gray-500">✓ Insurance Expiring</div>
                                                                    @endif
                                                                    @if($item->model->roadworthinessexpiry)
                                                                        <div class="text-xs text-gray-500">✓ Roadworthiness Expiring</div>
                                                                    @endif
                                                                    @if($item->model->hackneypermitexpiry)
                                                                        <div class="text-xs text-gray-500">✓ Hackney Permit Expiring</div>
                                                                    @endif
                                                                    @if($item->model->localgovernmentpermitexpiry)
                                                                        <div class="text-xs text-gray-500">✓ Local Government Permit Expiring</div>
                                                                    @endif
                                                                    @if($item->model->policeCMRIS)
                                                                        <div class="text-xs font-semibold text-gray-700">✓ Police CMRIS</div>
                                                                    @endif
                                                                </div>
                                                            @elseif($item->model->process_type == 'Vehicle Paper Renewal')
                                                                <div class="flex flex-wrap gap-1">
                                                                    @foreach (['vehicleLicense', 'roadWorthiness', 'vehicleInspectionPickanddrop', 'hackneyPermit', 'thirdPartyInsurance', 'policeCMRIS', 'proofOfOwnership'] as $key)
                                                                        @if($item->model->$key)
                                                                            <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs">
                                                                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                                            </span>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @elseif($item->model->process_type == 'Vehicle Registration')
                                                                <div class="space-y-1">
                                                                    <div>{{ $item->model->categoryInfo->name ?? 'N/A' }}</div>
                                                                    <div class="text-sm">{{ $item->model->vehicleregistrationType->name ?? 'N/A' }}</div>
                                                                    @if($item->model->numberplate == 'PCN')
                                                                        <div class="text-sm font-medium text-[#142444]">
                                                                            Personalized: {{ $item->model->preferrednumber ?? 'N/A' }}
                                                                        </div>
                                                                    @elseif($item->model->numberplate == 'RPN')
                                                                        <div class="text-sm text-gray-600">Random Plate Number</div>
                                                                    @endif
                                                                    @if($item->model->hackneypermit || $item->model->policeCMRIS)
                                                                        <div class="flex flex-wrap gap-1 mt-1">
                                                                            @if($item->model->hackneypermit)
                                                                                <span class="inline-block px-2 py-0.5 bg-green-50 text-green-700 rounded text-xs">Hackney Permit</span>
                                                                            @endif
                                                                            @if($item->model->policeCMRIS)
                                                                                <span class="inline-block px-2 py-0.5 bg-red-50 text-red-700 rounded text-xs">Police CMRIS</span>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="py-3 px-2 text-sm font-semibold text-gray-900 text-right">
                                                            ₦{{ number_format($item->subtotal ?? 0, 2) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="py-3 px-2 text-center text-gray-500">No items in cart</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Sidebar -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden sticky top-20">
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                                    
                                    <div class="space-y-3">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Subtotal</span>
                                            <span class="font-medium text-gray-900">₦{{ Cart::subtotal() ?? '0.00' }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">VAT</span>
                                            <span class="font-medium text-gray-900">₦{{ Cart::tax() ?? '0.00' }}</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-3">
                                            <div class="flex justify-between">
                                                <span class="text-base font-semibold text-gray-900">Total</span>
                                                <span class="text-xl font-bold text-[#142444]" id="total-amount-display">
                                                    ₦{{ number_format($totalToDisplay ?? 0, 2) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Promo Code -->
                                    <form action="{{ route('applyPromoCode') }}" method="POST" class="mt-4">
                                        @csrf
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Promo Code</label>
                                        <div class="flex gap-2">
                                            <input type="text" 
                                                name="promo_code" 
                                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] text-sm"
                                                placeholder="Enter code">
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-[#142444] hover:bg-[#0f1c38] text-white rounded-lg transition duration-200 text-sm font-medium">
                                                Apply
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Wallet Balance -->
                                    @if(isset($walletBalance))
                                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-600">Wallet Balance</span>
                                                <span class="font-medium text-gray-900">₦{{ number_format($walletBalance, 2) }}</span>
                                            </div>
                                            <div class="flex items-center gap-2 mt-2">
                                                <input type="checkbox" 
                                                    id="use_wallet_balance" 
                                                    name="use_wallet_balance" 
                                                    value="1"
                                                    class="w-4 h-4 text-[#142444] border-gray-300 rounded focus:ring-[#142444]">
                                                <label for="use_wallet_balance" class="text-sm text-gray-600 cursor-pointer">
                                                    Use wallet balance
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                    <input type="hidden" id="total" value="{{ $totalToDisplay ?? 0 }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="mt-6 bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Details</h2>
                            
                            <form action="{{ route('home.payment.initiate') }}" method="POST">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Delivery Option -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                            Delivery Option <span class="text-red-500">*</span>
                                        </label>
                                        <select id="deliveryOption" 
                                                required 
                                                name="delivery_option" 
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200">
                                            <option disabled selected value="">Choose Delivery Option</option>
                                            <option data-type="email" value="Scan and Send to Mail">Scan and send to mail</option>
                                            <option data-type="pickup" value="Pick Up from nearest location">Pick Up from nearest location</option>
                                            <option data-type="delivery" value="Delivery to door step">Delivery to door step</option>
                                        </select>
                                    </div>

                                    <!-- Email (hidden initially) -->
                                    <div id="emailContainer" class="hidden">
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                            Email Address <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                            name="scan_email" 
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200"
                                            placeholder="Enter email address">
                                    </div>

                                    <!-- Location (hidden initially) -->
                                    <div id="locationContainer" class="hidden">
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                            Location <span class="text-red-500">*</span>
                                        </label>
                                        <select id="locationSelect" 
                                                name="location" 
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200">
                                            <option disabled selected value="">Choose Preferred State</option>
                                            <option data-id="lagos" value="Lagos">Lagos</option>
                                            <option data-id="abuja" value="Abuja">Abuja</option>
                                            <option data-id="portharcourt" value="Port Harcourt">Port Harcourt</option>
                                            <option data-id="abeokuta" value="Abeokuta">Abeokuta</option>
                                            <option data-id="ibadan" value="Ibadan">Ibadan</option>
                                        </select>
                                    </div>

                                    <!-- Address (hidden initially) -->
                                    <div id="addressContainer" class="hidden md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                            Delivery Address <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="address" 
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200"
                                                rows="3"
                                                placeholder="Enter your delivery address"></textarea>
                                    </div>

                                    <!-- Branch Selection (hidden initially) -->
                                    <div id="branchContainer" class="hidden md:col-span-2">
                                        <div id="lagosBranches" class="hidden">
                                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                                Lagos Office Address <span class="text-red-500">*</span>
                                            </label>
                                            <select name="lagos_address" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200">
                                                <option disabled selected value="">Choose Lagos address</option>
                                                <option value="Festac Office Address: 1st floor AMG Workspace, 22 Road, Lagos, Nigeria.">
                                                    Festac Office: 1st floor AMG Workspace, 22 Road
                                                </option>
                                                <option value="Isheri Oshun Branch Address: Rilexgroups, Lilian Almaroof St, Ijegun, Ikotun/Ijegun 102213, Lagos, Nigeria.">
                                                    Isheri Oshun Branch: Rilexgroups, Lilian Almaroof St, Ijegun
                                                </option>
                                            </select>
                                        </div>
                                        <div id="abujaBranches" class="hidden">
                                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                                Abuja Office Address <span class="text-red-500">*</span>
                                            </label>
                                            <select name="lagos_address" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200">
                                                <option disabled selected value="">Choose Abuja Office Address</option>
                                                <option value="V I O Office Mabushi Kado Express Way Eagle Square, Abuja Nigeria.">
                                                    VIO Office Mabushi Kado Express Way Eagle Square
                                                </option>
                                            </select>
                                        </div>
                                        <div id="portharcourtBranches" class="hidden">
                                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                                Port Harcourt Office Address <span class="text-red-500">*</span>
                                            </label>
                                            <select name="lagos_address" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200">
                                                <option disabled selected value="">Choose Port Harcourt Office Address</option>
                                                <option value="Deborah Lawson House, Abacha road, GRA, Port Harcourt, Rivers.">
                                                    Deborah Lawson House, Abacha road, GRA
                                                </option>
                                            </select>
                                        </div>
                                        <div id="abeokutaBranches" class="hidden">
                                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                                Abeokuta Office Address <span class="text-red-500">*</span>
                                            </label>
                                            <select name="lagos_address" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200">
                                                <option disabled selected value="">Choose Abeokuta Office Address</option>
                                                <option value="5 Peter B somide street Onikoko Abeokuta Ogun Nigeria.">
                                                    5 Peter B Somide Street Onikoko
                                                </option>
                                            </select>
                                        </div>
                                        <div id="ibadanBranches" class="hidden">
                                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                                Ibadan Office Address <span class="text-red-500">*</span>
                                            </label>
                                            <select name="lagos_address" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] transition duration-200">
                                                <option disabled selected value="">Choose Ibadan Office Address</option>
                                                <option value="Onireke licencing office dugbe, Ibadan Nigeria.">
                                                    Onireke Licensing Office Dugbe
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden Fields -->
                                @if(isset($item))
                                    <input type="hidden" name="process_type" value="{{ $item->model->process_type ?? '' }}">
                                    <input type="hidden" name="process_id" value="{{ $item->model->process_id ?? '' }}">
                                @endif
                                <input type="hidden" name="fullname" value="{{ $fullname ?? '' }}">
                                <input type="hidden" name="email" value="{{ $email ?? '' }}">
                                <input type="hidden" name="orderNo" value="{{ $orderNumber ?? '' }}">
                                <input type="hidden" name="total" id="totalInput" value="{{ $totalToDisplay ?? 0 }}">

                                <!-- Submit Button -->
                                <div class="mt-6 text-center">
                                    <button type="submit" 
                                            class="inline-flex items-center px-8 py-3 bg-[#142444] hover:bg-[#0f1c38] text-white font-semibold rounded-xl transition duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <i class="bx bx-lock-alt mr-2"></i>
                                        Make Payment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
    
    /* Focus styles */
    *:focus-visible {
        outline: 2px solid #142444;
        outline-offset: 2px;
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
    document.addEventListener('DOMContentLoaded', function() {
        // Delivery Option Toggle
        const deliverySelect = document.getElementById('deliveryOption');
        const emailContainer = document.getElementById('emailContainer');
        const locationContainer = document.getElementById('locationContainer');
        const addressContainer = document.getElementById('addressContainer');
        const branchContainer = document.getElementById('branchContainer');
        
        // Location Branch Toggle
        const locationSelect = document.getElementById('locationSelect');
        const lagosBranches = document.getElementById('lagosBranches');
        const abujaBranches = document.getElementById('abujaBranches');
        const portharcourtBranches = document.getElementById('portharcourtBranches');
        const abeokutaBranches = document.getElementById('abeokutaBranches');
        const ibadanBranches = document.getElementById('ibadanBranches');

        // Delivery Option Change
        if (deliverySelect) {
            deliverySelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const selectedType = selectedOption.dataset.type;

                // Hide all
                if (emailContainer) emailContainer.classList.add('hidden');
                if (locationContainer) locationContainer.classList.add('hidden');
                if (addressContainer) addressContainer.classList.add('hidden');
                if (branchContainer) branchContainer.classList.add('hidden');

                // Show relevant
                if (selectedType === 'email') {
                    if (emailContainer) emailContainer.classList.remove('hidden');
                } else if (selectedType === 'pickup') {
                    if (locationContainer) locationContainer.classList.remove('hidden');
                } else if (selectedType === 'delivery') {
                    if (addressContainer) addressContainer.classList.remove('hidden');
                }
            });
        }

        // Location Change
        if (locationSelect) {
            locationSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const selectedId = selectedOption.dataset.id;

                // Hide all branches
                if (lagosBranches) lagosBranches.classList.add('hidden');
                if (abujaBranches) abujaBranches.classList.add('hidden');
                if (portharcourtBranches) portharcourtBranches.classList.add('hidden');
                if (abeokutaBranches) abeokutaBranches.classList.add('hidden');
                if (ibadanBranches) ibadanBranches.classList.add('hidden');

                // Show relevant branch
                if (selectedId === 'lagos') {
                    if (lagosBranches) lagosBranches.classList.remove('hidden');
                    if (branchContainer) branchContainer.classList.remove('hidden');
                } else if (selectedId === 'abuja') {
                    if (abujaBranches) abujaBranches.classList.remove('hidden');
                    if (branchContainer) branchContainer.classList.remove('hidden');
                } else if (selectedId === 'portharcourt') {
                    if (portharcourtBranches) portharcourtBranches.classList.remove('hidden');
                    if (branchContainer) branchContainer.classList.remove('hidden');
                } else if (selectedId === 'abeokuta') {
                    if (abeokutaBranches) abeokutaBranches.classList.remove('hidden');
                    if (branchContainer) branchContainer.classList.remove('hidden');
                } else if (selectedId === 'ibadan') {
                    if (ibadanBranches) ibadanBranches.classList.remove('hidden');
                    if (branchContainer) branchContainer.classList.remove('hidden');
                }
            });
        }

        // Wallet Balance Toggle
        const walletCheckbox = document.getElementById('use_wallet_balance');
        const totalDisplay = document.getElementById('total-amount-display');
        const totalInput = document.getElementById('totalInput');
        
        if (walletCheckbox && totalDisplay && totalInput) {
            const walletBalance = {{ $walletBalance ?? 0 }};
            const initialTotal = {{ $totalToDisplay ?? 0 }};

            walletCheckbox.addEventListener('change', function() {
                let updatedTotal = initialTotal;
                
                if (this.checked) {
                    updatedTotal = Math.max(0, initialTotal - walletBalance);
                }
                
                const formattedTotal = '₦' + updatedTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                totalDisplay.innerText = formattedTotal;
                totalInput.value = updatedTotal;
            });
        }
    });
</script>
@endpush
@endsection