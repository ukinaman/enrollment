<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    @include('backend.partials.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100">
        @include('backend.partials.header')
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @yield('content')
            </div>
            {{-- @include('backend.partials.footer') --}}
        </div>
    </div>
</div>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/@coreui/coreui/dist/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/simplebar/dist/simplebar.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('js/chart.js/dist/chart.min.js') }}"></script>
    <script src="{{ asset('js/@coreui/chartjs/dist/js/coreui-chartjs.js') }}"></script>
    <script src="{{ asset('js/@coreui/utils/dist/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
