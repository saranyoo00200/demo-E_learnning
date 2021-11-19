<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>..:: E-LEARNING ::..</title>

    <!-- Scripts -->
    <!-- {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}} -->

    {{-- bootstrap 4 --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- end bootstrap 4 --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" /> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

    <!-- ======== font ======== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/frontend/css/educa.css">
    <link rel="stylesheet" href="/assets/frontend/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="/assets/frontend/css/navbar-header.css">

    <!-- ======= w3school ======= -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- ======== Dashboard ======== -->
    <link rel="icon" href="<%= BASE_URL %>favicon.ico">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}

    <style>
    </style>
</head>

<body>
    <div id="app">
        <App></App>
    </div>
</body>

<script type="text/javascript" src="/assets/frontend/js/jquery-1.11.1.min.js"></script>
{{-- <script type="text/javascript" src="/assets/frontend/js/bootstrap.min.js"></script> --}}
<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script src="/assets/frontend/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="/assets/frontend/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- ===== Bootstrap5 ===== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}

<script src="{{ mix('/js/app.js') }}"></script>

<!-- ======== Dashboard ======== -->
<script src="https://kit.fontawesome.com/f15e8cd182.js" crossorigin="anonymous"></script>

<!-- ========= Header ========= -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script> --}}

<!-- reCaptcha -->
<script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
<!-- end reCaptcha -->

</html>
