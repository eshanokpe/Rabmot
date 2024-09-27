
<header class="navbar navbar-expand-md sticky-top d-none d-lg-flex d-print-none">

    <div class="container-xl">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"

            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="navbar-nav flex-row order-md-last">

            <div class="d-none d-md-flex">

                             

                <div class="nav-item dropdown d-none d-md-flex me-3">

                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"

                        aria-label="Show notifications">

                        <i class="fa-regular fa-bell"></i>

                        <span class="badge bg-red" id="unread"></span>

                    </a>

                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">

                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">Notification</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">                                
                                    <div class="row align-items-center" id="notificationList">                                      
                                           
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>

            </div>

            <div class="nav-item dropdown">

                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"

                    aria-label="Open user menu">

                    <span class="avatar avatar-sm" 

                        style="background-image: url({{ asset('assets/dist/img/015m.jpg')}})"></span>
                    @php
                        $user = Auth::user();
                        
                        // Access user details
                        $name = $user->fullname;
                        $email = $user->email;
                    @endphp  
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ $name}}</div>
                        <div class="mt-1 small text-muted">{{$email}}</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <a href="#" class="dropdown-item">Status</a>

                    <div class="dropdown-divider"></div>

                    <a href="{{route('admin.settings')}}" class="dropdown-item">Settings</a>

                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        Logout
                    </a>

                </div>

            </div>

        </div>

        <div class="collapse navbar-collapse" id="navbar-menu">

            <div>

                <form action="#" method="get" autocomplete="off" novalidate>

                    <div class="input-icon">

                        <span class="input-icon-addon">

                            <i class="fa fa-search"></i>

                        </span>

                        <input type="text" value="" class="form-control" placeholder="Search…"

                            aria-label="Search in website">

                    </div>

                </form>

            </div>

        </div>

    </div>

</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    function fetchNotifications(){
         // Fetch Notifications
        $.ajax({
            type: 'GET',
            url: "{{ route('admin.getNotifications') }}",
            success: function(response) {
            // alert(response.unreadNotificationsCount);
                const unread = response.unreadNotificationsCount;
                $("#unread").text(unread);
                const notifications = response.notifications;
                const notificationList = $('#notificationList');
                // Clear previous content
                notificationList.empty();
                if(notifications.length === 0){
                    // If there are no notifications, display a message
                    const noNotificationMessage = `
                        <div class="col text-center">
                            <p>No notifications available</p>
                        </div>`;
                    notificationList.append(noNotificationMessage);
                }else{
                    notifications.forEach(notification => {              
                        const notificationItem = 
                        `
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <span class="status-dot status-dot-animated bg-red d-block"></span>
                            </div>
                            <div class="col text-truncate">

                                <a href="/admin/notifications/${notification.id}" class="text-body d-block"><b>${notification.title}</b></a>
                                <div class="d-block text-muted text-truncate mt-n1">
                                    ${notification.message}
                                </div>
                            </div>
                        </div>
                        `;
                        
                        // Append each notification item to the notificationList
                        notificationList.append(notificationItem);
                    });
                }
            
            }, 
            error: function(error) {
                //alert('Error fetching notifications');
            }
        });
    }
    fetchNotifications();
    
    setInterval(fetchNotifications, 20000);
    });

    

</script>