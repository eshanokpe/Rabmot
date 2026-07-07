@extends('layouts.app')

@section('content')
<!-- Reset Password Page -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<div class="min-h-screen bg-slate-50 flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">

        @if(Session::has('flash-error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ Session::get('flash-error') }}
            </div>
        @endif

        <div class="rounded-2xl bg-white p-8 sm:p-10 shadow-xl shadow-slate-900/10">

            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#142444]/10">
                <svg class="w-6 h-6 text-[#142444]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                </svg>
            </div>

            <h2 class="mt-4 text-center text-2xl font-bold text-slate-900">{{ __('Reset Password') }}</h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                {{ __('Choose a new password for your account.') }}
            </p>

            <form method="POST" action="{{ route('reset.password.post') }}" id="signInForm" class="mt-6 space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

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

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">New Password</label>
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
                            placeholder="Enter your new password"
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
                            placeholder="Confirm your new password"
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
                            {{ __('Reset Password') }}
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
        </div>
    </div>
</div>

<!-- JavaScript: password show/hide, reCAPTCHA v2, submit handling -->
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

                document.getElementById('btnText').textContent = 'Resetting…';
                document.getElementById('btnSpinner').classList.remove('hidden');
                document.getElementById('submitBtn').disabled = true;
            });
        }
    });

    @if (session('recaptcha_error'))
        toastr.error("{{ session('recaptcha_error') }}");
    @endif
</script>
<!--// Reset Password Page -->
@endsection