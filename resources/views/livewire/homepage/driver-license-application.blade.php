<div class="intl-license-page" style="padding:80px 0; background:#f7f9fc; min-height:100vh;">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Panel - Service Info -->
            <div class="col-lg-4 mb-4">
                <div class="service-banner" style="background:linear-gradient(145deg,#0d2b52,#173f73); border-radius:20px; overflow:hidden; position:sticky; top:20px; color:#fff; box-shadow:0 20px 40px rgba(0,0,0,.15);">
                    <div class="service-overlay" style="padding:35px;">
                        <div class="service-badge" style="display:inline-flex; align-items:center; padding:8px 18px; border-radius:30px; background:rgba(255,255,255,.15); font-size:14px; font-weight:600;">
                            <i class="fas fa-id-card mr-2"></i>
                            Fresh Application
                        </div>

                        <h2 class="service-title" style="font-size:32px; font-weight:700; margin-top:20px;">
                            Driver's License
                        </h2>
                        <p class="service-description" style="opacity:.9; line-height:1.8; margin:20px 0 30px;">
                            Apply for your first Nigerian Driver's License online by completing the required information and making a secure payment.
                        </p>

                        <div class="info-card" style="display:flex; align-items:center; padding:18px; background:rgba(255,255,255,.08); border-radius:15px; margin-bottom:20px;">
                            <div class="icon" style="width:55px; height:55px; border-radius:50%; background:#fff; color:#173f73; display:flex; align-items:center; justify-content:center; font-size:22px; margin-right:15px;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <small class="text-light">Estimated Processing</small>
                                <h6 class="mb-0 text-white">5 – 10 Working Days</h6>
                            </div>
                        </div>

                        <div class="requirements-card" style="margin-top:30px;">
                            <h5 style="margin-bottom:20px;">
                                <i class="fas fa-clipboard-check mr-2"></i>
                                Requirements
                            </h5>
                            <ul style="list-style:none; padding:0;">
                                <li style="margin-bottom:14px;">
                                    <i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i>
                                    National Identification Number (NIN)
                                </li>
                                <li style="margin-bottom:14px;">
                                    <i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i>
                                    Valid Phone Number
                                </li>
                                <li style="margin-bottom:14px;">
                                    <i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i>
                                    Active Email Address
                                </li>
                                <li style="margin-bottom:14px;">
                                    <i class="fas fa-check-circle" style="color:#38d39f; margin-right:10px;"></i>
                                    Accurate Personal Information
                                </li>
                            </ul>
                        </div>

                        @if($is_authenticated)
                            <div class="notice-box" style="margin-top:35px; padding:18px; background:rgba(255,193,7,.15); border-left:4px solid #ffc107; border-radius:10px; font-size:14px; line-height:1.8;">
                                <i class="fas fa-user-check mr-2"></i>
                                Welcome back! Your information has been pre-filled.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Panel - Application Form -->
            <div class="col-lg-8">
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
                                            @case(1) Personal @break
                                            @case(2) Contact @break
                                            @case(3) Physical @break
                                            @case(4) Next of Kin @break
                                            @case(5) Review @break
                                            @case(6) Payment @break
                                        @endswitch
                                    </p>
                                </div>
                            @endfor
                            <div class="wizard-line" style="position:absolute; top:22px; left:10%; width:80%; height:3px; background:#dee2e6; z-index:1;"></div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form wire:submit.prevent="nextStep" novalidate>
                        <!-- STEP 1: Personal Information -->
                        @if($step == 1)
                            <div class="step-content active">
                                <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">
                                    Personal Information
                                </h4>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Surname <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror" 
                                               wire:model.live="surname" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('surname') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" 
                                               wire:model.live="firstname" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('firstname') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Other Name</label>
                                        <input type="text" class="form-control" wire:model.live="othername" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Sex <span class="text-danger">*</span></label>
                                        <select class="form-control @error('gender') is-invalid @enderror" 
                                                wire:model.live="gender" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('gender') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('dob') is-invalid @enderror" 
                                               wire:model.live="dob" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('dob') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Place of Birth <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" 
                                               wire:model.live="place_of_birth" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('place_of_birth') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Marital Status <span class="text-danger">*</span></label>
                                        <select class="form-control @error('marital_status') is-invalid @enderror" 
                                                wire:model.live="marital_status" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                            <option value="">Select Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                        @error('marital_status') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Nationality <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                                               wire:model.live="nationality" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('nationality') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Residential Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  wire:model.live="address" rows="3" style="border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;"></textarea>
                                        @error('address') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary-custom" wire:loading.attr="disabled" wire:target="nextStep"
                                            style="background:#142444; border:none; color:white; padding:12px 35px; border-radius:8px; font-weight:600; transition:all 0.2s ease; box-shadow:0 2px 8px rgba(20,36,68,0.2);">
                                        <span wire:loading.remove wire:target="nextStep">Continue <i class="fas fa-arrow-right ml-2"></i></span>
                                        <span wire:loading wire:target="nextStep"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- STEP 2: Contact Information -->
                        @if($step == 2)
                            <div class="step-content active">
                                <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">
                                    Personal Information (Part 2)
                                </h4>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">State of Origin <span class="text-danger">*</span></label>
                                        <select class="form-control @error('state_origin') is-invalid @enderror" 
                                                wire:model.live="state_origin" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                            <option value="">Select State</option>
                                            @foreach($all_states as $state)
                                                <option value="{{ $state }}">{{ $state }}</option>
                                            @endforeach
                                        </select>
                                        @error('state_origin') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Local Government of Origin <span class="text-danger">*</span></label>
                                        <select class="form-control @error('lga_origin') is-invalid @enderror" 
                                                wire:model.live="lga_origin" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;" {{ empty($lgas) ? 'disabled' : '' }}>
                                            <option value="">Select LGA</option>
                                            @if(!empty($lgas) && is_array($lgas))
                                                @foreach($lgas as $lga)
                                                    <option value="{{ $lga }}">{{ $lga }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('lga_origin') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                               wire:model.live="phone" placeholder="08012345678" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('phone') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               wire:model.live="email" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('email') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">NIN <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nin') is-invalid @enderror" 
                                               wire:model.live="nin" placeholder="11-digit NIN" maxlength="11" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('nin') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Occupation <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('occupation') is-invalid @enderror" 
                                               wire:model.live="occupation" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('occupation') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Mother's Maiden Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mother_maiden_name') is-invalid @enderror" 
                                               wire:model.live="mother_maiden_name" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('mother_maiden_name') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep" 
                                                style="padding:10px 25px; border-radius:8px; font-weight:500; transition:all 0.2s ease;">
                                            <i class="fas fa-arrow-left mr-2"></i> Back
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="submit" class="btn btn-primary-custom" wire:loading.attr="disabled" wire:target="nextStep"
                                                style="background:#142444; border:none; color:white; padding:10px 30px; border-radius:8px; font-weight:600; transition:all 0.2s ease; box-shadow:0 2px 8px rgba(20,36,68,0.2);">
                                            <span wire:loading.remove wire:target="nextStep">Continue <i class="fas fa-arrow-right ml-2"></i></span>
                                            <span wire:loading wire:target="nextStep"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif 

                        <!-- STEP 3: Physical Information -->
                        @if($step == 3)
                            <div class="step-content active">
                                <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">
                                    Physical Information
                                </h4>
                                <p class="text-muted mb-4">Please provide your physical information accurately.</p>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Blood Group <span class="text-danger">*</span></label>
                                        <select class="form-control @error('blood_group') is-invalid @enderror" 
                                                wire:model.live="blood_group" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                            <option value="">Select Blood Group</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
                                        @error('blood_group') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Height (cm) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('height') is-invalid @enderror" 
                                               wire:model.live="height" placeholder="Example: 175" min="50" max="250" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('height') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                        <small class="text-muted">Enter your height in centimetres.</small>
                                    </div>
                                </div>
                                <hr style="border-color:#f0f2f5;">
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep" 
                                                style="padding:10px 25px; border-radius:8px; font-weight:500; transition:all 0.2s ease;">
                                            <i class="fas fa-arrow-left mr-2"></i> Back
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="submit" class="btn btn-primary-custom" wire:loading.attr="disabled" wire:target="nextStep"
                                                style="background:#142444; border:none; color:white; padding:10px 30px; border-radius:8px; font-weight:600; transition:all 0.2s ease; box-shadow:0 2px 8px rgba(20,36,68,0.2);">
                                            <span wire:loading.remove wire:target="nextStep">Continue <i class="fas fa-arrow-right ml-2"></i></span>
                                            <span wire:loading wire:target="nextStep"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- STEP 4: Next of Kin -->
                        @if($step == 4)
                            <div class="step-content active">
                                <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">
                                    Next of Kin Information
                                </h4>
                                <p class="text-muted mb-4">Kindly provide your next of kin information.</p>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Next of Kin Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control @error('nok_phone') is-invalid @enderror" 
                                               wire:model.live="nok_phone" placeholder="08012345678" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('nok_phone') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" style="font-weight:600; margin-bottom:8px; color:#333;">Nationality of Next of Kin <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nok_nationality') is-invalid @enderror" 
                                               wire:model.live="nok_nationality" style="height:50px; border-radius:8px; border:1px solid #ced4da; transition:all 0.2s ease;">
                                        @error('nok_nationality') <div class="invalid-feedback mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <hr style="border-color:#f0f2f5;">
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep" 
                                                style="padding:10px 25px; border-radius:8px; font-weight:500; transition:all 0.2s ease;">
                                            <i class="fas fa-arrow-left mr-2"></i> Back
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="submit" class="btn btn-primary-custom" wire:loading.attr="disabled" wire:target="nextStep"
                                                style="background:#142444; border:none; color:white; padding:10px 30px; border-radius:8px; font-weight:600; transition:all 0.2s ease; box-shadow:0 2px 8px rgba(20,36,68,0.2);">
                                            <span wire:loading.remove wire:target="nextStep">Continue <i class="fas fa-arrow-right ml-2"></i></span>
                                            <span wire:loading wire:target="nextStep"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- STEP 5: Review -->
                        @if($step == 5)
                            <div class="step-content active">
                                <h4 class="section-title" style="color:#142444; font-size:20px; font-weight:700; margin-bottom:25px; border-bottom:1px solid #f0f2f5; padding-bottom:10px;">
                                    Review Your Application
                                </h4>
                                <p class="text-muted mb-4">Please review your information carefully before proceeding to payment.</p>

                                <!-- Personal Information -->
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light" style="border-radius:8px 8px 0 0;">
                                        <strong class="text-dark">Personal Information</strong>
                                        <button type="button" class="btn btn-sm btn-outline-primary" wire:click="goToStep(1)" style="border-radius:6px; border-color:#142444; color:#142444;">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr><th width="35%" class="text-muted">Surname</th><td>{{ $surname }}</td></tr>
                                            <tr><th class="text-muted">First Name</th><td>{{ $firstname }}</td></tr>
                                            <tr><th class="text-muted">Other Name</th><td>{{ $othername ?: 'N/A' }}</td></tr>
                                            <tr><th class="text-muted">Gender</th><td>{{ $gender }}</td></tr>
                                            <tr><th class="text-muted">Date of Birth</th><td>{{ $dob }}</td></tr>
                                            <tr><th class="text-muted">Nationality</th><td>{{ $nationality }}</td></tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light" style="border-radius:8px 8px 0 0;">
                                        <strong class="text-dark">Contact Information</strong>
                                        <button type="button" class="btn btn-sm btn-outline-primary" wire:click="goToStep(2)" style="border-radius:6px; border-color:#142444; color:#142444;">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr><th width="35%" class="text-muted">Phone Number</th><td>{{ $phone }}</td></tr>
                                            <tr><th class="text-muted">Email Address</th><td>{{ $email }}</td></tr>
                                            <tr><th class="text-muted">NIN</th><td>{{ $nin }}</td></tr>
                                            <tr><th class="text-muted">Occupation</th><td>{{ $occupation }}</td></tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Physical Information -->
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light" style="border-radius:8px 8px 0 0;">
                                        <strong class="text-dark">Physical Information</strong>
                                        <button type="button" class="btn btn-sm btn-outline-primary" wire:click="goToStep(3)" style="border-radius:6px; border-color:#142444; color:#142444;">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr><th width="35%" class="text-muted">Blood Group</th><td>{{ $blood_group }}</td></tr>
                                            <tr><th class="text-muted">Height</th><td>{{ $height }} cm</td></tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Next of Kin -->
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light" style="border-radius:8px 8px 0 0;">
                                        <strong class="text-dark">Next of Kin</strong>
                                        <button type="button" class="btn btn-sm btn-outline-primary" wire:click="goToStep(4)" style="border-radius:6px; border-color:#142444; color:#142444;">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr><th width="35%" class="text-muted">Phone Number</th><td>{{ $nok_phone }}</td></tr>
                                            <tr><th class="text-muted">Nationality</th><td>{{ $nok_nationality }}</td></tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Payment Summary -->
                                <div class="alert alert-success border-0" style="border-radius:8px; background:#ecfdf5;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Fresh Driver's License</strong><br>
                                            <span class="text-muted">Application Fee</span>
                                        </div>
                                        <h4 class="mb-0 text-success font-weight-bold">₦{{ number_format($total, 2) }}</h4>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep" 
                                                style="padding:10px 25px; border-radius:8px; font-weight:500;">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="nextStep"
                                                style="padding:10px 30px; border-radius:8px; font-weight:600; background:#16a34a; border:none;">
                                            <span wire:loading.remove wire:target="nextStep">Proceed to Payment <i class="fas fa-lock ml-2"></i></span>
                                            <span wire:loading wire:target="nextStep"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- STEP 6: Payment -->
                        @if($step == 6)
                            <div class="step-content active">
                                <div class="text-center mb-5">
                                    <div class="payment-icon" style="width:90px; height:90px; margin:auto; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-size:38px; color:#142444;">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <h3 class="mt-3" style="color:#142444; font-weight:700;">Payment Summary</h3>
                                    <p class="text-muted">You're almost done. Please review your payment details before proceeding.</p>
                                </div>

                                <!-- Applicant -->
                                <div class="card shadow-sm mb-4 border-0" style="border-radius:10px;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong class="text-dark">Applicant</strong>
                                                <p class="mb-0 mt-1">{{ $surname }} {{ $firstname }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <strong class="text-dark">Email Address</strong>
                                                <p class="mb-0 mt-1">{{ $email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Summary -->
                                <div class="card shadow-sm mb-4 border-0" style="border-radius:10px;">
                                    <div class="card-header bg-light" style="border-radius:10px 10px 0 0;">
                                        <strong>Order Summary</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr>
                                                <td>Fresh Driver's License</td>
                                                <td class="text-right">₦{{ number_format($service_fee, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Processing Fee</td>
                                                <td class="text-right">₦{{ number_format($processing_fee, 2) }}</td>
                                            </tr>
                                            <tr class="border-top">
                                                <th class="pt-2">Total</th>
                                                <th class="text-right text-success pt-2" style="font-size:18px;">₦{{ number_format($total, 2) }}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <!-- Notice -->
                                <div class="alert alert-info border-0" style="border-radius:8px; background:#eff6ff;">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    After payment, your application will be submitted automatically and a confirmation receipt will be sent to your email.
                                </div>
                                                                <div class="row mt-4">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary" wire:click="previousStep" 
                                                style="padding:10px 25px; border-radius:8px; font-weight:500;">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button type="button" class="btn btn-success btn-lg px-5" wire:click="processPayment" wire:loading.attr="disabled" wire:target="processPayment"
                                                style="background:#16a34a; border:none; border-radius:8px; font-weight:600;">
                                            <span wire:loading.remove wire:target="processPayment"><i class="fas fa-lock mr-2"></i> Pay ₦{{ number_format($total, 2) }}</span>
                                            <span wire:loading wire:target="processPayment"><i class="fas fa-spinner fa-spin mr-2"></i> Processing...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- STEP 7: Confirmation -->
                        @if(isset($step) && $step == 7)
                            <div class="step-content active">
                                <div class="text-center py-4">
                                    <div class="payment-icon" style="width:100px; height:100px; margin:auto; border-radius:50%; background:#ecfdf5; display:flex; align-items:center; justify-content:center; font-size:45px; color:#16a34a;">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <h2 class="mt-4" style="color:#142444; font-weight:700;">Payment Successful!</h2>
                                    <p class="text-muted">Your application has been submitted successfully.</p>
                                    
                                    <div class="card shadow-sm mb-4 mx-auto" style="max-width:500px; border-radius:10px; border:0;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <strong>Order Reference:</strong>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <span class="badge" style="background:#142444; padding:8px 15px; border-radius:20px; font-size:14px; color:white;">
                                                        {{ $order_reference }}
                                                    </span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <strong>Estimated Processing:</strong>
                                                </div>
                                                <div class="col-6 text-right">
                                                    5 – 10 Working Days
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 text-left">
                                                    <strong>What to expect next:</strong>
                                                    <p class="text-muted mt-2 mb-0">An agent will contact you within 24 hours to confirm your application status.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sign Up Prompt for New Users -->
                                    @if(!$is_authenticated && $show_signup_prompt)
                                        <div class="card shadow-sm mb-4 mx-auto" style="max-width:500px; border-radius:10px; border:2px solid #FBBF24; background:#fffbeb;">
                                            <div class="card-body">
                                                <h5 style="color:#142444; font-weight:600;">Save your info for next time!</h5>
                                                <p class="text-muted">Create an account to get license renewal reminders and skip re-entering details next time.</p>
                                                <div class="d-flex justify-content-center gap-3 mt-3">
                                                    <button type="button" class="btn btn-primary-custom" wire:click="createAccount" wire:loading.attr="disabled" wire:target="createAccount"
                                                            style="background:#142444; border:none; border-radius:8px; color:white; padding:8px 20px;">
                                                        <span wire:loading.remove wire:target="createAccount"><i class="fas fa-user-plus mr-2"></i> Create Account</span>
                                                        <span wire:loading wire:target="createAccount"><i class="fas fa-spinner fa-spin mr-2"></i> Please wait...</span>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary" wire:click="skipSignup" 
                                                            style="border-radius:8px; padding:8px 20px;">
                                                        Skip
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mt-4">
                                        <a href="{{ route('home') }}" class="btn btn-primary-custom" 
                                           style="background:#142444; border:none; border-radius:8px; color:white; padding:10px 25px;">
                                            <i class="fas fa-home mr-2"></i> Go to Home
                                        </a>
                                        <button type="button" class="btn btn-outline-secondary ml-2" onclick="window.print()" 
                                                style="border-radius:8px; padding:10px 25px;">
                                            <i class="fas fa-download mr-2"></i> Download Receipt
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

<!-- Custom Form Styles -->
<style>
/* Fix focus border */
.form-control:focus {
    border-color: #142444 !important;
    box-shadow: 0 0 0 0.2rem rgba(20, 36, 68, 0.15) !important;
    outline: none !important;
}

/* Invalid field style */
.form-control.is-invalid {
    border-color: #dc2626 !important;
    background-image: none !important;
}

.form-control.is-invalid:focus {
    box-shadow: 0 0 0 0.2rem rgba(220, 38, 38, 0.15) !important;
}

/* Invalid feedback - FORCE DISPLAY */
.invalid-feedback {
    display: block !important;
    color: #dc2626 !important;
    font-size: 0.875rem !important;
    font-weight: 500 !important;
    margin-top: 0.25rem !important;
}

/* Hover effect */
.form-control:hover:not(:disabled):not(:focus):not(.is-invalid) {
    border-color: #94a3b8;
}

/* Button hover */
.btn-primary-custom:hover {
    background-color: #0f1c38 !important;
    box-shadow: 0 4px 12px rgba(20,36,68,0.25) !important;
    color: white !important;
}

.btn-outline-secondary:hover {
    background-color: #f3f4f6;
    border-color: #d1d5db;
    color: #1f2937;
}

/* Disabled button style */
button:disabled {
    opacity: 0.7 !important;
    cursor: not-allowed !important;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .service-banner {
        position: static !important;
    }
}
</style>