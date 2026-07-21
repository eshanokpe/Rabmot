@extends('agent.layouts.app')
@section('content')

	<!-- wrapper -->
	<div class="wrapper">
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
						<div class="breadcrumb-title pe-3">Referrals</div>
						<div class="ps-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="{{ route('agent.index') }}"><i class="bx bx-car"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">My Referrals <i class="bx bx-share-alt" style="color:green;"></i></li>
								</ol>
							</nav>
						</div>
					</div>
					<!--end breadcrumb-->
                    <div class="user-profile-page">
                        <div class="card">
							<div class="card-body">
								<div class="card-title">
									<h4 class="mb-0">My Referral Link</h4>
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

                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Referral Code</label>
                                        <input type="text" class="form-control" id="referral-code" value="{{ $agent->referral_code }}" readonly>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Referral Link</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="referral-link" value="{{ $referralLink }}" readonly>
                                            <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText(document.getElementById('referral-link').value)">Copy</button>
                                        </div>
                                        <small class="form-hint">Share this link with other agents. When they register and start completing orders, you earn a commission automatically.</small>
                                    </div>

                                    <div class="col-xl-4 col-md-6 p-2">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6 class="mb-1 text-muted">Agents Referred</h6>
                                                        <span class="mb-0 h5 font-weight-bold">{{ $referredAgents->count() }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="">
                                                            <i class="bx bx-group" style="font-size: 24px;"></i>
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
                                                        <h6 class="mb-1 text-muted">Referral Commission Earned</h6>
                                                        <span class="mb-0 h5 font-weight-bold">₦ {{number_format($totalReferralCommission, 2,'.',',')}}</span>
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
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5 class="mb-0">Agents You Referred</h5>
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Username</th>
                                                        <th>Full Name</th>
                                                        <th>Status</th>
                                                        <th>Joined</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $serial = 1; @endphp
                                                    @forelse ($referredAgents as $referred)
                                                        <tr>
                                                            <td>{{ $serial++ }}</td>
                                                            <td>{{ $referred->username }}</td>
                                                            <td>{{ $referred->fullname }}</td>
                                                            <td>{{ ucfirst($referred->status) }}</td>
                                                            <td>
                                                                @php
                                                                    $date = \Carbon\Carbon::parse($referred->created_at);
                                                                @endphp
                                                                {{ $date->format('F j, Y') }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="5" class="text-danger">You haven't referred any agents yet.</td></tr>
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
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->
	</div>
@endsection
