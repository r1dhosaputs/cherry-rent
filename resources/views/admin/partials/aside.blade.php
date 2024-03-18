<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 100%">


    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="p-3 brand-text font-weight-bold">{{ auth()->user()->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Request::is('admin-dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-header">AKSI</li>
                <li class="nav-item">
                    <a href="{{ Route('admin.home-slider') }}"
                        class="nav-link {{ Request::is('admin-home-slider*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Slider Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kostum-list') }}"
                        class="nav-link {{ Request::is('admin/kostum*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-shirt"></i>
                        <p>
                            Kostum
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.peminjaman-list') }}"
                        class="nav-link {{ Request::is('admin/peminjaman*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-list"></i>
                        <p>
                            Peminjaman
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}"
                        class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-hashtag"></i>
                        <p>
                            Kategori Kostum
                        </p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p> {{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
