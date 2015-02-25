@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>Quản lí hãng, nhà sản xuất                     
        <small>Danh sách nhà sản xuất</small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Trang chính</a>
            </li>
            <li class="active">Danh sách nhà sản xuất</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="/adminchuyenmuc/add" class="btn btn-success">Thêm mới</a></h3>
                        <div class="box-tools">
                            <form action="/AdminChuyenMuc" method="get">
                                <div class="input-group">

                                    <input type="text" id="search" name="search" placeholder="Nhập tên tiếng việt và nhấn Enter" value="" class="form-control input-sm pull-right" style="width: 200px;">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID
                                    </th>
                                    <th>Tên nhà sản xuất
                                    </th>
                                    <th style="width: 13%">Thao tác</th>
                                </tr>
                                @foreach($producers as $producer)
                                <tr>
                                    <td>
                                       {{$producer->id}}

                                    </td>
                                    <td><a href="">{{$producer->name}}</a>
                                    </td>
                                    
                                    <td><a href="/admin/producers/edit/{{$producer->id}}" class="btn btn-primary">Sửa</a>

                                        <a href="/admin/producers/delete/{{$producer->id}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-default">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="/adminchuyenmuc/index">«</a>
                            </li>
                            <li><a class="Selected" href="/AdminChuyenMuc/Index?page=1">1</a>
                            </li>

                            <li><a href="/adminchuyenmuc/index?page=1">»</a>
                            </li>
                        </ul>
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