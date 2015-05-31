@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí themes
                       
        <small>Xem thông tin chi tiết</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí themes</li>
    </ol>
    <section class="content detail-content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{$product->title}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label>Tên</label>
                        <div class="ad-detail">
                            {{$product->name}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tên tiếng anh</label>
                        <div class="ad-detail">
                            {{$product->name_en}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alias</label>
                        <div class="ad-detail">
                            {{$product->alias}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link demo</label>
                        <div class="ad-detail">
                            {{$product->demo_url}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link download</label>
                        <div class="ad-detail">
                            {{$product->download_url}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số page</label>
                        <div class="ad-detail">
                            {{$product->layout}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Lượt tải</label>
                        <div class="ad-detail">
                            {{$product->number_of_download}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ngày đăng</label>
                        <div class="ad-detail">
                            {{$product->created_at}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hình đại diện</label>
                        <div class="ad-detail">
                            @if(empty($product->image))
                                {{HTML::image('images/no_image.jpg','')}}
                            @else
                                {{HTML::image($product->image,'')}}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hình logo</label>
                        <div class="ad-detail">
                            @if(empty($product->logo))
                                {{HTML::image('images/no_image.jpg','')}}
                            @else
                                {{HTML::image($product->logo,'')}}
                            @endif
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label>Thuộc danh mục</label>
                        <div class="ad-detail">
                            <?php
                            $category = ProductCategory::where('product_id','=',$product->id)->get();
                            ?>
                            @foreach($category as $row)
                                <span>{{$row->category->name}}</span><br>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái hiển thị</label>
                        <div class="ad-detail">
                            @if($product->state == true)
                                <span class="label label-success">Cho phép</span>
                            @else
                                <span class="label label-default">Đang ẩn</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái nổi bật</label>
                        <div class="ad-detail">
                            @if($product->highlight == true)
                                <span class="label label-danger">Cho phép</span>
                            @else
                                <span class="label label-default">Không chọn</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Giới thiệu</label>
                        <div class="ad-detail">
                            {{$product->description}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung chính</label>
                        <div class="ad-detail">
                            {{$product->content}}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-primary" href="/admin/products/edit/{{$product->id}}">Sửa</a>
                    <a class="btn btn-default"  href="/admin/products">Quay lại</a>
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