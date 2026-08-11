@extends('layouts.app')

@section('content')
<!-- Login Page -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<div class="min-h-screen bg-slate-50 py-16 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">

        <!-- Flash Messages -->
        @if(session('recaptcha_error') || session('error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ session('recaptcha_error') ?? session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 rounded-2xl shadow-xl shadow-slate-900/10 bg-white">

            <!-- Left panel: new user -->
            <div
                class="relative lg:col-span-2 bg-cover bg-center flex items-end overflow-hidden rounded-t-2xl lg:rounded-l-2xl lg:rounded-tr-none"
                style="background-image: linear-gradient(180deg, rgba(20,36,68,0.35) 0%, rgba(20,36,68,0.92) 100%), url('{{ asset('assets/img/Car_22.png') }}');"
            >
                <div class="relative z-10 p-8 sm:p-10 w-full text-white">
                    <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-white/70">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        New Here
                    </span>
                    <h4 class="mt-4 text-2xl sm:text-3xl font-bold leading-tight">
                        Don't have an account yet?
                    </h4>
                    <p class="mt-3 text-sm sm:text-base text-white/80">
                        Create a free account to manage your vehicle licensing and documentation with ease.
                    </p>
                    <a
                        href="{{ route('signup') }}"
                        class="mt-6 inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white bg-white px-8 py-3 text-sm font-bold uppercase tracking-wide text-[#142444] shadow-lg shadow-black/20 transition-all duration-200 hover:scale-105 hover:bg-[#142444] hover:text-white"
                    >
                        Create Account
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>

                    <!-- Trust badges -->
                    <div class="mt-8 flex items-center gap-6 text-white/50 text-xs">
                        <span class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Secure
                        </span>
                        <span class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                            </svg>
                            Encrypted
                        </span>
                        <span class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            24/7 Support
                        </span>
                    </div>
                </div>
            </div>
 
            <!-- Right panel: login form -->
            <div class="lg:col-span-3 p-8 sm:p-10">
                <h2 class="text-2xl font-bold text-slate-900">Sign in to your account</h2>
                <p class="mt-1 text-sm text-slate-500">Enter your credentials to access your dashboard.</p>

                @if ($errors->any())
                    <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4">
                        <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm" class="mt-6 space-y-5">
                    @csrf 

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
                                placeholder="you@example.com"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                class="block w-full rounded-lg border py-2.5 pl-10 pr-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('email') border-red-400 @else border-slate-300 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-medium text-[#142444] hover:underline">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
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
                                autocomplete="current-password"
                                class="block w-full rounded-lg border py-2.5 pl-10 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('password') border-red-400 @else border-slate-300 @enderror"
                            >
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-[#142444]"
                            >
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="inline-flex items-center gap-3 cursor-pointer select-none">
                            <span class="relative inline-flex h-6 w-11 flex-shrink-0">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="peer sr-only">
                                <span class="absolute inset-0 rounded-full bg-slate-300 transition-colors peer-checked:bg-[#142444]"></span>
                                <span class="absolute left-0.5 top-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></span>
                            </span>
                            <span class="text-sm text-slate-600">Remember Me</span>
                        </label>
                    </div>

                    <!-- reCAPTCHA v2 -->
                    <div class="pt-2 flex justify-center">
                        <div id="recaptcha-container"></div>
                        <input type="hidden" name="g-recaptcha-response" id="gRecaptchaResponse" value="">
                    </div>

                    <!-- Submit -->
                    <div class="pt-2 text-center">
                        <button
                            type="submit"
                            id="submitBtn"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#142444] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-[#142444]/30 transition-all duration-200 hover:scale-[1.02] hover:bg-[#0e1a34] disabled:opacity-70 disabled:cursor-not-allowed sm:w-auto"
                        >
                            <span id="btnText" class="inline-flex items-center gap-2">
                                Sign In
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                            <span id="btnSpinner" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Footer -->
                <p class="mt-6 text-center text-xs text-slate-400">
                    By signing in, you agree to our
                    <a href="#" class="font-medium text-[#142444] hover:underline">Terms of Service</a>
                    and
                    <a href="{{ route('policy') }}" class="font-medium text-[#142444] hover:underline">Privacy Policy</a>
                </p>

                <!-- JavaScript: password toggle, reCAPTCHA v2, submit handling -->
                <script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>
                <script>
                    let recaptchaId;

                    window.addEventListener('load', function () {
                        if (document.getElementById('recaptcha-container') && typeof grecaptcha !== 'undefined') {
                            recaptchaId = grecaptcha.render('recaptcha-container', {
                                sitekey: '{{ config('services.recaptcha.siteKey') }}',
                                callback: recaptchaSuccess,
                                'expired-callback': recaptchaExpired
                            });
                        }
                    });

                    function recaptchaSuccess(token) {
                        document.getElementById('gRecaptchaResponse').value = token;
                    }

                    function recaptchaExpired() {
                        document.getElementById('gRecaptchaResponse').value = '';
                        if (recaptchaId !== undefined) {
                            grecaptcha.reset(recaptchaId);
                        }
                    }

                    function togglePassword() {
                        const pwd = document.getElementById('password');
                        const icon = document.getElementById('eyeIcon');

                        if (pwd.type === 'password') {
                            pwd.type = 'text';
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c1.29 0 2.53-.234 3.674-.66M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.774 3.162 10.066 7.5a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
                        } else {
                            pwd.type = 'password';
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                        }
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        const form = document.getElementById('loginForm');
                        if (form) {
                            form.addEventListener('submit', function (e) {
                                const token = document.getElementById('gRecaptchaResponse').value.trim();
                                if (!token) {
                                    e.preventDefault();
                                    toastr.error('Please verify that you are not a robot by completing the reCAPTCHA.');
                                    return false;
                                }

                                document.getElementById('btnText').innerHTML = 'Signing In&hellip;';
                                document.getElementById('btnSpinner').classList.remove('hidden');
                                document.getElementById('submitBtn').disabled = true;
                            });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<!--// Login Page -->
@endsection