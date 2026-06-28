<section class="testimonials-section py-16 md:py-20 lg:py-24" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12 md:mb-16">
            <span class="inline-block text-yellow-500 font-semibold text-sm uppercase tracking-wider mb-2">Testimonials</span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold" style="color: #142444;">
                What Our <span class="text-yellow-500">Clients Say</span>
            </h2>
            <p class="text-gray-600 text-base sm:text-lg mt-4 max-w-2xl mx-auto">
                Real reviews from real people who have used our services
            </p>
            <div class="w-24 h-1 mx-auto mt-4 rounded-full" style="background: linear-gradient(90deg, #142444, #FBBF24);"></div>
        </div>

        <!-- Desktop View (2 columns) -->
        <div class="hidden md:block">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                @foreach($visibleTestimonials as $testimonial)
                    <div 
                        x-data="{ hover: false }"
                        @mouseenter="hover = true"
                        @mouseleave="hover = false"
                        class="testimonial-card bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300"
                        :style="{
                            'transform': hover ? 'translateY(-4px)' : 'translateY(0)',
                            'boxShadow': hover ? '0 20px 40px rgba(20, 36, 68, 0.12)' : '0 4px 6px rgba(0,0,0,0.05)'
                        }"
                        style="border-left: 4px solid #FBBF24;"
                    >
                        <div class="flex items-start gap-4">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                <img 
                                    src="{{ asset($testimonial['image']) }}" 
                                    alt="{{ $testimonial['name'] }}"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-yellow-500 shadow-md"
                                >
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <!-- Stars -->
                                <div class="flex text-yellow-500 mb-2">
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                </div>

                                <!-- Review -->
                                <p class="text-gray-700 text-sm leading-relaxed mb-3">
                                    "{{ $testimonial['review'] }}"
                                </p>

                                <!-- Name & Designation -->
                                <div>
                                    <h6 class="font-semibold" style="color: #142444;">
                                        {{ $testimonial['name'] }}
                                    </h6>
                                    <small class="text-gray-500 text-xs">{{ $testimonial['designation'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Dots (Desktop) -->
            <div class="flex justify-center gap-3 mt-10">
                @for($i = 0; $i < $totalSlides; $i++)
                    <button 
                        wire:click="goToSlide({{ $i }})"
                        class="h-3 rounded-full transition-all duration-300"
                        :class="{
                            'w-12 bg-yellow-500 shadow-md shadow-yellow-500/30': {{ $i }} === {{ $currentSlide }}, 
                            'w-3 bg-gray-300 hover:bg-gray-400': {{ $i }} !== {{ $currentSlide }}
                        }"
                        aria-label="Go to slide {{ $i + 1 }}"
                    ></button>
                @endfor
            </div>

            <!-- Navigation Arrows (Desktop) -->
            <div class="flex justify-center gap-4 mt-6">
                <button 
                    wire:click="previousSlide" 
                    class="p-3 rounded-full transition-all duration-300 hover:scale-110"
                    style="background-color: #142444; color: white;"
                >
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button 
                    wire:click="nextSlide" 
                    class="p-3 rounded-full transition-all duration-300 hover:scale-110"
                    style="background-color: #142444; color: white;"
                >
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Mobile View (Single column with carousel) -->
        <div class="block md:hidden relative">
            <div 
                x-data="mobileCarousel()" 
                x-init="init()"
                class="relative overflow-hidden"
            >
                <div 
                    class="flex transition-transform duration-500 ease-in-out"
                    :style="'transform: translateX(-' + currentSlide * 100 + '%)'"
                >
                    @foreach($testimonials as $testimonial)
                        <div class="w-full flex-shrink-0 px-2">
                            <div class="bg-white rounded-2xl p-6 shadow-md" style="border-left: 4px solid #FBBF24;">
                                <div class="flex items-start gap-4">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        <img 
                                            src="{{ asset($testimonial['image']) }}" 
                                            alt="{{ $testimonial['name'] }}"
                                            class="w-16 h-16 rounded-full object-cover border-2 border-yellow-500 shadow-md"
                                        >
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Stars -->
                                        <div class="flex text-yellow-500 mb-2">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>

                                        <!-- Review -->
                                        <p class="text-gray-700 text-sm leading-relaxed mb-3">
                                            "{{ Str::limit($testimonial['review'], 120) }}"
                                        </p>

                                        <!-- Name & Designation -->
                                        <div>
                                            <h6 class="font-semibold" style="color: #142444;">
                                                {{ $testimonial['name'] }}
                                            </h6>
                                            <small class="text-gray-500 text-xs">{{ $testimonial['designation'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Mobile Navigation Dots -->
                <div class="flex justify-center gap-2 mt-6">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button 
                            @click="goToSlide(index)"
                            class="h-2 rounded-full transition-all duration-300"
                            :class="{
                                'w-8 bg-yellow-500': currentSlide === index, 
                                'w-2 bg-gray-300': currentSlide !== index
                            }"
                        ></button>
                    </template>
                </div>

                <!-- Mobile Navigation Arrows -->
                <div class="flex justify-center gap-4 mt-4">
                    <button 
                        @click="previousSlide()" 
                        class="p-2 rounded-full transition-all duration-300"
                        style="background-color: #142444; color: white;"
                    >
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button 
                        @click="nextSlide()" 
                        class="p-2 rounded-full transition-all duration-300"
                        style="background-color: #142444; color: white;"
                    >
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .testimonials-section {
        position: relative;
        overflow: hidden;
    }

    .testimonials-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(251, 191, 36, 0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    .testimonial-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .testimonial-card::after {
        content: '"';
        position: absolute;
        top: -10px;
        right: 20px;
        font-size: 60px;
        opacity: 0.05;
        font-family: Georgia, serif;
        color: #142444;
    }

    .testimonial-card:hover::after {
        opacity: 0.08;
    }

    /* Mobile Carousel */
    .mobile-carousel {
        touch-action: pan-y;
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .testimonials-section {
            background: linear-gradient(135deg, #0d1117 0%, #161b22 50%, #0d1117 100%) !important;
        }

        .testimonial-card {
            background: #1a202c !important;
        }

        .testimonial-card p {
            color: #94a3b8 !important;
        }

        .testimonial-card h6 {
            color: #e2e8f0 !important;
        }

        .testimonial-card small {
            color: #64748b !important;
        }
    }

    /* Print styles */
    @media print {
        .testimonials-section {
            background: white !important;
            padding: 2rem 0 !important;
        }
        .testimonial-card {
            box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
            border: 1px solid #e5e7eb !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function mobileCarousel() {
        return {
            currentSlide: 0,
            slides: @json($testimonials),
            autoPlayTimer: null,
            isPlaying: true,

            init() {
                this.startAutoplay();

                // Pause on hover
                this.$el.addEventListener('mouseenter', () => {
                    this.stopAutoplay();
                });

                this.$el.addEventListener('mouseleave', () => {
                    this.startAutoplay();
                });

                // Touch events for mobile
                let touchStartX = 0;
                let touchEndX = 0;

                this.$el.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                this.$el.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    const diff = touchStartX - touchEndX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.previousSlide();
                        }
                    }
                }, { passive: true });
            },

            startAutoplay() {
                this.stopAutoplay();
                if (this.isPlaying) {
                    this.autoPlayTimer = setInterval(() => {
                        this.nextSlide();
                    }, 5000);
                }
            },

            stopAutoplay() {
                if (this.autoPlayTimer) {
                    clearInterval(this.autoPlayTimer);
                    this.autoPlayTimer = null;
                }
            },

            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                this.startAutoplay();
            },

            previousSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                this.startAutoplay();
            },

            goToSlide(index) {
                this.currentSlide = index;
                this.startAutoplay();
            },

            toggleAutoplay() {
                this.isPlaying = !this.isPlaying;
                if (this.isPlaying) {
                    this.startAutoplay();
                } else {
                    this.stopAutoplay();
                }
            }
        }
    }
</script>
@endpush