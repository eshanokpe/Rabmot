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
                @php
                    $documentProcessActive = request()->routeIs(
                        'admin.pendingpaper',
                        'admin.processedpaper',
                        'admin.readyfordelivery',
                        'admin.deliveryinprogress',
                        'admin.delivered'
                    );
                    $vehicleListActive = request()->routeIs(
                        'admin.vehicle.renewals',
                        'admin.vehicle.registrations.new',
                        'admin.changeOfOwnership'
                    );
                    $addVehicleActive = request()->routeIs(
                        'admin.vehicle.renewal.add',
                        'admin.vehicle.registration.new',
                        'admin.vehicle.changeOfOwnership.add'
                    );
                    $pricingActive = request()->routeIs(
                        'admin.services.index',
                        'admin.vehicle.types',
                        'admin.states',
                        'admin.vehicleRenewalPrice.index',
                        'admin.vehicleRegistrationPrice.index',
                        'admin.vehicleChangeofOwnershipPrice.index',
                        'admin.newDriverLicense.index',
                        'admin.driverLicenseRenewal.index',
                        'admin.intDriverLicense.index',
                        'admin.dealersPlateNumber.index',
                        'admin.otherPermit.index'
                    );
                    $transactionActive = request()->routeIs(
                        'admin.transactions',
                        'admin.transaction.*',
                        'admin.transactions.*',
                        'admin.withdrawalQueue.index'
                    );
                    $orderActive = request()->routeIs('admin.orders.*');
                    $reportsActive = request()->routeIs('admin.reports.*');
                    $broadcastActive = request()->routeIs('admin.broadcasts.*');
                    $faqActive = request()->routeIs('admin.faq.*');
                @endphp
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}" @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-home"></i>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>

                <!-- ✅ Document Processes Section -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $documentProcessActive ? 'active' : '' }}" href="#navbar-help" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $documentProcessActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-file"></i>
                        </span>
                        <span class="nav-link-title">
                          Document Processes
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $documentProcessActive ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.pendingpaper') ? 'active' : '' }}" href="{{route('admin.pendingpaper')}}" @if(request()->routeIs('admin.pendingpaper')) aria-current="page" @endif>
                            Pending Document
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.processedpaper') ? 'active' : '' }}" href="{{route('admin.processedpaper')}}" @if(request()->routeIs('admin.processedpaper')) aria-current="page" @endif>
                            Processing Document
                        </a>

                        <a class="dropdown-item {{ request()->routeIs('admin.readyfordelivery') ? 'active' : '' }}" href="{{route('admin.readyfordelivery')}}" @if(request()->routeIs('admin.readyfordelivery')) aria-current="page" @endif>
                           Ready for Delivery
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.deliveryinprogress') ? 'active' : '' }}" href="{{route('admin.deliveryinprogress')}}" @if(request()->routeIs('admin.deliveryinprogress')) aria-current="page" @endif>
                           Delivery in Progress
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.delivered') ? 'active' : '' }}" href="{{route('admin.delivered')}}" @if(request()->routeIs('admin.delivered')) aria-current="page" @endif>
                           Document Delivered
                         </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.processtype.index') ? 'active' : '' }}" href="{{ route('admin.processtype.index') }}" @if(request()->routeIs('admin.processtype.index')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-file"></i>
                        </span>
                        <span class="nav-link-title">Process Type</span>
                    </a>
                </li>
               
                @if(Auth::guard('admin')->user()->hasPermission('view-vehicles'))
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $vehicleListActive ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $vehicleListActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-car"></i>
                        </span>
                        <span class="nav-link-title">
                            View Added Vehicle
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $vehicleListActive ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicle.renewals') ? 'active' : '' }}" href="{{route('admin.vehicle.renewals')}}" rel="noopener" @if(request()->routeIs('admin.vehicle.renewals')) aria-current="page" @endif>
                            Vehicle Renewal
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicle.registrations.new') ? 'active' : '' }}" href="{{route('admin.vehicle.registrations.new')}}" @if(request()->routeIs('admin.vehicle.registrations.new')) aria-current="page" @endif>
                            New Vehicle Registration
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.changeOfOwnership') ? 'active' : '' }}" href="{{route('admin.changeOfOwnership')}}"
                            rel="noopener" @if(request()->routeIs('admin.changeOfOwnership')) aria-current="page" @endif>
                            Change Of Ownership
                        </a>
                        <a class="dropdown-item" href="{{route('admin.documentExpiry.index')}}">
                            Document Expiry
                        </a>
                    </div>
                </li>
                @endif

                <!-- Rest of your existing menu items below -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $addVehicleActive ? 'active' : '' }}" href="#navbar-help" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $addVehicleActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-car"></i>
                        </span>
                        <span class="nav-link-title">
                            +Add Vehicle
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $addVehicleActive ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicle.renewal.add') ? 'active' : '' }}" href="{{route('admin.vehicle.renewal.add')}}" @if(request()->routeIs('admin.vehicle.renewal.add')) aria-current="page" @endif>
                           Vehicle Renewal
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicle.registration.new') ? 'active' : '' }}" href="{{route('admin.vehicle.registration.new')}}" @if(request()->routeIs('admin.vehicle.registration.new')) aria-current="page" @endif>
                            New Vehicle Registration
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicle.changeOfOwnership.add') ? 'active' : '' }}" href="{{route('admin.vehicle.changeOfOwnership.add')}}"
                            rel="noopener" @if(request()->routeIs('admin.vehicle.changeOfOwnership.add')) aria-current="page" @endif>
                            Change Of Ownership
                        </a>
                    </div>
                </li>
                
               
                @if(Auth::guard('admin')->user()->hasPermission('view-pricing') || Auth::guard('admin')->user()->hasPermission('view-vehicles'))
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $pricingActive ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $pricingActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-money-bill"></i>
                        </span>
                        <span class="nav-link-title">
                            Price
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $pricingActive ? 'show' : '' }}">
                         @if(Auth::guard('admin')->user()->hasPermission('view-pricing'))
               
                        <a class="dropdown-item {{ request()->routeIs('admin.services.index') ? 'active' : '' }}" href="{{ route('admin.services.index') }}" @if(request()->routeIs('admin.services.index')) aria-current="page" @endif>
                            Service Pricing
                        </a>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('view-vehicles'))

                        <a class="dropdown-item {{ request()->routeIs('admin.vehicle.types') ? 'active' : '' }}" href="{{ route('admin.vehicle.types') }}" @if(request()->routeIs('admin.vehicle.types')) aria-current="page" @endif>
                            Vehicle Type
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.states') ? 'active' : '' }}" href="{{ route('admin.states') }}" @if(request()->routeIs('admin.states')) aria-current="page" @endif>
                            State
                        </a>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('view-pricing'))
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicleRenewalPrice.index') ? 'active' : '' }}" href="{{ route('admin.vehicleRenewalPrice.index') }}" @if(request()->routeIs('admin.vehicleRenewalPrice.index')) aria-current="page" @endif>
                            Vechicle Renewal Price
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicleRegistrationPrice.index') ? 'active' : '' }}" href="{{ route('admin.vehicleRegistrationPrice.index')}}" @if(request()->routeIs('admin.vehicleRegistrationPrice.index')) aria-current="page" @endif>
                           New Vehicle Registration
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.vehicleChangeofOwnershipPrice.index') ? 'active' : '' }}" href="{{ route('admin.vehicleChangeofOwnershipPrice.index')}}" @if(request()->routeIs('admin.vehicleChangeofOwnershipPrice.index')) aria-current="page" @endif>
                           Change of Ownership
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.newDriverLicense.index') ? 'active' : '' }}" href="{{ route('admin.newDriverLicense.index')}}" @if(request()->routeIs('admin.newDriverLicense.index')) aria-current="page" @endif>
                            New Driver License
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.driverLicenseRenewal.index') ? 'active' : '' }}" href="{{ route('admin.driverLicenseRenewal.index')}}" @if(request()->routeIs('admin.driverLicenseRenewal.index')) aria-current="page" @endif>
                            Driver License Renewal
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.intDriverLicense.index') ? 'active' : '' }}" href="{{ route('admin.intDriverLicense.index')}}" @if(request()->routeIs('admin.intDriverLicense.index')) aria-current="page" @endif>
                            International Driver License
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.dealersPlateNumber.index') ? 'active' : '' }}" href="{{ route('admin.dealersPlateNumber.index')}}" @if(request()->routeIs('admin.dealersPlateNumber.index')) aria-current="page" @endif>
                            Dealer's Plate Number
                         </a>
                          <a class="dropdown-item {{ request()->routeIs('admin.otherPermit.index') ? 'active' : '' }}" href="{{ route('admin.otherPermit.index')}}" @if(request()->routeIs('admin.otherPermit.index')) aria-current="page" @endif>
                            Other Permit
                         </a>
                        @endif
                    </div>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view-users'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{route('admin.users')}}" @if(request()->routeIs('admin.users')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-link-title">
                            User's
                        </span>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.agents') ? 'active' : '' }}" href="{{route('admin.agents')}}" @if(request()->routeIs('admin.agents')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-link-title">
                            Agent's
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.agentApprovals.*') ? 'active' : '' }}" href="{{route('admin.agentApprovals.index')}}" @if(request()->routeIs('admin.agentApprovals.*')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-user-check"></i>
                        </span>
                        <span class="nav-link-title">
                            Agent Approvals
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.commission.*') ? 'active' : '' }}" href="{{route('admin.commission.index')}}" @if(request()->routeIs('admin.commission.*')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-percent"></i>
                        </span>
                        <span class="nav-link-title">
                            Commission Management
                        </span>
                    </a>
                </li>

                @if(Auth::guard('admin')->user()->hasPermission('view_financial_reports'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $transactionActive ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $transactionActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        </span>
                        <span class="nav-link-title">
                            Transaction
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $transactionActive ? 'show' : '' }}">
                        @if(Auth::guard('admin')->user()->hasPermission('view-orders'))
                        <a class="dropdown-item {{ request()->routeIs('admin.transactions') ? 'active' : '' }}" href="{{ route('admin.transactions') }}" @if(request()->routeIs('admin.transactions')) aria-current="page" @endif>
                            All Transaction
                        </a>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('view-withdrawals'))
                        <a class="dropdown-item {{ request()->routeIs('admin.withdrawalQueue.index') ? 'active' : '' }}" href="{{ route('admin.withdrawalQueue.index') }}" @if(request()->routeIs('admin.withdrawalQueue.index')) aria-current="page" @endif>
                            Agent Withdraw
                        </a>
                        @endif
                        @if(Auth::guard('admin')->user()->hasPermission('view-orders'))
                        <a class="dropdown-item {{ request()->routeIs('admin.transaction.paperRenewal') ? 'active' : '' }}" href="{{ route('admin.transaction.paperRenewal') }}" @if(request()->routeIs('admin.transaction.paperRenewal')) aria-current="page" @endif>
                            Vechicle Paper Renewal
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.transaction.vehicleRegistration') ? 'active' : '' }}" href="{{ route('admin.transaction.vehicleRegistration')}}" @if(request()->routeIs('admin.transaction.vehicleRegistration')) aria-current="page" @endif>
                           New vehicle Registration
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.transaction.changeOfOwnership') ? 'active' : '' }}" href="{{ route('admin.transaction.changeOfOwnership')}}" @if(request()->routeIs('admin.transaction.changeOfOwnership')) aria-current="page" @endif>
                           Change of Ownership
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.transactions.newDriverLicense') ? 'active' : '' }}" href="{{ route('admin.transactions.newDriverLicense')}}" @if(request()->routeIs('admin.transactions.newDriverLicense')) aria-current="page" @endif>
                            New Driver License
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.transactions.driverLicenseRenewal') ? 'active' : '' }}" href="{{ route('admin.transactions.driverLicenseRenewal')}}" @if(request()->routeIs('admin.transactions.driverLicenseRenewal')) aria-current="page" @endif>
                            Driver License Renewal
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.transactions.internationalDriverLicense') ? 'active' : '' }}" href="{{ route('admin.transactions.internationalDriverLicense')}}" @if(request()->routeIs('admin.transactions.internationalDriverLicense')) aria-current="page" @endif>
                            International Driver License
                        </a>
                        <a class="dropdown-item {{ request()->routeIs('admin.transactions.dealerPlateNumber') ? 'active' : '' }}" href="{{ route('admin.transactions.dealerPlateNumber')}}" @if(request()->routeIs('admin.transactions.dealerPlateNumber')) aria-current="page" @endif>
                            Dealer's Plate Number
                         </a>
                          <a class="dropdown-item {{ request()->routeIs('admin.transactions.otherPermit') ? 'active' : '' }}" href="{{ route('admin.transactions.otherPermit')}}" @if(request()->routeIs('admin.transactions.otherPermit')) aria-current="page" @endif>
                            Other Permit
                         </a>
                        @endif
                    </div>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view-orders'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $orderActive ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $orderActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-list-check"></i>
                        </span>
                        <span class="nav-link-title">Order Management</span>
                    </a>
                    <div class="dropdown-menu {{ $orderActive ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.orders.index', 'admin.orders.show') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}" @if(request()->routeIs('admin.orders.index', 'admin.orders.show')) aria-current="page" @endif>All Orders</a>
                        <a class="dropdown-item {{ request()->routeIs('admin.orders.assigned') ? 'active' : '' }}" href="{{ route('admin.orders.assigned') }}" @if(request()->routeIs('admin.orders.assigned')) aria-current="page" @endif>Assigned to Me</a>
                    </div>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view-reports'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $reportsActive ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $reportsActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-chart-line"></i>
                        </span>
                        <span class="nav-link-title">Reports</span>
                    </a>
                    <div class="dropdown-menu {{ $reportsActive ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.reports.revenue') ? 'active' : '' }}" href="{{ route('admin.reports.revenue') }}" @if(request()->routeIs('admin.reports.revenue')) aria-current="page" @endif>Revenue Dashboard</a>
                        <a class="dropdown-item {{ request()->routeIs('admin.reports.orders') ? 'active' : '' }}" href="{{ route('admin.reports.orders') }}" @if(request()->routeIs('admin.reports.orders')) aria-current="page" @endif>Order Reports</a>
                        <a class="dropdown-item {{ request()->routeIs('admin.reports.agentPerformance') ? 'active' : '' }}" href="{{ route('admin.reports.agentPerformance') }}" @if(request()->routeIs('admin.reports.agentPerformance')) aria-current="page" @endif>Agent Performance</a>
                        <a class="dropdown-item {{ request()->routeIs('admin.reports.referrals') ? 'active' : '' }}" href="{{ route('admin.reports.referrals') }}" @if(request()->routeIs('admin.reports.referrals')) aria-current="page" @endif>Referral Reports</a>
                    </div>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view-messaging'))
               
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $broadcastActive ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $broadcastActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-chart-line"></i>
                        </span>
                        <span class="nav-link-title">Messages / Broadcasts</span>
                    </a>
                    <div class="dropdown-menu {{ $broadcastActive ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.broadcasts.compose') ? 'active' : '' }}" href="{{ route('admin.broadcasts.compose') }}" @if(request()->routeIs('admin.broadcasts.compose')) aria-current="page" @endif>Compose Broadcast</a>
                        <a class="dropdown-item {{ request()->routeIs('admin.broadcasts.history') ? 'active' : '' }}" href="{{ route('admin.broadcasts.history') }}" @if(request()->routeIs('admin.broadcasts.history')) aria-current="page" @endif>Broadcast History</a>
                    </div>
                </li>
                @endif

                

                @if(Auth::guard('admin')->user()->hasPermission('view_financial_reports'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.promocode.*') ? 'active' : '' }}" href="{{route('admin.promocode.index')}}" @if(request()->routeIs('admin.promocode.*')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-link-title">
                            Promo Code
                        </span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view_financial_reports'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.contactMessages.*') ? 'active' : '' }}" href="{{ route('admin.contactMessages.index') }}" @if(request()->routeIs('admin.contactMessages.*')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <span class="nav-link-title">
                            Contact Message
                        </span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view-faq'))
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $faqActive ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="{{ $faqActive ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-money-bill"></i>
                        </span>
                        <span class="nav-link-title">
                            FAQ
                        </span>
                    </a>
                    <div class="dropdown-menu {{ $faqActive ? 'show' : '' }}">
                        <a class="dropdown-item {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}" href="{{ route('admin.faq.index') }}" @if(request()->routeIs('admin.faq.*')) aria-current="page" @endif>
                            View FAQ
                        </a>
                    </div>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view_financial_reports'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}" @if(request()->routeIs('admin.settings.*')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-gears"></i>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->hasPermission('view_financial_reports'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}" href="{{ route('admin.staff.index') }}" @if(request()->routeIs('admin.staff.*')) aria-current="page" @endif>
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa-solid fa-user-shield"></i>
                        </span>
                        <span class="nav-link-title">
                            Staff Accounts
                        </span>
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
                        <span class="nav-link-title">
                            Logout
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>