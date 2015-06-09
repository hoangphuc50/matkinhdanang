@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí đơn hàng
                       
        <small>Xem thông tin chi tiết</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí đơn hàng</li>
    </ol>
    <section class="content detail-content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Đơn hàng của {{$order->name}} đặt ngày {{$order->created_at}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label>Tên khách hàng</label>
                        <div class="ad-detail">
                            {{$order->name}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <div class="ad-detail">
                            {{$order->phone}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="ad-detail">
                            {{$order->email}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ giao hàng</label>
                        <div class="ad-detail">
                            {{$order->ship_address}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Thông tin bổ sung</label>
                        <div class="ad-detail">
                            {{$order->description}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ngày đặt hàng</label>
                        <div class="ad-detail">
                            {{$order->created_at}}
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <div class="ad-detail">
                            @if($order->state == true)
                                <span class="label label-success">Đã xem</span>
                            @else
                                <span class="label label-danger">Mới</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Chi tiết đơn hàng</label>
                        <div class="ad-detail">
                            <table class="table table-striped table-cart">
                              <thead>
                                <tr>
                                  <th style="width:50%">Sản phẩm</th>
                                  <th>Số lượng</th>
                                  <th>Tổng giá trị</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach($order->products as $row)
                              <?php
                              $order_product = ProductOrder::where('product_id','=',$row->id)->where('order_id','=',$order->id)->first();
                              ?>
                                <tr>
                                  <td class="cart-name">
                                    <a href="{{URL::to('san-pham/'.$row->id)}}" target="_blank">
                                    <div class="cart-img" style="float:left; margin-right:10px">
                                        {{HTML::image(!is_null($row->image) ? productImageFolder().$row->image : "/images/no_image.jpg",'',array('width'=>"100",'height'=>"100"))}}
                                        
                                    </div>
                                    
                                    {{$row->name}}
                                    </a>
                                </td>
                                <td>
                                    <b>{{$order_product->number}}</b>
                                </td>
                                <td class="cart-price">{{displayPrice($row->price * $order_product->number)}} đ</td>
                                </tr>
                              @endforeach
                              </tbody>
                              
                            </table>
                            <br>
                            <p><b>Tổng giá trị đơn hàng: </b><span style="color:red; font-size:18px">{{displayPrice($order->total_price)}} đ</span></p>
                        </div>
                    </div>
                    
                </div>
                <div class="box-footer">
                    <a class="btn btn-primary" href="/admin/orders/edit/{{$order->id}}">Sửa</a>
                    <a class="btn btn-default"  href="/admin/orders">Quay lại</a>
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