 <!-- Sidebar -->
         <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class=""></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-Slip gaji Mitratani </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $menuDashboard ?? '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
             Menu Superadmin
                
            </div>

            <!-- Nav Item - Pages data user -->
           <li class="nav-item {{ $menuSuperdminUser ?? '' }}">
               <a class="nav-link" href="{{ route('user') }}">
                 <i class="fas fa-user"></i>
                  <span>Data User</span>
               </a>
            </li>

            <!-- Nav Item - daftar karyawan -->
            <li class="nav-item" {{ $SuperadminKaryawan ?? '' }}">
               <a class="nav-link" href="{{ route('karyawan') }}">
                 <i class="fas fa-user"></i>
                  <span>Daftar Karyawan</span>
               </a>
            </li>

            <!-- Nav Item - kirim slip gaji -->
           <li class="nav-item">
               <a class="nav-link" href="/kirim-slip">
                 <i class="fas fa-fw fa-folder"></i>
                  <span>Kirim Slip Gaji</span>
               </a>
             </li>

            <!-- Nav Item - Riwayat -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-history"></i>
                    <span> Detail Riwayat</span></a>
            </li>


             <!-- Divider -->
            <hr class="sidebar-divider">
            
             <!-- Heading -->
            <div class="sidebar-heading">
                Menu Admin
                
            </div>

            <!-- Nav Item - daftar karyawan -->
            <li class="nav-item">
               <a class="nav-link" href="/daftar-karyawan">
                 <i class="fas fa-user"></i>
                  <span>Daftar Karyawan</span>
               </a>
            </li>

            <!-- Nav Item - kirim slip gaji -->
           <li class="nav-item">
               <a class="nav-link" href="/kirim-slip">
                 <i class="fas fa-fw fa-folder"></i>
                  <span>Kirim Slip Gaji</span>
               </a>
             </li>

            <!-- Nav Item - Riwayat -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-history"></i>
                    <span> Detail Riwayat</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->