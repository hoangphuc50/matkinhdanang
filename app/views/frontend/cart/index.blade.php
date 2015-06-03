@extends('layouts.frontend.layout')

@section('content') 
<div class="col-md-9 col-sm-8">
    <div class="main-wrapper">
       <div class="breakcrum">
            <ul>
                <li>
                    <a href="#">Trang chủ</a>
                </li>
                <li>
                   <a href="#">Giỏ hàng</a>
                    
                </li>
            </ul>
        </div>
        <h2 class="title-2">Giỏ hàng
        </h2>
        <div class="cart-index-content">
            @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Cảnh báo!</h4>
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
                    <a href="{{URL::to('san-pham/'.$row->id)}}" target="_blank">
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
                    <div class="cart-update-qty">
                        <form action="{{URL::to('cart/update')}}" method="POST" style="display: inline;">
                            <a class="deletebtn" title="Xóa sản phẩm khỏi giỏ hàng"> </a>
                            <input type="text" title="Cập nhật số lượng trong giỏ hàng" class="inputbox_update" name="quantity" value="{{$row->qty}}">
                            <a class="updatebtn" title="Cập nhật số lượng trong giỏ hàng" ></a>
                            {{Form::hidden('id', $row->rowid)}}       
                        </form>
                    </div>
                    
                </td>
                <td class="cart-price">{{displayPrice($row->subtotal)}} đ</td>
                </tr>
              @endforeach
              </tbody>
              
            </table>
            <div class="cart-total-price">
                Tổng giá trị thanh toán: <span>{{displayPrice(Cart::instance('shopping')->total())}} đ</span> 
            </div>
        </div>
        <div class="cart-ship">
            <p class="ship-des">
                Quý khách vui lòng nhập thông tin liên lạc vào mục dưới đây. Mắt Kính MinhRayBan sẽ gọi điện xác nhận và giao sản phẩm đến địa chỉ của quý khách trong thời gian sớm nhất.
            </p>
            <form action="">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-row">
                        <label>
                            Email
                        </label>
                        <input type="email" required placeholder="Nhập địa chỉ email của bạn">
                    </div>
                    <div class="form-row">
                        <label>
                            Họ và tên
                        </label>
                        <input type="text" required placeholder="Nhập họ và tên đầy đủ">
                    </div>
                    <div class="form-row">
                        <label>
                            Địa chỉ
                        </label>
                        <input type="text" required placeholder="Nhập địa chỉ chính xác và chi tiết để chúng tôi có thể giao hàng">
                    </div>
                    <div class="form-row">
                        <label>
                            Địa chỉ
                        </label>
                        <input type="text" required placeholder="Nhập điện thoại của bạn">
                    </div>
                    
                    <div class="form-submit">
                        <a href="#" class="dat-hang-ngay">Xác nhận</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-row">
                        <label>
                            Thông tin bổ sung
                        </label>
                        <textarea placeholder="Thêm thông tin cần thiết cho quá trình giao nhận hàng"></textarea>
                    </div>
                    <div class="form-des">
                        
                    </div>
                </div>
            </div>
            </form>
        </div>
        

    </div>
</div>
@stop