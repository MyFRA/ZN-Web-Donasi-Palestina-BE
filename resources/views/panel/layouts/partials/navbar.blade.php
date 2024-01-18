<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="avatar img-fluid rounded me-1" alt="" /> <span class="text-dark">Admin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button class="dropdown-item" type="submit">Log out</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
