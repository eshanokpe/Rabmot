<section class="how-it-works-section py-16 md:py-20" style="background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
            <!-- Left Column - Video -->
            <div class="relative lg:pr-8">
                <div class="relative">
                    <!-- Decorative Border -->
                    <div class="absolute inset-0 rounded-2xl" style="border: 4px solid #142444; transform: rotate(-2deg);"></div>
                    
                    <!-- Video Container -->
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl" style="background: linear-gradient(135deg, #142444, #1a2d5a);">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M30 0l30 30-30 30L0 30z\'/%3E%3C/g%3E%3C/svg%3E');"></div>

                        <!-- Video Badge -->
                        <div class="absolute top-4 left-4 z-10 bg-white px-4 py-2 rounded-full shadow-lg">
                            <span class="text-sm font-semibold flex items-center" style="color: #142444;">
                                <i class="fas fa-play-circle text-yellow-500 mr-2"></i>
                                Watch Tutorial
                            </span>
                        </div>

                        <!-- YouTube Video -->
                        <div class="relative aspect-w-16 aspect-h-9" style="padding-bottom: 56.25%;">
                            <iframe 
                                class="absolute inset-0 w-full h-full"
                                src="https://www.youtube.com/embed/gCy6LcXYxa8"
                                title="How It Works - Rabmot Licensing"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                            ></iframe>
                        </div>

                        <!-- Overlay Gradient -->
                        <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Steps -->
            <div class="space-y-6">
                <!-- Section Header -->
                <div class="mb-8">
                    <span class="inline-block text-yellow-500 font-semibold text-sm uppercase tracking-wider mb-2">How It Works</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold leading-tight" style="color: #142444;">
                        Streamline Your Vehicle <br>
                        <span class="text-yellow-500">Paperwork In 5 Easy Steps</span>
                    </h2>
                    <div class="w-20 h-1 mt-3 rounded-full" style="background: linear-gradient(90deg, #142444, #FBBF24);"></div>
                </div>

                <!-- Steps -->
                <div class="space-y-4">
                    @foreach($steps as $index => $step)
                        <div 
                            x-data="{ expanded: {{ $index === 0 ? 'true' : 'false' }} }"
                            class="step-item bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden"
                            style="border-left: 4px solid {{ $this->getStepColor($step['color']) }};"
                        >
                            <!-- Step Header -->
                            <div 
                                @click="expanded = !expanded"
                                class="step-header p-4 md:p-5 cursor-pointer flex items-start gap-4 hover:bg-gray-50 transition-colors duration-200"
                            >
                                <!-- Step Number -->
                                <div 
                                    class="step-number flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm text-white shadow-md"
                                    style="background: {{ $this->getStepGradient($step['color']) }};"
                                >
                                    {{ $step['id'] }}
                                </div>

                                <!-- Step Title -->
                                <div class="flex-1 min-w-0">
                                    <h5 class="font-semibold text-sm md:text-base" style="color: #142444;">
                                        {{ $step['step'] }}. {{ $step['title'] }}
                                    </h5>
                                </div>

                                <!-- Toggle Icon -->
                                <div class="flex-shrink-0 text-gray-400 transition-transform duration-300" 
                                     :style="{ 'transform': expanded ? 'rotate(180deg)' : 'rotate(0deg)' }">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>

                            <!-- Step Content -->
                            <div 
                                x-show="expanded"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                class="step-content px-4 md:px-5 pb-4 md:pb-5"
                            >
                                <p class="text-gray-600 text-sm md:text-base leading-relaxed pl-14">
                                    {{ $step['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- CTA Button -->
                <div class="pt-4">
                    <a 
                        href="{{ route('pricing') }}" 
                        class="inline-flex items-center px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl"
                        style="background: linear-gradient(135deg, #142444 0%, #1a2d5a 100%); color: white;"
                    >
                        Get Started Now
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .how-it-works-section {
        position: relative;
        overflow: hidden;
    }

    .how-it-works-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 70% 30%, rgba(251, 191, 36, 0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    .step-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .step-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(20, 36, 68, 0.02), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        border-radius: 12px;
    }

    .step-item:hover::after {
        opacity: 1;
    }

    .step-number {
        position: relative;
        z-index: 1;
    }

    .step-number::after {
        content: '';
        position: absolute;
        inset: -2px;
        border-radius: 50%;
        background: linear-gradient(135deg, #142444, #FBBF24);
        opacity: 0.1;
        z-index: -1;
    }

    .step-header {
        position: relative;
        z-index: 2;
    }

    .step-content {
        position: relative;
        z-index: 2;
    }

    /* Video Aspect Ratio */
    .aspect-w-16 {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%;
    }

    .aspect-w-16 iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .how-it-works-section {
            background: linear-gradient(135deg, #0d1117 0%, #161b22 50%, #0d1117 100%) !important;
        }

        .step-item {
            background: #1a202c !important;
        }

        .step-item h5 {
            color: #e2e8f0 !important;
        }

        .step-item p {
            color: #94a3b8 !important;
        }

        .step-header:hover {
            background: #242b33 !important;
        }
    }

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .step-header {
            padding: 1rem !important;
        }

        .step-number {
            width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }

        .step-content p {
            font-size: 0.875rem !important;
        }
    }

    /* Print styles */
    @media print {
        .how-it-works-section {
            background: white !important;
            padding: 2rem 0 !important;
        }
        .step-item {
            box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
            border: 1px solid #e5e7eb !important;
        }
        .step-header {
            cursor: default !important;
        }
        .step-header .fa-chevron-down {
            display: none !important;
        }
        .step-content {
            display: block !important;
        }
    }
</style>
@endpush