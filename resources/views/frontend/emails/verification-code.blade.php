@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-md rounded-2xl bg-white p-8 shadow-xl shadow-slate-900/10 sm:p-10">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-blue-50 text-[#142444]">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-slate-900">Verify your email</h1>
            <p class="mt-2 text-sm leading-6 text-slate-600">
                We sent a six-digit verification code to <strong>{{ $user->email }}</strong>.
                Enter it below to activate your account. The code expires in 10 minutes.
            </p>

            @if (session('success'))
                <div class="mt-5 rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-700" role="status">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mt-5 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->has('code'))
                <div class="mt-5 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700" role="alert">
                    {{ $errors->first('code') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.code.submit') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="code" class="block text-sm font-medium text-slate-700">Verification code</label>
                    <input
                        id="code"
                        name="code"
                        type="text"
                        inputmode="numeric"
                        autocomplete="one-time-code"
                        pattern="[0-9]{6}"
                        maxlength="6"
                        required
                        autofocus
                        aria-describedby="code-hint"
                        class="mt-1 block w-full rounded-lg border border-slate-300 px-4 py-3 text-center text-2xl font-semibold tracking-[0.5em] text-slate-900 shadow-sm focus:border-[#142444] focus:outline-none focus:ring-2 focus:ring-[#142444]/30"
                    >
                    <p id="code-hint" class="mt-2 text-xs text-slate-500">Enter the 6-digit code from your email.</p>
                </div>
                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-[#142444] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0e1a34] focus:outline-none focus:ring-2 focus:ring-[#142444]/40 focus:ring-offset-2"
                >
                    Verify email
                </button>
            </form>

            <div class="mt-6 border-t border-slate-100 pt-5 text-center">
                <p class="text-sm text-slate-600">Didn’t receive the code?</p>
                <form method="POST" action="{{ route('verification.code.resend') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-[#142444] hover:underline">
                        Send a new code
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
