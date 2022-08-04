<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('/tabler/js/tabler.esm.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('/tabler/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/tabler/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/tabler/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/tabler/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/tabler/css/demo.min.css') }}" rel="stylesheet"/>

    {{-- PowerGrid Styles --}}
    @livewireStyles
    @powerGridStyles

    @yield('page_level_css')

</head>
<body>


    <div class="wrapper">
        @yield('main')
    </div>

    <!-- Scripts -->
   

    <!-- Tabler Core -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/tabler/js/tabler.min.js') }}"></script>
    <script src="{{ asset('/tabler/js/demo.min.js') }}"></script>

    {{-- PowerGrid Scripts --}}
    @livewireScripts
    @powerGridScripts
    @yield('page_level_scripts')

</body>
</html>
