<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('profile') }}">
            <img src=" {{ asset('/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Puskesmas Kec. Cibaduyut</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(Auth::check() && Auth::user()->role == 3)
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['setUser', 'detailsUser', 'editUser']) ? 'active' : '' }}"
                    href="{{ route('setUser') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Setting User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['setDoktor', 'detailsDoktor', 'editDoktor']) ? 'active' : '' }}"
                    href="{{ route('setDoktor') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Setting Doktor</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['setPoli', 'detailsPoli', 'editPoli']) ? 'active' : '' }}"
                    href="{{ route('setPoli') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Setting Poli</span>
                </a>
            </li>
            @endif
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-medapps"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Main Action</h6>
            </li>
            @if(Auth::check() && Auth::user()->role == 2 || Auth::user()->role == 3)
            <li class="nav-item">
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['dokAntrian']) ? 'active' : '' }}"
                    href="{{ route('dokAntrian') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Antrian</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                    href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-medapps"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Monitor</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'tiket' ? 'active' : '' }}"
                    href="{{ route('tiket') }}" target="_blank">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ambil Tiket</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'monitor' ? 'active' : '' }}"
                    href="{{ route('monitor') }}" target="_blank">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Monitor 1</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'monitor' ? 'active' : '' }}"
                    href="{{ route('monitor') }}?page=2" target="_blank">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Monitor 2 (Backup)</span>
                </a>
            </li>
        </ul>
    </div>
    <br>
    <br>
</aside>