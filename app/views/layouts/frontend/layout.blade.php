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
    <title>Mắt Kính Minh Rayban – Mắt Kính Thời Trang Nam Nữ</title>
    <meta name="description" content="Mắt Kính Minh Rayban – Mắt Kính Thời Trang Nam Nữ" />
    <meta name="keywords" content="Mắt Kính Minh Rayban – Mắt Kính Thời Trang Nam Nữ" />
    <meta name="author" content="Mắt Kính Minh Rayban – Mắt Kính Thời Trang Nam Nữ" />
    <link rel="shortcut icon" href="../favicon.ico">
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
    @include('layouts.frontend._ticker_news')
    @include('layouts.frontend._slider')
    <section class="main">
        <div class="container">
            <div class="row">
                @include('layouts.frontend._sidebar')
                @yield('content') 
            </div>
        </div>
    </section>
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
