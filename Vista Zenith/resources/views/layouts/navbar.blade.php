<style>
    .btn-fixed-width {
        width: 100px;
    }
</style>

<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-1 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>


    <div class="navbar-nav align-items-center ms-auto">
    <div class="m-n2">
        <a type="button" href="{{ route('ventes.init') }}" class="btn btn-dark m-2 btn-fixed-width"><i class="fa fa-plus me-2"></i> Sell </a>
        <a type="button" class="btn btn-dark m-2 btn-fixed-width"><i class="fa fa-plus me-2"></i>Supply</a>
    </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notification</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profile updated</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">New user added</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Password changed</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                    style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">

                    @auth
                        {{ Auth::user()->personnel->prenoms }} {{ Auth::user()->personnel->nom }}
                    @endauth
                    @guest
                        Anonymous
                    @endguest
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <div class="text-center">
                    <a href="#" class="dropdown-item button">My Profile</a>
                    <a href="#" class="dropdown-item button">Settings</a>
                    <form action="{{ route('auth.logout') }}" method="post" class="dropdown-item">
                        @csrf
                        <button type="bsubmit" class="dropdown-item">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
