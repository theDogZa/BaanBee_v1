<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>{{config('app.name','Laravel theDogZa')}} | @yield('title') </title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    {{--Styles--}}
    @yield('styles')
    <!-- App Css -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/core.css')}}" rel="stylesheet">
    <link href="{{asset('css/gentelella.core.cutsom.css')}}" rel="stylesheet">
    <!-- jQuery -->
    <!-- <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script> 
    
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script> -->
 
    @stack('header-scripts')
</head>
