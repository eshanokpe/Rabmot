@extends('layouts.app')

@section('content')
<!-- Forgot Password Page -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<div class="min-h-screen bg-slate-50 py-16 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">

        @if ($errors->has('verified'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ $errors->first('verified') }}
            </div>
        @endif

        @if(Session::has('flash-error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ Session::get('flash-error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 rounded-2xl shadow-xl shadow-slate-900/10 bg-white">

            <!-- Left panel: existing user -->
            <div
                class="relative lg:col-span-2 bg-cover bg-center flex items-end overflow-hidden rounded-t-2xl lg:rounded-l-2xl lg:rounded-tr-none"
                style="background-image: linear-gradient(180deg, rgba(20,36,68,0.35) 0%, rgba(20,36,68,0.92) 100%), url('{{ asset('assets/img/Car_22.png') }}');"
            >
                <div class="relative z-10 p-8 sm:p-10 w-full text-white">
                    <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-white/70">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                        </svg>
                        Existing User
                    </span>
                    <h4 class="mt-4 text-2xl sm:text-3xl font-bold leading-tight">
                        Already have an account?
                    </h4>
                    <p class="mt-3 text-sm sm:text-base text-white/80">
                        Sign in to pick up right where you left off and manage your papers with ease.
                    </p>
                    <a
                        href="{{ route('processpapers') }}"
                        class="mt-6 inline-flex items-center justify-center gap-2 rounded-lg border-2 border-white bg-white px-8 py-3 text-sm font-bold uppercase tracking-wide text-[#142444] shadow-lg shadow-black/20 transition-all duration-200 hover:scale-105 hover:bg-[#142444] hover:text-white"
                    >
                        Sign In
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right panel: forgot password form -->
            <div class="lg:col-span-3 p-8 sm:p-10">
                <h2 class="text-2xl font-bold text-slate-900">Forgot your password?</h2>
                <p class="mt-1 text-sm text-slate-500">Enter your email and we'll send you a link to reset it.</p>

                @if(session('status'))
                    <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                        <strong class="font-semibold">Success!</strong> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" id="signInForm" class="mt-6 space-y-5">
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
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                class="block w-full rounded-lg border py-2.5 pl-10 pr-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:border-[#142444] @error('email') border-red-400 @else border-slate-300 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- reCAPTCHA v2 -->
                    <div class="pt-2 flex justify-center">
                        <div id="recaptcha-container"></div>
                        <input type="hidden" name="g-recaptcha-response" id="gRecaptchaResponse" value="">
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 text-center">
                        <button
                            type="submit"
                            id="submitBtn"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#142444] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-[#142444]/30 transition-all duration-200 hover:scale-[1.02] hover:bg-[#0e1a34] disabled:opacity-70 disabled:cursor-not-allowed sm:w-auto"
                        >
                            <span id="btnText" class="inline-flex items-center gap-2">
                                Send Password Reset Link
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

                <!-- JavaScript: reCAPTCHA v2 + submit handling -->
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

                    document.addEventListener('DOMContentLoaded', function () {
                        const form = document.getElementById('signInForm');
                        if (form) {
                            form.addEventListener('submit', function (e) {
                                const token = document.getElementById('gRecaptchaResponse').value.trim();
                                if (!token) {
                                    e.preventDefault();
                                    toastr.error('Please verify that you are not a robot by completing the reCAPTCHA.');
                                    return false;
                                }

                                document.getElementById('btnText').innerHTML = 'Sending&hellip;';
                                document.getElementById('btnSpinner').classList.remove('hidden');
                                document.getElementById('submitBtn').disabled = true;
                            });
                        }
                    });

                    @if (session('recaptcha_error'))
                        toastr.error("{{ session('recaptcha_error') }}");
                    @endif
                </script>
            </div>
        </div>
    </div>
</div>
<!--// Forgot Password Page -->
@endsection