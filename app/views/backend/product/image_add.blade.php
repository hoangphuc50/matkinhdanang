@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>{{$product->name}}                   
        <small>Thêm mới hình ảnh</small>
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
                    <h3 class="box-name">Chọn hình từ máy tính</h3>
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
                {{Form::open(array('url' => URL::to('/admin/products/add-image'),'method' => 'POST','files' => true))}}
                {{Form::hidden('product_id', $product->id);}}
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('images') ? 'has-error' : '' }}}">
                        <label>Hình sản phẩm (có thể upload nhiều hình)</label>                
                        {{ Form::file('images[]',array('multiple'=>true)) }}
                        {{ $errors->first('images', '<span class="help-block">:message</span>') }}
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
