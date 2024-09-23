<header class="top-header">

    <nav class="navbar navbar-expand">

        <div class="left-topbar d-flex align-items-center">

            <a href="javascript:;" class="toggle-btn"> <i class="bx bx-menu"></i>

            </a>

        </div>

        <div class="flex-grow-1 search-bar">

            <div class="input-group">

                <button class="btn btn-search-back search-arrow-back" type="button"><i
                        class="bx bx-arrow-back"></i></button>

                <input type="text" class="form-control" placeholder="search" />

                <button class="btn btn-search" type="button"><i class="lni lni-search-alt"></i></button>

            </div>

        </div>

        <div class="right-topbar ms-auto">

            <ul class="navbar-nav">

                <li class="nav-item search-btn-mobile">

                    <a class="nav-link position-relative" href="javascript:;"> <i
                            class="bx bx-search vertical-align-middle"></i>

                    </a>

                </li>

                <li class="nav-item dropdown dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                        href=" {{ route('agent.cart') }}">
                        @php
                            $cartCounts = Cart::count();
                            Session::put('cartCounts', $cartCounts);
                            $cartCount = Session::get('cartCounts');
                        @endphp

                        @if($cartCount > 0)
                            <span class="msg-count">{{ $cartCount }}</span>
                        @else
                            <span class="msg-count">0</span>
                        @endif
                        <i class="bx bx-cart vertical-align-middle"></i>
                    </a>
                </li>

                <li class="nav-item dropdown dropdown-lg">

                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;"
                        data-bs-toggle="dropdown"> <i class="bx bx-bell vertical-align-middle"></i>

                        <span class="msg-count">0</span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-end">

                        <a href="javascript:;">

                            <div class="msg-header">

                                <h6 class="msg-header-title">0 New</h6>

                                <p class="msg-header-subtitle">Application Notifications</p>

                            </div>

                        </a>

                        <div class="">



                        </div>

                        <a href="javascript:;">

                            <div class="text-center msg-footer">View All Notifications</div>

                        </a>

                    </div>

                </li>

                <li class="nav-item dropdown dropdown-user-profile">

                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-bs-toggle="dropdown">

                        <div class="d-flex user-box align-items-center">
                            @php
                                

                                // Access user details
                                $name = $user->fullname;
                                $email = $user->email;
                                $profileImage = $user->profile_image;
                            @endphp
                            <div class="user-info">

                                <p class="user-name mb-0">Hi, {{ $name }}</p>

                                <p class="designattion mb-0">Available</p>

                            </div>
                            @if($profileImage)
                                <img src="{{ asset('/assets/profileimages/'.$profileImage) }}"
                                    class="user-img" alt="user avatar">
                            @else
                                <img src="{{ asset('/assets/dashboard/images/avatars/avatar-1.jpg') }}"
                                    class="user-img" alt="user avatar">
                            @endif

                        </div>

                    </a>

                    <div class="dropdown-menu dropdown-menu-end">

                        <a class="dropdown-item" href="{{ route('agent.profile') }}"><i
                                class="bx bx-user"></i><span>Profile</span></a>


                        <a class="dropdown-item" href="{{ route('agent.processHistory') }}"><i
                                class="bx bx-file"></i><span>Process History</span></a>


                        <a class="dropdown-item" href="{{ route('agent.transactionHistory') }}"><i
                                class="bx bx-wallet"></i><span>Transaction History</span></a>


                        <div class="dropdown-divider mb-0"></div>

                        <a class="dropdown-item" href="{{ route('agent.logout') }}" onclick="event.preventDefault();

                            document.getElementById('logout-form').submit();">

                            <i class="bx bx-power-off"></i><span>Logout</span>

                        </a>

                        <form id="logout-form" action="{{ route('agent.logout') }}" method="POST"
                            class="d-none">

                            @csrf

                        </form>

                    </div>

                </li>



            </ul>

        </div>

    </nav>

</header>
