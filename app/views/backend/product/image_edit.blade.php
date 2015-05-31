@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>{{$product->name}}                   
        <small>Sửa thông tin hình ảnh</small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Trang chính</a>
            </li>
            <li class="active">Danh sách hình ảnh</li>
        </ol>
        <br>
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-name">Nhập dữ liệu chính xác vào form bên dưới</h3>
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
                {{Form::open(array('url' => URL::to('/admin/products/edit-image'),'method' => 'POST','files' => true))}}
                {{Form::hidden('product_id', $product->id);}}
                {{Form::hidden('id', $image->id);}}
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên hình</label>
                        {{Form::text('name',isset($image) ? $image->name : '', array('class' => 'form-control','placeholder' => 'Nhập tiêu đề cho sản phẩm'))}}
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                        <label>Hình đại diện</label>
                        @if(empty($image->url))
                            {{HTML::image('images/no_image.jpg','',array('class'=>'no-image'))}}
                        @else
                            {{HTML::image(productImageFolder().$image->url,'')}}
                        @endif
                        
                        {{ Form::file('image','',array('id'=>'','class'=>'')) }}
                        {{ $errors->first('image', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('order') ? 'has-error' : '' }}}">
                        <label>Thứ tự</label>
                        {{Form::text('order',isset($image) ? $image->order : '', array('class' => 'form-control','placeholder' => 'Nhập thứ tự hiển thị'))}}
                        {{ $errors->first('image', '<span class="help-block">:message</span>') }}
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
