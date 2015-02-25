<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Ptheme CMS | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        {{HTML::style('backend/template/adminlte/css/AdminLTE.css')}}
        {{HTML::style('backend/template/adminlte/css/custom.css')}}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Đăng nhập quản trị</div>
            {{ Form::open(array('url'=>'admin/login', 'method' => 'post')) }}
                <div class="body bg-gray">
                    @if (Session::has('error_message'))
                        <div class="alert alert-danger" style="display: block;margin-left:0;padding-left:10px;">
                            <button class="close" data-close="alert"></button>
                            <span>
                            {{ Session::get('error_message') }} </span>
                        </div>
                    @endif

                    @if (Session::has('message'))
                        <div class="alert alert-success" style="display: block;margin-left:0;padding-left:10px;">
                            <button class="close" data-close="alert"></button>
                            <span>
                            {{ Session::get('message') }} </span>
                        </div>
                    @endif
                    <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email')) }}
                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
                        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Đăng nhập</button>

                    <p><a href="#">Quên mật khẩu</a></p>

                    <a href="register.html" class="text-center">Đăng kí tài khoản mới</a>
                </div>
            {{Form::close()}}

            <div class="margin text-center">
                <span>Find us in social</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
