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
        <style>
            body, html {
                height: 100%;
            }
        </style>
        @show
    </head>
    <body style="font-family: Microsoft JhengHei;">
        <div class="container-fluid h-100">
            <div id="app" class="h-100 d-flex flex-column">

                <div class="row">
                    <div class="col-md-12 bg-dark">
                    @include('layouts.header')
                    </div>
                </div>

                <div class="row flex-grow-1">
                    <div class="col-md-1 bg-light">
                    @include('layouts.sidebar')
                    </div>

                    <div class="col-md-11 bg-white">
                    @yield('content')
                    </div>
                </div>

            </div>
        </div>

        @section('script')
        <script src="js/app.js"></script>
        @show
    </body>
</html>
