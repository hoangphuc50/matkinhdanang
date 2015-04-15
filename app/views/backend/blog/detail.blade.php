@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí bài viết
                       
        <small>Xem thông tin chi tiết</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí bài viết</li>
    </ol>
    <section class="content detail-content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{$blog->title}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <div class="ad-detail">
                            {{$blog->title}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hình đại diện</label>
                        <div class="ad-detail">
                            @if(empty($blog->image))
                                {{HTML::image('images/no_image.jpg','')}}
                            @else
                                {{HTML::image($blog->image,'')}}
                            @endif
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label>Thuộc danh mục</label>
                        <div class="ad-detail">
                            <?php
                            $category = BlogCategory::where('blog_id','=',$blog->id)->get();
                            ?>
                            @foreach($category as $row)
                                <span>{{$row->category->name}}</span><br>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái hiển thị</label>
                        <div class="ad-detail">
                            @if($blog->state == true)
                                <span class="label label-success">Cho phép</span>
                            @else
                                <span class="label label-default">Đang ẩn</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái nổi bật</label>
                        <div class="ad-detail">
                            @if($blog->highlight == true)
                                <span class="label label-danger">Cho phép</span>
                            @else
                                <span class="label label-default">Không chọn</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <label>Nội dung chính</label>
                        <div class="ad-detail">
                            {{$blog->content}}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-primary" href="/admin/blogs/edit/{{$blog->id}}">Sửa</a>
                    <a class="btn btn-default"  href="/admin/blogs">Quay lại</a>
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