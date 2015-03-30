@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí sản xuất
                       
        <small>Thêm mới</small>
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
                <!-- /.box-header -->
                <!-- form start -->
                {{Form::open(array('url' => URL::to('/admin/producers/add'),'method' => 'POST','files' => true))}}
                <div class="box-body">
                    <div class="form-group">
                        <label>Tên chuyên mục</label>
                        {{Form::text('name','', array('class' => 'form-control','placeholder' => 'Tên nhà sản xuất','required' => 'required'))}}
                    </div>
                    <div class="form-group">
                        <label>Hình đại diện</label>
                        {{ Form::file('image','',array('id'=>'','class'=>'')) }}
                    </div>
                    <div class="form-group">
                        <label>Giới thiệu ngắn</label>
                        {{Form::text('description','', array('class' => 'form-control','placeholder' => 'Giới thiệu ngắn'))}}
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        {{Form::textarea('description','', array('class' => 'form-control','placeholder' => 'Giới thiệu'))}}
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


    <!-- Main content -->
    <section class="content">


    </section>
    <!-- /.content -->
</aside>

@stop