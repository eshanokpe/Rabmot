<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/img/fav.png')}}">
    <title>Rabmot Automoblie and Licensing </title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2/dist/css/bootstrap.min.css')}}">
    <script src="{{ asset('assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6/dist-font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- Scripts -->  
    
    
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('/assets/img/fav.png')}}">
    {{-- assets-slide --}}
    <link rel="stylesheet" href="{{ asset('assets-slide/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-slide/css/responsive.css') }}">


    <style>
        #main {
            padding-top: 60px;
        }
        @media screen and (max-width: 600px) {
            .hidden {
                display: none; 
            } 
        }
        .hidden {
            display: none; 
        }  
    
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    
    
    
</head>
<body>
    
    @include('partials.navbar')
      
    
    <main class="py-4" style="padding-top: 600px;" >
        @yield('content')
    </main>

    @include('partials.footer')
</body> 
</html>