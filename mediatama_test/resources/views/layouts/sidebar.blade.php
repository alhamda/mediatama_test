<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-video"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Video</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if(Auth::user()->level=='admin')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.requests.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>Permintaan</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading pt-2">
        Master
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.videos.index') }}">
            <i class="fas fa-fw fa-video"></i>
            <span>Video</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.customers.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Customer</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Admin</span></a>
    </li>

    @else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.videos.index') }}">
            <i class="fas fa-fw fa-video"></i>
            <span>Video</span></a>
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
