<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- FavIcon -->
    <link rel="icon" href="{{ asset('assets/img/logo_totable.jpg') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset ('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('plugin/DataTables-1.13.8/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin/Buttons-2.4.2/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin/DateTime-1.5.1/css/dataTables.dateTime.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset ('assets/css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div id="app">
        @include('layouts.header')

        @include('layouts.sidebar')

        <!-- Page Content -->
        <main>
            @yield('content')

        </main>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{asset ('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{asset ('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset ('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset ('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset ('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset ('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset ('assets/vendor/tinymce/tinymce.min.js')}}"></script>

    <!-- datatable js -->
    <script src="{{ asset('plugin/jQuery-3.7.0/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('plugin/DataTables-1.13.8/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugin/pdfmake-0.2.7/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugin/pdfmake-0.2.7/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugin/JSZip-3.10.1/jszip.min.js') }}"></script>
    <script src="{{ asset('plugin/Buttons-2.4.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugin/Buttons-2.4.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugin/Buttons-2.4.2/js/buttons.print.min.js') }}"></script>

    @include('sweetalert::alert')

</body>


<!-- Template Main JS File -->
<script src="{{asset('assets/js/main.js') }}"></script>

</html>