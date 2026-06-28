<div 
    x-data="sliderComponent()" 
    x-init="init()" 
    class="relative w-full overflow-hidden"
    style="min-height: 100vh; background-color: #142444;"
    @touchstart="handleTouchStart($event)"
    @touchmove="handleTouchMove($event)"
    @touchend="handleTouchEnd()"
>
    <div class="relative w-full h-screen">
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-400"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 w-full h-full will-change-transform"
                :style="`background-image: url('${slide.bg_image}'); background-size: cover; background-position: center center;`"
            >
                <!-- Brand Color Overlay with gradient -->
                <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(20, 36, 68, 0.92) 0%, rgba(20, 36, 68, 0.70) 40%, rgba(20, 36, 68, 0.30) 70%, transparent 100%);"></div>
                
                <!-- Content Container -->
                <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center w-full">
                        <!-- Left Text Content -->
                        <div class="text-white space-y-7 md:space-y-8 max-w-2xl pl-12 sm:pl-14 md:pl-16 lg:pl-20">
                            <div class="space-y-5">
                                <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold leading-tight tracking-tight">
                                    <span x-text="slide.title"></span>
                                </h3>
                                
                                <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold leading-none">
                                    <span class="text-yellow-400 drop-shadow-lg" x-text="slide.highlight"></span>
                                </h1>
                            </div>

                            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-light text-gray-100 leading-relaxed" x-text="slide.subtitle"></p>

                            <div class="pt-3">
                                @if(auth()->check())
                                    <a href="{{ route('home') }}" 
                                       class=" md:text-1xl inline-block px-2 py-3 bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-600 text-[#142444] font-semibold text-lg rounded-xl transition-all duration-300 transform hover:scale-[1.03] active:scale-[0.98] shadow-lg hover:shadow-yellow-500/25">
                                        View Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('signup') }}" 
                                       class="md:text-1xl inline-block px-2 py-3 bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-600 text-[#142444] font-semibold text-lg rounded-xl transition-all duration-300 transform hover:scale-[1.03] active:scale-[0.98] shadow-lg hover:shadow-yellow-500/25">
                                        Sign Up Now
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Right Floating Image -->
                        <div class="flex justify-center items-center w-full">
                            <img 
                                :src="'{{ asset('') }}' + slide.image" 
                                alt="Featured Image"
                                loading="lazy"
                                class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl object-contain drop-shadow-2xl animate-bounce-slow"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Previous Arrow - Brand Color -->
        <button 
            @click="previousSlide()" 
            class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 z-20 p-3 md:p-4 rounded-full text-white backdrop-blur-sm transition-all duration-300 hover:scale-110 active:scale-95"
            style="background-color: rgba(20, 36, 68, 0.7); hover:background-color: rgba(20, 36, 68, 0.9);"
            aria-label="Previous slide"
        >
            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <!-- Next Arrow - Brand Color -->
        <button 
            @click="nextSlide()" 
            class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 z-20 p-3 md:p-4 rounded-full text-white backdrop-blur-sm transition-all duration-300 hover:scale-110 active:scale-95"
            style="background-color: rgba(20, 36, 68, 0.7); hover:background-color: rgba(20, 36, 68, 0.9);"
            aria-label="Next slide"
        >
            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Dots Navigation - Brand Color -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
            <template x-for="(slide, index) in slides" :key="index">
                <button 
                    @click="goToSlide(index)" 
                    :class="{
                        'w-12 bg-yellow-400 shadow-md shadow-yellow-400/30': currentSlide === index, 
                        'w-3 bg-white/40 hover:bg-white/70': currentSlide !== index
                    }"
                    class="h-3 rounded-full transition-all duration-300 ease-out"
                    :aria-label="`Go to slide ${index + 1}`"
                ></button>
            </template>
        </div>

        <!-- Slide Counter - Brand Color -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 pointer-events-none">
            <span class="text-white text-sm font-medium px-3 py-1 rounded-full backdrop-blur-sm" style="background-color: rgba(20, 36, 68, 0.7);">
                <span x-text="currentSlide + 1"></span> / <span x-text="slides.length"></span>
            </span>
        </div>

        <!-- Autoplay Toggle - Brand Color -->
        <button 
            @click="toggleAutoplay()"
            class="absolute bottom-8 right-6 z-20 p-2.5 rounded-full text-white backdrop-blur-sm transition-all duration-300 hover:scale-105 active:scale-95"
            style="background-color: rgba(20, 36, 68, 0.7); hover:background-color: rgba(20, 36, 68, 0.9);"
            aria-label="Toggle autoplay"
        >
            <svg x-show="autoplay" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <svg x-show="!autoplay" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </button>
    </div>
</div>


<script>
    function sliderComponent() {
        return {
            slides: @json($slides),
            currentSlide: {{ $currentSlide ?? 0 }},
            autoplay: {{ $autoplay ?? true ? 'true' : 'false' }},
            interval: {{ $interval ?? 5000 }},
            timer: null,

            // Touch variables
            touchStartX: 0,
            touchEndX: 0,
            swipeThreshold: 50,

            init() {
                if (this.autoplay) this.startAutoplay();
                
                // Pause when tab is inactive
                document.addEventListener('visibilitychange', () => {
                    document.hidden ? this.stopAutoplay() : this.autoplay && this.startAutoplay();
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') this.previousSlide();
                    if (e.key === 'ArrowRight') this.nextSlide();
                });
            },

            startAutoplay() {
                this.stopAutoplay();
                this.timer = setInterval(() => this.nextSlide(), this.interval);
            },

            stopAutoplay() {
                if (this.timer) clearInterval(this.timer);
                this.timer = null;
            },

            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                this.autoplay && this.startAutoplay();
            },

            previousSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                this.autoplay && this.startAutoplay();
            },

            goToSlide(index) {
                this.currentSlide = index;
                this.autoplay && this.startAutoplay();
            },

            toggleAutoplay() {
                this.autoplay = !this.autoplay;
                this.autoplay ? this.startAutoplay() : this.stopAutoplay();
            },

            handleTouchStart(e) {
                this.touchStartX = e.changedTouches[0].screenX;
            },

            handleTouchMove(e) {
                this.touchEndX = e.changedTouches[0].screenX;
            },

            handleTouchEnd() {
                const distance = this.touchEndX - this.touchStartX;
                if (distance < -this.swipeThreshold) this.nextSlide();
                if (distance > this.swipeThreshold) this.previousSlide();
                this.touchStartX = this.touchEndX = 0;
            }
        }
    }
</script>


<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-18px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3.2s ease-in-out infinite;
        will-change: transform;
    }

    /* Brand Color Utility Classes */
    .bg-brand {
        background-color: #142444;
    }
    .bg-brand-light {
        background-color: rgba(20, 36, 68, 0.7);
    }
    .bg-brand-hover:hover {
        background-color: rgba(20, 36, 68, 0.9);
    }
    .text-brand {
        color: #142444;
    }
    .border-brand {
        border-color: #142444;
    }
    .shadow-brand {
        box-shadow: 0 4px 14px rgba(20, 36, 68, 0.3);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #142444;
    }
    ::-webkit-scrollbar-thumb {
        background: #FBBF24;
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #F59E0B;
    }
</style>
