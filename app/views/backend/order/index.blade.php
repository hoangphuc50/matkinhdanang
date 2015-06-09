@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>Quản lí đơn hàng                   
        <small>Danh sách tất cả</small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Trang chính</a>
            </li>
            <li class="active">Danh sách đơn hàng</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        
                        <div class="box-tools">
                            <form action="/admin/orders" method="get">
                                <div class="input-group">

                                    <input type="text" id="search" name="search" placeholder="Nhập tiếng việt và nhấn Enter" value="{{Input::get('search')}}" class="form-control input-sm pull-right" style="width: 200px;">
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
                                    <th style="width:3%">{{adminSort("ID","id")}}
                                    </th>
                                    <th>{{adminSort("Tên","name")}}
                                    </th>
                                    <th>{{adminSort("Số điện thoại","phone")}}
                                    </th>
                                    <th>{{adminSort("Địa chỉ","ship_address")}}
                                    </th>
                                    <th style="width:20%">
                                        {{adminSort("Ngày đặt","id")}}
                                    </th>
                                    <th style="width:85px">{{adminSort("Trạng thái","state")}}
                                    </th>
                                    
                                    <th style="width: 175px">Thao tác</th>
                                </tr>
                                @foreach($orders as $order)
                                <tr>
                                    <td>
                                       {{$order->id}}

                                    </td>
                                    
                                    <td><a href="/admin/orders/detail/{{$order->id}}">{{$order->name}}</a>
                                    </td>
                                    <td>
                                        {{$order->phone}}
                                    </td>
                                    <td>
                                        {{$order->ship_address}}
                                    </td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
                                    <td>
                                        @if($order->state == true)
                                        <span class="label label-success">Đã xem</span>
                                        @else
                                        <span class="label label-danger">Mới</span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <a class="btn btn-info" href="/admin/orders/detail/{{$order->id}}">Xem</a>
                                        <a href="/admin/orders/delete/{{$order->id}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-default">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                       <?php echo $orders->appends(Input::only('search','option','per_page','sort','order'))->links(); ?>
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