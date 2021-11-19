<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>..:: E-LEARNING ::..</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="{{ asset('assets/backend/js/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('js/datepicker/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('js/clockpicker/dist/jquery-clockpicker.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/components.css') }}">
    {{-- js/fullcalendar-5.8.0/lib/main.css --}}
    <link href="{{ asset('js/fullcalendar-5.8.0/lib/main.css') }}" rel='stylesheet' defer />
    @yield('css')
    @yield('css-step')
    @yield('css-script')
</head>

<body>
    <div id="app">

        <div class="main-wrapper">
            @include('layouts.navbar')

            @include('layouts.sidebar')

            <div class="main-content">
                {{-- @stack('content') --}}
                @yield('content')
            </div>

            @include('layouts.footer')



        </div>

    </div>
    <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/backend/js/stisla.js') }}"></script>
    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
    <script src="{{ asset('assets/backend/js/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/datepicker/locales/bootstrap-datepicker.th.js') }}"></script>
    <script src="{{ asset('js/datepicker/bootstrap-datepicker-thai.js') }}"></script>
    <script src="{{ asset('js/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar-5.8.0/lib/main.js') }}" defer></script>
    <script src="{{ asset('js/fullcalendar-5.8.0/lib/locales/th.js') }}" defer></script>
    <script type="text/javascript">
        var base_url = $('#base_url').val();
    </script>
    @yield('scripts')
    @yield('cke-editor')
    <!-- Page Specific JS File -->

    @stack('script')

    @yield('script')
</body>

</html>
