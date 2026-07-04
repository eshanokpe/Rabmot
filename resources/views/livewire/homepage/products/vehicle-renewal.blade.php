<div style="padding:80px 0; background:#f7f9fc; min-height:100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1"></div>

            <!-- Left Panel -->
            <div class="col-lg-3 mb-4">
                <div style="background:linear-gradient(145deg,#0d2b52,#173f73); border-radius:20px; overflow:hidden; position:sticky; top:20px; color:#fff; box-shadow:0 20px 40px rgba(0,0,0,.15);">
                    <div style="padding:28px;">
                        <div style="display:inline-flex; align-items:center; padding:8px 18px; border-radius:30px; background:rgba(255,255,255,.15); font-size:14px; font-weight:600;">
                            <i class="fas fa-sync-alt mr-2"></i> Renewal Service
                        </div>
                        <h2 style="font-size:28px; font-weight:700; margin-top:20px;">
                            Vehicle Papers Renewal
                        </h2>
                        <p style="opacity:.9; line-height:1.8; margin:20px 0 30px; color:#fff;">
                            Renew your vehicle documents online without visiting a licensing office.
                        </p>
                        <div style="display:flex; align-items:center; padding:15px; background:rgba(255,255,255,.08); border-radius:15px; margin-bottom:20px;">
                            <div style="width:55px; height:55px; border-radius:50%; background:#fff; color:#173f73; display:flex; align-items:center; justify-content:center; font-size:22px; margin-right:15px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <small class="text-light">Estimated Processing</small>
                                <h6 class="mb-0 text-white">3 – 7 Working Days</h6>
                            </div>
                        </div>
                        <div class="alert" style="background:rgba(255,255,255,.1); border:none; border-radius:12px; color:#fff;">
                            <strong><i class="fas fa-exclamation-triangle mr-1"></i> NOTE:</strong><br>
                            <small>Select Hackney Permit for commercial vehicles, taxis and company vehicles.</small>
                        </div>
                        <div style="margin-top:20px;">
                            <h5 style="margin-bottom:15px;"><i class="fas fa-clipboard-check mr-2"></i> Instructions</h5>
                            <ul style="list-style:none; padding:0;">
                                <li style="margin-bottom:12px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Enter your contact details</li>
                                <li style="margin-bottom:12px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Select your vehicle type and state</li>
                                <li style="margin-bottom:12px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Choose renewal services needed</li>
                                <li style="margin-bottom:12px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Upload the required documents</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="col-lg-7">
                <div style="background:#fff; border-radius:15px; padding:35px; box-shadow:0 5px 25px rgba(0,0,0,.08);">

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Stepper -->
                    <div style="margin-bottom:40px;">
                        <div style="display:flex; justify-content:space-between; align-items:center; position:relative;">
                            @for($i = 1; $i <= 6; $i++)
                                <div style="flex:1; text-align:center; position:relative; z-index:2;">
                                    <div style="width:42px; height:42px; line-height:42px; margin:auto; border-radius:50%; background:{{ $i < $step ? '#28a745' : ($i == $step ? '#142444' : '#dee2e6') }}; color:{{ $i <= $step ? '#fff' : '#6c757d' }}; font-weight:700; font-size:14px; transition:.3s;">
                                        {{ $i < $step ? '✓' : $i }}
                                    </div>
                                    <p style="margin-top:8px; font-size:11px; font-weight:600;">
                                        @switch($i)
                                            @case(1) Start @break
                                            @case(2) Contact @break
                                            @case(3) Services @break
                                            @case(4) Documents @break
                                            @case(5) Review @break
                                            @case(6) Payment @break
                                        @endswitch
                                    </p>
                                </div>
                            @endfor
                            <div style="position:absolute; top:21px; left:8%; width:84%; height:3px; background:#dee2e6; z-index:1;"></div>
                        </div>
                    </div>

                    <form wire:submit.prevent="nextStep" novalidate>

                        {{-- Step 1: Start --}}
                        @if($step == 1)
                        <div class="text-center py-5">
                            <h3 style="color:#142444; font-weight:700; margin-bottom:20px;">Start Your Renewal</h3>
                            <p class="text-muted mb-4">Select the documents you need renewed and upload them in one simple process.</p>
                            <div class="alert alert-info text-left mb-5">
                                <h6><i class="fas fa-info-circle mr-2"></i> Before you begin:</h6>
                                <ul class="mb-0">
                                    <li>Know your vehicle type and state of registration</li>
                                    <li>Decide which renewal services you need</li>
                                    <li>Have the relevant documents ready to upload (PDF, JPG or PNG, max 2MB each)</li>
                                </ul>
                            </div>
                            <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                                Start Renewal <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                        @endif

                        {{-- Step 2: Contact Info --}}
                        @if($step == 2)
                        <div>
                            <h4 style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Contact Information</h4>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" wire:model.live="full_name">
                                    @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" wire:model.live="phone">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.live="email">
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 3: Vehicle & Services --}}
                        @if($step == 3)
                        <div>
                            <h4 style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Vehicle & Renewal Services</h4>

                            @if(session('error'))
                                <div class="alert alert-warning">{{ session('error') }}</div>
                            @endif

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <select class="form-control @error('state') is-invalid @enderror" wire:model.live="state">
                                        <option value="">Select State</option>
                                        <option>Lagos</option>
                                        <option>Ogun</option>
                                        <option>Oyo</option>
                                        <option>Osun</option>
                                        <option>Abia</option>
                                        <option>Abuja</option>
                                        <option>Rivers</option>
                                    </select>
                                    @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('vehicle_type') is-invalid @enderror" wire:model.live="vehicle_type">
                                        <option value="">Select Vehicle Type</option>
                                        <option>Saloon</option>
                                        <option>SUV</option>
                                        <option>Coaster</option>
                                        <option>Truck - 15 Tons</option>
                                        <option>Truck - 20 Tons</option>
                                        <option>Truck - 30 Tons</option>
                                    </select>
                                    @error('vehicle_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-light py-2">
                                            <small class="text-muted font-weight-bold text-uppercase">Select Renewal Services</small>
                                        </div>
                                        <div class="list-group list-group-flush">
                                            @foreach($services as $key => $svc)
                                            <label for="svc_{{ $key }}"
                                                class="list-group-item list-group-item-action d-flex align-items-center mb-0"
                                                style="cursor:pointer; padding:14px 18px; {{ ${'svc_'.$key} ? 'background:#f0f7ff; border-left:3px solid #142444;' : 'border-left:3px solid transparent;' }}">
                                                <input type="checkbox"
                                                    id="svc_{{ $key }}"
                                                    wire:model.live="svc_{{ $key }}"
                                                    style="width:18px; height:18px; margin-right:14px; flex-shrink:0; cursor:pointer; accent-color:#142444;">
                                                <span style="flex:1; font-weight:{{ ${'svc_'.$key} ? '600' : '400' }}; color:{{ ${'svc_'.$key} ? '#142444' : '#495057' }};">
                                                    {{ $svc['label'] }}
                                                </span>
                                                <span style="font-weight:600; color:{{ ${'svc_'.$key} ? '#142444' : '#6c757d' }}; white-space:nowrap;">
                                                    ₦{{ number_format($svc['price']) }}
                                                </span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="card shadow-sm sticky-top" style="top:80px;">
                                        <div class="card-header text-white" style="background:#142444;">Renewal Summary</div>
                                        <div class="card-body">
                                            <p class="mb-1"><strong>State:</strong> {{ $state ?: '-' }}</p>
                                            <p class="mb-3"><strong>Vehicle:</strong> {{ $vehicle_type ?: '-' }}</p>
                                            <hr>
                                            <h6>Selected Services</h6>
                                            @if(count($selectedServices) > 0)
                                                <ul class="pl-3 mb-3">
                                                    @foreach($selectedServices as $key => $svc)
                                                        <li>{{ $svc['label'] }} — ₦{{ number_format($svc['price']) }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="text-muted small">No service selected</p>
                                            @endif
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong>Estimated Total</strong>
                                                <h5 class="mb-0 text-success">₦{{ number_format($total) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 4: Documents --}}
                        @if($step == 4)
                        <div>
                            <h4 style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Upload Required Documents</h4>
                            <div class="alert alert-info mb-4">Upload one document per selected service. Accepted: JPG, PNG, PDF (max 2MB each).</div>
                            <div class="row">
                                @foreach($selectedServices as $key => $svc)
                                <div class="col-md-6 mb-4">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <label class="form-label">{{ $svc['label'] }} <span class="text-danger">*</span></label>
                                            <input type="file"
                                                class="form-control @error('doc_'.$key) is-invalid @enderror"
                                                wire:model.live="doc_{{ $key }}"
                                                accept=".jpg,.jpeg,.png,.pdf"
                                                wire:loading.attr="disabled"
                                                wire:target="{{ collect($selectedServices)->keys()->map(fn($k) => 'doc_'.$k)->implode(',') }}">
                                            @error('doc_'.$key) <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            <div wire:loading wire:target="doc_{{ $key }}"><small class="text-muted"><i class="fas fa-spinner fa-spin"></i> Uploading...</small></div>
                                            @if(${'doc_'.$key} ?? null)
                                                <small class="text-success d-block mt-1"><i class="fas fa-check-circle"></i> File selected</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row mt-2">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 5: Review --}}
                        @if($step == 5)
                        <div>
                            <h4 style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Review Your Application</h4>
                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                    <strong>Contact & Vehicle Details</strong>
                                    <button type="button" wire:click="goToStep(2)" class="btn btn-sm btn-outline-primary">Edit</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="40%">Full Name</th><td>{{ $full_name }}</td></tr>
                                        <tr><th>Phone / Email</th><td>{{ $phone }} / {{ $email }}</td></tr>
                                        <tr><th>State</th><td>{{ $state }}</td></tr>
                                        <tr><th>Vehicle Type</th><td>{{ $vehicle_type }}</td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                    <strong>Selected Renewal Services</strong>
                                    <button type="button" wire:click="goToStep(3)" class="btn btn-sm btn-outline-primary">Edit</button>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        @foreach($selectedServices as $key => $svc)
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>{{ $svc['label'] }}</span>
                                            <strong>₦{{ number_format($svc['price']) }}</strong>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-success border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><strong>Vehicle Papers Renewal</strong><br><span class="text-muted">Total Application Fee</span></div>
                                    <h4 class="mb-0 text-success font-weight-bold">₦{{ number_format($total) }}</h4>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-success">Proceed to Payment <i class="fas fa-lock"></i></button></div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 6: Payment --}}
                        @if($step == 6)
                        <div>
                            <div class="text-center mb-5">
                                <div style="width:90px; height:90px; margin:auto; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-size:38px; color:#142444;">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h3 class="mt-3" style="color:#142444; font-weight:700;">Payment Summary</h3>
                                <p class="text-muted">Review before making payment.</p>
                            </div>
                            <div class="card shadow-sm mb-4 border-0">
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><td>Applicant</td><td class="text-right">{{ $full_name }}</td></tr>
                                        <tr><td>State / Vehicle</td><td class="text-right">{{ $state }} / {{ $vehicle_type }}</td></tr>
                                    </table>
                                    <hr>
                                    <h6 class="mb-3">Services Breakdown</h6>
                                    @foreach($selectedServices as $key => $svc)
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <span>{{ $svc['label'] }}</span>
                                        <strong>₦{{ number_format($svc['price']) }}</strong>
                                    </div>
                                    @endforeach
                                    <div class="d-flex justify-content-between pt-3">
                                        <strong style="font-size:16px;">Total</strong>
                                        <strong class="text-success" style="font-size:18px;">₦{{ number_format($total) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info"><i class="fas fa-info-circle mr-2"></i> After payment, your application will be submitted and a receipt sent to your email.</div>
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @include('livewire.homepage.products.partials.account-login-prompt')
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-success btn-lg px-5" wire:click="processPayment" wire:loading.attr="disabled">
                                        <span wire:loading.remove><i class="fas fa-lock mr-2"></i> Pay ₦{{ number_format($total) }}</span>
                                        <span wire:loading><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus { border-color: #142444 !important; box-shadow: 0 0 0 0.2rem rgba(20,36,68,0.15) !important; }
.invalid-feedback { display: block !important; color: #dc2626 !important; font-size: 0.875rem; margin-top: 0.25rem; }
.form-control.is-invalid { border-color: #dc2626 !important; }
.btn-primary-custom { background: #142444; border: none; color: white; }
.btn-primary-custom:hover { background: #0f1c38; color: white; }
</style>
