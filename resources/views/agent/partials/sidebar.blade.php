<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class=""> 
            <img src="{{ asset('/assets/img/dashboard_logo.png')}} " class="img-fluid w-75 logo-text" alt="" />
        </div>
        <a href="javascript:;" class="toggle-btn ms-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li> 
            <a href="{{ route('agent.dashboard')}}" class=""> 
                <div class="parent-icon icon-color-13"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
         <li>
            <a href="{{ route('agent.addVehicle') }}">
                <div class="parent-icon icon-color-13">+<i class="bx bx-car"></i>
                </div>
                <div class="menu-title">Add Vehicle</div>
            </a>
        </li>  
        <li> 
            <a href="{{route('agent.pricing')}}">
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
				    <a href="{{ route('agent.vehicleRenewalPaper') }}"><i class="bx bx-right-arrow-alt"></i>Vehicle Paper Renewal  </a> 
				</li>
				<li>
				     <a href="{{ route('agent.newVehicleRegistration')}}"><i class="bx bx-right-arrow-alt"></i>New Vehicle Registration</a>
				</li>
				<li> 
				    <a href="{{ route('agent.changeofOwnership') }}"><i class="bx bx-right-arrow-alt"></i>Change of Ownership</a></a>
				</li>
				<li>
				   <a href="{{ route('agent.platenumber')}}"><i class="bx bx-right-arrow-alt"></i>Dealer's Plate Number</a>
				</li>
				<li>
				   <a href="{{ route('agent.newdriverlicense') }}"><i class="bx bx-right-arrow-alt"></i>New Driver License</a>
				</li>
				<li>
				   <a href="{{ route('agent.driverslicenserenewal') }}"><i class="bx bx-right-arrow-alt"></i>Drivers License Renewal</a>
				</li>
				<li>
				   <a href="{{ route('agent.internationaldriverlicense')}}"><i class="bx bx-right-arrow-alt"></i>International Driver License</a>
				</li>
				<li>
				   <a href="{{route('agent.otherpermit')}}"><i class="bx bx-right-arrow-alt"></i>Other Permit</a>
				</li>
			</ul>
		</li>

        <li>
            <a href="{{ route('agent.processHistory') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Process History</div>
            </a>
        </li>
        <li>
            <a href="{{ route('agent.transactionHistory') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Transaction History</div>
            </a>
        </li>
        <li>
            <a href="{{ route('agent.profile') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Profile</div>
            </a>
        </li>

        {{-- <li>
            <a href="{{ route('topics.index') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-chat"></i>
                </div>
                <div class="menu-title">Discussions</div>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('agent.faq') }}">
                <div class="parent-icon icon-color-13"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">FAQ</div>
            </a>
        </li>

        <li>
            <a  href="{{ route('agent.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit()">
                <div class="parent-icon icon-color-13"><i class="bx bx-power-off"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
            <form id="logout-form" action="{{ route('agent.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
    <!--end navigation-->

    



</div>