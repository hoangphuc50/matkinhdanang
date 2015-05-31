@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>{{$product->name}}                   
        <small>Danh sách hình ảnh</small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Trang chính</a>
            </li>
            <li class="active">Danh sách hình ảnh</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{URL::to('/admin/products/add-image/'.$product->id)}}" class="btn btn-success">Thêm hình mới</a></h3>
                        <div class="box-tools">
                            
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                                Kiểm tra lại dữ liệu nhập vào
                            </div>
                        @endif

                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                                {{Session::get('error_message')}}
                            </div>
                        @endif

                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>    <i class="icon fa fa-check"></i> Thành công!</h4>
                            {{Session::get('success_message')}}
                        </div>
                        @endif
                        
                        <table class="table table-hover">
                            <tbody>
                                <tr> 
                                    <th>Hình
                                    </th>                                  
                                    <th>Tên hình
                                    </th>
                                    <th>Đường dẫn file hình
                                    </th>
                                    <th>Thứ tự
                                    </th>
                                    
                                    <th style="width: 175px">Thao tác</th>
                                </tr>
                                @foreach($product->images as $image)
                                <tr>
                                    <td>
                                        {{HTML::image(productImageFolder().'/thumb/'.$image->url,'',array('class'=>'image-list'))}}   
                                    </td>
                                    <td>
                                       {{$image->name}}

                                    </td>
                                    <td>
                                       {{productImageFolder().$image->url}}

                                    </td>
                                    <td>
                                       {{$image->order}}

                                    </td>
                                    
                                    <td>
                                        <a class="btn btn-info" href="/admin/products/edit-image/{{$image->id}}">Sửa</a>

                                        <a href="/admin/products/delete-image/{{$image->id}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-default">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                       
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">


    </section>
    <!-- /.content -->
</aside>

@stop