<div class="intl-license-page" style="padding:80px 0; background:#f7f9fc; min-height:100vh;">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Panel - Service Info -->
            <div class="col-lg-1"></div>
            <div class="col-lg-3 mb-4">
                <div class="service-banner" style="background:linear-gradient(145deg,#0d2b52,#173f73); border-radius:20px; overflow:hidden; position:sticky; top:20px; color:#fff; box-shadow:0 20px 40px rgba(0,0,0,.15);">
                    <div class="service-overlay" style="padding:28px;">
                        <div class="service-badge" style="display:inline-flex; align-items:center; padding:8px 18px; border-radius:30px; background:rgba(255,255,255,.15); font-size:14px; font-weight:600;">
                            <i class="fas fa-car mr-2"></i>
                            Vehicle Service
                        </div>
                        <h2 class="service-title" style="font-size:32px; font-weight:700; margin-top:20px;">
                            New Vehicle Registration
                        </h2>
                        <p class="service-description" style="opacity:.9; line-height:1.8; margin:20px 0 30px; color:#fff">
                            Register your new vehicle in Lagos State. Complete your application online and pay securely.
                        </p>
                        <div class="info-card" style="display:flex; align-items:center; padding:15px; background:rgba(255,255,255,.08); border-radius:15px; margin-bottom:20px;">
                            <div class="icon" style="width:55px; height:55px; border-radius:50%; background:#fff; color:#173f73; display:flex; align-items:center; justify-content:center; font-size:22px; margin-right:15px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <small class="text-light">Estimated Processing</small>
                                <h6 class="mb-0 text-white">5 – 7 Working Days</h6>
                            </div>
                        </div>
                        <div class="requirements-card" style="margin-top:30px;">
                            <h5 style="margin-bottom:20px;"><i class="fas fa-clipboard-check mr-2"></i> Requirements</h5>
                            <ul style="list-style:none; padding:0;">
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Valid NIN</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Purchase Receipt / Custom Papers</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Clear Photo of Chassis Number</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Valid Email & Phone Number</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="col-lg-7">
                <div class="application-card" style="background:#fff; border-radius:15px; padding:35px; box-shadow:0 5px 25px rgba(0,0,0,.08);">

                    <!-- Stepper -->
                    <div class="wizard-wrapper" style="margin-bottom:40px;">
                        <div class="wizard-steps" style="display:flex; justify-content:space-between; align-items:center; position:relative;">
                            @for($i = 1; $i <= 6; $i++)
                                <div class="wizard-step {{ $i < $step ? 'completed' : ($i == $step ? 'active' : '') }}" 
                                     style="flex:1; text-align:center; position:relative; z-index:2;">
                                    <div class="circle" style="width:45px; height:45px; line-height:45px; margin:auto; border-radius:50%; background:{{ $i < $step ? '#28a745' : ($i == $step ? '#142444' : '#dee2e6') }}; color:{{ $i <= $step ? '#fff' : '#6c757d' }}; font-weight:700; transition:.3s;">
                                        {{ $i }}
                                    </div>
                                    <p style="margin-top:10px; font-size:13px; font-weight:600;">
                                        @switch($i)
                                            @case(1) Start @break
                                            @case(2) Owner Info @break
                                            @case(3) Vehicle Info @break
                                            @case(4) Documents @break
                                            @case(5) Review @break
                                            @case(6) Payment @break
                                        @endswitch
                                    </p>
                                </div>
                            @endfor
                            <div class="wizard-line" style="position:absolute; top:22px; left:10%; width:80%; height:3px; background:#dee2e6; z-index:1;"></div>
                        </div>
                    </div>

                    <form wire:submit.prevent="nextStep" novalidate>
                        <!-- Step 1: Start -->
                        @if($step == 1)
                        <div class="step-content text-center py-5">
                            <div style="max-width: 600px; margin: 0 auto;">
                                <h3 style="color:#142444; font-weight:700; margin-bottom:20px;">Start Your Application</h3>
                                <p class="text-muted mb-4">This process takes 5–10 minutes. You can complete it without logging in — account creation is optional after payment.</p>
                                <div class="alert alert-info text-left mb-5">
                                    <h6><i class="fas fa-info-circle mr-2"></i> Before you begin, please have ready:</h6>
                                    <ul class="mb-0">
                                        <li>Your valid NIN and NIN slip</li>
                                        <li>Vehicle purchase receipt or customs papers</li>
                                        <li>Clear photo of the vehicle chassis number</li>
                                        <li>Active phone number and email address</li>
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                                    Start Application <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Step 2: Owner Info -->
                        @if($step == 2)
                        <div class="step-content">
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Owner Information</h4>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Surname <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('surname') is-invalid @enderror" wire:model.live="surname">
                                    @error('surname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" wire:model.live="firstname">
                                    @error('firstname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Other Name</label>
                                    <input type="text" class="form-control" wire:model.live="othername">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control @error('gender') is-invalid @enderror" wire:model.live="gender">
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Marital Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('marital_status') is-invalid @enderror" wire:model.live="marital_status">
                                        <option value="">Select</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                    @error('marital_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror" wire:model.live="dob">
                                    @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="Lagos" readonly>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Local Government <span class="text-danger">*</span></label>
                                    <select class="form-control @error('lga') is-invalid @enderror" wire:model.live="lga">
                                        <option value="">Select LGA</option>
                                        @foreach($lagos_lgas as $lga)
                                            <option value="{{ $lga }}">{{ $lga }}</option>
                                        @endforeach
                                    </select>
                                    @error('lga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Residential Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" wire:model.live="address" rows="2"></textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">NIN (11 digits) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nin') is-invalid @enderror" wire:model.live="nin" maxlength="11">
                                    @error('nin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        <!-- Step 3: Vehicle Info -->
                        @if($step == 3)
                        <div class="step-content">
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Vehicle Information</h4>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Chassis Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('chassis_number') is-invalid @enderror" wire:model.live="chassis_number">
                                    @error('chassis_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Engine Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('engine_number') is-invalid @enderror" wire:model.live="engine_number">
                                    @error('engine_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Vehicle Make <span class="text-danger">*</span></label>
                                    <select class="form-control @error('vehicle_make') is-invalid @enderror" wire:model.live="vehicle_make">
                                        <option value="">Select Make</option>
                                        @foreach($vehicle_makes as $make)
                                            <option value="{{ $make }}">{{ $make }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_make') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Vehicle Model <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('vehicle_model') is-invalid @enderror" wire:model.live="vehicle_model">
                                    @error('vehicle_model') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Year of Manufacture <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" wire:model.live="year" min="1990" max="{{ date('Y') }}">
                                    @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Color <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" wire:model.live="color">
                                    @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Fuel Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('fuel_type') is-invalid @enderror" wire:model.live="fuel_type">
                                        <option value="">Select</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                    @error('fuel_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        <!-- Step 4: Documents -->
                        @if($step == 4)
                        <div class="step-content">
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Document Upload</h4>
                            <p class="text-muted mb-4">All files must be under 2MB. Accepted formats: JPG, PNG, PDF.</p>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Custom Papers / Purchase Receipt <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('doc_custom_papers') is-invalid @enderror" wire:model.live="doc_custom_papers">
                                    @error('doc_custom_papers') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Photo of Chassis Number <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('doc_chassis_photo') is-invalid @enderror" wire:model.live="doc_chassis_photo">
                                    @error('doc_chassis_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">NIN Slip <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('doc_nin_slip') is-invalid @enderror" wire:model.live="doc_nin_slip">
                                    @error('doc_nin_slip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Proof of Address (Optional)</label>
                                    <input type="file" class="form-control" wire:model.live="doc_address_proof">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        <!-- Step 5: Review -->
                        @if($step == 5)
                        <div class="step-content">
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Review Your Application</h4>
                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light"><strong>Owner Details</strong><button wire:click="goToStep(2)" class="btn btn-sm btn-outline-primary">Edit</button></div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="35%">Full Name</th><td>{{ $surname }} {{ $firstname }} {{ $othername }}</td></tr>
                                        <tr><th>Gender</th><td>{{ $gender }}</td></tr>
                                        <tr><th>Address</th><td>{{ $address }}, {{ $lga }}, {{ $state }}</td></tr>
                                        <tr><th>Phone / Email</th><td>{{ $phone }} / {{ $email }}</td></tr>
                                        <tr><th>NIN</th><td>{{ $nin }}</td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light"><strong>Vehicle Details</strong><button wire:click="goToStep(3)" class="btn btn-sm btn-outline-primary">Edit</button></div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="35%">Make / Model</th><td>{{ $vehicle_make }} {{ $vehicle_model }}</td></tr>
                                        <tr><th>Year / Color</th><td>{{ $year }} / {{ $color }}</td></tr>
                                        <tr><th>Chassis Number</th><td>{{ $chassis_number }}</td></tr>
                                        <tr><th>Engine Number</th><td>{{ $engine_number }}</td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="alert alert-success border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><strong>New Vehicle Registration (Lagos)</strong><br><span class="text-muted">Application Fee</span></div>
                                    <h4 class="mb-0 text-success font-weight-bold">₦{{ number_format($total, 2) }}</h4>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-success">Proceed to Payment <i class="fas fa-lock"></i></button></div>
                            </div>
                        </div>
                        @endif

                        <!-- Step 6: Payment -->
                        @if($step == 6)
                        <div class="step-content">
                            <div class="text-center mb-5">
                                <div class="payment-icon" style="width:90px; height:90px; margin:auto; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-size:38px; color:#142444;">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h3 class="mt-3" style="color:#142444; font-weight:700;">Payment Summary</h3>
                                <p class="text-muted">Review your details before making payment.</p>
                            </div>
                            <div class="card shadow-sm mb-4 border-0">
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><td>Service Fee</td><td class="text-right">₦{{ number_format($service_fee, 2) }}</td></tr>
                                        <tr><td>Processing Fee</td><td class="text-right">₦{{ number_format($processing_fee, 2) }}</td></tr>
                                        <tr class="border-top"><th>Total</th><th class="text-right text-success pt-2" style="font-size:18px;">₦{{ number_format($total, 2) }}</th></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="alert alert-info"><i class="fas fa-info-circle mr-2"></i> After payment, your application will be submitted and a receipt sent to your email.</div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-success btn-lg px-5" wire:click="processPayment" wire:loading.attr="disabled">
                                        <span wire:loading.remove><i class="fas fa-lock mr-2"></i> Pay ₦{{ number_format($total, 2) }}</span>
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