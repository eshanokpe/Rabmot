@extends('layouts.app')

@section('title', 'Application Submitted Successfully')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                <div class="card-body p-5 text-center">

                    <!-- Success Icon -->
                    <div class="mx-auto mb-4" style="width: 100px; height: 100px; background: #ecfdf5; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                    </div>

                    <h2 class="mb-3" style="color: #142444; font-weight: 700;">Payment & Application Successful!</h2>
                    <p class="text-muted mb-4">Thank you for choosing Rabmot Licensing. Your application has been received and is now being processed.</p>

                    <!-- Reference Details -->
                    <div class="bg-light rounded p-4 mb-4 text-left">
                        <div class="row mb-3">
                            <div class="col-6 text-muted">Order Reference:</div>
                            <div class="col-6 text-right fw-bold text-dark">{{ $reference }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 text-muted">Service Type:</div>
                            <div class="col-6 text-right fw-bold text-dark">New Driver License</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 text-muted">Payment Status:</div>
                            <div class="col-6 text-right">
                                <span class="badge bg-success px-3 py-1">Paid</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-muted">Estimated Processing:</div>
                            <div class="col-6 text-right fw-bold text-dark">5 – 10 Working Days</div>
                        </div>
                    </div>

                    <!-- Next Steps Info -->
                    <div class="alert alert-info text-left mb-4">
                        <h6 class="fw-bold mb-2">What happens next?</h6>
                        <ul class="mb-0 ps-3">
                            <li>We will verify your details and documents.</li>
                            <li>An agent will contact you via email or phone within 24 hours if we need more information.</li>
                            <li>You will receive updates and your license details via email once ready.</li>
                        </ul>
                    </div>

                    <!-- Optional: Create Account Prompt -->
                    @guest
                    <div class="bg-warning bg-opacity-10 border border-warning rounded p-4 mb-4 text-left">
                        <h6 class="fw-bold text-dark mb-2">Want to track your application easily?</h6>
                        <p class="text-muted mb-3">Create a free account to view status, save details, and manage future applications.</p>
                        <a href="{{ route('signup', ['ref' => $reference]) }}" class="btn btn-primary-custom" style="background: #142444; border: none;">
                            <i class="fas fa-user-plus me-2"></i> Create My Account
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-2">Skip for Now</a>
                    </div>
                    @endguest

                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary-custom px-4" style="background: #142444; border: none;">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-download me-2"></i> Download Receipt
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, nav, footer { display: none !important; }
    body { background: white !important; }
}
</style>
@endsection