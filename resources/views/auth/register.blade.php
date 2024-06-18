@extends('layouts.app')

@section('content')
    @php
        $ndeliknoHeader = true;
    @endphp
    @php
        $ndeliknoFooter = true;
    @endphp

    <body class=" d-flex flex-column">

        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <a href="." class="navbar-brand navbar-brand-autodark"><img
                            src="{{ asset('/static/gudangrempah/gricon.png') }}" height="36" alt="Gudang Rempah">Gudang
                        Rempah</a>
                </div>
                <form class="card card-md" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Buat akun baru</h2>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group input-group-flat">
                                <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>

                        {{-- confirm password --}}
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <div class="input-group input-group-flat">
                                <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Agree the <a href="./terms-of-service.html"
                                        tabindex="-1">terms and policy</a>.</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Create new account</button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted mt-3">
                    Already have account? <a href="./sign-in.html" tabindex="-1">Sign in</a>
                </div>
            </div>
        </div>
    </body>
@endsection
