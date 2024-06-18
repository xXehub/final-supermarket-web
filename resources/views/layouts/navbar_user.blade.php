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

        @auth
            <div class="navbar-nav flex-row order-md-last">
                <div class="d-none d-md-flex">
                    {{-- gawe notif --}}
                    <div class="nav-item dropdown d-none d-md-flex me-1">
                        {{-- default e <div class="nav-item dropdown d-none d-md-flex me-3"> --}}
                        <a href="{{ route('supermarket.keranjang.index') }}" class="nav-link px-0" tabindex="-1"
                            aria-label="Show notifications">
                            <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17h-11v-14h-2" />
                                <path d="M6 5l14 1l-1 7h-13" />
                            </svg>
                            <span class="badge bg-red ">{{ $jumlahProdukKeranjang }}</span>
                        </a>
                    </div>
                    <div class="nav-item dropdown d-none d-md-flex me-3">
                        <a href="{{ route('pesanan.index') }}" class="nav-link px-0" tabindex="-1"
                            aria-label="Show notifications">
                            <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-backpack">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 18v-6a6 6 0 0 1 6 -6h2a6 6 0 0 1 6 6v6a3 3 0 0 1 -3 3h-8a3 3 0 0 1 -3 -3z" />
                                <path d="M10 6v-1a2 2 0 1 1 4 0v1" />
                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                                <path d="M11 10h2" />
                            </svg>
                            <span class="badge bg-red badge-sm">{{ $jumlahPemesanan }}</span>
                        </a>
                    </div>
                </div>
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
                        {{-- <a href="#" class="dropdown-item">Status</a> --}}
                        <a href="{{ route('profile.index') }}" class="dropdown-item">Profile Saya</a>
                        <a href="#" class="dropdown-item">Laporkan Bug</a>
                        {{-- <a href="#" class="dropdown-item">Feedback</a> --}}
                        <div class="dropdown-divider"></div>
                        {{-- <a href="./settings.html" class="dropdown-item">Settings</a> --}}
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
            </div>
        @endauth
    </div>
</header>
{{-- navbar --}}
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li
                        class="nav-item {{ Route::is('supermarket.index', 'supermarket.keranjang.index', 'supermarket.pesanan.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('supermarket.index') }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <i class="fa-solid fa-home"></i>
                            </span>
                            <span class="nav-link-title">
                                Beranda
                            </span>
                        </a>
                    </li>

                </ul>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="./" method="get" autocomplete="off" novalidate>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>