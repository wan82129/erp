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
    <body style="font-family: Microsoft JhengHei;">
        <div class="container-fluid">
            <div id="app">

                <div class="row">
                    <div class="col-md-12 bg-dark">
                    @include('layouts.header')
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-1 bg-light" style="min-height:100vh;">
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
