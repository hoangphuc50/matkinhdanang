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
        <h2 class="order-title">Thông tin đặt hàng</h2>
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Đã có lỗi!</h4>
            Xem lại thông tin order của bạn
        </div>
        @endif
        <div class="cart-ship">
            <p class="ship-des">
                Quý khách vui lòng nhập thông tin liên lạc vào mục dưới đây. Mắt Kính MinhRayBan sẽ gọi điện xác nhận và giao sản phẩm đến địa chỉ của quý khách trong thời gian sớm nhất.<span style="color:red"> (* mục bắt buộc nhập)</span>
            </p>
            {{ Form::open(array('url'=>URL::to('cart/save'),'method' => 'post', 'class'=>'form-horizontal','files'=>true)) }}
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-row {{{ $errors->has('email') ? 'has-error' : '' }}}">
                            <label for="order_email">
                                Email <span style="color:red">*</span>
                            </label>
                            {{ Form::text('email',Input::old('email'), array('id'=>'order_email','placeholder'=>'Nhập địa chỉ email của bạn')) }}
                            {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                        </div>
                        <div class="form-row {{{ $errors->has('name') ? 'has-error' : '' }}}">
                            <label for="order_name">
                                Họ và tên <span style="color:red">*</span>
                            </label>
                            {{ Form::text('name',Input::old('name'), array('id'=>'order_name','placeholder'=>'Nhập họ và tên đầy đủ')) }}
                            {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                        </div>
                        <div class="form-row {{{ $errors->has('ship_address') ? 'has-error' : '' }}}">
                            <label for="order_ship_address">
                                Địa chỉ giao hàng <span style="color:red">*</span>
                            </label>
                            {{ Form::text('ship_address',Input::old('ship_address'), array('id'=>'order_ship_address','placeholder'=>'Nhập địa chỉ chính xác và chi tiết để chúng tôi có thể giao hàng')) }}
                            {{ $errors->first('ship_address', '<span class="help-block">:message</span>') }}

                        </div>
                        <div class="form-row {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                            <label for="order_phone">
                                Số điện thoại <span style="color:red">*</span>
                            </label>
                            {{ Form::text('phone',Input::old('phone'), array('id'=>'order_phone','placeholder'=>'Nhập số điện thoại hiện tại của bạn')) }}
                            {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="form-row {{{ $errors->has('description') ? 'has-error' : '' }}}">
                            <label for="order_description">
                                Thông tin bổ sung
                            </label>
                            {{ Form::textarea('description',Input::old('description'), ['class' => '','size' => '5x5','placeholder'=>"Thông tin bổ sung cho đơn hàng"]) }}
                            {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                        </div>
                        <div class="form-des">
                            
                        </div>
                    </div>
                </div>
                <h2 class="order-title">Phương thức thanh toán & vận chuyển</h2>
                <br>
                <p>
                    <b>Vận chuyển toàn quốc: </b>Các bạn thuộc khu vực nội thành Tp. Hồ Chí Minh được nhân viên của MinhRayBan giao hàng tận nơi. Các bạn thuộc các khu vực khác chúng tôi sẽ chuyển hàng theo hình thức phát hàng thu tiền (COD) của bưu điện.
                </p>
                <p>
                    <b>Thanh toán trực tiếp:</b> Thanh toán trực tiếp cho nhân viên của Mắt Kính MinhRayBan hoặc nhân viên bưu điện khi bạn nhận hàng.
                </p>
                <br>
            <div class="form-submit">
                <input type="submit" class="dat-hang-ngay order-submit" value="Xác nhận">
            </div>
        {{ Form::close() }}
        </div>


    </div>
</div>
@stop