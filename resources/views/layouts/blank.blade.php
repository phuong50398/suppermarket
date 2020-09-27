<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- //for-mobile-apps -->
    <link href="{{url('custom/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="{{url('custom/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('custom/css/util.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('custom/css/user.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('custom/css/font-awesome.css')}}" rel="stylesheet">
    <script src="{{url('custom/js/jquery-1.11.1.min.js')}}"></script>
</head>
<body>
    @section('content')

        @show
    
</body>
<script src="{{url('custom/js/bootstrap.js')}}"></script>
<script src="{{url('custom/js/jquery.flexslider.js')}}"></script>
<script src="{{url('custom/js/user.js')}}"></script>
</html>
