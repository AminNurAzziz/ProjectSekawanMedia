<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-industry"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT.AZZIZ</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (auth()->user()->role == 'admin')
            
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item {{ Request::is('report') ? 'active' : '' }}">
            <a class="nav-link" href="/report">
                <i class="fas fa-chart-line"></i>
                <span>Periodic Report</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Management Sections -->
        <div class="sidebar-heading">
            Management Sections
        </div>

        <!-- Booking & Vehicle Management -->
        <li class="nav-item {{ Request::is('bookings*', 'booking-histories*', 'vehicles*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bookings.index') }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Booking</span></a>
            <a class="nav-link" href="{{ route('booking-histories.index') }}">
                <i class="fas fa-history"></i>
                <span>Historical</span></a>
            <a class="nav-link" href="{{ route('vehicles.index') }}">
                <i class="fas fa-car"></i>
                <span>Vehicle</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Office & Branch Management -->
        <li class="nav-item {{ Request::is('head-office-managers*', 'branch-managers*', 'branches*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('head-office-managers.index') }}">
                <i class="fas fa-users"></i>
                <span>Manager Office</span></a>
            <a class="nav-link" href="{{ route('branch-managers.index') }}">
                <i class="fas fa-users"></i>
                <span>Manager Branch</span></a>
            <a class="nav-link" href="{{ route('branches.index') }}">
                <i class="fas fa-building"></i>
                <span>Branch</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Company Driver & Position Management -->
        <li class="nav-item {{ Request::is('company-drivers*', 'positions*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('company-drivers.index') }}">
                <i class="fas fa-user"></i>
                <span>Company Driver</span></a>
            <a class="nav-link" href="{{ route('positions.index') }}">
                <i class="fas fa-suitcase"></i>
                <span>Position</span></a>
        </li>

@elseif (auth()->user()->role == 'approver1' || auth()->user()->role == 'approver2')
    <li class="nav-item {{ Request::is('/approval') ? 'active' : '' }}">
        <a class="nav-link" href="/approval">
            <i class="fas fa-check"></i>
            <span>Approval</span></a>
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-chart-line"></i>
            <span>Periodic Report</span></a>
    </li>

@endif
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

<!-- End of Sidebar -->
