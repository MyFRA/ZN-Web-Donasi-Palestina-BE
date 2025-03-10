<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='/'>
            <span class="align-middle">Bali Lestari Malik</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                App
            </li>

            <li class="sidebar-item {{ Request::is('panel') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel') }}'>
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Master Data
            </li>

            <li class="sidebar-item {{ Request::is('panel/news') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/news') }}'>

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tv">
                        <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                        <polyline points="17 2 12 7 7 2"></polyline>
                    </svg>
                    <span class="align-middle">Berita</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('panel/donation-packages') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/donation-packages') }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package">
                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span class="align-middle">Paket Donasi</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('panel/product-donations') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/product-donations') }}'>

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive">
                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                        <rect x="1" y="3" width="22" height="5"></rect>
                        <line x1="10" y1="12" x2="14" y2="12"></line>
                    </svg>
                    <span class="align-middle">Produk Donasi</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('panel/bank-accounts') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/bank-accounts') }}'>

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    <span class="align-middle">Bank Account VA</span>
                </a>
            </li>

            <li class="sidebar-header">
                Donasi Terkumpul
            </li>

            <li class="sidebar-item {{ Request::is('panel/donation-packages-collected') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/donation-packages-collected') }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package">
                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span class="align-middle">Paket Donasi</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('panel/product-donation-orders-collected') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/product-donation-orders-collected') }}'>

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive">
                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                        <rect x="1" y="3" width="22" height="5"></rect>
                        <line x1="10" y1="12" x2="14" y2="12"></line>
                    </svg>
                    <span class="align-middle">Produk Donasi</span>
                </a>
            </li>

            <li class="sidebar-header">
                Pengaturan
            </li>

            <li class="sidebar-item {{ Request::is('panel/setting-web-donation') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/setting-web-donation') }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                    <span class="align-middle">Web Donasi</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('panel/setting') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/panel/setting') }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-codepen">
                        <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
                        <line x1="12" y1="22" x2="12" y2="15.5"></line>
                        <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
                        <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
                        <line x1="12" y1="2" x2="12" y2="8.5"></line>
                    </svg>
                    <span class="align-middle">Perusahaan</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
