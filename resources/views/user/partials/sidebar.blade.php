<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <a href="{{ route('index') }}">
            <div class="">
                <img src="{{ asset('/assets/img/dashboard_logo.png') }}"
                    class="img-fluid w-75 logo-text" alt="" />
            </div>
        </a>
        <a href="javascript:;" class="toggle-btn ms-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('home') }}" class="">
                <div class="parent-icon icon-color-13"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('home.addVehicle') }}">
                <div class="parent-icon icon-color-13">+<i class="bx bx-car"></i>
                </div>
                <div class="menu-title">Add Vehicle</div>
            </a>
        </li>
        <li>
            {{-- <a href="{{route('home.pricing') }}"> --}}
            <a href="{{ route('home.pricing') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Check Prices</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-13"> <i class="bx bx-file"></i></div>
                <div class="menu-title">Process Document</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('home.vehicleRenewalPaper') }}"><i
                            class="bx bx-right-arrow-alt"></i>Vehicle Paper Renewal </a>
                </li>
                <li>
                    <a href="{{ route('home.newVehicleRegistration') }}"><i
                            class="bx bx-right-arrow-alt"></i>New Vehicle Registration</a>
                </li>
                <li>
                    <a href="{{ route('home.changeofOwnership') }}"><i
                            class="bx bx-right-arrow-alt"></i>Change of Ownership</a></a>
                </li>
                <li>
                    <a href="{{ route('home.platenumber') }}"><i
                            class="bx bx-right-arrow-alt"></i>Dealer's Plate Number</a>
                </li>
                <li>
                    <a href="{{ route('home.newdriverlicense') }}"><i
                            class="bx bx-right-arrow-alt"></i>New Driver License</a>
                </li>
                <li>
                    <a href="{{ route('home.driverslicenserenewal') }}"><i
                            class="bx bx-right-arrow-alt"></i>Drivers License Renewal</a>
                </li>
                <li>
                    <a href="{{ url('home/internationaldriverlicense') }}"><i
                            class="bx bx-right-arrow-alt"></i>International Driver License</a>
                </li>
                <li>
                    <a href="{{ route('home.otherpermit') }}"><i
                            class="bx bx-right-arrow-alt"></i>Other Permit</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('home.processHistory') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-history"></i>
                </div>
                <div class="menu-title">Process History</div>
            </a>
        </li>
        <li>
            <a href="{{ route('home.transactionHistory') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-history"></i>
                </div>
                <div class="menu-title">Transaction History</div>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('home.wallet') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-money"></i>
                </div>
                <div class="menu-title">Wallet</div>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('home.profile') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Profile</div>
            </a>
        </li>

        <li>

            <a href="{{ route('topics.index') }}">

                <div class="parent-icon icon-color-13"><i class="bx bx-chat"></i>

                </div>

                <div class="menu-title">Discussions</div>

            </a>

        </li>

        <li>

            <a href="{{ route('home.faq') }}">

                <div class="parent-icon icon-color-13"><i class="bx bx-help-circle"></i>

                </div>

                <div class="menu-title">FAQ</div>

            </a>

        </li>



        <li>



            <a href="{{ route('logout') }}" onclick="event.preventDefault();

            document.getElementById('logout-form').submit()">

                <div class="parent-icon icon-color-13"><i class="bx bx-power-off"></i>

                </div>

                <div class="menu-title">Logout</div>

            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                @csrf

            </form>



        </li>



    </ul>



    <!--end navigation-->





</div>
