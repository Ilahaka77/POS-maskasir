<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ url('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ url('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ url('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ url('css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    @yield('content')
    

    <!-- Jquery JS-->
    <script src="{{ url('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ url('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ url('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ url('vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ url('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ url('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ url('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ url('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ url('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ url('vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ url('js/main.js') }}"></script>

</body>

</html>
<!-- end document-->
