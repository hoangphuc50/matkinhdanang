@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí người dùng, khách hàng
        @if(isset($user))
            <small>Chỉnh sửa thông tin</small>
        @else
            <small>Thêm mới</small>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí người dùng</li>
    </ol>
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nhập dữ liệu chính xác vào form bên dưới</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                        Kiểm tra lại dữ liệu nhập vào
                    </div>
                @endif
                <!-- /.box-header -->
                <!-- form start -->
                @if(isset($user))
                    {{ Form::model($user, array('url'=>'admin/users/edit','method' => 'POST', 'class'=>'form-horizontal','files'=>true))}}
                    {{Form::hidden('id', $user->id);}}
                @else
                    {{Form::open(array('url' => URL::to('/admin/users/add'),'method' => 'POST','files' => true))}}
                @endif
                
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                        <label>Email</label>
                        {{Form::text('email',isset($user) ? $user->email : '', array('class' => 'form-control','placeholder' => 'Email'))}}
                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('username') ? 'has-error' : '' }}}">
                        <label>Username</label>
                        {{Form::text('username',isset($user) ? $user->username : '', array('class' => 'form-control','placeholder' => 'Username'))}}
                        {{ $errors->first('username', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên đầy đủ</label>
                        {{Form::text('name',isset($user) ? $user->name : '', array('class' => 'form-control','placeholder' => 'Họ và Tên'))}}
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                        <label>Mật khẩu</label>
                        {{Form::password('password', array('class' => 'form-control','placeholder' => 'Mật khẩu'))}}
                        {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
                        <label>Nhập lại mật khẩu</label>
                        {{Form::password('password_confirmation', array('class' => 'form-control','placeholder' => 'Xác nhận mật khẩu'))}}
                        {{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
                    </div>
                    

                    <div class="form-group">
                        <label>Cho phép hoạt động</label>
                        <br>
                        <div class="form-radio">
                            <label>
                            {{Form::radio('state',true,true,array())}}
                            Có&nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                                {{Form::radio('state',false,false,array())}}
                                Không
                            </label>       
                        </div>                            
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::submit('Cập nhật', array('class' => 'btn btn-primary'))}}
                </div>
                {{Form::close()}}

         </div>
        </div>
    </section>
</section>
</aside>
@stop

@section('js')
    
@stop
