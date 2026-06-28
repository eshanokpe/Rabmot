<footer>
    <style>
        @media only screen and (max-width: 600px) {
            .wide{
            margin-left: -30px;
        } 
        }
    </style>
    <section class="container-fluid bg-pry ps-5 ">
       
        <div class="row p-3 ps-5 ">
            <div class="col-12  col-sm-6 col-md-5   footter">
            <a class="navbar-brand" href="/" id="a-nav">
                <img src="{{ asset('assets/img/rab.png')}}" width="150px" alt="">
            </a>
            <p class="wide">We serves as your authorized representative / agent to the necessary official bodies or parastatals 
                responsible for approving the papers we process. Please note that we do not privately produce these papers nor make any such claims.</p>
                <!-- <i class="fa fa-facebook"></i>
                <i class="fab fa-facebook-f"></i>
            <i class="fa fa-twitter p-2" style="color: white;">twitere</i>
            <a href="#"><i class="fa fa-facebook p-2"></i></a>
            <a href="#" ><i class="fa fa-instagram p-2"></i></a>
            <a href="#" ><i class="fa fa-whatsapp p-2"></i></a> -->
            <div class="text"> <h5> - FOLLOW US:  
            <a  href="https://www.facebook.com/rabmotlicensing " ><i class="fab fa-facebook-f ps-2 pe-2"></i></a>
            <a  href="https://www.instagram.com/rabmotlicensing/" ><i class="fab fa-instagram pe-2"></i></a>
            <a  href="https://twitter.com/rabmotlicensinq"><i class="fab fa-twitter pe-2"></i></a>
            <a  href="https://wa.me/message/CXH37OUHPFJ3J1"><i class="fab fa-whatsapp pe-2"></i></a>
            <a  href="https://www.linkedin.com/in/rabmot-automobile-and-licensing-agency-b72b90243/ " ><i class="fab fa-linkedin-in pe-2"></i></a></h5>
            
            </div>
            </div>
           <div class="col-6  col-sm-6 col-md-2 p-2  footter">
                <h4>Company</h4>
                <ul class="list-unstyled">
                    <li> <a href="{{ route('aboutus')}}">About Us</a></li>
                    <li> <a href="{{ route('community')}}">Community</a></li>
                    <li> <a href="{{ route('faq')}}">FAQ</a></li>
                    <li> <a href="{{ route('agent.login')}}">Agents Login</a></li>
                    <li> <a href="{{ route('policy')}}">Privacy Policy</a></li> 

                </ul>
            </div> 
            <div class="col-6  col-sm-6 col-md-2 p-2  footter">
                <h4>Clients</h4>
                <ul class="list-unstyled">
                    <li>  
                        @if(auth()->check())
                        @else
                        <a href="{{ route('processpapers')}}">Clients Login</a>
                        @endif
                    </li>
                    <li> 
                        @if(auth()->check())
                        @else
                        <a href="{{ route('signup')}}">Create Account</a>
                        @endif
                    </li>

                    <li> <a href="{{ route('howitwork')}}">How it works</a></li>
                    <li> <a href="{{ route('terms')}}">Terms of Use</a></li> 

                </ul>
            </div>
            
            
            <div class="col-12  col-sm-6 col-md-3 p-2  footter ">
                <h4>Contact Us</h4>
                <h5 class="pt-2"><i class="icon flaticon-pin"></i> 1st floor AMG Workspace 22 Road, <br>Festac Town, Lagos NIgeria.</h5>
                <h5><a href="mailto:support@rabmotlicensing.com?subject=Email%20Subject&body=Email%20Body"><i class="fa fa-envelope"></i> support@rabmotlicensing.com</a> </h5>
                <h5><i class="fa fa-phone"></i><a href="tel:+2348155206810">+2348155206810,</a> <a href="tel:+2347088173662"> +2347088173662</a></h5>
            </div>
        </div> 
        
        
    
    </section>
    <section class=" bg-light footter p-3 text-center">
                <h6>© {{ date('Y') }} RABMOT LICENSING AGENCY all right reserved.</h6> 
        </section>
</footer>
