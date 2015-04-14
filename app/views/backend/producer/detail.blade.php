@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí nhà sản xuất
                       
        <small>Thêm mới</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí nhà sản xuất</li>
    </ol>
    <section class="content detail-content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{$producer->name}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên chuyên mục</label>
                        <div class="ad-detail">
                            {{$producer->name}}
                        </div>
                    </div>
                    <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                        <label>Hình đại diện</label>
                        <div class="ad-detail">
                        @if(empty($producer->image))
                            {{HTML::image('images/no_image.jpg','')}}
                        @else
                            {{HTML::image($producer->image,'')}}
                        @endif
                    </div>
                        
                    </div>
                    <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                        <label>Giới thiệu ngắn</label>
                        <div class="ad-detail">
                            {{$producer->description}}
                        </div>
                    </div>
                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <label>Ghi chú</label>
                        <div class="ad-detail">
                            {{$producer->content}}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-primary" href="/admin/producers/edit/{{$producer->id}}">Sửa</a>
                    <a class="btn btn-default"  href="/admin/producers">Quay lại</a>
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