@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí bài viết
        @if(isset($blog))
            <small>Chỉnh sửa thông tin</small>
        @else
            <small>Thêm mới</small>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí bài viết</li>
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
                @if(isset($blog))
                    {{ Form::model($blog, array('url'=>'admin/blogs/edit','method' => 'POST', 'class'=>'form-horizontal','files'=>true))}}
                    {{Form::hidden('id', $blog->id);}}
                @else
                    {{Form::open(array('url' => URL::to('/admin/blogs/add'),'method' => 'POST','files' => true))}}
                @endif
                
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
                        <label>Tên chuyên mục</label>
                        {{Form::text('title',isset($blog) ? $blog->title : '', array('class' => 'form-control','placeholder' => 'Nhập tiêu đề cho bài viết'))}}
                        {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                        <label>Hình đại diện</label>
                        @if(empty($blog->image))
                            {{HTML::image('images/no_image.jpg','',array('class'=>'no-image'))}}
                        @else
                            {{HTML::image($blog->image,'')}}
                        @endif
                        
                        {{ Form::file('image','',array('id'=>'','class'=>'')) }}
                        {{ $errors->first('image', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                        <label>Giới thiệu</label>
                        {{Form::textarea('description',Input::old('description'), array('class' => 'form-control','placeholder' => 'Giới thiệu'))}}
                        {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('category_id') ? 'has-error' : '' }}}">
                        <label>Thuộc chuyên mục</label>
                        <p class="help-block" style="text-align: center">Tất cả&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      >>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Được chọn</p>
                            @if(isset($blog))
                                {{Form::select('category_id[]', $categories, $selected_categories, array('multiple','class'=>'multi-select'))}}
                            @else
                                {{Form::select('category_id[]', $categories,null, array('multiple','class'=>'multi-select'))}}
                            @endif
                          {{ $errors->first('category_id', '<span class="help-block">Bài viết phải thuộc ít nhất 1 chuyên mục. Vui lòng chọn chuyên mục.</span>') }}  

                    </div>

                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <label>Nội dung</label>
                        {{Form::textarea('content',isset($blog) ? $blog->content : Input::old('content'), array('id'=>'editor', 'class' => 'form-control use_editor','placeholder' => 'Nội dung'))}}
                        {{ $errors->first('content', '<span class="help-block">:message</span>') }}
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

@section('js')
    @include('layouts.backend._load_editor')
    @include('layouts.backend._load_multi_select')
@stop
