<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />
    <!-- For iPhone 4 with high-resolution Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png">
    <!-- For first-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png">
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(isset($web_title)){{$web_title}}@else Mắt kính Đà Nẵng @endif</title>
    <meta name="description" content="@if(isset($web_description)){{$web_description}}@else Mắt kính Đà Nẵng  @endif" />
    <meta name="keywords" content="Mắt kính Đà Nẵng " />
    @include('layouts.frontend._og_share')
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('template/minhrayban/images/favicon.ico')}}">
    <link rel="icon" href="{{URL::to('template/minhrayban/images/favicon.ico')}}" type="image/x-icon">
    
    {{HTML::style('template/minhrayban/css/bootstrap.min.css')}}
    {{HTML::style('template/minhrayban/css/font-awesome.min.css')}}
    {{HTML::style('template/minhrayban/css/animate.css')}}
    {{HTML::style('template/minhrayban/fonts/fonts.css')}}
    {{HTML::style('template/minhrayban/popup/magnific-popup.css')}}
    {{HTML::style('template/minhrayban/css/style.css')}}
    {{HTML::style('template/minhrayban/css/responsive.css')}}
    @section('css')
    @show
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
    @include('layouts.frontend._header')
    @include('layouts.frontend._top_menu')
    
    @yield('content') 
    @include('layouts.frontend._footer')
</body>
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

{{HTML::script('template/minhrayban/js/jquery.min.js')}}
{{HTML::script('template/minhrayban/js/jquery.easing.1.3.js')}}
{{HTML::script('template/minhrayban/js/wow.min.js')}}
{{HTML::script('template/minhrayban/bx_slider/jquery.bxslider.min.js')}}
{{HTML::script('template/minhrayban/js/jquery.marquee.min.js')}}
{{HTML::script('template/minhrayban/popup/jquery.magnific-popup.min.js')}}
{{HTML::script('template/minhrayban/js/custom.js')}}
<!-- Page JS -->
@section('js')
@show

</html>
