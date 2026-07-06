<section class="why-choose-us py-16 md:py-20 lg:py-24" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <!-- Section Badge -->
                <div>
                    <span class="inline-block text-black-500 font-semibold text-sm uppercase tracking-wider">Why Choose Us?</span>
                    <div class="w-16 h-1 mt-2 rounded-full" style="background: linear-gradient(90deg, #142444, #808080);"></div>
                </div>

                <!-- Description -->
                <div class="space-y-4">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight" style="color: #142444;">
                        Why <span class="text-black-500">Choose Us?</span>
                    </h2>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed max-w-lg">
                        We understand that the process of obtaining the necessary documents for your vehicle 
                        can be overwhelming and time-consuming. That's why we are here to provide you with a 
                        seamless, stress-free experience.
                    </p>
                </div>

                <!-- Feature Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 md:gap-6 pt-4">
                    @foreach($features as $index => $feature)
                        <div 
                            x-data="{ hover: false }"
                            @mouseenter="hover = true"
                            @mouseleave="hover = false"
                            class="feature-card group"
                            :style="`animation-delay: ${index * 0.1}s`"
                        >
                            <a 
                                href="$feature['route']" 
                                
                                class="block"
                            >
                                <div 
                                    class="bg-white rounded-2xl p-4 md:p-6 text-center transition-all duration-300 shadow-md hover:shadow-xl"
                                    :style="{
                                        'transform': hover ? 'translateY(-6px)' : 'translateY(0)',
                                        'boxShadow': hover ? '0 20px 40px rgba(20, 36, 68, 0.12)' : '0 4px 6px rgba(0,0,0,0.05)'
                                    }"
                                    style="border: 1px solid rgba(20, 36, 68, 0.08);"
                                >
                                    <!-- Icon -->
                                    <div 
                                        class="icon-wrapper w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-3 transition-all duration-300"
                                        :style="{
                                            'background-color': hover ? '#142444' : '#f0f2f5',
                                            'transform': hover ? 'scale(1.05)' : 'scale(1)'
                                        }"
                                    >
                                        <img 
                                            src="{{ asset($feature['icon']) }}" 
                                            alt="{{ $feature['title'] }}"
                                            class="w-8 h-8 sm:w-10 sm:h-10 object-contain transition-all duration-300"
                                            :style="{
                                                'filter': hover ? 'brightness(0) invert(1)' : 'none'
                                            }"
                                        >
                                    </div>

                                    <!-- Title -->
                                    <h6 
                                        class="text-xs sm:text-sm font-semibold transition-colors duration-300"
                                        style="color: #142444;"
                                    >
                                        {{ $feature['title'] }}
                                    </h6>

                                    <!-- Arrow Indicator -->
                                    <div 
                                        class="mt-2 transition-all duration-300"
                                        :style="{
                                            'transform': hover ? 'translateX(4px)' : 'translateX(0)',
                                            'color': hover ? '#FBBF24' : '#142444'
                                        }"
                                    >
                                        <i class="fas fa-arrow-right text-xs"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Trust Badge -->
                <div class="flex items-center gap-6 pt-4">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-bold" style="color: #142444;">✓</div>
                            <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-bold" style="color: #142444;">✓</div>
                            <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-bold" style="color: #142444;">✓</div>
                        </div>
                        <span class="text-sm text-gray-600">Trusted by 1000+ clients</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - Image -->
            <div class="relative lg:pl-8">
                <div class="relative">
                    <!-- Decorative Border -->
                    <div class="absolute inset-0 rounded-2xl" style="border: 4px solid #142444; transform: rotate(-3deg);"></div>
                    
                    <!-- Main Image Container -->
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl" style="background: linear-gradient(135deg, #142444, #1a2d5a);">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M30 0l30 30-30 30L0 30z\'/%3E%3C/g%3E%3C/svg%3E');"></div>
                        
                        <!-- Doorstep Delivery Badge -->
                        <div class="absolute top-4 right-4 z-10 bg-white px-4 py-2 rounded-full shadow-lg">
                            <span class="text-sm font-semibold" style="color: #142444;">
                                <i class="fas fa-truck text-yellow-500 mr-2"></i>
                                Doorstep Delivery
                            </span>
                        </div>

                        <!-- Image -->
                        <img 
                            src="{{ asset('assets/img/whoarewe.png') }}" 
                            alt="Why Choose Us"
                            class="w-full h-auto object-cover relative z-0"
                            style="min-height: 300px;"
                        >

                        <!-- Overlay Gradient -->
                        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/50 to-transparent"></div>

                        <!-- Stats Overlay -->
                        <div class="absolute bottom-4 left-4 right-4 z-10 grid grid-cols-3 gap-2">
                            <div class="bg-white/95 backdrop-blur-sm rounded-xl p-3 text-center shadow-lg">
                                <p class="text-lg font-bold" style="color: #142444;">5K+</p>
                                <p class="text-xs text-gray-600">Documents</p>
                            </div>
                            <div class="bg-white/95 backdrop-blur-sm rounded-xl p-3 text-center shadow-lg">
                                <p class="text-lg font-bold" style="color: #142444;">99%</p>
                                <p class="text-xs text-gray-600">Success Rate</p>
                            </div>
                            <div class="bg-white/95 backdrop-blur-sm rounded-xl p-3 text-center shadow-lg">
                                <p class="text-lg font-bold" style="color: #142444;">72h</p>
                                <p class="text-xs text-gray-600">Delivery</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .why-choose-us {
        position: relative;
        overflow: hidden;
    }

    .why-choose-us::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at 30% 50%, rgba(251, 191, 36, 0.03) 0%, transparent 50%);
        pointer-events: none;
    }

    .feature-card {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .icon-wrapper {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
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

    .feature-card:hover .icon-wrapper::after {
        opacity: 0.1;
    }

    /* Responsive Adjustments */
    @media (max-width: 640px) {
        .feature-card {
            animation-delay: 0s !important;
        }
    }

    @media (prefers-color-scheme: dark) {
        .why-choose-us {
            background: linear-gradient(135deg, #0d1117 0%, #161b22 50%, #0d1117 100%) !important;
        }

        .feature-card .bg-white {
            background: #1a202c !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
        }

        .feature-card h6 {
            color: #e2e8f0 !important;
        }

        .why-choose-us p {
            color: #94a3b8 !important;
        }

        .bg-white\/95 {
            background: rgba(26, 32, 44, 0.95) !important;
        }

        .bg-white\/95 p {
            color: #e2e8f0 !important;
        }

        .bg-white\/95 .text-gray-600 {
            color: #94a3b8 !important;
        }
    }

    /* Print Styles */
    @media print {
        .why-choose-us {
            background: white !important;
            padding: 2rem 0 !important;
        }
        .feature-card .bg-white {
            box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
            border: 1px solid #e5e7eb !important;
        }
        .feature-card:hover {
            transform: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if ('IntersectionObserver' in window) {
            const cards = document.querySelectorAll('.feature-card');
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
        } else {
            document.querySelectorAll('.feature-card').forEach((card) => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            });
        }
    });
</script>
@endpush