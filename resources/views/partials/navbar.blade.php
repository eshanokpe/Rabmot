<nav class="navbar navbar-expand-lg navbar-light bg-pry shadow-sm fixed-top">
    <div class="container" id="div-nav">
        <a class="navbar-brand" href="/" id="a-nav"><img src="{{ asset('assets/img/rab.png')}}" width="150px" alt=""></a>
        <button class="navbar-toggler" style="background-color: rgb(184, 182, 221);" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav  mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('index')}}" id="a-nav">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('pricing')}}" id="a-nav">Check Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('processpapers')}}" id="a-nav">Process Papers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('contactus')}}" id="a-nav">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('community')}}" id="a-nav">Community</a>
                </li> 
                <li>
                <a class="nav-link "  href="{{ route('processpapers')}}" id="a-nav"><button class="btn-radius btn-nav"> Sign In</button></a>
                </li>
            </ul>
        </div>
    </div>
</nav>