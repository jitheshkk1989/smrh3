<header class="header">
    <div class="d-flex align-items-center">
        <button class="btn btn-link d-md-none toggle-sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo ms-3">Synergy <span class="text-muted small">UI Management</span></div>
    </div>
    <div class="d-flex align-items-center">
        <div class="input-group me-3">
            <input type="text" class="form-control form-control-sm" placeholder="Search...">
            <button class="btn btn-outline-secondary btn-sm" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell me-2"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Notification 1</a></li>
                <li><a class="dropdown-item" href="#">Notification 2</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">See all notifications</a></li>
            </ul>
        </div>
        <div class="dropdown ms-3">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/default-profile.png') }}" alt="User Avatar" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                <span class="d-none d-md-inline">Sophia Williams</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <button class="btn btn-primary btn-sm ms-3">Create a Request</button>
    </div>
</header>

<style>
    .header {
        background-color: #fff;
        color: #333;
        padding: 10px 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 2;
    }

    .logo {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .toggle-sidebar {
        font-size: 1.2rem;
    }
</style>