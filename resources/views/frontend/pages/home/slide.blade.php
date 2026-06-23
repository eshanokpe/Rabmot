<style>
    .hero-wrapper{
        position: relative;
    }

    .service-overlay-cards{
        position: relative;
        margin-top: -90px;
        z-index: 100;
    }

    .service-card{
        background: #fff;
        border-radius: 16px;
        padding: 25px 15px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
        transition: all .3s ease;
        cursor: pointer;
        height: 100%;
    }

    .service-card i{
        font-size: 32px;
        margin-bottom: 12px;
        color: #142444;
    }

    .service-card h6{
        font-weight: 600;
        margin: 0;
    }

    .service-card:hover{
        transform: translateY(-8px);
    }

    .service-card-link{
        text-decoration: none;
        color: inherit;
        display: block;
    }

    

    .service-card:hover{
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,.12);
    }

    .service-arrow{
        opacity: 0;
        margin-left: 5px;
        transition: .3s;
    }

    .service-card:hover .service-arrow{
        opacity: 1;
        margin-left: 10px;
    }


    @media(max-width:768px){

        .service-overlay-cards{
            margin-top: -40px;
        }

        .service-card{
            padding: 15px 10px;
        }

        .service-card i{
            font-size: 24px;
        }

        .service-card h6{
            font-size: 13px;
        }
    }
</style>
    <div class="home-slider-area style-02">
        <div id="hid">
            <div class="container-fluid" >
                <div class="row">
                    <div class="home-slider-one">
                            <!--Slider Items Start-->
                            <div class="slider-items" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">
                                <div class="container">
                                    <div class="slider-items-wrap">
                                        <div class="slider-inner">
                                            <div class="slider-content" >
                                                <div class="slider-content-inner">
                                                    <div class="slider-title" >
                                                        <h3 style="font-size: 28px;">
                                                            <b> REGISTER AND RENEW YOUR 
                                                            <br> GENUINE CAR PAPERS WITHIN</b>
                                                        </h3>
                                                        <h1 class="heading-01" style="font-size: 80px;"> <span class="bold"> 72 HOURS</span></h1>
                                                    </div>
                                                    <!--// Slider Title End-->
                                                    <div class="slider-paragraph padding-bottom-25 padding-top-20">
                                                        <p style="font-size: 26px;">(With free doorstep delivery)</p>
                                                    </div>

                                                    <!--// Slider Paragraph End-->

                                                    <div class="main-btn-wrap">
                                                        @if(auth()->check())
                                                            <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                        @else
                                                            <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                        @endif
                                                    </div>

                                                    <!--// Main Btn Wrap End-->

                                                </div>

                                            </div>

                                            

                                            <!--// Slider Content End-->

                                            <div class="slider-img">

                                                <!-- <img src="assets-slide/img/slider/Car_1.png" alt="img"> -->
                                                <img src="{{ asset('assets/img/Car_11.png')}}" alt="img">

                                            </div>

                                            <!--// Slider Img-->

                                        </div>

                                        <!--// Slider Inner-->

        

        

                                    </div>

                                    <!--// Slider Item Wrap-->

                                </div>

                                <!--//Container-->

                            </div>

                            <!--// Slider Items End-->

                            <!--Slider Items Start-->

                            <div class="slider-items" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                                <div class="container">

                                    <div class="slider-items-wrap">

                                        <div class="slider-inner">

                                            <div class="slider-content" id="hid">

                                                <div class="slider-content-inner">

        

                                                    <div class="slider-title">

                                                        <h3 style="font-size: 28px;">

                                                            <b> REGISTER AND RENEW YOUR <br> GENUINE CAR PAPERS WITHIN</b>

                                                        </h3>

                                                        <h1 class="heading-01" style="font-size: 80px;"> <span class="bold"> 72 HOURS</span></h1>

                                                    </div>

                                                    <!--// Slider Title End-->

        

                                                    <div class="slider-paragraph padding-bottom-25 padding-top-20">

                                                        <p style="font-size: 26px;">(With free doorstep delivery)</p>

                                                    </div>

                                                    <!--// Slider Paragraph End-->

                                                    <div class="main-btn-wrap">
                                                        @if(auth()->check())
                                                            <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                        @else
                                                            <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                        @endif
                                                    </div>

                                                    <!--// Main Btn Wrap End-->

                                                </div>

                                            </div>

                                            

                                            <!--// Slider Content End-->

                                            

                                            <div class="slider-img">
                                                <img src="{{ asset('assets/img/Car_22.png')}}" alt="img">

                                                

                                            </div>

                                            <!--// Slider Img-->

                                        </div>

                                        <!--// Slider Inner-->

        

        

                                    </div>

                                    <!--// Slider Item Wrap-->

                                </div>

                                <!--//Container-->

                            </div>

                            <!--// Slider Items End-->

                            <!--Slider Items Start-->

                            <div class="slider-items" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                                <div class="container">

                                    <div class="slider-items-wrap">

                                        <div class="slider-inner">

                                            <div class="slider-content" id="hid">

                                                <div class="slider-content-inner">

        

                                                    <div class="slider-title">

                                                        <h3 style="font-size: 28px;">

                                                            <b> REGISTER AND RENEW YOUR <br> GENUINE CAR PAPERS WITHIN</b>

                                                        </h3>

                                                        <h1 class="heading-01" style="font-size: 80px;"> <span class="bold"> 72 HOURS</span></h1>

                                                    </div>

                                                    <!--// Slider Title End-->

        

                                                    <div class="slider-paragraph padding-bottom-25 padding-top-20">

                                                        <p style="font-size: 26px;">(With free doorstep delivery)</p>

                                                    </div>

                                                    <!--// Slider Paragraph End-->

                                                    <div class="main-btn-wrap">
                                                        @if(auth()->check())
                                                            <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                        @else
                                                            <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                        @endif
                                                    </div>

                                                    <!--// Main Btn Wrap End-->

                                                </div>

                                            </div>

                                            

                                            <!--// Slider Content End-->

                                            <div class="slider-img">

                                                <!-- <img src="assets-slide/img/slider/Car_3.png" alt="img"> -->
                                            
                                                <img src="{{ asset('assets/img/Car_33.png')}}" alt="img">

                                            </div>

                                            <!--// Slider Img-->

                                        </div>

                                        <!--// Slider Inner-->
                                    </div>

                                    <!--// Slider Item Wrap-->

                                </div>

                                <!--//Container-->

                            </div>

                            <!--// Slider Items End-->

                            <!--Slider Items Start-->

                            <div class="slider-items" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                                <div class="container">

                                    <div class="slider-items-wrap">

                                        <div class="slider-inner">

                                            <div class="slider-content" id="hid">

                                                <div class="slider-content-inner">

        

                                                    <div class="slider-title">

                                                        <h3 style="font-size: 28px;">

                                                            <b> REGISTER AND RENEW YOUR <br> GENUINE CAR PAPERS WITHIN</b>

                                                        </h3>

                                                        <h1 class="heading-01" style="font-size: 80px;"> <span class="bold"> 72 HOURS</span></h1>

                                                    </div>

                                                    <!--// Slider Title End-->

        

                                                    <div class="slider-paragraph padding-bottom-25 padding-top-20">

                                                        <p style="font-size: 26px;">(With free doorstep delivery)</p>

                                                    </div>

                                                    <!--// Slider Paragraph End-->

                                                    <div class="main-btn-wrap">
                                                        @if(auth()->check())
                                                            <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                        @else
                                                            <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                        @endif
                                    
                                                    </div>

                                                    <!--// Main Btn Wrap End-->

                                                </div>

                                            </div>

                                            

                                            <!--// Slider Content End-->

                                            <div class="slider-img">

                                                <img src="{{ asset('assets/img/Car_44.png')}}" alt="img">

                                            </div>

                                            <!--// Slider Img-->

                                        </div>

                                        <!--// Slider Inner-->

        

        

                                    </div>

                                    <!--// Slider Item Wrap-->

                                </div>

                                <!--//Container-->

                            </div>

                            <!--// Slider Items End-->

                            <!--Slider Items Start-->

                            <div class="slider-items" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                                <div class="container">

                                    <div class="slider-items-wrap">

                                        <div class="slider-inner">

                                            <div class="slider-content" id="hid">

                                                <div class="slider-content-inner">

        

                                                    <div class="slider-title">

                                                        <h3 style="font-size: 28px;">

                                                            <b> REGISTER AND RENEW YOUR <br> GENUINE CAR PAPERS WITHIN</b>

                                                        </h3>

                                                        <h1 class="heading-01" style="font-size: 80px;"> <span class="bold"> 72 HOURS</span></h1>

                                                    </div>

                                                    <!--// Slider Title End-->

        

                                                    <div class="slider-paragraph padding-bottom-25 padding-top-20">

                                                        <p style="font-size: 26px;">(With free doorstep delivery)</p>

                                                    </div>

                                                    <!--// Slider Paragraph End-->

                                                    <div class="main-btn-wrap">
                                                        @if(auth()->check())
                                                            <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                        @else
                                                            <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                        @endif
                                                    </div>

                                                    <!--// Main Btn Wrap End-->

                                                </div>

                                            </div>

                                            

                                            <!--// Slider Content End-->

                                            <div class="slider-img">

                                                <img src="{{ asset('assets/img/Car_55.png')}}" alt="img">

                                            </div>

                                            <!--// Slider Img-->

                                        </div>

                                        <!--// Slider Inner-->

        

        

                                    </div>

                                    <!--// Slider Item Wrap-->

                                </div>

                                <!--//Container-->

                            </div>

                            <!--// Slider Items End-->

                            <!--Slider Items Start-->

                            <div class="slider-items" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                                <div class="container">

                                    <div class="slider-items-wrap">

                                        <div class="slider-inner">

                                            <div class="slider-content" id="hid">

                                                <div class="slider-content-inner">

        

                                                    <div class="slider-title ">

                                                        <h3 style="font-size: 28px;">

                                                            <b> REGISTER AND RENEW YOUR <br> GENUINE CAR PAPERS WITHIN</b>

                                                        </h3>

                                                        <h1 class="heading-01" style="font-size: 80px;"> <span class="bold"> 72 HOURS</span></h1>

                                                    </div>

                                                    <!--// Slider Title End-->

        

                                                    <div class="slider-paragraph padding-bottom-25 padding-top-20">

                                                        <p style="font-size: 26px;">(With free doorstep delivery)</p>

                                                    </div>

                                                    <!--// Slider Paragraph End-->

                                                    <div class="main-btn-wrap">
                                                        @if(auth()->check())
                                                            <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                        @else
                                                            <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                        @endif
                                                    </div>

                                                    <!--// Main Btn Wrap End-->

                                                </div>

                                            </div>

                                        

                                            <!--// Slider Content End-->

                                            <div class="slider-img">

                                                <img src="{{ asset('assets/img/Car_66.png')}}" alt="img">

                                            </div>

                                            <!--// Slider Img-->

                                        </div>

                                        <!--// Slider Inner-->

        

        

                                    </div>

                                    <!--// Slider Item Wrap-->

                                </div>

                                <!--//Container-->

                            </div>

                            <!--// Slider Items End-->

                        
                    </div>
                    <!--// Home 02 Slider Active-->

                </div>
                <!--// Slider Row End-->
                <div class="service-overlay-cards">
                    <div class="container">
                        <div class="row g-4 justify-content-center">

                            <div class="row g-4 justify-content-center">

                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="#" class="service-card-link">
                                        <div class="service-card">
                                            <i class="fas fa-id-card"></i>
                                            <h6>
                                                Driver's License
                                                <span class="service-arrow">→</span>
                                            </h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="#" class="service-card-link">
                                        <div class="service-card">
                                            <i class="fas fa-car"></i>
                                            <h6>
                                                Vehicle Registration
                                                <span class="service-arrow">→</span>
                                            </h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="#" class="service-card-link">
                                        <div class="service-card">
                                            <i class="fas fa-exchange-alt"></i>
                                            <h6>
                                                Change Ownership
                                                <span class="service-arrow">→</span>
                                            </h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('int-drivers-license') }}" class="service-card-link">
                                        <div class="service-card">
                                            <i class="fas fa-globe"></i>
                                            <h6>
                                                International License
                                                <span class="service-arrow">→</span>
                                            </h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('dealer-plate-number') }}" class="service-card-link">
                                        <div class="service-card">
                                            <i class="fas fa-tags"></i>
                                            <h6>
                                                Dealer Plate Number
                                                <span class="service-arrow">→</span>
                                            </h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-2 col-md-4 col-6">
                                    <a href="{{ route('vehicle-renewal') }}" class="service-card-link">
                                        <div class="service-card">
                                            <i class="fas fa-sync-alt"></i>
                                            <h6>
                                                Vehicle Renewal
                                                <span class="service-arrow">→</span>
                                            </h6>
                                        </div>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!--Carouse Dots Area-->


            <!--// Carouse Dots Area End-->

        </div>

        <!--//Slider Area End wide-->



        <div id="display">
            <div class="container-fluid" >

                <div class="row">

                    <div class="home-slider-one">

    

                        <!--Slider Items Start-->

                        <div class="col-sm-12" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                            <div class="container pt-5">

                                <div class="slider-items-wrap">

                                    <div class="slider-inner">

                                        <div class="slider-content">

                                            <div class="slider-content-inner pt-5">

    

                                                <div class="slider-title" >

                                                    <h3 style="font-size: 22px;">

                                                        <b>REGISTER AND RENEW YOUR<br>

                                                            GENUINE CAR PAPERS WITHIN</b>

                                                    </h3>

                                                    <h1 class="heading-01" style="font-size: 60px;"> <span class="bold"> 72 HOURS</span></h1>

                                                </div>

                                                <!--// Slider Title End-->

    

                                                <div class="slider-paragraph padding-bottom-25 padding-top-5">

                                                    <p style="font-size: 20px;">(With free doorstep delivery)</p>

                                                </div>

                                                <!--// Slider Paragraph End-->

                                                <div class="main-btn-wrap">

                                                    @if(auth()->check())
                                                        <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                    @else
                                                        <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                    @endif
                                                </div>

                                                <!--// Main Btn Wrap End-->

                                            </div>

                                        </div>

                                        

                                        <!--// Slider Content End-->

                                        <div class="slider-img">

                                            <!-- <img src="assets-slide/img/slider/Car_1.png" alt="img"> -->

                                            <img src="{{ asset('assets/img/Car_11.png')}}" alt="img">

                                        </div>

                                        <!--// Slider Img-->

                                    </div>

                                    <!--// Slider Inner-->

    

    

                                </div>

                                <!--// Slider Item Wrap-->

                            </div>

                            <!--//Container-->

                        </div>

                        <!--// Slider Items End-->

                        <!--Slider Items Start-->

                        <div class="col-12" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                            <div class="container pt-5">

                                <div class="slider-items-wrap">

                                    <div class="slider-inner">

                                        <div class="slider-content" >

                                            <div class="slider-content-inner pt-5">

    

                                                <div class="slider-title">

                                                    <h3 style="font-size: 22px;">

                                                        <b> REGISTER AND RENEW YOUR <br> GENUINE CAR  PAPERS WITHIN</b>

                                                    </h3>

                                                    <h1 class="heading-01" style="font-size: 60px;"> <span class="bold"> 72 HOURS</span></h1>

                                                </div>

                                                <!--// Slider Title End-->

    

                                                <div class="slider-paragraph padding-bottom-25 padding-top-5">

                                                    <p style="font-size: 20px;">(With free doorstep delivery)</p>

                                                </div>

                                                <!--// Slider Paragraph End-->

                                                <div class="main-btn-wrap">

                                                    @if(auth()->check())
                                                        <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                    @else
                                                        <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                    @endif
                                                </div>

                                                <!--// Main Btn Wrap End-->

                                            </div>

                                        </div>

                                        

                                        <!--// Slider Content End-->

                                        

                                        <div class="slider-img">

                                            <img src="{{ asset('assets/img/Car_22.png')}}" alt="img">

                                            

                                        </div>

                                        <!--// Slider Img-->

                                    </div>

                                    <!--// Slider Inner-->

    

    

                                </div>

                                <!--// Slider Item Wrap-->

                            </div>

                            <!--//Container-->

                        </div>

                        <!--// Slider Items End-->

                        <!--Slider Items Start-->

                        <div class="col-12" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                            <div class="container pt-5">

                                <div class="slider-items-wrap">

                                    <div class="slider-inner ">

                                        <div class="slider-content" >

                                            <div class="slider-content-inner pt-5">

    

                                                <div class="slider-title">

                                                    <h3 style="font-size: 22px;">

                                                        <b> REGISTER AND RENEW YOUR<br> GENUINE CAR PAPERS WITHIN</b>

                                                    </h3>

                                                    <h1 class="heading-01" style="font-size: 60px;"> <span class="bold"> 72 HOURS</span></h1>

                                                </div>

                                                <!--// Slider Title End-->

    

                                                <div class="slider-paragraph padding-bottom-25 padding-top-5">

                                                    <p style="font-size: 20px;">(With free doorstep delivery)</p>

                                                </div>

                                                <!--// Slider Paragraph End-->

                                                <div class="main-btn-wrap">

                                                    @if(auth()->check())
                                                        <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                    @else
                                                        <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                    @endif
                                                </div>

                                                <!--// Main Btn Wrap End-->

                                            </div>

                                        </div>

                                        

                                        <!--// Slider Content End-->

                                        <div class="slider-img">

                                            <!-- <img src="assets-slide/img/slider/Car_3.png" alt="img"> -->

                                            <img src="{{ asset('assets/img/Car_33.png')}}" alt="img">

                                        </div>

                                        <!--// Slider Img-->

                                    </div>

                                    <!--// Slider Inner-->

    

    

                                </div>

                                <!--// Slider Item Wrap-->

                            </div>

                            <!--//Container-->

                        </div>

                        <!--// Slider Items End-->

                        <!--Slider Items Start-->

                        <div class="col-12" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                            <div class="container pt-5">

                                <div class="slider-items-wrap">

                                    <div class="slider-inner">

                                        <div class="slider-content" >

                                            <div class="slider-content-inner pt-5">

    

                                                <div class="slider-title">

                                                    <h3 style="font-size: 22px;">

                                                        <b> REGISTER AND RENEW YOUR<br> GENUINE CAR PAPERS WITHIN</b>

                                                    </h3>

                                                    <h1 class="heading-01" style="font-size: 60px;"> <span class="bold"> 72 HOURS</span></h1>

                                                </div>

                                                <!--// Slider Title End-->

    

                                                <div class="slider-paragraph padding-bottom-25 padding-top-5">

                                                    <p style="font-size: 20px;">(With free doorstep delivery)</p>

                                                </div>

                                                <!--// Slider Paragraph End-->

                                                <div class="main-btn-wrap">

                                                    @if(auth()->check())
                                                        <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                    @else
                                                        <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                    @endif
                                                </div>

                                                <!--// Main Btn Wrap End-->

                                            </div>

                                        </div>

                                       

                                        <!--// Slider Content End-->

                                        <div class="slider-img">

                                            <img src="{{ asset('assets/img/Car_44.png')}}" alt="img">

                                        </div>

                                        <!--// Slider Img-->

                                    </div>

                                    <!--// Slider Inner-->

                                </div>

                                <!--// Slider Item Wrap-->

                            </div>

                            <!--//Container-->

                        </div>

                        <!--// Slider Items End-->

                          <!--Slider Items Start-->

                          <div class="col-12" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                            <div class="container pt-5">

                                <div class="slider-items-wrap">

                                    <div class="slider-inner">

                                        <div class="slider-content" >

                                            <div class="slider-content-inner pt-5">

    

                                                <div class="slider-title">

                                                    <h3 style="font-size: 22px;">

                                                        <b> REGISTER AND RENEW YOUR<br> GENUINE CAR PAPERS WITHIN</b>

                                                    </h3>

                                                    <h1 class="heading-01" style="font-size: 60px;"> <span class="bold"> 72 HOURS</span></h1>

                                                </div>

                                                <!--// Slider Title End-->

    

                                                <div class="slider-paragraph padding-bottom-25 padding-top-5">

                                                    <p style="font-size: 20px;">(With free doorstep delivery)</p>

                                                </div>

                                                <!--// Slider Paragraph End-->

                                                <div class="main-btn-wrap">
                                                    @if(auth()->check())
                                                        <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                    @else
                                                        <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                    @endif
                                                </div>

                                                <!--// Main Btn Wrap End-->

                                            </div>

                                        </div>

                                        

                                        <!--// Slider Content End-->

                                        <div class="slider-img">

                                            <img src="{{ asset('assets/img/Car_55.png')}}" alt="img">

                                        </div>

                                        <!--// Slider Img-->

                                    </div>

                                    <!--// Slider Inner-->

    

    

                                </div>

                                <!--// Slider Item Wrap-->

                            </div>

                            <!--//Container-->

                        </div>

                        <!--// Slider Items End-->

                          <!--Slider Items Start-->

                          <div class="col-12" style="background-image: url('{{ asset('assets-slide/img/bg/bg-01.png')}}">

                            <div class="container pt-5">

                                <div class="slider-items-wrap">

                                    <div class="slider-inner">

                                        <div class="slider-content" >

                                            <div class="slider-content-inner pt-5">

    

                                                <div class="slider-title ">

                                                    <h3 style="font-size: 22px;">

                                                        <b> REGISTER AND RENEW YOUR<br> GENUINE CAR PAPERS WITHIN</b>

                                                    </h3>

                                                    <h1 class="heading-01" style="font-size: 60px;"> <span class="bold"> 72 HOURS</span></h1>

                                                </div>

                                                <!--// Slider Title End-->

    

                                                <div class="slider-paragraph padding-bottom-25 padding-top-5">

                                                    <p style="font-size: 20px;">(With free doorstep delivery)</p>

                                                </div>

                                                <!--// Slider Paragraph End-->

                                                <div class="main-btn-wrap">
                                                    @if(auth()->check())
                                                        <a href="{{ route('home')}}" class="main-btn">View Dashboard</a>
                                                    @else
                                                        <a href="{{ route('signup')}}" class="main-btn">sign up Now</a>
                                                    @endif
                                                </div>

                                                <!--// Main Btn Wrap End-->

                                            </div>

                                        </div>

                                        

                                        <!--// Slider Content End-->

                                        <div class="slider-img">

                                            <img src="{{ asset('assets/img/Car_66.png')}}" alt="img">

                                        </div>

                                        <!--// Slider Img-->

                                    </div>

                                    <!--// Slider Inner-->

    

    

                                </div>

                                <!--// Slider Item Wrap-->

                            </div>

                            <!--//Container-->

                        </div>

                        <!--// Slider Items End-->

                    </div>

                    <!--// Home 02 Slider Active-->

    

    

                </div>

                <!--// Slider Row End-->
                <div class="service-overlay-cards">
                    <div class="container">
                        <div class="row g-4 justify-content-center">

                            <div class="col-lg-2 col-md-4 col-6">
                                <a href="#" class="service-card-link">
                                    <div class="service-card">
                                        <i class="fas fa-id-card"></i>
                                        <h6>
                                            Driver's License
                                            <span class="service-arrow">→</span>
                                        </h6>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-2 col-md-4 col-6">
                                <a href="#" class="service-card-link">
                                    <div class="service-card">
                                        <i class="fas fa-car"></i>
                                        <h6>
                                            Vehicle Registration
                                            <span class="service-arrow">→</span>
                                        </h6>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-2 col-md-4 col-6">
                                <a href="#" class="service-card-link">
                                    <div class="service-card">
                                        <i class="fas fa-exchange-alt"></i>
                                        <h6>
                                            Change Ownership
                                            <span class="service-arrow">→</span>
                                        </h6>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-2 col-md-4 col-6">
                                <a href="#" class="service-card-link">
                                    <div class="service-card">
                                        <i class="fas fa-globe"></i>
                                        <h6>
                                            International License
                                            <span class="service-arrow">→</span>
                                        </h6>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-2 col-md-4 col-6">
                                <a href="#" class="service-card-link">
                                    <div class="service-card">
                                        <i class="fas fa-tags"></i>
                                        <h6>
                                            Dealer Plate Number
                                            <span class="service-arrow">→</span>
                                        </h6>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-2 col-md-4 col-6">
                                <a href="#" class="service-card-link">
                                    <div class="service-card">
                                        <i class="fas fa-sync-alt"></i>
                                        <h6>
                                            Vehicle Renewal
                                            <span class="service-arrow">→</span>
                                        </h6>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!--// Full Width Sider End-->

    
