<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">VISTA ZENITH</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">
                    @auth
                        {{ Auth::user()->personnel->prenoms }} {{ Auth::user()->personnel->nom }}
                    @endauth
                    @guest
                        Anonymous
                    @endguest
                </h6>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }} "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown ">
                <a href="#" class="nav-link dropdown-toggle  {{ request()->routeIs('ventes') ? 'active' : '' }} {{ request()->routeIs('approvisionnements') ? 'active' : '' }}" data-bs-toggle="dropdown">
                    <i class="fa fa-exchange-alt me-2"></i>
                    Exchanges
                </a>
                <div class="dropdown-menu bg-transparent border-0"  aria-expanded="true">
                    <div class="mx-4">
                        <a href="{{ route('ventes') }}" class="dropdown-item  {{ request()->routeIs('ventes') ? 'active' : '' }}"><i class="fa fa-shopping-cart mx-1"></i>Sales</a>
                        <a href="{{ route('approvisionnements') }}" class="dropdown-item {{ request()->routeIs('approvisionnements') ? 'active' : '' }}"><i class="fa fa-truck mx-1"></i>Supplying</a>

                    </div>
                </div>
            </div>
            <a href="form.html" class="nav-item nav-link"><i class="fa fa-cube me-2"></i>Products</a>
            {{-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Sales</a> --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-tasks me-2"></i>Others</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <div class="mx-4">
                        <a href="signin.html" class="dropdown-item"><i class="fa fa-tags mx-1"></i>Clients</a>
                        <a href="signup.html" class="dropdown-item"><i class="fa fa-truck mx-1"></i>Suppliers</a>
                        <a href="404.html" class="dropdown-item"><i
                                class="fa fa-exclamation-circle mx-1"></i>Anomaly</a>

                    </div>
                </div>
            </div>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Staff</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa fa-user-circle me-2"></i>Accounts</a>
        </div>
    </nav>
</div>
