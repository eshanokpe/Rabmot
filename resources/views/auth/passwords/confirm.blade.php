@extends('layouts.app')

@section('content')
<!-- Confirm Password Page -->
<div class="min-h-screen bg-slate-50 flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div class="rounded-2xl bg-white p-8 sm:p-10 shadow-xl shadow-slate-900/10">

            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#142444]/10">
                <svg class="w-6 h-6 text-[#142444]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4h8z" />
                </svg>
            </div>

            <h2 class="mt-4 text-center text-2xl font-bold text-slate-900">{{ __('Confirm Password') }}</h2>
            <p class="mt-2 text-center text-sm text-slate-500">
                {{ __('Please confirm your password before continuing.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-5">
                @csrf

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">{{ __('Password') }}</label>
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
                            placeholder="{{ __('Enter your password') }}"
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

                <!-- Submit -->
                <div class="pt-2 text-center">
                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#142444] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-lg shadow-[#142444]/30 transition-all duration-200 hover:scale-[1.02] hover:bg-[#0e1a34] sm:w-auto"
                    >
                        {{ __('Confirm Password') }}
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <p class="text-center text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-[#142444] hover:underline">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</div>

<!-- JavaScript: password show/hide -->
<script>
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
</script>
<!--// Confirm Password Page -->
@endsection