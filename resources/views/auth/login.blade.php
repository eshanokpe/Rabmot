@include('layouts.header');


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

@include('layouts.footer')
