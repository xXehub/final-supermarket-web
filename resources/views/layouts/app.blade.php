<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>{{ $ingfo_sakkarepmu }}</title> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/sass/app.scss')
</head>

<body>
    @include('layouts.navbar')
    @yield('content')
    @vite('resources/js/app.js')

    {{-- jquert --}}


</body>

</html>
