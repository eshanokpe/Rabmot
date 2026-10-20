
<header class="navbar navbar-expand-md sticky-top d-none d-lg-flex d-print-none">

    <div class="container-xl">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"

            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="navbar-nav flex-row order-md-last">

            <div class="d-none d-md-flex">
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-2 position-relative" data-bs-toggle="dropdown"
                        aria-label="Show notifications" aria-haspopup="true">
                        <i class="fa-regular fa-bell" aria-hidden="true"></i>
                        <span class="badge bg-red notification-count d-none" id="unread"
                            aria-live="polite"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card notification-dropdown">
                        <div class="card notification-card">
                            <div class="card-header notification-header">
                                <div>
                                    <h3 class="card-title mb-1">Notifications</h3>
                                    <div class="text-muted small">Stay up to date with recent activity</div>
                                </div>
                                <a href="{{ route('admin.notificationList') }}" class="small fw-semibold">
                                    View all
                                </a>
                            </div>
                            <div class="notification-list" id="notificationList" aria-live="polite">
                                <div class="notification-state text-muted">Loading notifications…</div>
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
                        $user = Auth::guard('admin')->user();
                        
                        // Access user details
                        $name = $user->name;
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

                    <a href="{{route('admin.account.password')}}" class="dropdown-item">Change Password</a>

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
<style>
    .notification-dropdown {
        width: min(24rem, calc(100vw - 2rem));
        padding: 0;
        overflow: hidden;
    }

    .notification-card {
        border: 0;
        box-shadow: none;
    }

    .notification-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 1.125rem;
    }

    .notification-list {
        max-height: 24rem;
        overflow-y: auto;
    }

    .notification-item {
        display: flex;
        gap: .875rem;
        align-items: flex-start;
        padding: .95rem 1.125rem;
        color: inherit;
        text-decoration: none;
        border-top: 1px solid var(--tblr-border-color);
        transition: background-color .15s ease;
    }

    .notification-item:hover,
    .notification-item:focus {
        color: inherit;
        background: var(--tblr-bg-surface-secondary);
        text-decoration: none;
    }

    .notification-icon {
        display: grid;
        width: 2.25rem;
        height: 2.25rem;
        flex: 0 0 2.25rem;
        place-items: center;
        color: var(--tblr-primary);
        background: var(--tblr-primary-lt);
        border-radius: .65rem;
    }

    .notification-copy {
        min-width: 0;
    }

    .notification-message {
        display: -webkit-box;
        overflow: hidden;
        color: var(--tblr-secondary);
        font-size: .8125rem;
        line-height: 1.4;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .notification-state {
        padding: 2rem 1.25rem;
        text-align: center;
        font-size: .875rem;
    }

    .notification-count {
        position: absolute;
        top: -.25rem;
        right: -.35rem;
        min-width: 1.15rem;
        padding: .15rem .3rem;
        border: 2px solid var(--tblr-bg-surface);
        border-radius: 1rem;
        font-size: .625rem;
        line-height: 1;
    }
</style>
<script>
    jQuery(document).ready(function ($) {
        const notificationList = $('#notificationList');
        const unreadBadge = $('#unread');
        const notificationUrl = "{{ url('/admin/notifications') }}";

        function showState(message, isError = false) {
            notificationList.empty().append(
                $('<div>', {
                    class: `notification-state${isError ? ' text-danger' : ' text-muted'}`,
                    text: message
                })
            );
        }

        function formatDate(value) {
            const date = new Date(value);

            if (Number.isNaN(date.getTime())) {
                return '';
            }

            return new Intl.DateTimeFormat(undefined, {
                dateStyle: 'medium',
                timeStyle: 'short'
            }).format(date);
        }

        function renderNotification(notification) {
            const item = $('<a>', {
                class: 'notification-item',
                href: `${notificationUrl}/${encodeURIComponent(notification.id)}`
            });
            const icon = $('<span>', {
                class: 'notification-icon',
                'aria-hidden': 'true'
            }).append($('<i>', { class: 'fa-regular fa-bell' }));
            const copy = $('<span>', { class: 'notification-copy' });

            copy.append($('<span>', {
                class: 'd-block fw-semibold text-truncate mb-1',
                text: notification.title || 'Notification'
            }));
            copy.append($('<span>', {
                class: 'notification-message',
                text: notification.message || ''
            }));

            const date = formatDate(notification.created_at);
            if (date) {
                copy.append($('<span>', {
                    class: 'd-block text-muted small mt-2',
                    text: date
                }));
            }

            return item.append(icon, copy);
        }

        function fetchNotifications() {
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.getNotifications') }}",
                success: function (response) {
                    const unread = Number(response.unreadNotificationsCount) || 0;
                    const notifications = Array.isArray(response.notifications)
                        ? response.notifications
                        : [];

                    unreadBadge.text(unread > 99 ? '99+' : unread);
                    unreadBadge.toggleClass('d-none', unread === 0);
                    notificationList.empty();

                    if (notifications.length === 0) {
                        showState('You’re all caught up. No new notifications.');
                        return;
                    }

                    notifications.forEach(function (notification) {
                        notificationList.append(renderNotification(notification));
                    });
                },
                error: function (error) {
                    console.error('Unable to load notifications.', error);
                    showState('Notifications could not be loaded. Please try again.', true);
                }
            });
        }

        fetchNotifications();
        setInterval(fetchNotifications, 20000);
    });
</script>