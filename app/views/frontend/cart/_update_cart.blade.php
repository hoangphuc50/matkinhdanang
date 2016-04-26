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
<<<<<<< HEAD
        <a href="{{URL::to('san-pham/'.$row->alias)}}" target="_blank">
=======
        <a href="{{URL::to('san-pham/'.$row->options->alias)}}" target="_blank">
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
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
                <a class="deletebtn" title="Xóa sản phẩm khỏi giỏ hàng" href=""> </a>
                <input type="text" title="Cập nhật số lượng trong giỏ hàng" class="inputbox_update" name="quantity" value="{{$row->qty}}">
                <div type="submit" class="updatebtn" name="update" title="Cập nhật số lượng trong giỏ hàng" value=" "></div>
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