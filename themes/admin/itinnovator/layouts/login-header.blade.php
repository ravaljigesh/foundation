<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page_title }} - Admin</title>

        <!-- Styles -->
        @foreach ($css_files as $css)
        <link href="{{ $css }}" rel="stylesheet"> @endforeach

        <!-- Scripts -->
        <script>
            var CSRF = '{{ csrf_token() }}';
            var csrfToke = '{{ csrf_token() }}';
                window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                ]) !!};
        </script>
    </head>

    <body>
        <div id="app">
            @yield('content')
            @extends('layouts.footer')
        </div>

        @foreach ($js_files as $js)
            <script src="{{ $js }}"></script>
        @endforeach
    </body>

</html>
