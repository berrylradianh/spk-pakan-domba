<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $active }} - Sistem Pendukung Keputusan (SPK) Pakan Domba</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/app.css')

    @if ($title === 'Dashboard' || $title === 'Login')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.tailwindcss.min.css') }}">
    @endif
    @if ($title === 'Login')
    <style>
        .body {
            background-image: linear-gradient(to right bottom, #00b0ff, #00adfb, #01aaf6, #01a8f2, #02a5ee, #02a1e8, #029ce1, #0298db, #0290d0, #0289c6, #0181bb, #017ab1) !important;
        }

        .box {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
    @endif

    @if ($title === 'Dashboard' || $title === 'Login')
    <style>
        .box {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
    @endif
</head>

<body class="font-plusJakartaSans w-full body">
    @include('sweetalert::alert')

    <main class="bg-light relative">
        @yield('content')
    </main>

    @if ($title === 'Dashboard' || $title === 'Login')
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script>
        new DataTable('.example');
        new DataTable('#example');
    </script>
    @endif

</body>

</html>