<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="utf-8">
    <title>@yield('title', '我就說不是改我了!!')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('template/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <!-- Kendo UI -->
    <link rel="stylesheet" href="{{ asset('kendo/css/kendo.common-material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kendo/css/kendo.material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kendo/css/kendo.material.mobile.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('/veg.ico') }}" type="image/x-icon" />
    <!-- Lunar -->
    <link rel="stylesheet" href="{{ asset('lunar/assets/css/lunar.css') }}">
    <!-- ICON CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- JQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    @yield('css')
</head>
<body class="goto-here" id="app-layout">
    @include('layouts.navbar')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')

    
    {{-- JavaScripts --}}
    <!-- JQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Lunar -->
    <link rel="stylesheet" href="{{ asset('lunar/assets/js/lunar.js') }}">
    <script src="https://code.jquery.com/jquery-migrate-3.1.0.min.js"></script>
    <script src="{{ asset('template/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('template/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/js/aos.js') }}"></script>
    <script src="{{ asset('template/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('template/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
    <!-- Kendo -->
    <script src="{{ asset('kendo/js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('kendo/js/kendo.messages.zh-TW.js') }}"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- CDN Editer -->
    <script src="{{ asset('template/js/ckeditor5-build-classic-master/src/ckeditor.js') }}"></script>
    <!-- Sweetalert2, modal/dialog plugin -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Embedly -->
    <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
    <!-- Glide JS -->
    <script src="{{ asset('glideJS/glide.js') }}"></script>


    @yield('js')
</body>
</html>
