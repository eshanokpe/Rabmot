<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/img/fav.png')}}">
    <title>Rabmot Automoblie and Licensing</title>

    <!-- Core Styles -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6/dist-font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#142444',
                        primary: '#142444',
                        yellow: {
                            500: '#facc15',
                            600: '#eab308'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js (required for navbar + slider) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Livewire / Vite -->
    @livewireStyles
    @viteReactRefresh
    @vite('resources/js/app.jsx')

    <!-- Slide Assets -->
    <link rel="stylesheet" href="{{ asset('assets-slide/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/responsive.css') }}">

    <style>
        /* Prevent content hiding under fixed navbar */
        body {
            padding-top: 80px; /* Matches navbar height */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin: 0;
        }
        /* Override old large padding */
        main {
            padding-top: 0 !important;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <!-- Navbar (our updated version) -->
    @include('partials.navbar')

    <!-- Main Content Area -->
    <main class="w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <livewire:footer />

    <!-- Scripts -->
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets-slide/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('assets-slide/js/jquery-migrate.min.js')}}"></script>
    <script src="{{ asset('assets-slide/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets-slide/js/slick.min.js')}}"></script>
    <script src="{{ asset('assets-slide/js/main.js')}}"></script>

    <!-- Tawk.to Chat -->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/64db775dcc26a871b02f6170/1h7skkidv';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>

    <!-- Security / Dev Tools Block -->
    <script>
        window.addEventListener('keydown', e => {
            if ((e.ctrlKey && [83, 85, 73, 74, 67, 86, 72, 65, 70].includes(e.keyCode)) || e.keyCode === 123) {
                e.preventDefault();
                return false;
            }
        });
        window.addEventListener('contextmenu', e => e.preventDefault());
    </script>

    @if (session('recaptcha_error'))
    <script>
        $(document).ready(() => toastr.error("{{ session('recaptcha_error') }}"));
    </script>
    @endif

    <!-- Page-specific scripts pushed via @push('scripts') in child views -->
    @stack('scripts')

</body>
</html>