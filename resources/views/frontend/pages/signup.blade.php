<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@once
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endonce

@extends('layouts.app')

@section('content')
<!-- Sign Up Page -->
<div class="min-h-screen bg-slate-50 py-16 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-5 rounded-2xl shadow-xl shadow-slate-900/10 bg-white">

            <!-- Left panel: existing user -->
            <div
                class="relative lg:col-span-2 bg-cover bg-center flex items-end overflow-hidden rounded-t-2xl lg:rounded-l-2xl lg:rounded-tr-none"
                style="background-image: linear-gradient(180deg, rgba(20,36,68,0.35) 0%, rgba(20,36,68,0.92) 100%), url('{{ asset('assets/img/Car_11.png') }}');"
            >
                <div class="relative z-10 p-8 sm:p-10 w-full text-white">
                    <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-white/70">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                        </svg>
                        Members Only
                    </span>
                    <h4 class="mt-4 text-2xl sm:text-3xl font-bold leading-tight">
                        Already have an account?
                    </h4>
                    <p class="mt-3 text-sm sm:text-base text-white/80">
                        Sign in to pick up right where you left off and manage your papers with ease.
                    </p>
                    <a
                        href="{{ url('processpapers') }}"
                        class="mt-6 inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white bg-white px-8 py-3 text-sm font-bold uppercase tracking-wide text-[#142444] shadow-lg shadow-black/20 transition-all duration-200 hover:scale-105 hover:bg-[#142444] hover:text-white"
                    >
                        Sign In
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right panel: sign-up form -->
            <div class="lg:col-span-3 p-8 sm:p-10">
                <h2 class="text-2xl font-bold text-slate-900">Create your account</h2>
                <p class="mt-1 text-sm text-slate-500">Fill in your details below to get started.</p>

                @if ($errors->any())
                    <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4">
                        <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div id="error-message" class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                    <script>
                        setTimeout(function () {
                            var errorMessage = document.getElementById('error-message');
                            if (errorMessage) {
                                errorMessage.parentNode.removeChild(errorMessage);
                            }
                        }, 3000);
                    </script>
                @endif

                <form method="POST" action="{{ route('register') }}" id="signUpForm" onsubmit="return validateForm()" class="mt-6 space-y-5">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="fullname" class="block text-sm font-medium text-slate-700">Full Name</label>
                        <div class="relative mt-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input
                                id="fullname"
                                type="text"
                                name="fullname"
                                placeholder="Enter your name"
                                value="{{ old('fullname') }}"
                                required
                                autocomplete="fullname"
                                autofocus
                                class="block w-full rounded-lg border py-2.5 pl-10 pr-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('fullname') border-red-400 @else border-slate-300 @enderror"
                            >
                        </div>
                        @error('fullname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                        <div class="relative mt-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                placeholder="Enter your email address"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="block w-full rounded-lg border py-2.5 pl-10 pr-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('email') border-red-400 @else border-slate-300 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700">Phone Number</label>
                        <div class="relative mt-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.95.68l1.2 3.6a1 1 0 01-.27 1.05l-1.5 1.5a11 11 0 006.34 6.34l1.5-1.5a1 1 0 011.05-.27l3.6 1.2a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.72 21 3 14.28 3 6V5z" />
                                </svg>
                            </span>
                            <input
                                id="phone"
                                type="text"
                                name="phone"
                                placeholder="Enter your phone number"
                                value="{{ old('phone') }}"
                                required
                                autocomplete="phone"
                                class="block w-full rounded-lg border py-2.5 pl-10 pr-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('phone') border-red-400 @else border-slate-300 @enderror"
                            >
                        </div>
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <div class="relative mt-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                                </svg>
                            </span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-lg border py-2.5 pl-10 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('password') border-red-400 @else border-slate-300 @enderror"
                            >
                            <button
                                type="button"
                                onclick="togglePasswordVisibility('password', this)"
                                class="btn-show-pass absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-[#142444]"
                            >
                                <svg class="show-hide-icon w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                        <div class="relative mt-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                                </svg>
                            </span>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                placeholder="Confirm password"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-lg border border-slate-300 py-2.5 pl-10 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444]"
                            >
                            <button
                                type="button"
                                onclick="togglePasswordVisibility('password_confirmation', this)"
                                class="btn-show-pass absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-[#142444]"
                            >
                                <svg class="show-hide-icon w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- How did you hear about us? -->
                    <div>
                        <label for="know_us" class="block text-sm font-medium text-slate-700">How did you hear about us?</label>
                        <div class="relative mt-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <select
                                required
                                name="know_us"
                                id="know_us"
                                class="block w-full appearance-none rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-8 text-sm text-slate-900 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('know_us') border-red-400 @enderror"
                            >
                                <option disabled selected value="">Select option</option>
                                <option value="YouTube">YouTube</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Tiktok">Tiktok</option>
                                <option value="Linkedin">Linkedin</option>
                                <option value="Whatsapp">Whatsapp</option>
                                <option value="Google">Google</option>
                                <option value="Physical">Physical</option>
                                <option value="Friend and Family">Friend and Family</option>
                                <option value="Social Gathering">Social Gathering</option>
                                <option value="Flyers">Flyers</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        @error('know_us')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Referral Link -->
                    <div>
                        <label for="referral_code" class="block text-sm font-medium text-slate-700">Referral Link</label>
                        <div class="relative mt-1">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5M10.172 13.828a4 4 0 010-5.656l3-3a4 4 0 015.656 5.656l-1.5 1.5" />
                                </svg>
                            </span>
                            <input
                                id="referral_code"
                                type="text"
                                name="referral_code"
                                placeholder="Referral link"
                                value="{{ old('referral_code', request()->input('ref')) }}"
                                class="block w-full rounded-lg border border-slate-300 py-2.5 pl-10 pr-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444]"
                            >
                        </div>
                    </div>

                    <!-- Agree to Terms -->
                    <div class="pt-2">
                        <label class="inline-flex items-center gap-3 cursor-pointer select-none">
                            <span class="relative inline-flex h-6 w-11 flex-shrink-0">
                                <input type="checkbox" name="agreed" id="agreed" required class="peer sr-only">
                                <span class="absolute inset-0 rounded-full bg-slate-300 transition-colors peer-checked:bg-[#142444]"></span>
                                <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></span>
                            </span>
                            <span class="text-sm text-slate-600">
                                Agree to
                                <a href="terms" class="font-semibold text-red-600 hover:underline">Terms &amp; Conditions</a>
                            </span>
                        </label>
                        @error('agreed')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- reCAPTCHA v2 checkbox -->
                    <div class="pt-2">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.siteKey') }}"></div>
                        <p id="recaptcha-error" class="mt-1 hidden text-sm text-red-600">Please verify you're not a robot.</p>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 text-center">
                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#142444] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-[#142444]/30 transition-all duration-200 hover:scale-[1.02] hover:bg-[#0e1a34] sm:w-auto"
                        >
                            Sign Up
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- JavaScript for password show/hide and reCAPTCHA validation -->
                <script>
                    function togglePasswordVisibility(inputId, element) {
                        const passwordInput = document.getElementById(inputId);
                        const icon = element.querySelector('svg');

                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c1.29 0 2.53-.234 3.674-.66M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.774 3.162 10.066 7.5a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
                        } else {
                            passwordInput.type = 'password';
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                        }
                    }

                    function validateForm() {
                        const agreedCheckbox = document.getElementById('agreed');
                        if (!agreedCheckbox.checked) {
                            toastr.error('Please agree to the Terms & Conditions before submitting.');
                            return false;
                        }

                        const recaptchaError = document.getElementById('recaptcha-error');
                        if (typeof grecaptcha !== 'undefined' && grecaptcha.getResponse().length === 0) {
                            toastr.error('Please verify you are not a robot.');
                            recaptchaError.classList.remove('hidden');
                            return false;
                        }
                        if (recaptchaError) {
                            recaptchaError.classList.add('hidden');
                        }

                        return true;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<!--// Sign Up Page -->
@endsection