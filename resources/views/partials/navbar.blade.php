<nav class="fixed top-0 w-full shadow-sm z-50" style="background-color: #142444;" id="div-nav">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a class="flex items-center" href="/" id="a-nav">
                <img src="{{ asset('assets/img/rab.png') }}" width="150" alt="Logo" class="h-auto">
            </a>

            <!-- Mobile Toggle Button -->
            <button 
                class="lg:hidden p-2 rounded-md bg-yellow-500 hover:bg-yellow-400 transition-colors" 
                type="button"
                @click="open = !open"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <svg class="w-6 h-6 text-[#142444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center justify-end space-x-6">
                <ul class="flex items-center space-x-6 m-0 p-0 list-none">
                    <li>
                        <a 
                            class="nav-link font-medium transition-colors duration-200 text-white hover:text-yellow-400" 
                            href="{{ route('index') }}" 
                            id="a-nav"
                        >
                            Home
                        </a>
                    </li>
                    <li>
                        <a 
                            class="nav-link font-medium transition-colors duration-200 text-white hover:text-yellow-400" 
                            href="{{ route('pricing') }}" 
                            id="a-nav"
                        >
                            Check Pricing
                        </a>
                    </li>
                    @if(auth()->check())
                        <li>
                            <a 
                                class="nav-link font-medium transition-colors duration-200 text-white hover:text-yellow-400" 
                                href="{{ route('home') }}" 
                                id="a-nav"
                            >
                                Dashboard
                            </a>
                        </li>
                    @else
                        <li>
                            <a 
                                class="nav-link font-medium transition-colors duration-200 text-white hover:text-yellow-400" 
                                href="{{ route('processpapers') }}" 
                                id="a-nav"
                            >
                                Process Papers
                            </a>
                        </li>
                    @endif
                    <li>
                        <a 
                            class="nav-link font-medium transition-colors duration-200 text-white hover:text-yellow-400" 
                            href="{{ route('contactus') }}" 
                            id="a-nav"
                        >
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a 
                            class="nav-link font-medium transition-colors duration-200 text-white hover:text-yellow-400" 
                            href="{{ route('community') }}" 
                            id="a-nav"
                        >
                            Community
                        </a>
                    </li>
                    <li>
                        <a href="{{ auth()->check() ? route('home') : route('processpapers') }}" id="a-nav">
                            <button 
                                class="px-6 py-2 bg-white hover:bg-yellow-400 text-[#142444] font-semibold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                            >
                                {{ auth()->check() ? 'Dashboard' : 'Sign In' }}
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Menu (Alpine.js) -->
    <div 
        x-data="{ open: false }" 
        x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden border-t shadow-lg"
        style="background-color: #142444; border-color: rgba(255,255,255,0.1);"
    >
        <div class="container mx-auto px-4 py-5 space-y-4">
            <a 
                href="{{ route('index') }}" 
                class="block py-2 font-medium text-white hover:text-yellow-400 transition-colors"
            >
                Home
            </a>
            <a 
                href="{{ route('pricing') }}" 
                class="block py-2 font-medium text-white hover:text-yellow-400 transition-colors"
            >
                Check Pricing
            </a>
            @if(auth()->check())
                <a 
                    href="{{ route('home') }}" 
                    class="block py-2 font-medium text-white hover:text-yellow-400 transition-colors"
                >
                    Dashboard
                </a>
            @else
                <a 
                    href="{{ route('processpapers') }}" 
                    class="block py-2 font-medium text-white hover:text-yellow-400 transition-colors"
                >
                    Process Papers
                </a>
            @endif
            <a 
                href="{{ route('contactus') }}" 
                class="block py-2 font-medium text-white hover:text-yellow-400 transition-colors"
            >
                Contact Us
            </a>
            <a 
                href="{{ route('community') }}" 
                class="block py-2 font-medium text-white hover:text-yellow-400 transition-colors"
            >
                Community
            </a>
            <a href="{{ auth()->check() ? route('home') : route('processpapers') }}" class="block mt-5">
                <button 
                    class="w-full py-3 bg-white hover:bg-yellow-400 text-[#142444] font-semibold rounded-lg transition-all transform hover:scale-105"
                >
                    {{ auth()->check() ? 'Dashboard' : 'Sign In' }}
                </button>
            </a>
        </div>
    </div>
</nav>

@push('styles')
<style>
    /* Additional navigation styles if needed */
    .nav-link {
        position: relative;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #fff;
        transition: width 0.3s ease;
    }
    
    .nav-link:hover::after {
        width: 100%;
    }
</style>
@endpush