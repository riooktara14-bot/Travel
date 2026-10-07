<style>
    /* =====================================
       TRAVEL GO - SIDEBAR NAVY + GOLD
       ===================================== */

    #sidebar {
        background: #1E293B !important;
        color: #F4C95D !important;
    }

    #sidebar .nav {
        background: #1E293B !important;
    }

    /* ===============================
       SEMUA MENU
       =============================== */

    #sidebar .nav-link {
        color: #F4C95D !important;
        background: transparent !important;
        border-radius: 10px;
        margin: 4px 10px;
        padding: 11px 15px !important;
        transition: all .2s ease;
    }

    #sidebar .nav-link .menu-title {
        color: #F4C95D !important;
    }

    #sidebar .nav-link .menu-icon {
        color: #F4C95D !important;
    }

    #sidebar .menu-arrow {
        color: #F4C95D !important;
    }


    /* ===============================
       HOVER
       =============================== */

    #sidebar .nav-link:hover {
        background: #334155 !important;
        color: #F4C95D !important;
        border-radius: 10px;
    }

    #sidebar .nav-link:hover .menu-title,
    #sidebar .nav-link:hover .menu-icon,
    #sidebar .nav-link:hover .menu-arrow {
        color: #F4C95D !important;
    }


    /* ===============================
       MENU AKTIF
       =============================== */

    #sidebar .nav-item.active > .nav-link {
        background: #F4C95D !important;
        color: #1E293B !important;
        border-radius: 10px !important;

        /* EFEK DIKELILINGI */
        box-shadow:
            0 0 0 2px rgba(244, 201, 93, .25),
            0 4px 12px rgba(244, 201, 93, .18);

        font-weight: 700;
    }

    #sidebar .nav-item.active > .nav-link .menu-title,
    #sidebar .nav-item.active > .nav-link .menu-icon,
    #sidebar .nav-item.active > .nav-link .menu-arrow {
        color: #1E293B !important;
    }

    #sidebar .finance-menu .nav-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        font-weight: 500;
    }

    #sidebar .finance-menu .nav-link .menu-icon {
        min-width: 22px;
        margin-right: 8px;
    }

    #sidebar .finance-menu .nav-item.active > .nav-link {
        font-weight: 700;
    }


    /* ===============================
       SUBMENU
       =============================== */

    #sidebar .collapse,
    #sidebar .sub-menu {
        background: #172033 !important;
    }

    #sidebar .sub-menu {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    #sidebar .sub-menu .nav-link {
        color: #F4C95D !important;
        background: transparent !important;
        margin: 2px 15px 2px 25px;
        padding: 9px 12px !important;
        border-radius: 8px;
    }

    #sidebar .sub-menu .nav-link:hover {
        background: #334155 !important;
        color: #F4C95D !important;
    }


    /* ===============================
       SUBMENU AKTIF
       =============================== */

    #sidebar .sub-menu .nav-item.active > .nav-link {
        background: #F4C95D !important;
        color: #1E293B !important;

        box-shadow:
            0 0 0 2px rgba(244, 201, 93, .20),
            0 3px 10px rgba(244, 201, 93, .15);
    }


    /* ===============================
       LOGOUT
       =============================== */

    #sidebar .nav-link.text-danger {
        color: #F4C95D !important;
    }

    #sidebar .nav-link.text-danger:hover {
        background: #334155 !important;
        color: #F4C95D !important;
    }


    /* ===============================
       ICON
       =============================== */

    #sidebar i,
    #sidebar span {
        transition: all .2s ease;
    }


    /* ===============================
       GARIS/OUTLINE GOLD
       =============================== */

    #sidebar .nav-item.active {
        position: relative;
    }

    #sidebar .nav-item.active > .nav-link::before {
        content: "";
        position: absolute;
        left: -4px;
        top: 50%;
        transform: translateY(-50%);

        width: 4px;
        height: 65%;

        background: #F4C95D;
        border-radius: 0 5px 5px 0;

        box-shadow: 0 0 8px rgba(244, 201, 93, .5);
    }

    @media screen and (max-width: 991px) {
        body.finance-layout #sidebar.sidebar-offcanvas {
            position: fixed;
            top: 97px;
            bottom: 0;
            left: 0;
            right: auto;
            max-height: calc(100vh - 97px);
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform .25s ease-out;
            z-index: 1050;
        }

        body.finance-layout #sidebar.sidebar-offcanvas.active {
            left: 0;
            right: auto;
            transform: translateX(0);
        }
    }
</style>


<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav {{ auth()->user()->isFinance() ? 'finance-menu' : '' }}">

        @if (auth()->user()->isFinance())
            <li class="nav-item {{ request()->routeIs('booking*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('booking') }}" @if (request()->routeIs('booking*')) aria-current="page" @endif><i class="mdi mdi-cash-multiple menu-icon"></i><span class="menu-title">Booking</span></a></li>
            <li class="nav-item {{ request()->routeIs('pendapatan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('pendapatan') }}" @if (request()->routeIs('pendapatan*')) aria-current="page" @endif><i class="mdi mdi-chart-line menu-icon"></i><span class="menu-title">Pendapatan</span></a></li>
            <li class="nav-item {{ request()->routeIs('finance.laporankeuangan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('finance.laporankeuangan') }}" @if (request()->routeIs('finance.laporankeuangan*')) aria-current="page" @endif><i class="mdi mdi-file-chart-outline menu-icon"></i><span class="menu-title">Laporan Keuangan</span></a></li>
            <li class="nav-item {{ request()->routeIs('finance.refund*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('finance.refund') }}" @if (request()->routeIs('finance.refund*')) aria-current="page" @endif><i class="mdi mdi-cash-refund menu-icon"></i><span class="menu-title">Refund</span></a></li>
            <li class="nav-item {{ request()->routeIs('profiladmin*', 'finance.profil*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('profiladmin') }}" @if (request()->routeIs('profiladmin*', 'finance.profil*')) aria-current="page" @endif><i class="mdi mdi-account menu-icon"></i><span class="menu-title">Profil Saya</span></a></li>
            <li class="nav-item"><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start"><i class="mdi mdi-logout menu-icon"></i><span class="menu-title">Logout</span></button></form></li>
        @else

        <!-- DASHBOARD -->
        <li class="nav-item active">

            <a class="nav-link"
               href="{{ route('admin') }}">

                <i class="mdi mdi-view-dashboard menu-icon"></i>

                <span class="menu-title">
                    Dashboard
                </span>

            </a>

        </li>


        <!-- MASTER DATA -->
        <li class="nav-item">

            <a class="nav-link"
               data-bs-toggle="collapse"
               href="#masterData"
               aria-expanded="false">

                <i class="mdi mdi-database menu-icon"></i>

                <span class="menu-title">
                    Master Data
                </span>

                <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="masterData">

                <ul class="nav flex-column sub-menu">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('destinasiwisata') }}">
                            Destinasi Wisata
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('hotel') }}">
                            Hotel
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('transportasi') }}">
                            Transportasi
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('promo') }}">
                            Promo
                        </a>
                    </li>

                </ul>

            </div>

        </li>

        <!-- BOOKING -->
        <li class="nav-item {{ request()->routeIs('booking*') ? 'active' : '' }}">

            <a class="nav-link"
               href="{{ route('booking') }}"
               @if (request()->routeIs('booking*')) aria-current="page" @endif>

                <i class="mdi mdi-cash-multiple menu-icon"></i>

                <span class="menu-title">
                    Booking
                </span>

            </a>

        </li>


        <!-- PELANGGAN -->
        <li class="nav-item">

            <a class="nav-link"
               href="{{ route('datapelanggan') }}">

                <i class="mdi mdi-account-group menu-icon"></i>

                <span class="menu-title">
                    Pelanggan
                </span>

            </a>

        </li>


        <!-- PENDAPATAN -->
        <li class="nav-item">

            <a class="nav-link"
               href="{{ route('pendapatan') }}">

                <i class="mdi mdi-chart-line menu-icon"></i>

                <span class="menu-title">
                    Pendapatan
                </span>

            </a>

        </li>

        @if (auth()->user()->isOwner())
        <li class="nav-item {{ request()->routeIs('finance.laporankeuangan*') ? 'active' : '' }}">

            <a class="nav-link"
               href="{{ route('finance.laporankeuangan') }}">

               <i class="mdi mdi-finance menu-icon"></i>

                <span class="menu-title">
                    laporan
                </span>

            </a>

        </li>
        @endif


        <!-- ADMIN -->
        <li class="nav-item">

            <a class="nav-link"
               data-bs-toggle="collapse"
               href="#admin"
               aria-expanded="false">

                <i class="mdi mdi-account-cog menu-icon"></i>

                <span class="menu-title">
                    Admin
                </span>

                <i class="menu-arrow"></i>

            </a>

            <div class="collapse" id="admin">

                <ul class="nav flex-column sub-menu">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('profiladmin') }}">
                            Profil Admin
                        </a>
                    </li>

                    @if (auth()->user()->role()->where('nama_peran', 'Super Admin')->exists() || strtolower((string) auth()->user()->getRawOriginal('role')) === 'super admin' || auth()->user()->isOwner())
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('kelolaadmin') }}">
                                Kelola Admin
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('pengaturanweb') }}">
                                Pengaturan Website
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="owner-logout-form">
                            @csrf
                            <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start owner-logout-button">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>

            </div>

        </li>

        @endif
    </ul>

</nav>
