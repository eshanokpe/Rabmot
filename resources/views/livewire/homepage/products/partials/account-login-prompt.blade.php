@if($accountExists)
<div class="card border-warning mb-4">
    <div class="card-body">
        <h6 class="mb-2"><i class="fas fa-lock mr-2"></i> Log in to continue</h6>
        <p class="text-muted small mb-3">An account already exists for <strong>{{ $email }}</strong>. Enter your password to continue this application under your account.</p>

        @if($loginError)
            <div class="alert alert-danger py-2">{{ $loginError }}</div>
        @endif

        <div class="form-group mb-3">
            <input type="password" class="form-control" wire:model="loginPassword" wire:keydown.enter="attemptLogin" placeholder="Password">
        </div>

        <button type="button" class="btn btn-primary-custom" wire:click="attemptLogin" wire:loading.attr="disabled" wire:target="attemptLogin">
            <span wire:loading.remove wire:target="attemptLogin">Log In &amp; Continue</span>
            <span wire:loading wire:target="attemptLogin"><i class="fas fa-spinner fa-spin mr-1"></i> Logging in...</span>
        </button>
        <a href="{{ route('password.request') }}" class="btn btn-link btn-sm" target="_blank">Forgot password?</a>
    </div>
</div>
@endif
