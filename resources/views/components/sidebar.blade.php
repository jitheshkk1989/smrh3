<aside class="sidebar" id="sidebar">
    <div class="p-3">
        <div class="mb-4">
            <img src="{{ asset('images/synergy-logo.png') }}" alt="Synergy Logo" style="max-width: 100%; height: auto;">
        </div>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Menu</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-calendar me-2"></i>
                    Calendar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-clock me-2"></i>
                    Time Off
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-tasks me-2"></i>
                    Task
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users me-2"></i>
                    Team
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-sticky-note me-2"></i>
                    Notes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-line me-2"></i>
                    Reports
                    <span class="badge bg-info text-white ms-auto">NEW</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-folder-open me-2"></i>
                    Documents
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Synergy Suite</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-sitemap me-2"></i>
                    Synergy Team
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-lightbulb me-2"></i>
                    Monthly Redesign
                    <span class="badge bg-warning text-dark ms-auto">2</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Udemy Courses
                </a>
            </li>
        </ul>

        <hr class="my-3">

        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog me-2"></i>
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-question-circle me-2"></i>
                    Support
                </a>
            </li>
        </ul>

        <div class="p-3 mt-auto">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/sophia-williams.png') }}" alt="Sophia Williams" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                <div>
                    <small class="d-block">Sophia Williams</small>
                    <small class="text-muted">sophia.williams@synergy.com</small>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
    .sidebar {
        background-color: #f8f9fa; /* Light background */
        color: #333;
        width: 260px; /* Adjust width */
        flex-shrink: 0;
        transition: width 0.3s ease;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1;
        overflow-y: auto;
        padding-top: 56px; /* Adjust for fixed header */
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }

    .sidebar-heading {
        font-size: 0.75rem;
        text-transform: uppercase;
    }

    .nav-link {
        color: #333;
        padding: 8px 15px;
        transition: background-color 0.15s ease;
    }

    .nav-link.active, .nav-link:hover {
        background-color: #e9ecef;
        color: #007bff; /* Primary color for active/hover */
    }

    .nav-link i {
        width: 24px;
        display: inline-block;
        margin-right: 8px;
    }

    .badge {
        font-size: 0.65rem;
    }

    .mt-auto {
        margin-top: auto !important;
    }
</style>