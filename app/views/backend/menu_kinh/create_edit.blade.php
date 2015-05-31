@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí menu kính
        @if(isset($menu_kinh))
            <small>Chỉnh sửa thông tin</small>
        @else
            <small>Thêm mới</small>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí block</li>
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
                @if(isset($menu_kinh))
                    {{ Form::model($menu_kinh, array('url'=>'admin/menu_kinhs/edit','method' => 'POST', 'class'=>'form-horizontal','files'=>true))}}
                    {{Form::hidden('id', $menu_kinh->id);}}
                @else
                    {{Form::open(array('url' => URL::to('/admin/menu_kinhs/add'),'method' => 'POST','files' => true))}}
                @endif
                
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên menu</label>
                        {{Form::text('name',isset($menu_kinh) ? $menu_kinh->name : '', array('class' => 'form-control','placeholder' => 'Tên block'))}}
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                        <label>Hình đại diện</label>
                        @if(empty($menu_kinh->image))
                            {{HTML::image('images/no_image.jpg','',array('class'=>'no-image'))}}
                        @else
                            {{HTML::image($menu_kinh->image,'')}}
                        @endif
                        
                        {{ Form::file('image','',array('id'=>'','class'=>'')) }}
                        {{ $errors->first('image', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group {{{ $errors->has('link') ? 'has-error' : '' }}}">
                        <label>Link</label>
                        {{Form::text('link',isset($menu_kinh) ? $menu_kinh->link : '', array('class' => 'form-control','placeholder' => 'Link khi click vô menu'))}}
                        {{ $errors->first('link', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('order') ? 'has-error' : '' }}}">
                        <label>Thứ tự sắp xếp (nếu có)</label>
                        {{Form::text('order',isset($menu_kinh) ? $menu_kinh->order : '', array('class' => 'form-control','placeholder' => 'Thứ tự sắp xếp'))}}
                        {{ $errors->first('order', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group">
                        <label>Hiển thị</label>
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
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <br>
                        <div class="form-radio">
                            <label>
                                {{Form::radio('highlight',true,true,array())}}
                                Có&nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                                {{Form::radio('highlight',false,false,array())}}
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

@section('css')
    
@stop
@section('js')
    @include('layouts.backend._load_editor')
@stop
