@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí chuyên mục
                       
        <small>Xem thông tin chi tiết</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí chuyên mục</li>
    </ol>
    <section class="content detail-content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{$category->name}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên chuyên mục</label>
                        <div class="ad-detail">
                            {{$category->name}}
                        </div>
                    </div>
                    <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                        <label>Hình đại diện</label>
                        <div class="ad-detail">
                        @if(empty($category->image))
                            {{HTML::image('images/no_image.jpg','')}}
                        @else
                            {{HTML::image($category->image,'')}}
                        @endif
                    </div>
                        
                    </div>
                    <div class="form-group">
                        <label>Giới thiệu ngắn</label>
                        <div class="ad-detail">
                            {{$category->short_description}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Giới thiệu </label>
                        <div class="ad-detail">
                            {{$category->description}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <div class="ad-detail">
                            {{$category->link}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sắp xếp</label>
                        <div class="ad-detail">
                            {{$category->order}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Loại danh mục</label>
                        <div class="ad-detail">
                            {{$category->category_type}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái hiển thị</label>
                        <div class="ad-detail">
                            @if($category->state == true)
                                <span class="label label-success">Cho phép</span>
                            @else
                                <span class="label label-default">Đang ẩn</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái nổi bật</label>
                        <div class="ad-detail">
                            @if($category->highlight == true)
                                <span class="label label-success">Cho phép</span>
                            @else
                                <span class="label label-default">Không chọn</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <label>Ghi chú</label>
                        <div class="ad-detail">
                            {{$category->content}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <div class="ad-detail">
                            {{$category->link}}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-primary" href="/admin/categories/edit/{{$category->id}}">Sửa</a>
                    <a class="btn btn-default"  href="/admin/categories">Quay lại</a>
                </div>

         </div>
        </div>
    </section>
</section>


    <!-- Main content -->
    <section class="content">


    </section>
    <!-- /.content -->
</aside>

@stop