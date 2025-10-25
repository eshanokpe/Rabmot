@extends('layouts.app')

@section('content')

<!--Cantact-->
     <div class="contact-page padding-top-60 " style="padding-top: 90px;">

            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="left-content">
                            <div class="section-title">
                                <h2 class="heading-03 padding-bottom-10">Get In Touch</h2>
                                </div> 
                            <div class="pb-5 pe-2 p5-2">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{route('contactus.form')}}" class="contact-form" method="POST" id="contactForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Full Name</label>
                                                <input type="text" class="form-control" name="fullname" id="name">
                                                @error('fullname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" name="phone" id="phone">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="subject">Subject</label>
                                                <input type="text" class="form-control" name="subject" id="subject">
                                                @error('subject')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> 
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <textarea class="form-control" cols="30" rows="5" name="message" id="message"></textarea>
                                                @error('message')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="main-btn-wrap">
                                                <button type="submit" class="g-recaptcha main-btn black"
                                                data-sitekey="{{ config('services.recaptcha.siteKey') }}"
                                                data-callback='onSubmit'
                                                data-action='submit'>Send Message</button>
                                            </div>
 
                                        </div>
                                    </div>
                                </form>
                                 <!-- JavaScript for reCAPTCHA callback -->
                                <script>
                                    function onSubmit(token) {
                                        document.getElementById("contactForm").submit();
                                    }
                                </script>
                                <!--// Form -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 ">
                        <div class="quick-find-us">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class='find-us-inner'>
                                            <h4 class="title">Quick Find Us</h4>
                                            <!--Contact Items-->
                                            <div class="contact-items padding-top-20">
                                                <div class="icon">
                                                    
                                                    <img src=" {{ asset('/assets-slide/img/marker1.png')}}" alt="marker">
                                                </div>
                                                <h5 class="heading">Our Office</h5>
                                                <div class="contact">
                                                    <span class="contact-info">1st floor AMG Workspace 22 Road,</span>
                                                

                                                    <span class="contact-info">Festac Town, Lagos NIgeria.</span>
                                                </div>
                                            </div>
                                            <!--// Contact Items-->

                                            <!--Contact Items-->
                                            <div class="contact-items padding-top-20">
                                                <div class="icon">
                                                    <i class="flaticon-call-answer"></i>
                                                </div>
                                                <h5 class="heading">Phone</h5>
                                                <div class="contact">
                                                    <a href="tel:+2348155206810">
                                                        <span class="contact-info">(+234) 815 520 6810</span>
                                                    </a>
                                                    <a href="tel:+2347088173662">
                                                        <span class="contact-info">(+234) 708 817 3662</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!--// Contact Items-->

                                            <!--Contact Items-->
                                            <div class="contact-items padding-top-20">
                                                <div class="icon">
                                                    <i class="flaticon-black-back-closed-envelope-shape"></i>
                                                </div>
                                                <h5 class="heading">Email</h5>
                                                <div class="contact">
                                                 <a href="mailto:info@rabmotlicensing.com?subject=Email%20Subject&body=Email%20Body">   
                                                    <span class="contact-info">info@rabmotlicensing.com</span>
                                                </a>
                                                <a href="mailto:support@rabmotlicensing.com?subject=Email%20Subject&body=Email%20Body">
                                                    <span class="contact-info">support@rabmotlicensing.com</span>
                                                </a>
                                                </div>
                                            </div>
                                            <!--// Contact Items-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!--// Cantact-->

            <!--Google Map -->
            <div class="google-map-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 px-0">
                            <div id="google-map">
                                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=4th floor Polystar Building Marwa Bus stop Lekki, Lagos.&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://2yu.co">2yu</a><br><style>.mapouter{position:relative;text-align:right;height:100%;width:100%;}</style><a href="https://embedgooglemap.2yu.co/">html embed google map</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:100%;width:100%;}</style></div></div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!--// Google Map End-->
        </div>
    </section>
    

@endsection