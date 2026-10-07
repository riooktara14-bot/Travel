<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row"
     style="background-color: #1E293B !important;">

    <!-- LOGO -->
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start"
         style="background-color: #1E293B !important;">

        <div class="me-3">
            <button class="navbar-toggler align-self-center"
                    type="button"
                    data-bs-toggle="minimize">
                <span class="icon-menu"
                      style="color: #F4C95D;"></span>
            </button>
        </div>

        <div></div>
    </div>

    <!-- NAVBAR MENU -->
    <div class="navbar-menu-wrapper d-flex align-items-top"
         style="background-color: #1E293B !important;">

        <!-- SAPAAN -->
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">

                <div class="welcome-text"
                     style="color: #CBD5E1;">
                    Selamat Datang,
                    <span class="fw-bold"
                          style="color: #FFFFFF;">
                        {{ auth()->user()->name }}
                    </span>
                </div>

                <h3 class="welcome-sub-text"
                    style="color: #CBD5E1;">
                    Kelola data Travel GO dengan mudah
                </h3>

                <!-- AKSEN GOLD -->
                <div style="
                    width: 45px;
                    height: 3px;
                    background-color: #F4C95D;
                    border-radius: 10px;
                    margin-top: 8px;
                "></div>

            </li>
        </ul>

        <!-- MOBILE MENU -->
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                type="button"
                data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"
                  style="color: #F4C95D;"></span>
        </button>

    </div>
</nav>
<!-- partial -->
