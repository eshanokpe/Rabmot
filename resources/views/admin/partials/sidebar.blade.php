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
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-file"></i>
                        </span>
                        <span class="nav-link-title">
                          Document Processes
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('admin.pendingpaper')}}">
                            Pending Document 
                        </a>
                        <a class="dropdown-item" href="{{route('admin.processedpaper')}}">
                            Processing Document
                        </a>
                        
                        <a class="dropdown-item" href="{{route('admin.readyfordelivery')}}">
                           Ready for Delivery
                        </a>
                        <a class="dropdown-item" href="{{route('admin.deliveryinprogress')}}">
                           Delivery in Progress
                        </a>
                        <a class="dropdown-item" href="{{route('admin.delivered')}}">
                           Document Delivered
                         </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-file"></i>
                        </span>
                        <span class="nav-link-title">
                            Process Type
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.processVehiclePaperRenewal') }}">
                            Vechicle Paper Renewal
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.processNewVehicleRegistration')}}">
                           New vehicle Registration
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.processChangeOfOwnership')}}">
                           Change of Ownership
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.processNewDriverlicense')}}">
                            New Driver License
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.processNewDriverLicenseRenewal')}}">
                            Driver License Renewal
                        </a>
                        <a class="dropdown-item"href="{{ route('admin.processInternationalDriverLicense')}}"> 
                            International Driver License 
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.processDealerPlateNumber')}}">
                            Dealer's Plate Number
                         </a>
                          <a class="dropdown-item" href="{{ route('admin.processOtherPermit')}}">
                            Other Permit
                         </a>
                    </div>
                </li>
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-car"></i>
                        </span>
                        <span class="nav-link-title">
                            View Added Vehicle
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('admin.vehicle.renewals')}}"  rel="noopener">
                            Vehicle Renewal
                        </a>
                        <a class="dropdown-item" href="{{route('admin.vehicle.registrations.new')}}">
                            New Vehicle Registration
                        </a>
                        <a class="dropdown-item" href="{{route('admin.changeOfOwnership')}}" 
                            rel="noopener">
                            Change Of Ownership
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-car"></i>
                        </span>
                        <span class="nav-link-title">
                            +Add Vehicle
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('admin.vehicle.renewal.add')}}" >
                           Vehicle Renewal
                        </a>
                        <a class="dropdown-item" href="{{route('admin.vehicle.registration.new')}}">
                            New Vehicle Registration
                        </a>
                        <a class="dropdown-item" href="{{route('admin.vehicle.changeOfOwnership.add')}}" 
                            rel="noopener">
                            Change Of Ownership
                        </a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-money-bill"></i>
                        </span>
                        <span class="nav-link-title">
                            Price 
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.vehicle.types') }}">
                            Vehicle Type
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.states') }}"> 
                            State
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.vehicleRenewalPrice.index') }}">
                            Vechicle Renewal Price
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.vehicleRegistrationPrice.index')}}">
                           New Vehicle Registration
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.vehicleChangeofOwnershipPrice.index')}}">
                           Change of Ownership
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.newDriverLicense.index')}}">
                            New Driver License
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.driverLicenseRenewal.index')}}">
                            Driver License Renewal
                        </a>
                        <a class="dropdown-item"href="{{ route('admin.intDriverLicense.index')}}"> 
                            International Driver License 
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.dealersPlateNumber.index')}}">
                            Dealer's Plate Number
                         </a>
                          <a class="dropdown-item" href="{{ route('admin.otherPermit.index')}}">
                            Other Permit
                         </a>
                    </div>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.users')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-link-title">
                            User's
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.getAgent')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <i class="fa fa-users"></i>
                        </span>
                        <span class="nav-link-title">
                            Agent's
                        </span>
                    </a>
                </li>
              
                

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        </span>
                        <span class="nav-link-title">
                            Transaction
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.transaction') }}">
                            All Transaction
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.withdraw') }}">
                            Agent Withdraw
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.transactionPaperRenewal') }}">
                            Vechicle Paper Renewal
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.transactionVehicleRegistration')}}">
                           New vehicle Registration
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.transactionChangeofownership')}}">
                           Change of Ownership
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.transactionNewDriverlicense')}}">
                            New Driver License
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.transactionDriverlicenseRenewal')}}">
                            Driver License Renewal
                        </a>
                        <a class="dropdown-item"href="{{ route('admin.transactionInternationalDriverlicense')}}"> 
                            International Driver License 
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.transactionDealerplateNumber')}}">
                            Dealer's Plate Number
                         </a>
                          <a class="dropdown-item" href="{{ route('admin.transactionOtherPermit')}}">
                            Other Permit
                         </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.contactMessage') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <span class="nav-link-title">
                            Contact Message
                        </span>
                    </a>
                </li>
                
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="fa fa-money-bill"></i>
                        </span>
                        <span class="nav-link-title">
                            FAQ 
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.question') }}">
                            Question
                        </a>
                        <a class="dropdown-item" href=""> 
                            Response
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.settings') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="fa fa-gears"></i>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>



                <li class="nav-item">

                    <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->

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

