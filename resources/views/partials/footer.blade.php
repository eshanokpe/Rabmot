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
                    <li> <a href="{{ route('community')}}">FAQ</a></li>
                    <li> <a href="{{ route('agent.login')}}">Agents Login</a></li>
                    <li> <a href="{{ route('policy')}}">Privacy Policy</a></li> 

                </ul>
            </div> 
            <div class="col-6  col-sm-6 col-md-2 p-2  footter">
                <h4>Clients</h4>
                <ul class="list-unstyled">
                    <li> <a href="{{ route('processpapers')}}">Clients Login</a></li>
                    <li> <a href="{{ route('signup')}}">Create Account</a></li>
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

<!--Start of Tawk.to Script-->
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
<!--End of Tawk.to Script-->
<script>
    // prevent ctrl + s
    window.addEventListener('keydown', async (e) => {
        if (e.ctrlKey && (e.which == 83)) {
            e.preventDefault();
            return false;
        }
    });
    window.addEventListener('contextmenu', event => event.preventDefault());
    document.onkeydown = function (e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
            return false;
        }
    }
    window.onkeydown = (e) => {
        return !(e.ctrlKey &&
            (e.keyCode === 67 ||
                e.keyCode === 86 ||
                e.keyCode === 85 ||
                e.keyCode === 117));
    };    
</script>
 <!-- jQery -->
 <script type="text/javascript" src="{{ asset('assets/js/jquery-3.4.1.min.js')}}"></script>

 <!-- bootstrap js -->
 <script type="text/javascript" src="{{ asset('assets/js/bootstrap.js')}}"></script>
 <!-- script -->
 <script src="{{ asset('assets-slide/js/jquery-3.4.1.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/jquery-migrate.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/bootstrap.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/jquery.meanmenu.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/waypoints.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/wow.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/slick.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/jQuery.rcounter.js')}}"></script>
 <script src="{{ asset('assets-slide/js/jquery.rPopup.js')}}"></script>
 <script src="{{ asset('assets-slide/js/jquery.nice-select.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/imagesloaded.pkgd.min.js')}}"></script>
 <script src="{{ asset('assets-slide/js/main.js')}}"></script>
 <!-- Include Google reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js"></script>
<!-- JavaScript for toastr messages -->
@if (session('recaptcha_error'))
<script>
    $(document).ready(function() {
        toastr.error("{{ session('recaptcha_error') }}");
    });
</script>
@endif