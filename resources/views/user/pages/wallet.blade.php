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
					<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
						<div class="breadcrumb-title pe-3">Wallet</div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="{{ route('agent.index') }}"><i class="bx bx-car"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">My Wallet <i class="bx bx-wallet" style="color:green;"></i></li>
								</ol>
							</nav>
						</div> 
						
					</div>
					<!--end breadcrumb-->
                    <div class="user-profile-page">
                        <div class="card">
						<div class="card-body">
							<div class="card-title">
								<h4 class="mb-0">My Wallet</h4>
							</div>
							<hr/>
							<div class="row">
								@if (session('success'))
									<div class="col-sm-12">
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											{{ session('success') }}
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>

									</div>
								@endif
								@if (session('error'))
									<div class="col-sm-12">
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											{{ session('error') }}
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>

									</div>
								@endif
                                <div class="col-xl-4 col-md-6 p-2">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="mb-1 text-muted">Wallet balance</h6>
                                                    <span class="mb-0 h5 font-weight-bold">₦ {{number_format($walletBalance, 2,'.',',')}}</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="">
                                                        <i class="bx bx-wallet" style="font-size: 24px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 p-2">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="mb-1 text-muted">Total Earnings</h6>
                                                    <span class="mb-0 h5 font-weight-bold">₦ {{number_format($totalEarning, 2,'.',',')}}</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="">
                                                        <i class="bx bxs-coin-stack" style="font-size: 24px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 p-2">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="mb-1 text-muted">Total Withdraw</h6>
                                                    <span class="mb-0 h5 font-weight-bold">₦ {{number_format($totalWithdrawAmount, 2,'.',',')}}</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="">
                                                        <i class="bx bx-wallet" style="font-size: 24px;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6 p-2">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="card-title">
                								<h5 class="mb-0">Withdraw</h5>
                							</div>
						                    <form class="form-horizontal form-material" action="{{ route('agent.create')}}" method="POST">
                                                @csrf
                                                <div class="form-group col-md-12 mb-3">
                                                    <label for="amount">Amount(NGN)</label>
                                                    <input type="number" placeholder="Enter amount" class="form-control" name="amount" value="" required=""> 
                                                </div>
                                                <div class="form-group col-md-12 mb-3">
                                                    <label for="amount">Bank Type</label>
                                                    <input type="text" placeholder="Enter bank name " class="form-control" name="bank"  required=""> 
                                                </div>
                                                <div class="form-group col-md-12 mb-3">
                                                    <label for="amount">Account Number</label>
                                                    <input type="text" placeholder="Enter account number" class="form-control" name="account_number"  required=""> 
                                                </div>
                                                <div class="form-group col-md-12 mb-3">
                                                    <label for="amount">Account Name</label>
                                                    <input type="text" placeholder="Enter account name" class="form-control" name="account_name"  required=""> 
                                                </div>
                                                
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Proceed to withdraw</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 p-2">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="card-title">
                								<h5 class="mb-0">Withdrawal History</h5>
                								<div class="table-responsive">
                    								<table id="example" class="table table-striped table-bordered" style="width:100%">
                    									<thead>
                    										<tr>
                                                                <th>S/N</th>
                    											<th>Amount(NGN)</th>
                    											<th>Withdrawal Account</th>
                    											<th>Bank</th>
                    											<th>Account Name</th>
                    											<th>Status</th>
                    											<th>Date</th>
                    											
                    										</tr>
                    									</thead>
                    									<tbody>
															@php
																$serial = 1;
															@endphp
															@forelse ($items as $item)
																<tr>
																	<td>{{$serial ++}}</td>
																	<td>₦{{ number_format($item->amount,2, '.', ',') }}</td>
																	<td>{{$item->account_number}}</td>
																	<td>{{$item->bank}}</td>
																	<td>{{$item->account_name}}</td>
																	
																	@if( $item->status == 0 )
																		<td class="badge badge-success pending text-center mt-2"> Pending </td>
																	@elseif ( $item->status == 1 )
																		<td  class="badge badge-success processing mt-2"> Processing </td>
																	@elseif ( $item->status == 2 )
																		<td style="align-items: center"  class="mt-2 badge badge-success delivery">Paid</td>
																	
																	@endif
																	 
																	<td>
																		@php							
																			$date = \Carbon\Carbon::parse($item->created_at);							
																		@endphp							
																		{{ $date->format('F j, Y H:i:s A') }}							
																	</td>
																</tr>
															@empty
																<p class="text-danger">No data found</p>
															@endforelse
                    									   
                    									</tbody>
                    								</table>
                    				            </div>
                							</div>
                						</div>
				                    </div>
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
@endsection