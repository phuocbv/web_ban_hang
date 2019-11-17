<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap-star-rating/js/star-rating.js') }}"></script>
        <script src="{{ asset('user/reactjs/react.js') }}"></script>
        <script src="{{ asset('user/reactjs/react-dom.js') }}"></script>
        <script src="{{ asset('user/reactjs/browser.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react-dom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.6.15/browser.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/metisMenu/dist/metisMenu.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/fonts/glyphicons-halflings-regular.woff') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/fonts/glyphicons-halflings-regular.woff2') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/layout.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap-star-rating/css/star-rating.css') }}">
        @yield('style')
    </head>
    <body>
        @include('layouts.header')
        @include('layouts.search')
        <div id="aa"></div>
        @yield('content')
        @include('layouts.footer')
    </body>
    @yield('script')
    <script src="{{ asset('js/lang.js') }}"></script>
    <script src="{{ asset('/js/myapp.js') }}"></script>
    <script>
        var myApp = new myApp;
        myApp.init();
    </script>
</html>
