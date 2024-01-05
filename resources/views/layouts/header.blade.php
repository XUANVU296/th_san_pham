<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <form>
        <input style="width:500px;" type="text" name="search" class="form-control" placeholder="Search now"
            aria-label="search" aria-describedby="search">
    </form>
    <script>
        document.getElementById('search-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var searchInput = document.getElementById('search-input').value;
            var rows = document.querySelectorAll('table tbody tr');
            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var rowData = row.textContent || row.innerText;
                if (rowData.indexOf(searchInput) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    </script>
    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown mr-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                id="messageDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-message-text mx-0"></i>
                <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                    </div>
                    <div class="item-content flex-grow">
                        <h6 class="ellipsis font-weight-normal">John Doe
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                            The meeting is cancelled
                        </p>
                    </div>
                </a>
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <img src="{{ asset('assets/images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                    </div>
                    <div class="item-content flex-grow">
                        <h6 class="ellipsis font-weight-normal">John Doe
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                            New product launch
                        </p>
                    </div>
                </a>
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <img src="{{ asset('assets/images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                    </div>
                    <div class="item-content flex-grow">
                        <h6 class="ellipsis font-weight-normal"> John Doe
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                            Upcoming board meeting
                        </p>
                    </div>
                </a>
            </div>
        </li>
        <li class="nav-item dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell mx-0"></i>
                <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <div class="item-icon bg-success">
                            <i class="mdi mdi-information mx-0"></i>
                        </div>
                    </div>
                    <div class="item-content">
                        <h6 class="font-weight-normal">Application Error</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                            Just now
                        </p>
                    </div>
                </a>
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <div class="item-icon bg-warning">
                            <i class="mdi mdi-settings mx-0"></i>
                        </div>
                    </div>
                    <div class="item-content">
                        <h6 class="font-weight-normal">Settings</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                            Private message
                        </p>
                    </div>
                </a>
                <a class="dropdown-item">
                    <div class="item-thumbnail">
                        <div class="item-icon bg-info">
                            <i class="mdi mdi-account-box mx-0"></i>
                        </div>
                    </div>
                    <div class="item-content">
                        <h6 class="font-weight-normal">New user registration</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                            2 days ago
                        </p>
                    </div>
                </a>
            </div>
        </li>
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="{{ asset('assets/images/faces/face5.jpg') }}" alt="profile" />
                <span class="nav-profile-name">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">
                    <i class="mdi mdi-settings text-primary"></i>
                    Settings
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="mdi mdi-logout text-primary"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
    </button>
</div>
