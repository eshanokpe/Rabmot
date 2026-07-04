<div style="padding:80px 0; background:#f7f9fc; min-height:100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1"></div>

            <!-- Left Panel -->
            <div class="col-lg-3 mb-4">
                <div style="background:linear-gradient(145deg,#0d2b52,#173f73); border-radius:20px; overflow:hidden; position:sticky; top:20px; color:#fff; box-shadow:0 20px 40px rgba(0,0,0,.15);">
                    <div style="padding:28px;">
                        <div style="display:inline-flex; align-items:center; padding:8px 18px; border-radius:30px; background:rgba(255,255,255,.15); font-size:14px; font-weight:600;">
                            <i class="fas fa-id-card mr-2"></i> License Service
                        </div>
                        <h2 style="font-size:28px; font-weight:700; margin-top:20px;">
                            International Driver's License
                        </h2>
                        <p style="opacity:.9; line-height:1.8; margin:20px 0 30px; color:#fff;">
                            Apply for your international driver's license online. Fast, secure and convenient.
                        </p>
                        <div style="display:flex; align-items:center; padding:15px; background:rgba(255,255,255,.08); border-radius:15px; margin-bottom:20px;">
                            <div style="width:55px; height:55px; border-radius:50%; background:#fff; color:#173f73; display:flex; align-items:center; justify-content:center; font-size:22px; margin-right:15px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <small class="text-light">Estimated Processing</small>
                                <h6 class="mb-0 text-white">3 – 5 Working Days</h6>
                            </div>
                        </div>
                        <div style="margin-top:30px;">
                            <h5 style="margin-bottom:20px;"><i class="fas fa-clipboard-check mr-2"></i> Requirements</h5>
                            <ul style="list-style:none; padding:0;">
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Valid Nigerian Driver's License</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Recent Passport Photograph</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Valid Email & Phone Number</li>
                                <li style="margin-bottom:14px;"><i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i> Country of Destination</li>
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
                            @for($i = 1; $i <= 5; $i++)
                                <div style="flex:1; text-align:center; position:relative; z-index:2;">
                                    <div style="width:45px; height:45px; line-height:45px; margin:auto; border-radius:50%; background:{{ $i < $step ? '#28a745' : ($i == $step ? '#142444' : '#dee2e6') }}; color:{{ $i <= $step ? '#fff' : '#6c757d' }}; font-weight:700; transition:.3s;">
                                        {{ $i < $step ? '✓' : $i }}
                                    </div>
                                    <p style="margin-top:10px; font-size:12px; font-weight:600;">
                                        @switch($i)
                                            @case(1) Start @break
                                            @case(2) Personal Info @break
                                            @case(3) Upload @break
                                            @case(4) Review @break
                                            @case(5) Payment @break
                                        @endswitch
                                    </p>
                                </div>
                            @endfor
                            <div style="position:absolute; top:22px; left:10%; width:80%; height:3px; background:#dee2e6; z-index:1;"></div>
                        </div>
                    </div>

                    <form wire:submit.prevent="nextStep" novalidate>

                        {{-- Step 1: Start --}}
                        @if($step == 1)
                        <div class="text-center py-5">
                            <h3 style="color:#142444; font-weight:700; margin-bottom:20px;">Start Your Application</h3>
                            <p class="text-muted mb-4">This process takes about 5 minutes. You can apply without logging in.</p>
                            <div class="alert alert-info text-left mb-5">
                                <h6><i class="fas fa-info-circle mr-2"></i> Before you begin, please have ready:</h6>
                                <ul class="mb-0">
                                    <li>Your valid Nigerian Driver's License number and expiry date</li>
                                    <li>A recent passport photograph (JPG or PNG, max 2MB)</li>
                                    <li>Active phone number and email address</li>
                                    <li>Your country of destination</li>
                                </ul>
                            </div>
                            <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                                Start Application <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                        @endif

                        {{-- Step 2: Personal Info --}}
                        @if($step == 2)
                        <div>
                            <h4 style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Personal Information</h4>

                            @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <strong>Please fix the following before continuing:</strong>
                                <ul class="mb-0 mt-1">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" wire:model.lazy="firstname">
                                    @error('firstname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" wire:model.lazy="middlename">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" wire:model.lazy="lastname">
                                    @error('lastname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control @error('gender') is-invalid @enderror" wire:model="gender">
                                        <option value="">-- Select --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Marital Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('maritalstatus') is-invalid @enderror" wire:model="maritalstatus">
                                        <option value="">-- Select --</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                    @error('maritalstatus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('dateofbirth') is-invalid @enderror" wire:model.lazy="dateofbirth">
                                    @error('dateofbirth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Place of Birth <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('localgovtplaceofbirth') is-invalid @enderror" wire:model.lazy="localgovtplaceofbirth" placeholder="City / Town of birth">
                                    @error('localgovtplaceofbirth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phonenumber') is-invalid @enderror" wire:model.lazy="phonenumber" placeholder="e.g. 08012345678">
                                    @error('phonenumber') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.lazy="email">
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Local Government Area (Lagos) <span class="text-danger">*</span></label>
                                    <select class="form-control @error('localgovernment') is-invalid @enderror" wire:model="localgovernment">
                                        <option value="">-- Select LGA --</option>
                                        @foreach($lagos_lgas as $lga)
                                            <option value="{{ $lga }}">{{ $lga }}</option>
                                        @endforeach
                                    </select>
                                    @error('localgovernment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Country of Destination <span class="text-danger">*</span></label>
                                    <select class="form-control @error('country_destination') is-invalid @enderror" wire:model="country_destination">
                                        <option value="">-- Select Country --</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>Canada</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                        <option>United Arab Emirates</option>
                                        <option>South Africa</option>
                                        <option>Ghana</option>
                                        <option>Other</option>
                                    </select>
                                    @error('country_destination') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Driver's License Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('license_number') is-invalid @enderror" wire:model.lazy="license_number" placeholder="e.g. AAD000000001">
                                    @error('license_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">License Expiry Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('license_expiry') is-invalid @enderror" wire:model.lazy="license_expiry">
                                    <small class="text-muted">Must be a future date</small>
                                    @error('license_expiry') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Residential Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" wire:model.lazy="address" rows="2" placeholder="Full residential address"></textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 3: Passport Upload --}}
                        @if($step == 3)
                        <div>
                            <h4 style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Passport Photograph</h4>
                            <div class="alert alert-info mb-4">
                                Upload a recent passport photograph. Accepted formats: JPG, PNG. Maximum size: 2MB.
                            </div>
                            <div style="border:2px dashed #d6dce5; border-radius:12px; padding:40px; text-align:center; background:#fafbfd;">
                                <i class="fas fa-cloud-upload-alt fa-4x mb-3" style="color:#142444;"></i>
                                <h5 class="mb-3">Upload Passport Photograph</h5>
                                <input type="file" class="form-control @error('passport') is-invalid @enderror" wire:model.live="passport" accept=".jpg,.jpeg,.png">
                                @error('passport') <div class="invalid-feedback text-left mt-2">{{ $message }}</div> @enderror
                                @if($passport)
                                    <div class="mt-3">
                                        <img src="{{ $passport->temporaryUrl() }}" style="width:150px; height:150px; object-fit:cover; border-radius:10px; border:3px solid #e9ecef;">
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-primary-custom">Continue <i class="fas fa-arrow-right"></i></button></div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 4: Review --}}
                        @if($step == 4)
                        <div>
                            <h4 style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">Review Your Application</h4>
                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                    <strong>Personal Details</strong>
                                    <button type="button" wire:click="goToStep(2)" class="btn btn-sm btn-outline-primary">Edit</button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr><th width="40%">Full Name</th><td>{{ $firstname }} {{ $middlename }} {{ $lastname }}</td></tr>
                                        <tr><th>Gender / DOB</th><td>{{ $gender }} / {{ $dateofbirth }}</td></tr>
                                        <tr><th>Phone / Email</th><td>{{ $phonenumber }} / {{ $email }}</td></tr>
                                        <tr><th>Address</th><td>{{ $address }}, {{ $localgovernment }}, Lagos</td></tr>
                                        <tr><th>Country of Destination</th><td>{{ $country_destination }}</td></tr>
                                        <tr><th>License Number</th><td>{{ $license_number }} (Exp: {{ $license_expiry }})</td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card shadow-sm mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                    <strong>Passport Photo</strong>
                                    <button type="button" wire:click="goToStep(3)" class="btn btn-sm btn-outline-primary">Change</button>
                                </div>
                                <div class="card-body text-center">
                                    @if($passport)
                                        <img src="{{ $passport->temporaryUrl() }}" style="width:120px; height:120px; object-fit:cover; border-radius:10px; border:3px solid #e9ecef;">
                                    @endif
                                </div>
                            </div>
                            <div class="alert alert-success border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><strong>International Driver's License</strong><br><span class="text-muted">Application Fee</span></div>
                                    <h4 class="mb-0 text-success font-weight-bold">₦{{ number_format($total, 2) }}</h4>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6"><button type="button" class="btn btn-outline-secondary" wire:click="previousStep"><i class="fas fa-arrow-left"></i> Back</button></div>
                                <div class="col-6 text-right"><button type="submit" class="btn btn-success">Proceed to Payment <i class="fas fa-lock"></i></button></div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 5: Payment --}}
                        @if($step == 5)
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
                                        <tr><td>Applicant</td><td class="text-right">{{ trim("{$firstname} {$lastname}") }}</td></tr>
                                        <tr><td>Email</td><td class="text-right">{{ $email }}</td></tr>
                                        <tr><td>Service Fee</td><td class="text-right">₦{{ number_format($service_fee, 2) }}</td></tr>
                                        <tr><td>Processing Fee</td><td class="text-right">₦{{ number_format($processing_fee, 2) }}</td></tr>
                                        <tr class="border-top"><th>Total</th><th class="text-right text-success pt-2" style="font-size:18px;">₦{{ number_format($total, 2) }}</th></tr>
                                    </table>
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
