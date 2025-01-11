

<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="left-topbar d-flex align-items-center">
            <a href="javascript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
            </a>
        </div>
        <div class="flex-grow-1 search-bar">
            <div class="input-group">
                 <button class="btn btn-search-back search-arrow-back" type="button"><i class="bx bx-arrow-back"></i></button>
                 <input type="text" class="form-control" placeholder="search">
                 <button class="btn btn-search" type="button"><i class="lni lni-search-alt"></i></button>
            </div>
        </div>
        <div class="right-topbar ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item search-btn-mobile">
                    <a class="nav-link position-relative" href="javascript:;">	<i class="bx bx-search vertical-align-middle"></i>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href=" {{ route('home.cart') }}" >	
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
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false">	<i class="bx bx-bell vertical-align-middle"></i>
                        <span class="msg-count">{{$notificationCount}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:;">
                            <div class="msg-header">
                                <h6 class="msg-header-title">{{ $notificationCount }} New</h6>
                                <p class="msg-header-subtitle">Application Notifications</p>
                            </div>
                        </a> 
                        <div class="header-notifications-list ps">
                            @forelse ($notifications as $notification)
                                <a class="dropdown-item" href="{{ route('home.notifications.markAsRead', $notification->id) }}">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 notification-item">
                                            <h6 class="msg-name"><snap><b>{{ $notification->data['title'] ?? 'Notification' }}</b></snap>
                                                <span class="msg-time float-end">{{ $notification->created_at->diffForHumans() }}</span>
                                            </h6>
                                            <p class="msg-info">{{ $notification->data['message'] ?? 'No details available' }}</p>
                                        </div>
                                        <style>
                                            .notification-item {
                                                display: flex;
                                                flex-direction: column;
                                                max-width: 100%; 
                                            }

                                            .msg-name {
                                                white-space: normal;
                                                overflow: visible; 
                                                word-wrap: break-word; 
                                                margin: 0;
                                            }

                                            .msg-time {
                                                white-space: nowrap; 
                                                float: right; 
                                            }

                                            .msg-info {
                                                white-space: normal; 
                                                overflow: visible;
                                                word-wrap: break-word;
                                                margin: 0; 
                                                max-width: 100%;
                                            }
                                            .dropdown-menu {
                                                max-width: 300px; /* Set an appropriate width for the dropdown */
                                                word-wrap: break-word; /* Handle long words */
                                                overflow: visible; /* Ensure content can expand */
                                            }


                                        </style>
                                        
                                    </div>
                                </a>
                            @empty
                                <div class="text-center p-3">
                                    <p class="text-muted">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                        <a href="{{ route('home.notifications.index') }}">
                            <div class="text-center msg-footer">View All Notifications</div>
                        </a>
                    </div>
                    
                </li>
                <li class="nav-item dropdown dropdown-user-profile">

                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">

                        <div class="d-flex user-box align-items-center">

                            <div class="user-info">

                                <p class="user-name mb-0">Hi, {{ Auth::user()->fullname }}</p>

                                <p class="designattion mb-0">Available</p>

                            </div>

                            @if(Auth::user()->profile_image != null)
                                <img src="{{ asset('/assets/profileimages/'.Auth::user()->profile_image) }}" id="image_preview_container" class="user-img" alt="user avatar" />
                            @else
                                <img src="{{ asset('/assets/img/avatar.png')}}" id="image_preview_container" class="user-img" alt="user avatar" />
                            @endif
                        </div>

                    </a>

                    <div class="dropdown-menu dropdown-menu-end">	
                        <a class="dropdown-item" href="{{ route('home.profile') }}">
                            <i class="bx bx-user"></i><span>Profile</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('home') }}">
                            <i class="bx bx-tachometer"></i><span>Dashboard</span>
                        </a>

                        <a class="dropdown-item" href="{{ route('home.processHistory') }}">
                            <i class="bx bx-file"></i><span>Process History</span>
                        </a>

                        <a class="dropdown-item" href="{{ route('home.transactionHistory') }}">
                            <i class="bx bx-wallet"></i><span>Transaction History</span>
                        </a>
                        
                        <div class="dropdown-divider mb-0"></div>	
                        <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off"></i><span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                </li>
             
            </ul>
        </div>
    </nav>
</header>      