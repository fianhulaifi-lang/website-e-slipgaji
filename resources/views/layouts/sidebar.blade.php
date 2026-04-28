 <!-- Sidebar -->
<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{ route('dashboard') }}">

        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo.png') }}"
                 width="70"
                 height="70"
                 class="img-fluid">
        </div>

        <div class="sidebar-brand-text mx-2">
            E-Slip Gaji Mitratani
        </div>

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ $menuDashboard ?? '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Utama
    </div>

    <!-- KHUSUS SUPERADMIN -->
    @if(strtolower(auth()->user()->role) == 'superadmin')

    <li class="nav-item {{ $menuUser ?? '' }}">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-user-shield"></i>
            <span>Data User</span>
        </a>
    </li>

    @endif

    <!-- ADMIN + SUPERADMIN -->

    <li class="nav-item {{ $menuKaryawan ?? '' }}">
        <a class="nav-link" href="{{ route('karyawan') }}">
            <i class="fas fa-users"></i>
            <span>Daftar Karyawan</span>
        </a>
    </li>

    <li class="nav-item {{ $menuSlip ?? '' }}">
        <a class="nav-link" href="{{ route('slipCreate') }}">
            <i class="fas fa-paper-plane"></i>
            <span>Kirim Slip Gaji</span>
        </a>
    </li>

    <li class="nav-item {{ $menuHistory ?? '' }}">
        <a class="nav-link" href="{{ route('slipHistory') }}">
            <i class="fas fa-history"></i>
            <span>Detail Riwayat</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Toggle -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>