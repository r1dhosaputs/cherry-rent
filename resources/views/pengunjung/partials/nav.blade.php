<nav class="navbar navbar-expand-lg fixed-top bg-primary" data-bs-theme="dark">
    <!-- d-lg-none -->
    <div class="container">
        <a class="navbar-brand" href="#">Cherry Rent</a>

        <!-- Mobile Cart -->
        {{-- <div class="text-white ms-auto me-3 fw-bold d-none d-sm-block d-md-block d-lg-none d-xl-none d-xxl-none">
            <i class="fa-solid fa-cart-plus"></i>
        </div> --}}

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active fw-bold' : '' }}"
                        style="{{ Request::is('/') ? 'text-decoration: underline;' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kostum') ? 'active fw-bold' : '' }}"
                        style="{{ Request::is('kostum') ? 'text-decoration: underline;' : '' }}"
                        href="{{ route('kostum') }}">Kostum</a>
                </li>

            </ul>
            <div class="d-flex justify-content-start align-items-center gap-2">
                <!-- Selain Mobile Cart -->
                {{-- <div class="fw-bold d-none d-lg-block d-xl-block d-xxl-block">
                    <a href="" class="text-white fw-light" style="opacity: 0.5;">
                        <!-- opacity 1 jika memasuki /cart -->
                        <!-- <i class="fa-solid fa-cart-plus"></i> -->
                        <i class="fa-solid fa-cart-shopping"></i> <!-- icon jika cart ada isinya  -->
                    </a>
                </div> --}}
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            More..
                        </a>
                        <ul class="dropdown-menu ">

                            @auth
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            @endauth

                            @guest
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login Admin</a></li>
                            @endguest

                            {{-- <li><a class="dropdown-item" href="loginadmin.html">Login Users</a></li> --}}
                            @auth
                                <li><a class="dropdown-item" href="{{ route('admin.kostum-list') }}">Dashboard Admin</a>
                                </li>
                            @endauth
                            {{-- <li>
                                <hr class="dropdown-divider">
                            </li> --}}
                            {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
