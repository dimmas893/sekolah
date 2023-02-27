<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Al-azhar BSD</title>

    @include('layouts.template.css')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>


    <!-- /END GA -->
</head>
<div class="d-sm-none">
    <style>
        body.layout-3 .main-content {
            padding-left: 0;
            padding-right: 0;
            padding-top: 170px;
        }
    </style>

    <body class="layout-3">

</div>
<div class="d-none d-xl-block d-lg-block d-md-block">
    <style>
        body.layout-3 .main-content {
            padding-left: 0;
            padding-right: 0;
            padding-top: 125px;
        }
    </style>

    <body class="layout-3">
</div>
<div>
    <div class="main-wrapper container">

        @include('layouts.template.navbar')

        {{-- @include('layouts.template.sidebar') --}}

        <!-- Main Content -->




        @yield('content')

        @include('layouts.template.footer')
    </div>
</div>


@include('layouts.template.scripts')
</body>




</html>
