<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        @section('style')
        <link href="css/app.css" rel="stylesheet">
        @show
    </head>
    <body>
        <div class="container-fluid">
            <div id="app">

                <div class="row">
                @include('layouts.header')
                </div>

                <div class="row">
                @include('layouts.sidebar')

                    <div class="col-md-10 bg-white">
                    @yield('content')
                    </div>

                @include('layouts.footer')
                </div>

            </div>
        </div>

        @section('script')
        <script src="js/app.js"></script>
        @show
    </body>
</html>
