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
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <div class="container">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">IT-Innovator</a>
                    <ul class="navbar-nav pull-right">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $context->core->url('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $context->core->url('employee/create') }}">Register</a>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
            @extends('layouts.footer')
        </div>

        @foreach ($js_files as $js)
            <script src="{{ $js }}"></script>
        @endforeach
        <!-- Scripts -->
        <script src="{{ $js_url . '/require.js' }}"></script>
        <script src="{{ $js_url . '/app.js' }}"></script>
    </body>

</html>
