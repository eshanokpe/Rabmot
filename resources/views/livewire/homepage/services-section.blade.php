<div>
   <div 
    x-data="servicesSection()" 
    x-init="init()"
    class="services-section py-16 md:py-20 lg:py-24"
    style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12 md:mb-10 lg:mb-15">
            <span class="inline-block text-yellow-500 font-semibold text-sm uppercase tracking-wider mb-2">Our Services</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-4xl font-bold mb-4" style="color: #142444;">
                Professional <span class="text-yellow-500">Licensing</span> Solutions
            </h2>
            <p class="text-gray-600 text-base sm:text-lg md:text-xl max-w-2xl mx-auto px-4">
                Fast, reliable, and professional vehicle licensing services at your fingertips
            </p>
            <div class="w-24 h-1 mx-auto mt-4 rounded-full" style="background: linear-gradient(90deg, #142444, #FBBF24);"></div>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-5 lg:gap-6">
            @foreach($services as $index => $service)
                <div 
                    x-data="{ hover: false }"
                    @mouseenter="hover = true"
                    @mouseleave="hover = false"
                    class="service-card-wrapper"
                    :style="`animation-delay: ${$index * 0.05}s`"
                >
                    <a 
                        href="{{ $service['route'] === '#' ? 'javascript:void(0)' : route($service['route']) }}" 
                        class="block h-full group"
                        @if($service['route'] === '#') 
                            @click.prevent
                        @endif
                    >
                        <div 
                            class="service-card bg-white rounded-2xl p-4 sm:p-5 md:p-6 text-center transition-all duration-300 h-full flex flex-col items-center justify-center shadow-md hover:shadow-2xl"
                            :style="{
                                'transform': hover ? 'translateY(-8px)' : 'translateY(0)',
                                'boxShadow': hover ? '0 20px 40px rgba(20, 36, 68, 0.15)' : '0 4px 6px rgba(0,0,0,0.05)'
                            }"
                            style="border-bottom: 4px solid #FBBF24; min-height: 180px;"
                        >
                            <!-- Icon Container -->
                            <div 
                                class="icon-wrapper w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mb-3 sm:mb-4 transition-all duration-300"
                                :style="{
                                    'background-color': hover ? '#142444' : '#f0f2f5',
                                    'transform': hover ? 'scale(1.1)' : 'scale(1)'
                                }"
                            >
                                <i 
                                    class="fas {{ $service['icon'] }} text-xl sm:text-2xl md:text-3xl transition-all duration-300"
                                    :style="{
                                        'color': hover ? '#FBBF24' : '#142444'
                                    }"
                                ></i>
                            </div>

                            <!-- Title -->
                            <h6 
                                class="text-xs sm:text-sm md:text-base font-semibold transition-colors duration-300 text-center leading-tight"
                                style="color: #142444;"
                            >
                                {{ $service['title'] }}
                            </h6>

                            <!-- Description (hidden on mobile) -->
                            <p class="hidden md:block text-xs text-gray-500 mt-1 transition-opacity duration-300" 
                               :style="{ 'opacity': hover ? '1' : '0' }">
                                {{ $service['description'] }}
                            </p>

                            <!-- Arrow Indicator -->
                            <div 
                                class="service-arrow mt-2 transition-all duration-300"
                                :style="{
                                    'transform': hover ? 'translateX(4px)' : 'translateX(0)',
                                    'color': hover ? '#FBBF24' : '#142444'
                                }"
                            >
                                <i class="fas fa-arrow-right text-xs sm:text-sm"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-12 md:mt-16">
            <div class="inline-flex items-center gap-4 bg-white rounded-2xl p-2 shadow-lg">
                <span class="text-gray-700 font-medium px-4 py-2">Need help choosing?</span>
                <a 
                    href="{{ route('contactus') }}" 
                    class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl"
                    style="background: linear-gradient(135deg, #142444 0%, #1a2d5a 100%); color: white;"
                >
                    Contact Us
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Base Styles */
    .services-section {
        position: relative;
        overflow: hidden;
    }

    .services-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(251, 191, 36, 0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    .service-card {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        will-change: transform;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(20, 36, 68, 0.02), rgba(251, 191, 36, 0.04));
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        border-radius: 16px;
    }

    .service-card:hover::before {
        opacity: 1;
    }

    .service-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #142444, #FBBF24);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(-50%);
        border-radius: 3px;
    }

    .service-card:hover::after {
        width: 80%;
    }

    /* Icon Wrapper */
    .icon-wrapper {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        flex-shrink: 0;
    }

    .icon-wrapper::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        background: linear-gradient(135deg, #142444, #FBBF24);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .service-card:hover .icon-wrapper::after {
        opacity: 0.1;
    }

    .service-arrow {
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Animation */
    .service-card-wrapper {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 480px) {
        .service-card {
            min-height: 150px !important;
            padding: 0.75rem !important;
        }
        
        .icon-wrapper {
            width: 48px !important;
            height: 48px !important;
        }
        
        .icon-wrapper i {
            font-size: 1.1rem !important;
        }
        
        .service-card h6 {
            font-size: 0.7rem !important;
        }
    }

    @media (min-width: 481px) and (max-width: 768px) {
        .service-card {
            min-height: 170px !important;
        }
    }

    /* Tablet and Desktop */
    @media (min-width: 769px) {
        .service-card {
            min-height: 200px;
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .service-card {
            background: #1a202c !important;
        }
        
        .service-card h6 {
            color: #e2e8f0 !important;
        }

        .services-section {
            background: linear-gradient(135deg, #0d1117 0%, #161b22 100%) !important;
        }
    }

    /* Accessibility */
    .service-card:focus-visible {
        outline: 2px solid #FBBF24;
        outline-offset: 2px;
    }

    /* Hover state for touch devices */
    @media (hover: hover) {
        .service-card:hover {
            transform: translateY(-8px);
        }
    }

    /* Print styles */
    @media print {
        .services-section {
            background: white !important;
            padding: 2rem 0 !important;
        }
        .service-card {
            box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
            border: 1px solid #e5e7eb !important;
        }
        .service-card:hover {
            transform: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function servicesSection() {
        return {
            init() {
                // Initialize intersection observer for scroll animations
                if ('IntersectionObserver' in window) {
                    const cards = document.querySelectorAll('.service-card-wrapper');
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.style.animationPlayState = 'running';
                            }
                        });
                    }, {
                        threshold: 0.1,
                        rootMargin: '0px 0px -50px 0px'
                    });

                    cards.forEach((card) => {
                        card.style.animationPlayState = 'paused';
                        observer.observe(card);
                    });

                    // Store observer for cleanup
                    this._observer = observer;
                } else {
                    // Fallback for older browsers
                    document.querySelectorAll('.service-card-wrapper').forEach((card) => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    });
                }
            },

            // Cleanup observer when component is destroyed
            destroy() {
                if (this._observer) {
                    this._observer.disconnect();
                }
            }
        }
    }
</script>
@endpush
</div>
