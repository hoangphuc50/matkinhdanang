<?php 
$web_title = "Đặt hàng thành công.";
?>
@extends('layouts.frontend.layout')

@section('content') 
<section class="main">
    <div class="container">
        <div class="row">
<div class="col-md-9 col-sm-8">
    <div class="main-wrapper">
       <div class="breakcrum">
            <ul>
                <li>
                    <a href="#">Trang chủ</a>
                </li>
                <li>
                   <a href="#">Đặt hàng thành công</a>
                    
                </li>
            </ul>
        </div>
        <h2 class="title-2">Đơn hàng của bạn
        </h2>
        <div class="cart-index-content">
            @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Đã có lỗi!</h4>
                {{Session::get('error_message')}}
            </div>
            @endif

            @if (Session::has('success_message') or isset($success_message))
                <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>    <i class="icon fa fa-check"></i> Thành công!</h4>
                {{Session::get('success_message')}}{{$success_message}}
            </div>
            @endif
            <table class="table table-striped table-cart">
              <thead>
                <tr>
                  <th style="width:50%">Sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Tổng giá trị</th>
                </tr>
              </thead>
              <tbody>
              @foreach($cart as $row)
                <tr>
                  <td class="cart-name">
                    <a href="{{URL::to('san-pham/'.$row->alias)}}" target="_blank">
                    <div class="cart-img">
                        {{HTML::image(!is_null($row->options->image) ? productImageFolder().$row->options->image : "/images/no_image.jpg",'',array('width'=>"100",'height'=>"100"))}}
                        
                    </div>
                    @if(!is_null($row->options->product_id))
                    [{{$row->options->product_id}}] 
                    @endif
                    {{$row->name}}
                    </a>
                </td>
                <td>
                    <b>{{$row->qty}}</b>
                    
                </td>
                <td class="cart-price">{{displayPrice($row->subtotal)}} đ</td>
                </tr>
              @endforeach
              </tbody>
              
            </table>
            <div class="cart-total-price">
                Tổng giá trị thanh toán: <span>{{displayPrice($cart_total)}} đ</span> 
            </div>
        </div>
        <h2 class="order-title">Thông tin đặt hàng</h2>
        <div class="cart-ship">
            {{ Form::open(array('url'=>URL::to('cart/save'),'method' => 'post', 'class'=>'form-horizontal','files'=>true)) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row {{{ $errors->has('email') ? 'has-error' : '' }}}">
                            <label for="order_email">
                                Email
                            </label>
                            <p>{{$order->email}}</p>
                        </div>
                        <div class="form-row {{{ $errors->has('name') ? 'has-error' : '' }}}">
                            <label for="order_name">
                                Họ và tên 
                            </label>
                            <p>{{$order->name}}</p>
                        </div>
                        <div class="form-row {{{ $errors->has('ship_address') ? 'has-error' : '' }}}">
                            <label for="order_ship_address">
                                Địa chỉ giao hàng
                            </label>
                            <p>{{$order->ship_address}}</p>

                        </div>
                        <div class="form-row {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                            <label for="order_phone">
                                Số điện thoại
                            </label>
                            <p>{{$order->phone}}</p>
                        </div>
                        <div class="form-row {{{ $errors->has('description') ? 'has-error' : '' }}}">
                            <label for="order_description">
                                Thông tin bổ sung
                            </label>
                            <p>{{$order->description}}</p>
                        </div>
                    </div>
                    
                </div>
                <h2 class="order-title">Phương thức thanh toán & vận chuyển</h2>
                <br>
                <p>
                    <b>Vận chuyển toàn quốc: </b>Các bạn thuộc khu vực nội thành Tp. Đà Nẵng được nhân viên của MatKinhDaNang.Com giao hàng tận nơi. Các bạn thuộc các khu vực khác chúng tôi sẽ chuyển hàng theo hình thức phát hàng thu tiền (COD) của bưu điện.
                </p>
                <p>
                    <b>Thanh toán trực tiếp:</b> Thanh toán trực tiếp cho nhân viên của Mắt Kính Đà Nẵng hoặc nhân viên bưu điện khi bạn nhận hàng.
                </p>
                <br>
            <div class="form-submit">
                <a href="/" class="dat-hang-ngay order-submit">Về trang chủ</a>
            </div>
        </div>


    </div>
</div>
</div>
</div>
</section>
@stop