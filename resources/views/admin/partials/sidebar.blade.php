<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="#">
                <img src="{{ asset('/assets/dist/img/Rabmot.png')}}" alt="Rabmot licensing" class="navbar-brand-image">
            </a>
        </h1>
  
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3"> 
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-home"></i>
                        </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>

                <!-- ✅ 5.5 Order Management Section - Corrected -->
               
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-list-ol"></i>
                        </span>
                        <span class="nav-link-title">Order List</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.orders.status', 'submitted') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="fa fa-circle text-secondary"></i></span>
                            Submitted</a>
                        <a class="dropdown-item" href="{{ route('admin.orders.status', 'agent_assigned') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="fa fa-user-tag text-info"></i></span>
                            Agent Assigned</a>
                        <a class="dropdown-item" href="{{ route('admin.orders.status', 'processing') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="fa fa-cog fa-spin text-warning"></i></span>
                            Processing</a>
                        <a class="dropdown-item" href="{{ route('admin.orders.status', 'ready') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="fa fa-check-circle text-primary"></i></span>
                            Ready</a>
                         <a class="dropdown-item" href="{{ route('admin.orders.status', 'delivered') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="fa fa-truck text-success"></i></span>
                            Delivered</a>
                    </div>
                </li>

                <!-- Rest of your existing menu items below -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-car"></i>
                        </span>
                        <span class="nav-link-title">+Add Vehicle</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('admin.vehicle.renewal.add')}}">Vehicle Renewal</a>
                        <a class="dropdown-item" href="{{route('admin.vehicle.registration.new')}}">New Vehicle Registration</a>
                        <a class="dropdown-item" href="{{route('admin.vehicle.changeOfOwnership.add')}}">Change Of Ownership</a>
                    </div>
                </li>

                {{-- ✅ Only show Price section to Super Admin --}}
                @if(Auth::guard('admin')->user()->hasPermission('set_service_pricing'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-money-bill"></i>
                        </span>
                        <span class="nav-link-title">Price</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.vehicle.types') }}">Vehicle Type</a>
                        <a class="dropdown-item" href="{{ route('admin.states') }}">State</a>
                        <a class="dropdown-item" href="{{ route('admin.vehicleRenewalPrice.index') }}">Vehicle Renewal Price</a>
                        <a class="dropdown-item" href="{{ route('admin.vehicleRegistrationPrice.index')}}">New Vehicle Registration</a>
                        <a class="dropdown-item" href="{{ route('admin.vehicleChangeofOwnershipPrice.index')}}">Change of Ownership</a>
                        <a class="dropdown-item" href="{{ route('admin.newDriverLicense.index')}}">New Driver License</a>
                        <a class="dropdown-item" href="{{ route('admin.driverLicenseRenewal.index')}}">Driver License Renewal</a>
                        <a class="dropdown-item" href="{{ route('admin.intDriverLicense.index')}}">International Driver License</a>
                        <a class="dropdown-item" href="{{ route('admin.dealersPlateNumber.index')}}">Dealer's Plate Number</a>
                        <a class="dropdown-item" href="{{ route('admin.otherPermit.index')}}">Other Permit</a>
                    </div>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.users')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-link-title">User's</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.agents')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-link-title">Agent's</span>
                    </a>
                </li>

                {{-- ✅ Show full transaction menu only to Super Admin --}}
                @if(Auth::guard('admin')->user()->hasPermission('view_financial_reports'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </span>
                        <span class="nav-link-title">Transaction</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.transactions') }}">All Transaction</a>
                        <a class="dropdown-item" href="{{ route('admin.transactions.agent') }}">Agent Withdraw</a>
                        <a class="dropdown-item" href="{{ route('admin.transaction.paperRenewal') }}">Vehicle Paper Renewal</a>
                        <a class="dropdown-item" href="{{ route('admin.transaction.vehicleRegistration')}}">New Vehicle Registration</a>
                        <a class="dropdown-item" href="{{ route('admin.transaction.changeOfOwnership')}}">Change of Ownership</a>
                        <a class="dropdown-item" href="{{ route('admin.transactions.newDriverLicense')}}">New Driver License</a>
                        <a class="dropdown-item" href="{{ route('admin.transactions.driverLicenseRenewal')}}">Driver License Renewal</a>
                        <a class="dropdown-item" href="{{ route('admin.transactions.internationalDriverLicense')}}">International Driver License</a>
                        <a class="dropdown-item" href="{{ route('admin.transactions.dealerPlateNumber')}}">Dealer's Plate Number</a>
                        <a class="dropdown-item" href="{{ route('admin.transactions.otherPermit')}}">Other Permit</a>
                    </div>
                </li>
                @endif

                <!-- 5.9 Messages / Broadcasts -->
<li class="nav-item {{ request()->is('admin/broadcasts*') ? 'open' : '' }}">
    <a class="nav-link {{ request()->is('admin/broadcasts*') ? 'active' : '' }}" 
       href="#broadcast-submenu" data-bs-toggle="collapse" data-bs-auto-close="false" 
       role="button" aria-expanded="{{ request()->is('admin/broadcasts*') ? 'true' : 'false' }}">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="fa fa-bullhorn"></i>
        </span>
        <span class="nav-link-title">Messages / Broadcasts</span>
        <i class="fa fa-chevron-down ms-auto"></i>
    </a>
    <div id="broadcast-submenu" class="collapse {{ request()->is('admin/broadcasts*') ? 'show' : '' }}">
        <ul class="nav submenu">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.broadcasts.compose') ? 'active' : '' }}" 
                   href="{{ route('admin.broadcasts.compose') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-pencil-alt"></i>
                    </span>
                    <span class="nav-link-title">Compose Broadcast</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.broadcasts.history') ? 'active' : '' }}" 
                   href="{{ route('admin.broadcasts.history') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-history"></i>
                    </span>
                    <span class="nav-link-title">Broadcast History</span>
                </a>
            </li>
        </ul>
    </div>
</li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.promocode.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-ticket"></i>
                        </span>
                        <span class="nav-link-title">Promo Code</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.contactMessages.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <span class="nav-link-title">Contact Message</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-question-circle"></i>
                        </span>
                        <span class="nav-link-title">FAQ</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.faq.index') }}">View FAQ</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.settings.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-gears"></i>
                        </span>
                        <span class="nav-link-title">Settings</span>
                    </a>
                </li>

                {{-- ✅ Only Super Admin can manage other admins --}}
                @if(Auth::guard('admin')->user()->hasPermission('manage_admins'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admins.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-user-shield"></i>
                        </span>
                        <span class="nav-link-title">Manage Admins</span>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <span class="nav-link-title">Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>