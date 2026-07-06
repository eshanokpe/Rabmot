<footer class="footer-section">
    <!-- Main Footer -->
    <div class="bg-pry" style="background: linear-gradient(135deg, #142444 0%, #1a2d5a 100%);">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 py-8 md:py-12">
                
                <!-- Column 1: Logo & Description -->
                <div class="sm:col-span-2 lg:col-span-5 footer-col">
                    <a class="navbar-brand inline-block mb-4" href="/">
                        <img src="{{ asset('assets/img/rab.png') }}" width="150" alt="RABMOT Licensing" class="h-auto">
                    </a>
                    <p class="text-gray-300 text-sm leading-relaxed max-w-md ml-0 md:ml-0">
                        We serves as your authorized representative / agent to the necessary official bodies or parastatals 
                        responsible for approving the papers we process. Please note that we do not privately produce these papers nor make any such claims.
                    </p>
                    
                    <!-- Social Media -->
                    <div class="mt-4">
                        <h5 class="text-white text-sm font-semibold flex items-center gap-2">
                            FOLLOW US:
                            <a href="https://www.facebook.com/rabmotlicensing" target="_blank" rel="noopener noreferrer" 
                               class="social-icon text-gray-300 hover:text-yellow-500 transition-colors duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/rabmotlicensing/" target="_blank" rel="noopener noreferrer" 
                               class="social-icon text-gray-300 hover:text-yellow-500 transition-colors duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://twitter.com/rabmotlicensinq" target="_blank" rel="noopener noreferrer" 
                               class="social-icon text-gray-300 hover:text-yellow-500 transition-colors duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/message/CXH37OUHPFJ3J1" target="_blank" rel="noopener noreferrer" 
                               class="social-icon text-gray-300 hover:text-yellow-500 transition-colors duration-300">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/rabmot-automobile-and-licensing-agency-b72b90243/" target="_blank" rel="noopener noreferrer" 
                               class="social-icon text-gray-300 hover:text-yellow-500 transition-colors duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </h5>
                    </div>
                </div>

                <!-- Column 2: Company -->
                <div class="sm:col-span-1 lg:col-span-2 footer-col">
                    <h4 class="text-white font-semibold text-lg mb-4 relative">
                        Company
                        <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-grey-500 mt-1"></span>
                    </h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('aboutus') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('community') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                Community
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('agent.login') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                Agents Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('policy') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Clients -->
                <div class="sm:col-span-1 lg:col-span-2 footer-col">
                    <h4 class="text-white font-semibold text-lg mb-4 relative">
                        Clients
                        <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-grey-500 mt-1"></span>
                    </h4>
                    <ul class="space-y-2">
                        <li>
                            @if(!auth()->check())
                                <a href="{{ route('processpapers') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                    Clients Login
                                </a>
                            @endif
                        </li>
                        <li>
                            @if(!auth()->check())
                                <a href="{{ route('signup') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                    Create Account
                                </a>
                            @endif
                        </li>
                        <li>
                            <a href="{{ route('howitwork') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                How it works
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                Terms of Use
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Contact -->
                <div class="sm:col-span-2 lg:col-span-3 footer-col">
                    <h4 class="text-white font-semibold text-lg mb-4 relative">
                        Contact Us
                        <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-black-500 mt-1"></span>
                    </h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-white mt-1"></i>
                            <span class="text-gray-300 text-sm">
                                1st floor AMG Workspace 22 Road, <br>Festac Town, Lagos Nigeria.
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-white"></i>
                            <a href="mailto:support@rabmotlicensing.com?subject=Email%20Subject&body=Email%20Body" 
                               class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm break-all">
                                support@rabmotlicensing.com
                            </a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-white"></i>
                            <div class="flex flex-wrap gap-1">
                                <a href="tel:+2348155206810" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                    +2348155206810
                                </a>
                                <span class="text-gray-500">,</span>
                                <a href="tel:+2347088173662" class="text-gray-300 hover:text-yellow-500 transition-colors duration-300 text-sm">
                                    +2347088173662
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="bg-light" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-top: 1px solid rgba(20, 36, 68, 0.1);">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-4 text-center">
                <h6 class="text-gray-600 text-sm font-medium">
                    © {{ $currentYear }} RABMOT LICENSING AGENCY. All rights reserved.
                </h6>
            </div>
        </div>
    </div>
</footer>

@push('styles')
<style>
    .footer-section {
        position: relative;
        overflow: hidden;
    }

    .footer-section .bg-pry {
        position: relative;
        overflow: hidden;
    }

    .footer-section .bg-pry::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 70% 30%, rgba(251, 191, 36, 0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    .footer-col {
        position: relative;
        z-index: 1;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .social-icon:hover {
        background: rgba(251, 191, 36, 0.1);
        transform: translateY(-2px);
    }

    .footer-col h4 {
        display: inline-block;
        padding-bottom: 8px;
    }

    .footer-col h4::after {
        content: '';
        display: block;
        width: 30px;
        height: 2px;
        background: #fff;
        margin-top: 4px;
        border-radius: 2px;
    }

    .footer-col ul li {
        padding: 2px 0;
    }

    .footer-col ul li a {
        position: relative;
        display: inline-block;
    }

    .footer-col ul li a::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: #fff;
        transition: width 0.3s ease;
    }

    .footer-col ul li a:hover::before {
        width: 100%;
    }

    .footer-col .fas, 
    .footer-col .fab {
        font-size: 14px;
        width: 20px;
        flex-shrink: 0;
    }

    /* Dark mode support for copyright */
    @media (prefers-color-scheme: dark) {
        .bg-light {
            background: linear-gradient(135deg, #0d1117 0%, #161b22 100%) !important;
            border-top-color: rgba(255, 255, 255, 0.05) !important;
        }
        
        .bg-light h6 {
            color: #94a3b8 !important;
        }
    }

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .footer-col {
            padding: 0.5rem 0;
        }
        
        .footer-col h4 {
            margin-bottom: 0.75rem;
        }
        
        .social-icon {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }
    }

    /* Tablet Responsive */
    @media (min-width: 641px) and (max-width: 1024px) {
        .footer-col ul li a {
            font-size: 0.875rem;
        }
    }

    /* Print styles */
    @media print {
        .footer-section .bg-pry {
            background: #142444 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .footer-section .bg-light {
            background: #f8fafc !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .social-icon {
            background: rgba(255, 255, 255, 0.1) !important;
        }
    }
</style>
@endpush