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
								<h1 class="text-2xl font-bold text-gray-900">Transaction History</h1>
								<p class="text-sm text-gray-500 mt-1">View and track all your transactions</p>
							</div>
							<div class="flex items-center gap-3">
								<button onclick="window.print()" 
										class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg transition duration-200 text-sm font-medium">
									<i class="bx bx-printer mr-2"></i>
									Print
								</button>
								<a href="{{ route('home') }}" 
								class="inline-flex items-center px-4 py-2 bg-[#142444] hover:bg-[#0f1c38] text-white rounded-lg transition duration-200 text-sm font-medium">
									<i class="bx bx-arrow-back mr-2"></i>
									Back to Dashboard
								</a>
							</div>
						</div>
					</div>

					<!-- Stats Cards -->
					@if($transactionhistory->count() > 0)
						<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
							<div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
								<div class="flex items-center justify-between">
									<div>
										<p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Total Transactions</p>
										<h3 class="text-2xl font-bold text-gray-900">{{ $transactionhistory->count() }}</h3>
									</div>
									<div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
										<i class="bx bx-receipt text-blue-600 text-xl"></i>
									</div>
								</div>
							</div>
							
							<div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
								<div class="flex items-center justify-between">
									<div>
										<p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Pending</p>
										<h3 class="text-2xl font-bold text-yellow-600">
											{{ $transactionhistory->where('status', 0)->count() }}
										</h3>
									</div>
									<div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
										<i class="bx bx-time text-yellow-600 text-xl"></i>
									</div>
								</div>
							</div>
							
							<div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-orange-500">
								<div class="flex items-center justify-between">
									<div>
										<p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Processing</p>
										<h3 class="text-2xl font-bold text-orange-600">
											{{ $transactionhistory->where('status', 1)->count() }}
										</h3>
									</div>
									<div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
										<i class="bx bx-loader-circle text-orange-600 text-xl"></i>
									</div>
								</div>
							</div>
							
							<div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
								<div class="flex items-center justify-between">
									<div>
										<p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Completed</p>
										<h3 class="text-2xl font-bold text-green-600">
											{{ $transactionhistory->where('status', 4)->count() }}
										</h3>
									</div>
									<div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
										<i class="bx bx-check-circle text-green-600 text-xl"></i>
									</div>
								</div>
							</div>
						</div>
					@endif

					<!-- Main Content -->
					<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
						<div class="p-6">
							<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
								<div>
									<h2 class="text-lg font-semibold text-gray-900">Transactions</h2>
									<p class="text-sm text-gray-500">
										{{ $transactionhistory->count() }} transaction(s) found
									</p>
								</div>
								<div class="flex items-center gap-2">
									<div class="relative">
										<input type="text" 
											placeholder="Search transactions..." 
											class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142444] focus:border-[#142444] text-sm w-full sm:w-64">
										<i class="bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
									</div>
								</div>
							</div>

							@if($transactionhistory->count() > 0)
								<!-- Desktop Table -->
								<div class="hidden md:block overflow-x-auto">
									<table class="w-full">
										<thead>
											<tr class="border-b border-gray-200">
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">S/N</th>
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Order ID</th>
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Process Type</th>
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Email</th>
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Description</th>
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Amount</th>
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Status</th>
												<th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-2">Date</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($transactionhistory as $index => $history)
												<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
													<td class="py-3 px-2 text-sm text-gray-600">{{ $index + 1 }}</td>
													<td class="py-3 px-2 text-sm font-medium text-gray-900">{{ $history->process_id }}</td>
													<td class="py-3 px-2 text-sm text-gray-600">
														<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
															{{ $history->process_type }}
														</span>
													</td>
													<td class="py-3 px-2 text-sm text-gray-600">{{ $history->user_email }}</td>
													<td class="py-3 px-2 text-sm text-gray-600 max-w-xs">
														<div class="truncate">
															@if($history->process_type == 'Other Permit')
																{{ $history->process_DPN_processtype }}
															@elseif($history->process_type == 'Vehicle Paper Renewal')
																{{ $history->process_type }}
															@elseif($history->process_type == 'Vehicle Registration')
																{{ $history->process_VR_name }},
																{{ $history->process_VR_vehicleregistrationType }}
																@if($history->process_VR_numberplate == 'PCN')
																	<br>Personalized: {{ $history->process_VR_preferrednumber }}
																@elseif($history->process_VR_numberplate == 'RPN')
																	<br>Random Plate Number
																@endif
															@elseif($history->process_type == 'Change of Ownership')
																{{ $history->process_CO_vc }}, 
																{{ $history->process_CO_vl }}
															@elseif($history->process_type == 'Dealer`s Plate Number')
																{{ $history->process_DPN_processtype }}, 
																{{ $history->process_DPN_fullname }}
															@elseif($history->process_type == 'New Driver License')
																Validity: {{ $history->process_NDL_lengthofyear }} Years
															@elseif($history->process_type == 'Driver License Renewal')
																Validity: {{ $history->process_DLR_lengthofyears }} Years
															@elseif($history->process_type == 'International Driver’s License')
																Validity: {{ $history->process_DLR_lengthofyears }} Years
															@endif
														</div>
													</td>
													<td class="py-3 px-2 text-sm font-semibold text-gray-900">
														₦{{ number_format($history->totalamount) }}
													</td>
													<td class="py-3 px-2">
														@php
															$statusMap = [
																0 => ['label' => 'Pending', 'class' => 'bg-yellow-100 text-yellow-800'],
																1 => ['label' => 'Processing', 'class' => 'bg-orange-100 text-orange-800'],
																2 => ['label' => 'Ready for Delivery', 'class' => 'bg-blue-100 text-blue-800'],
																3 => ['label' => 'Delivery in Progress', 'class' => 'bg-purple-100 text-purple-800'],
																4 => ['label' => 'Delivered', 'class' => 'bg-green-100 text-green-800'],
															];
															$status = $statusMap[$history->status] ?? ['label' => 'Unknown', 'class' => 'bg-gray-100 text-gray-800'];
														@endphp
														<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }}">
															<span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $history->status == 0 ? 'bg-yellow-500' : ($history->status == 1 ? 'bg-orange-500' : ($history->status == 4 ? 'bg-green-500' : 'bg-blue-500')) }}"></span>
															{{ $status['label'] }}
														</span>
													</td>
													<td class="py-3 px-2 text-sm text-gray-500">
														{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y') }}
														<br>
														<span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>

								<!-- Mobile Cards -->
								<div class="md:hidden space-y-4">
									@foreach ($transactionhistory as $index => $history)
										@php
											$statusMap = [
												0 => ['label' => 'Pending', 'class' => 'bg-yellow-100 text-yellow-800 border-yellow-500'],
												1 => ['label' => 'Processing', 'class' => 'bg-orange-100 text-orange-800 border-orange-500'],
												2 => ['label' => 'Ready for Delivery', 'class' => 'bg-blue-100 text-blue-800 border-blue-500'],
												3 => ['label' => 'Delivery in Progress', 'class' => 'bg-purple-100 text-purple-800 border-purple-500'],
												4 => ['label' => 'Delivered', 'class' => 'bg-green-100 text-green-800 border-green-500'],
											];
											$status = $statusMap[$history->status] ?? ['label' => 'Unknown', 'class' => 'bg-gray-100 text-gray-800 border-gray-500'];
										@endphp
										<div class="bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md transition-shadow">
											<div class="flex justify-between items-start mb-3">
												<div>
													<p class="text-xs text-gray-500">Order ID</p>
													<p class="font-medium text-gray-900 text-sm">{{ $history->process_id }}</p>
												</div>
												<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }}">
													<span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $history->status == 0 ? 'bg-yellow-500' : ($history->status == 1 ? 'bg-orange-500' : ($history->status == 4 ? 'bg-green-500' : 'bg-blue-500')) }}"></span>
													{{ $status['label'] }}
												</span>
											</div>
											
											<div class="grid grid-cols-2 gap-2 text-sm">
												<div>
													<p class="text-xs text-gray-500">Process Type</p>
													<p class="font-medium text-gray-700">{{ $history->process_type }}</p>
												</div>
												<div>
													<p class="text-xs text-gray-500">Amount</p>
													<p class="font-semibold text-gray-900">₦{{ number_format($history->totalamount) }}</p>
												</div>
												<div class="col-span-2">
													<p class="text-xs text-gray-500">Description</p>
													<p class="text-gray-600 text-sm">
														@if($history->process_type == 'Other Permit')
															{{ $history->process_DPN_processtype }}
														@elseif($history->process_type == 'Vehicle Paper Renewal')
															{{ $history->process_type }}
														@elseif($history->process_type == 'Vehicle Registration')
															{{ $history->process_VR_name }}, {{ $history->process_VR_vehicleregistrationType }}
														@elseif($history->process_type == 'Change of Ownership')
															{{ $history->process_CO_vc }}, {{ $history->process_CO_vl }}
														@elseif($history->process_type == 'Dealer`s Plate Number')
															{{ $history->process_DPN_processtype }}, {{ $history->process_DPN_fullname }}
														@elseif($history->process_type == 'New Driver License')
															Validity: {{ $history->process_NDL_lengthofyear }} Years
														@elseif($history->process_type == 'Driver License Renewal')
															Validity: {{ $history->process_DLR_lengthofyears }} Years
														@elseif($history->process_type == 'International Driver’s License')
															Validity: {{ $history->process_DLR_lengthofyears }} Years
														@endif
													</p>
												</div>
												<div class="col-span-2">
													<p class="text-xs text-gray-500">Date</p>
													<p class="text-gray-600 text-sm">
														{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y') }}
														<span class="text-xs text-gray-400">at {{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>
													</p>
												</div>
												<div class="col-span-2">
													<p class="text-xs text-gray-500">Email</p>
													<p class="text-gray-600 text-sm truncate">{{ $history->user_email }}</p>
												</div>
											</div>
										</div>
									@endforeach
								</div>

								<!-- Pagination -->
								<div class="mt-6 flex items-center justify-between">
									<p class="text-sm text-gray-500">
										Showing <span class="font-medium">{{ $transactionhistory->count() }}</span> transactions
									</p>
									<div class="flex gap-2">
										<button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors disabled:opacity-50" disabled>
											Previous
										</button>
										<button class="px-3 py-1 bg-[#142444] text-white rounded-lg text-sm hover:bg-[#0f1c38] transition-colors">
											1
										</button>
										<button class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
											Next
										</button>
									</div>
								</div>
							@else
								<!-- Empty State -->
								<div class="text-center py-12">
									<div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
										<i class="bx bx-receipt text-3xl text-gray-400"></i>
									</div>
									<h3 class="text-lg font-semibold text-gray-900 mb-2">No Transactions Found</h3>
									<p class="text-gray-500 text-sm max-w-md mx-auto mb-6">
										You haven't made any transactions yet. Start by applying for a service.
									</p>
									<a href="{{ route('home') }}" 
									class="inline-flex items-center px-6 py-3 bg-[#142444] hover:bg-[#0f1c38] text-white font-medium rounded-lg transition duration-200">
										<i class="bx bx-plus-circle mr-2"></i>
										Browse Services
									</a>
								</div>
							@endif
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
    
    /* Table hover effect */
    tbody tr:hover {
        background-color: #f8fafc;
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
        .shadow-sm {
            box-shadow: none !important;
        }
        .border {
            border-color: #e5e7eb !important;
        }
        button, .no-print {
            display: none !important;
        }
    }
    
    /* Status dot pulse animation */
    .status-dot {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.querySelector('input[placeholder="Search transactions..."]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush
@endsection