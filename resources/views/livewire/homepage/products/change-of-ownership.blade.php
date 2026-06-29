<div class="coo-page" style="padding:80px 0; background:#f7f9fc; min-height:100vh;">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Info Panel -->
            <div class="col-lg-1"></div>
            <div class="col-lg-3 mb-4">
                <div class="service-banner" style="background:linear-gradient(145deg,#0d2b52,#173f73); border-radius:20px; overflow:hidden; position:sticky; top:20px; color:#fff; box-shadow:0 20px 40px rgba(0,0,0,.15);">
                    <div class="service-overlay" style="padding:28px;">
                        <div class="service-badge" style="display:inline-flex; align-items:center; padding:8px 18px; border-radius:30px; background:rgba(255,255,255,.15); font-size:14px; font-weight:600;">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            Vehicle Service
                        </div>
                        <h2 class="service-title" style="font-size:32px; font-weight:700; margin-top:20px;">
                            Change of Ownership & Re-Registration
                        </h2>
                        <p class="service-description" style="opacity:.9; line-height:1.8; margin:20px 0 30px;">
                            Transfer vehicle ownership legally and re-register in your name. Fast, secure, and fully online.
                        </p>
                        <div class="info-card" style="display:flex; align-items:center; padding:15px; background:rgba(255,255,255,.08); border-radius:15px; margin-bottom:20px;">
                            <div class="icon" style="width:55px; height:55px; border-radius:50%; background:#fff; color:#173f73; display:flex; align-items:center; justify-content:center; font-size:22px; margin-right:15px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <small class="text-light">Processing Time</small>
                                <h6 class="mb-0 text-white">5 – 7 Working Days</h6>
                            </div>
                        </div>
                        <div class="requirements-card">
                            <h5 style="margin-bottom:20px;"><i class="fas fa-clipboard-check mr-2"></i> Required Documents</h5>
                            <ul style="list-style:none; padding:0;">
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle text-success mr-2"></i> Proof of Ownership</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle text-success mr-2"></i> Valid Vehicle License</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle text-success mr-2"></i> Road Worthiness Certificate</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle text-success mr-2"></i> Agreement Between Parties</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle text-success mr-2"></i> Chassis Number Photo</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle text-success mr-2"></i> New Owner’s NIN Slip</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="col-lg-7">
                <div class="application-card" style="background:#fff; border-radius:15px; padding:35px; box-shadow:0 5px 25px rgba(0,0,0,.08);">

                    <!-- Stepper -->
                    <div class="wizard-wrapper" style="margin-bottom:40px;">
                        <div class="wizard-steps" style="display:flex; justify-content:space-between; align-items:center; position:relative;">
                            @for($i = 1; $i <= 8; $i++)
                                <div class="wizard-step {{ $i < $step ? 'completed' : ($i == $step ? 'active' : '') }}" style="flex:1; text-align:center; position:relative; z-index:2;">
                                    <div class="circle" style="width:40px; height:40px; line-height:40px; margin:auto; border-radius:50%; background:{{ $i < $step ? '#28a745' : ($i == $step ? '#142444' : '#dee2e6') }}; color:{{ $i <= $step ? '#fff' : '#6c757d' }}; font-weight:700;">
                                        {{ $i }}
                                    </div>
                                    <p style="margin-top:8px; font-size:12px; font-weight:500;">
                                        @switch($i)
                                            @case(1) Start @break
                                            @case(2) Owner Info @break
                                            @case(3) Vehicle Info @break
                                            @case(4) Documents @break
                                            @case(5) Review @break
                                            @case(6) Payment @break
                                            @case(7) Account @break
                                            @case(8) Confirm @break
                                        @endswitch
                                    </p>
                                </div>
                            @endfor
                            <div class="wizard-line" style="position:absolute; top:20px; left:5%; width:90%; height:2px; background:#dee2e6; z-index:1;"></div>
                        </div>
                    </div>

                    <form wire:submit.prevent="nextStep" novalidate>
                        <!-- Step 1: Start -->
                        @if($step == 1)
                        <div class="text-center py-5">
                            <h3 style="color:#142444; font-weight:700; margin-bottom:20px;">Change of Ownership Application</h3>
                            <p class="text-muted mb-4">Transfer vehicle ownership into your name. You can complete this without an account — sign up later if you wish.</p>
                            <div class="alert alert-info text-left mb-5">
                                <h6><i class="fas fa-info-circle mr-2"></i> Before you start:</h6>
                                <ul class="mb-0">
                                    <li>Have all required documents ready in JPG/PNG/PDF format</li>
                                    <li>Files must be under 2MB each</li>
                                    <li>Processing takes 5–7 working days after payment</li>
                                </ul>
                            </div>
                            <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                                Start Application <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                        @endif

                        <!-- Step 2: New Owner Info -->
                        @if($step == 2)
                        <div>
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">New Owner Information</h4>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fullname') is-invalid @enderror" wire:model.live="fullname">
                                    @error('fullname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" wire:model.live="date_of_birth">
                                    @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Place of Birth <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" wire:model.live="place_of_birth">
                                    @error('place_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Residential Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" rows="2" wire:model.live="address"></textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Local Government Area <span class="text-danger">*</span></label>
                                    <select class="form-control @error('lga') is-invalid @enderror" wire:model.live="lga">
                                        <option value="">Select LGA</option>
                                        @foreach($lagos_lgas as $lga)
                                            <option value="{{ $lga }}">{{ $lga }}</option>
                                        @endforeach
                                    </select>
                                    @error('lga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="Lagos" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phonenumber') is-invalid @enderror" wire:model.live="phonenumber">
                                    @error('phonenumber') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('emailaddress') is-invalid @enderror" wire:model.live="emailaddress">
                                    @error('emailaddress') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button>
                                <button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        @endif

                        <!-- Step 3: Vehicle Info -->
                        @if($step == 3)
                        <div>
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Vehicle Information</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Chassis Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('chassis_number') is-invalid @enderror" wire:model.live="chassis_number">
                                    @error('chassis_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Engine Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('engine_number') is-invalid @enderror" wire:model.live="engine_number">
                                    @error('engine_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle Make <span class="text-danger">*</span></label>
                                    <select class="form-control @error('vehicle_make') is-invalid @enderror" wire:model.live="vehicle_make">
                                        <option value="">Select Make</option>
                                        @foreach($vehicle_makes as $make)
                                            <option value="{{ $make }}">{{ $make }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_make') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle Color <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('vehicle_color') is-invalid @enderror" wire:model.live="vehicle_color">
                                    @error('vehicle_color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button>
                                <button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        @endif

                        <!-- Step 4: Document Upload -->
                        @if($step == 4)
                        <div>
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Document Upload</h4>
                            <p class="text-muted mb-4">All files must be under 2MB. Accepted formats: JPG, PNG, PDF.</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Proof of Ownership Paper <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('proofofownership') is-invalid @enderror" wire:model.live="proofofownership">
                                    @error('proofofownership') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle License Paper <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('vehiclelicensepapers') is-invalid @enderror" wire:model.live="vehiclelicensepapers">
                                    @error('vehiclelicensepapers') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Road Worthiness Paper <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('road_worthiness_paper') is-invalid @enderror" wire:model.live="road_worthiness_paper">
                                    @error('road_worthiness_paper') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Agreement Note Between Parties <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('agreement') is-invalid @enderror" wire:model.live="agreement">
                                    @error('agreement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Chassis Number Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('chassis_image') is-invalid @enderror" wire:model.live="chassis_image">
                                    @error('chassis_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">New Owner NIN Slip <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('nin_slip') is-invalid @enderror" wire:model.live="nin_slip">
                                    @error('nin_slip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button>
                                <button type="submit" class="btn btn-primary-custom">Proceed to Review <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        @endif

                        <!-- Step 5: Order Review -->
                        @if($step == 5)
                        <div>
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Review Application</h4>

                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light"><strong>Owner Details</strong><button wire:click="goToStep(2)" class="btn btn-sm btn-outline-primary">Edit</button></div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="35%">Full Name</th><td>{{ $fullname }}</td></tr>
                                        <tr><th>DOB / Place of Birth</th><td>{{ $date_of_birth }} / {{ $place_of_birth }}</td></tr>
                                        <tr><th>Address</th><td>{{ $address }}, {{ $lga }}, {{ $state }}</td></tr>
                                        <tr><th>Contact</th><td>{{ $phonenumber }} / {{ $emailaddress }}</td></tr>
                                    </table>
                                </div>
                            </div>

                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light"><strong>Vehicle Details</strong><button wire:click="goToStep(3)" class="btn btn-sm btn-outline-primary">Edit</button></div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="35%">Make / Color</th><td>{{ $vehicle_make }} / {{ $vehicle_color }}</td></tr>
                                        <tr><th>Chassis No.</th><td>{{ $chassis_number }}</td></tr>
                                        <tr><th>Engine No.</th><td>{{ $engine_number }}</td></tr>
                                    </table>
                                </div>
                            </div>

                            <div class="alert alert-success border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><strong>Change of Ownership & Re-Registration</strong></div>
                                    <h4 class="mb-0 text-success font-weight-bold">₦{{ number_format($totalamount, 2) }}</h4>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button>
                                <button type="button" class="btn btn-primary-custom" wire:click="processPayment">Proceed to Payment <i class="fas fa-lock ml-2"></i></button>
                            </div>
                        </div>
                        @endif

                        <!-- Step 6: Payment -->
                        @if($step == 6)
                        <div>
                            <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Payment Summary</h4>
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr><td>Service Fee</td><td class="text-right">₦{{ number_format($service_fee, 2) }}</td></tr>
                                        <tr><td>Processing Fee</td><td class="text-right">₦{{ number_format($processing_fee, 2) }}</td></tr>
                                        <tr class="border-top"><th>Total</th><th class="text-right text-success pt-2" style="font-size:18px;">₦{{ number_format($totalamount, 2) }}</th></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="alert alert-info"><i class="fas fa-info-circle mr-2"></i> After payment, your application will be processed and you will receive updates via email.</div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button>
                                <button type="button" class="btn btn-success btn-lg" wire:click="paymentSuccessful">Pay Now <i class="fas fa-lock ml-2"></i></button>
                            </div>
                        </div>
                        @endif

                        <!-- Step 7: Sign Up Prompt -->
                        @if($step == 7)
                        <div class="text-center py-5">
                            <div style="max-width:550px; margin:0 auto;">
                                <h3 style="color:#142444; font-weight:700; margin-bottom:20px;">Save Your Details</h3>
                                <p class="text-muted mb-4">Create an account to save this vehicle and your information for future renewals, updates, and faster service requests.</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-outline-secondary px-4" wire:click="skipSignup">Skip for Now</button>
                                    <button type="button" class="btn btn-primary-custom px-4" wire:click="createAccount">Create Account</button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Step 8: Confirmation -->
                        @if($step == 8)
                        <div class="text-center py-5">
                            <div style="width:90px; height:90px; margin:0 auto; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-size:38px; color:#28a745;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 style="color:#142444; font-weight:700; margin:20px 0;">Application Submitted Successfully!</h3>
                            <div class="alert alert-light border mb-4">
                                <p><strong>Process ID:</strong> {{ $process_id }}</p>
                                <p><strong>Order Reference:</strong> {{ $order_reference }}</p>
                            </div>
                            <p class="text-muted">Your application is now being processed. Expected completion: <strong>5–7 working days</strong>.</p>
                            <p class="text-muted">You will receive your new ownership documents and updated registration via email once ready.</p>
                            <a href="/" class="btn btn-primary-custom mt-4">Back to Services</a>
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
.gap-3 { gap: 1rem; }
</style>