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

    <hr class="sidebar-divider my-0">

    <!-- DASHBOARD -->
    <li class="nav-item {{ $menuDashboard ?? '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Utama
    </div>

    <!-- MASTER DATA -->
@if(strtolower(auth()->user()->role) == 'superadmin' || strtolower(auth()->user()->role) == 'admin')

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterData">
        <i class="fas fa-database"></i>
        <span>Master Data</span>
    </a>

    <div id="masterData" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">

            @if(strtolower(auth()->user()->role) == 'superadmin')
            <a class="collapse-item" href="{{ route('user') }}">
                User
            </a>
            @endif

            <a class="collapse-item" href="{{ route('divisi') }}">
                Divisi
            </a>

            <a class="collapse-item" href="{{ route('jabatan') }}">
                Jabatan
            </a>

            <!-- TAMBAHAN INI -->
            <a class="collapse-item" href="{{ route('karyawan') }}">
                Karyawan
            </a>

        </div>
    </div>
</li>

@endif


    <!-- SLIP -->
    <li class="nav-item {{ $menuSlip ?? '' }}">
        <a class="nav-link" href="{{ route('slipCreate') }}">
            <i class="fas fa-paper-plane"></i>
            <span>Kirim Slip Gaji</span>
        </a>
    </li>

    <!-- HISTORY -->
    <li class="nav-item {{ $menuHistory ?? '' }}">
        <a class="nav-link" href="{{ route('slipHistory') }}">
            <i class="fas fa-history"></i>
            <span>Detail Riwayat</span>
        </a>
    </li>

    <hr class="sidebar-divider">

<div class="sidebar-heading">
    Sistem
</div>

<li class="nav-item {{ $menuSetting ?? '' }}">
    <a class="nav-link" href="{{ route('setting') }}">
        <i class="fas fa-cog"></i>
        <span>Setting</span>
    </a>
</li>

{{-- ROLE MANAGEMENT - hanya superadmin --}}
@if(strtolower(auth()->user()->role) == 'superadmin')
<li class="nav-item {{ $menuRole ?? '' }}">
    <a class="nav-link" href="{{ route('role.index') }}">
        <i class="fas fa-fw fa-shield-alt"></i>
        <span>Role Management</span>
    </a>
</li>
@endif

    

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>