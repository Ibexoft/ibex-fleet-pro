<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('panelslayout/website/assets/css/style.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('panelslayout/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('panelslayout/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script src="{{ asset('panelslayout/website/assets/js/website.js') }}"></script>

    @if (Route::currentRouteName() == 'loginRegister')
        {!! htmlScriptTagJsApi([
            'callback_then' => 'callbackThen',
            'callback_catch' => 'callbackCatch',
        ]) !!}
    @endif

    <title>Ibex Fleet Pro</title>
</head>

<body>
    <div id="loader">
        <div class="site-preloader">
            <div class="car">
                <div class="strike"></div>
                <div class="strike strike2"></div>
                <div class="strike strike3"></div>
                <div class="strike strike4"></div>
                <div class="strike strike5"></div>
                <div class="car-detail spoiler"></div>
                <div class="car-detail back"></div>
                <div class="car-detail center"></div>
                <div class="car-detail center1"></div>
                <div class="car-detail front"></div>
                <div class="car-detail wheel"></div>
                <div class="car-detail wheel wheel2"></div>
            </div>
        </div>
    </div>
    @include('website.layouts.header')
    @yield('content')
    @include('website.layouts.footer')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('#loader').addClass('loaded');
    });
</script>

@yield('script')

</html>
