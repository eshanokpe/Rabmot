<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('/assets/img/fav.png')}}">
    <title>Rabmot Licensing | Admin</title>
    <!-- CSS files -->
    <link href="{{ asset('/assets/dist/css/tabler.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/assets/dist/css/tabler-flags.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/assets/dist/css/tabler-payments.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/assets/dist/css/tabler-vendors.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/assets/dist/css/demo.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/assets/dist/fontawesome/css/fontawesome.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/assets/dist/fontawesome/css/solid.min.css')}}" rel="stylesheet" />

    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";     
        }
    </style>
    <script src="{{ asset('/assets/dist/js/demo-theme.min.js')}}"></script>
</head>

<body>  
    <div class="page"> 
        @include('admin.partials.sidebar')
        @include('admin.partials.navheader')   
        
        @yield('content')
        @include('admin.partials.footer')
    </div>
</body>



