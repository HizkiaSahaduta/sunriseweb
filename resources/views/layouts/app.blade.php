<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN: Head-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sunrise Web Login </title>

    <!-- Include core + vendor Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/vendors.min.css') }}">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/animate-css/animate.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/pages/login.css') }}">

    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/laravel-custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
    <script type="text/javascript" src="{{ asset('outside/material/vendors/sweetalert/sweetalert.min.js') }}"></script>

</head>
<!-- END: Head-->
<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns  login-bg " data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                @yield('content')
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('outside/material/js/vendors.min.js') }}"></script>
<script src="{{ asset('outside/material/js/plugins.js') }}"></script>
<script src="{{ asset('outside/material/js/scripts/css-animation.js') }}"></script>
<!-- END THEME  JS-->
</body>
</html>
