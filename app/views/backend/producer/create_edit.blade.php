@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí nhà sản xuất
        @if(isset($producer))
            <small>Chỉnh sửa thông tin</small>
        @else
            <small>Thêm mới</small>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí nhà sản xuất</li>
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
                @if(isset($producer))
                    {{ Form::model($producer, array('url'=>'admin/producers/edit','method' => 'POST', 'class'=>'form-horizontal','files'=>true))}}
                    {{Form::hidden('id', $producer->id);}}
                @else
                    {{Form::open(array('url' => URL::to('/admin/producers/add'),'method' => 'POST','files' => true))}}
                @endif
                
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên chuyên mục</label>
                        {{Form::text('name',isset($producer) ? $producer->name : '', array('class' => 'form-control','placeholder' => 'Tên nhà sản xuất'))}}
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                        <label>Hình đại diện</label>
                        @if(empty($producer->image))
                            {{HTML::image('images/no_image.jpg','',array('class'=>'no-image'))}}
                        @else
                            {{HTML::image($producer->image,'')}}
                        @endif
                        
                        {{ Form::file('image','',array('id'=>'','class'=>'')) }}
                        {{ $errors->first('image', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                        <label>Giới thiệu ngắn</label>
                        {{Form::text('description',isset($producer) ? $producer->description : '', array('class' => 'form-control','placeholder' => 'Giới thiệu ngắn'))}}
                        {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <label>Ghi chú</label>
                        {{Form::textarea('content',isset($producer) ? $producer->content : '', array('id'=>'editor', 'class' => 'form-control use_editor','placeholder' => 'Giới thiệu'))}}
                        {{ $errors->first('content', '<span class="help-block">:message</span>') }}
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
    @include('layouts.backend._load_editor')
@stop
