<style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }
</style>
<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
                <img src="{{ asset('/static/gudangrempah/gricon.png') }}" width="110" height="32"
                    alt="Gudang Rempah" class="navbar-brand-image">
            </a>
            Gudang Rempah
        </h1>
        @guest
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item d-none d-md-flex me-3">
                    <div class="btn-list">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary" rel="noreferrer">
                            Daftar
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-primary" rel="noreferrer">
                            <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                <path d="M3 12h13l-3 -3" />
                                <path d="M13 15l3 -3" />
                            </svg>
                            Masuk
                        </a>
                    </div>
                </div>
            </div>
        @endguest
        @role('user')
        {{-- gawe gambar profile --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url(
                  @if (Auth::user()->gambar_profile) {{ url('storage/' . Auth::user()->gambar_profile) }}
                  @else
                    {{ url('storage/profile/default.WEBP') }} @endif
                )">
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="mt-1 small text-muted">{{ Auth::user()->roles->pluck('name')->implode(', ') }}
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Status</a>
                    <a href="{{ route('profile.index') }}" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="./settings.html" class="dropdown-item">Settings</a>
                    {{-- gawe logout --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        @endrole

    </div>
</header>
{{-- navbar --}}
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Route::is('supermarket.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('supermarket.index') }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <i class="fa-solid fa-database"></i>
                            </span>
                            <span class="nav-link-title">
                                Home
                            </span>
                        </a>
                    </li>
                    {{-- penyimpanan --}}
                    <li
                        class="nav-item dropdown {{ Route::is('produk.index', 'kategori.index', 'supplier.index', 'produk.show', 'kategori.show', 'supplier.show') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                <i class="fa-solid fa-box"></i>
                            </span>
                            <span class="nav-link-title">
                                Penyimpanan
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ Route::is('produk.index', 'produk.show') ? 'active' : '' }}"
                                        href="{{ route('produk.index') }}">
                                        Produk
                                    </a>
                                    <a class="dropdown-item {{ Route::is('kategori.index', 'kategori.show') ? 'active' : '' }}"
                                        href="{{ route('kategori.index') }}">
                                        Kategori
                                    </a>
                                    <a class="dropdown-item {{ Route::is('supplier.index', 'supplier.show') ? 'active' : '' }}"
                                        href="{{ Route('supplier.index') }}">
                                        Supplier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="./" method="get" autocomplete="off" novalidate>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </span>
                            <input type="text" value="" class="form-control" placeholder="Search…"
                                aria-label="Search in website">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
