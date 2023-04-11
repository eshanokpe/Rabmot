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
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/flaticon.css')); ?>">
    <!-- Fonts Awesome Icons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome.min.css')); ?>">
    <!--Themefy Icons-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/themify-icons.css')); ?>">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <!-- animate -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <!--Slick Carousel-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.css')); ?>">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
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
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--// Sidebar Nav-->



    <!--Main Header Start-->
    <header class="position-inherit border-none">
         <div class="container">
            <div class="row">
                <div class="header-bottom-area">
                    <!--Logo Area Start-->
                    <div class="logo-area">
                        <a href="index-2.html">
                            <img src="assets/img/logo-02.png" alt="Logo">
                        </a>
                    </div>
                    <!--// Logo Area End-->

                    <!--Navbar Area Start Here-->
                    <nav class="navbar navbar-area navbar-expand-lg style-02">
                        <div class="container nav-container">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#autoshop_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="humberger-menu black">
                                    <span class="one"></span>
                                    <span class="two"></span>
                                    <span class="three"></span>
                                </span>
                            </button>
                            <div class="collapse navbar-collapse" id="autoshop_main_menu">
                                <ul class="navbar-nav">
                                    <li class="menu-item-has-children">
                                        <a href="#">Home</a>
                                        <ul class="sub-menu">
                                            <li><a href="index-2.html">Home 01</a></li>
                                            <li><a href="index-3.html">Home 02</a></li>
                                            <li><a href="index-4.html">Home 03</a></li>
                                            <li><a href="index-5.html">Home 04</a></li>
                                            <li><a href="index-6.html">Home 05</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Services</a>
                                        <ul class="sub-menu">
                                            <li><a href="service.html">Services</a></li>
                                            <li><a href="service-details.html">Services Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Blog</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop</a>
                                        <ul class="sub-menu">
                                            <li><a href="shop.html">Shop</a></li>
                                            <li><a href="shop-02.html">Shop 02</a></li>
                                            <li><a href="shop-details.html">Shop Details</a></li>
                                            <li><a href="shop-details-2.html">Shop Details 02</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children current-menu-item">
                                        <a href="#">Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="about-us.html">About Us</a></li>
                                            <li class="menu-item-has-children">
                                                <a href="#">UI Elements</a>
                                                <ul class="sub-menu">
                                                    <li><a href="cart.html">Cart</a></li>
                                                    <li><a href="typography.html">Typography</a></li>
                                                    <li><a href="accordions.html">Accordions</a></li>
                                                    <li><a href="buttons.html">Buttons</a></li>
                                                    <li><a href="icons.html">Icons</a></li>
                                                    <li><a href="table.html">Table</a></li>
                                                    <li><a href="pagination.html">Pagination</a></li>
                                                    <li><a href="modal.html">Modal</a></li>
                                                    <li><a href="form.html">Form</a></li>
                                                    <li><a href="header.html">Header</a></li>
                                                    <li><a href="footer.html">Footer</a></li>
                                                    <li><a href="alert.html">Alert</a></li>
                                                    <li><a href="countdown.html">Countdown</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="car-sell.html">Car Sell</a></li>
                                            <li><a href="car-repair.html">Car Repair</a></li>
                                            <li><a href="car-booking.html">Car Booking</a></li>
                                            <li><a href="faq.html">Faq</a></li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                            <li><a href="404.html">404</a></li>
                                            <li><a href="sign-in.html">Sign In</a></li>
                                            <li><a href="sign-up.html">Sign Up</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                            <!--Nav Right Content-->
                            <div class="nav-right-content black">
                                <ul>
                                    <li class="cart show-cart">
                                        <a href="#" class="notification">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span class="badge">3</span>
                                        </a>
                                    </li>
                                    <li class="search" id="search">
                                        <i class="fa fa-search"></i>
                                    </li>
                                    <li>
                                        <div class="humberger-menu black toggle-btn">
                                            <span class="one"></span>
                                            <span class="two"></span>
                                            <span class="three"></span>
                                        </div>
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


    <!--Sign Up Page-->
    <div class="sign padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1">
                    <div class="sign-register-area" style="background-image: url(assets/img/sign-in/01.png)">
                        <div class="sign-register-area-inner">
                            <h4 class="title">New User!</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and</p>
                            <div class="main-btn-wrap text-center">
                                <a href="#" class="main-btn white uppercase">REGISTER</a>
                            </div>
                        </div>
                    </div>
                    <!--// Register Area-->
                </div>
                <div class="col-lg-5">
                    <div class="sign-in-area">
                        <!--Form-->
                        <form action="http://zwin.io/html/coche/sign-in.html">
                            <a href="#" class="btn-login-with google">
                                <i class="icon fab fa-google-plus-g"></i>
                                <span class="text">Sign In With Google</span>
                            </a>
                            <!--// Google BTN-->
                            <a href="#" class="btn-login-with facebook">
                                <i class="icon fab fa-facebook-f"></i>
                                <span class="text">Sign in with Facebook</span>
                            </a>
                            <!--// Facebook BTN-->
                            <div class="hr-border">OR</div>
                            <!--// Border-->
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon flaticon-black-back-closed-envelope-shape"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="email" placeholder="Enter Your Email">
                            </div>
                            <!--// Email-->
                            <label for="password" class="padding-top-30">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon flaticon-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Enter Your Password">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn-show-pass">
                                        <i class="show-hide-icon fa fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <!--// Password-->
                            <div class="form-bottom-area padding-top-30">
                                <div class="remember-me">
                                    <label class="sign-in-area-switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <a href="#">Remember Me</a>
                                </div>
                                <div class="forgot-password">
                                    <a href="#">Forgot Password</a>
                                </div>
                            </div>

                            <div class="main-btn-wrap text-center padding-top-60">
                                <input type="submit" class="main-btn black uppercase" value="SIGN IN">
                            </div>

                        </form>
                        <!--// Form-->
                    </div>
                    <!--// Sign In Area-->
                </div>
            </div>
        </div>
    </div>
    <!--// Sign Up Page-->

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\rabmot\resources\views/auth/login.blade.php ENDPATH**/ ?>