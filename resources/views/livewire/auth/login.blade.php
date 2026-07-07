@push('styles')
<style>
    .transition-base {
        transition: all 0.3s ease;
    }
    .spinner {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid #ffffff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin-right: 8px;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endpush

<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-200 text-green-800 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-900">×</button>
            </div>
        @endif

        @if($errors->has('verified'))
            <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-200 text-red-800 flex justify-between items-center">
                <span>{{ $errors->first('verified') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-900">×</button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

            <!-- Left Panel -->
            <div class="relative rounded-xl overflow-hidden h-80 lg:h-[500px] bg-cover bg-center"
                 style="background-image: url('{{ asset('assets/img/Car_22.png') }}');">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <div class="relative z-10 h-full flex flex-col justify-center items-center text-center p-8 text-white">
                    <h2 class="text-3xl font-bold mb-4 drop-shadow-md">New User?</h2>
                    <p class="text-lg mb-6 drop-shadow-sm">Don't have an account yet? Join us today.</p>
                    <a href="{{ route('signup') }}"
                       class="bg-[#142444] hover:bg-[#0f1b33] text-white font-semibold px-8 py-3 rounded-md border-2 border-white transition-base transform hover:scale-105 shadow-lg">
                        SIGN UP
                    </a>
                </div>
            </div>

            <!-- Login Form -->
            <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md mx-auto">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign In</h3>

                <form wire:submit.prevent="login" id="loginForm">
                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" id="email" wire:model="email" required autofocus
                                   class="pl-10 w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#142444] focus:border-transparent transition-base
                                   @error('email') border-red-500 @else border-gray-300 @enderror"
                                   placeholder="your@email.com"
                                   @if($isLoading) disabled @endif>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa fa-lock"></i>
                            </span>
                            <input type="password" id="password" wire:model="password" required
                                   class="pl-10 pr-10 w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#142444] focus:border-transparent transition-base
                                   @error('password') border-red-500 @else border-gray-300 @enderror"
                                   placeholder="Enter your password"
                                   @if($isLoading) disabled @endif>
                            <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700"
                                    @if($isLoading) disabled @endif>
                                <i class="fa fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" wire:model="remember" class="w-4 h-4 text-[#142444] rounded border-gray-300"
                                   @if($isLoading) disabled @endif>
                            <span class="text-sm text-gray-600">Remember Me</span>
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-[#142444] hover:underline"
                               @if($isLoading) tabindex="-1" @endif>
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="mb-6" wire:ignore>
                        <div id="recaptcha-container" class="g-recaptcha flex justify-center"
                            data-sitekey="{{ config('services.recaptcha.siteKey') }}"
                            @if($isLoading) style="pointer-events: none; opacity: 0.6;" @endif></div>
                    </div>
                    @error('recaptcha')
                        <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-[#142444] hover:bg-[#0f1b33] text-white font-semibold py-3 rounded-md transition-base transform hover:scale-[1.02] shadow-md flex items-center justify-center"
                            @if($isLoading) disabled @endif>
                        @if($isLoading)
                            <span class="spinner"></span>
                            Processing...
                        @else
                            SIGN IN
                        @endif
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>

<script>
    let recaptchaId;
    let livewireComponentId;

    document.addEventListener('livewire:load', function () {
        // Capture this component's wire:id once Livewire has hydrated
        const formEl = document.getElementById('loginForm');
        livewireComponentId = formEl.closest('[wire\\:id]').getAttribute('wire:id');

        renderRecaptcha();
    });

    function getComponent() {
        return window.livewire.find(livewireComponentId);
    }

    function renderRecaptcha() {
        if (typeof grecaptcha === 'undefined' || !grecaptcha.render) {
            setTimeout(renderRecaptcha, 200);
            return;
        }
        recaptchaId = grecaptcha.render('recaptcha-container', {
            sitekey: '{{ config('services.recaptcha.siteKey') }}',
            callback: onRecaptchaSuccess,
            'expired-callback': onRecaptchaExpired,
            'error-callback': onRecaptchaError
        });
    }

    function onRecaptchaSuccess(token) {
        const component = getComponent();
        if (component) {
            component.set('gRecaptchaResponse', token);
        } else {
            console.error('Livewire component not found for recaptcha sync');
        }
    }

    function onRecaptchaExpired() {
        const component = getComponent();
        if (component) {
            component.set('gRecaptchaResponse', null);
        }
        alert('reCAPTCHA expired, please verify again.');
    }

    function onRecaptchaError() {
        const component = getComponent();
        if (component) {
            component.set('gRecaptchaResponse', null);
        }
        alert('reCAPTCHA error, please check your connection.');
    }

    // Listen for reset request from the Livewire component (emit)
    window.addEventListener('resetRecaptcha', () => {
        if (recaptchaId !== undefined && typeof grecaptcha !== 'undefined') {
            grecaptcha.reset(recaptchaId);
        }
    });

    function togglePassword() {
        const pwd = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        pwd.type = pwd.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
</script>
@endpush