<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zwin.io/html/coche/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Apr 2023 10:43:22 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rabmot</title>

    <!-- favicon -->
    <link rel=icon href=favicon.png sizes="20x20" type="image/png">
    <!-- flaticon -->
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css')}}">
    <!-- Fonts Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css')}}">
    <!--Themefy Icons-->
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}">
    <!--Slick Carousel-->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
</head>
<body>

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- search Popup -->
    <div class="body-overlay" id="body-overlay"></div>
    <div class="search-popup" id="search-popup">
        <form action="http://zwin.io/html/coche/index.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- // search Popup -->

    <!--Sidebar Nav-->
    @include('layouts.sidebar')
    <!--// Sidebar Nav-->



    <div class="contact-popup"></div>
    <div class="contact-popup-content">
        <button type="button" class="contact-popup-content_close">
            <span class="ti-close"></span>
        </button>
        <div class="row no-gutters">
            <div class="contact-popup__wrapper">
                <div class="contact-popup__thumb" style="background-image: url(assets/img/modal/02.png);"></div>
                <div class="contact-popup__info__wrap">
                    <div class="contact-items">
                        <h5 class="heading">Opening Hour</h5>
                        <div class="contact">
                            <span class="contact-info">Monday to Friday </span>
                            <span class="contact-info">7:00 - 21:00 </span>
                            <span class="contact-info">Saturday</span>
                            <span class="contact-info">7:00 - 16:00 </span>
                        </div>
                    </div>
                    <div class="contact-items padding-top-20">
                        <h5 class="heading">Phone</h5>
                        <div class="contact">
                            <span class="contact-info">(+88) 0172 570051 <br> (+88) 0172 570051</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Contact-popup-->


    <!--Full Width Sider Start-->
    <div class="full-width-slider">
        <!--Main Header Start-->
        <header>
            <div class="container">
                <div class="row">
                    <div class="header-bottom-area">
                        <!--Logo Area Start-->
                        <div class="logo-area">
                            <a href="index-2.html">
                                <img src="assets/img/logo-01.png" alt="Logo">
                            </a>
                        </div>
                        <!--// Logo Area End-->

                        <!--Navbar Area Start Here-->
                        <nav class="navbar navbar-area navbar-expand-lg style-02">
                            <div class="container nav-container">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#autoshop_main_menu" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="humberger-menu black">
                                        <span class="one"></span>
                                        <span class="two"></span>
                                        <span class="three"></span>
                                    </span>
                                </button>
                                <div class="collapse navbar-collapse" id="autoshop_main_menu">
                                    <ul class="navbar-nav">
                                        <li class=" current-menu-item">
                                            <a href="{{url('/')}}">Home</a>
                                        </li>
                                        <li class="">
                                            <a href="{{url('checkpricing')}}">Check Pricing</a>
                                        </li>
                                        <li class="">
                                            <a href="{{ url('processpapers')}}">Process Papers</a>
                                        </li>
                                        <li class="">
                                            <a href="{{ url('community')}}">Community</a>
                                        </li>
                                        
                                        <li><a href="{{ url('contact')}}">Contact us</a></li>
                                        @guest
                                            @if (Route::has('login'))
                                            <li>
                                                <div class="main-btn-wrap" >
                                                    <a href="{{ route('login') }}" class="main-btn">Log in</a>
                                                </div>
                                            </li>
                                            @endif
                                        @endguest
                                        
                                    </ul>
                                </div>
                                <!--Nav Right Content-->
                                <div class="nav-right-content black">
                                    <ul>
                                        
                                        <li>
                                            <!-- Humberger -->
                                            <div class="humberger-menu black toggle-btn">
                                                <span class="one"></span>
                                                <span class="two"></span>
                                                <span class="three"></span>
                                            </div>
                                            <!--// Humberger -->
                                        </li>
                                    </ul>
                                </div>
                                <!--// Nav Right Content-->
                            </div>
                        </nav>
                        <!-- navbar area end -->
                    </div>
                    <!--// header Bottom-->
                </div>
            </div>
        </header>
        <!--// Main Header End Here-->

        
                        
                        
