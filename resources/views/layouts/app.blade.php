<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    {{-- <title>{{ $ingfo_sakkarepmu }}</title> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- @vite('resources/sass/app.scss') --}}
    {{-- fontawesome cooook --}}
    <script src="https://kit.fontawesome.com/a45f001349.js" crossorigin="anonymous"></script>

    {{-- import css --}}
    @vite('resources/dist/css/tabler.min.css?1684106062')
    @vite('resources/dist/css/tabler-flags.min.css?1684106062')
    @vite('resources/dist/css/tabler-payments.min.css?1684106062')
    @vite('resources/dist/css/tabler-vendors.min.css?1684106062')
    @vite('resources/dist/css/demo.min.css?1684106062')

    {{-- datatable --}}
    @vite('resources/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')
    @vite('resources/assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- plugin datatable coo -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    @if (!isset($ndeliknoNavbar) || !$ndeliknoNavbar)
        @include('layouts.navbar')
    @endif
    @yield('content')


    @if (!isset($ndeliknoFooter) || !$ndeliknoFooter)
        @include('layouts.footer')
    @endif

    @vite('resources/js/app.js')


    <!-- Libs JS -->
    @vite('resources/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062')
    @vite('resources/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062')
    @vite('resources/dist/libs/jsvectormap/dist/maps/world.js?1684106062')
    @vite('resources/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062')

    {{-- tabel --}}
    @vite('resources/dist/js/tabler.min.js?1684106062')
    @vite('resources/dist/js/demo.min.js?1684106062')

    {{-- script --}}
    @vite('resources/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')
    @vite('resources/dist/libs/list.js/dist/list.min.js?1684106062')
    {{-- tabel --}}
    @vite('resources/dist/js/tabler.min.js?1684106062')
    @vite('resources/dist/js/demo.min.js?1684106062')
</body>

</html>
