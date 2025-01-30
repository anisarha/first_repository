<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation" style="background:  #e61616;">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center" style="margin-bottom: 10px;">
        {{-- <img src="{{ asset('backend/dist/images/kasir.png') }}" alt="AdminLTE Logo" style="width: 70%; height: auto;"> --}}
        <span class="text-white">SIMS Web Aps</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- <li class="nav-header text-white"><span>MENU</span></li> --}}


                    <li class="nav-item">
                        <a href="/index_product" class="nav-link">
                            &nbsp;
                            <i class="fa fa-cube" style="color: white"></i>&nbsp;
                            <span class="brand-text text-white font-weight-light">Product</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/index_profil" class="nav-link">
                            &nbsp;
                            <i class="fa fa-user" style="color: white"></i>&nbsp;
                            <span class="brand-text text-white font-weight-light">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           &nbsp;
                            <i class="fas fa-sign-out-alt" style="color: white"></i>&nbsp;
                            <span class="brand-text text-white font-weight-light">Log Out</span>
                        </a>
                    </li>

                    <!-- Form Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

            </ul>
        </nav>
        {{-- <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header text-white"><span> MENU</span></li>
                <li class="nav-item">
                    <a href="/index_santri" class="nav-link">
                        <i class="nav-icon fas fa-user fa-flip"></i>
                        <span class="brand-text text-white font-weight-light">Master data Siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/index_saldo" class="nav-link">
                        &nbsp;
                        <i class="fas fa-money-bill fa-bounce"></i> &nbsp;
                        <span class="brand-text text-white font-weight-light">Isi Saldo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index_barang" class="nav-link">
                        &nbsp;
                        <i class="fas fa-box"></i> &nbsp;
                        <!-- Ganti "fa-box" dengan kelas ikon yang sesuai -->
                        <span class="brand-text text-white font-weight-light">Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        &nbsp;
                        <i class="fas fa-cubes"></i> &nbsp;
                        <!-- Ganti "fa-cubes" dengan kelas ikon yang sesuai -->
                        <span class="brand-text text-white font-weight-light">Barang Stock</span>
                    </a>
                </li>

            </ul>
        </nav> --}}
        {{-- <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header text-white"><span>TRANSAKSI</span></li>
                <li class="nav-item">
                    <a href="/index_santri" class="nav-link">
                        <i class="nav-icon fas fa-user fa-flip"></i>
                        <span class="brand-text text-white font-weight-light">Master data Siswa</span>
                    </a>
                </li>
            </ul>
        </nav> --}}

        <!-- /.sidebar-menu -->
        {{-- <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header text-white"><span> Account</span></li>
                <li class="nav-item">
                    <a href="/index_register" class="nav-link">
                        <i class="nav-icon fas fa-user fa-flip"></i>
                        <span class="brand-text text-white font-weight-light">Register</span>
                    </a>
                </li>
            </ul>
        </nav> --}}

    </div>
    <!-- /.sidebar -->
{{-- </aside> --}}
