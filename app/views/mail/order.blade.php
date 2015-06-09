<h1>ĐƠN ĐẶT HÀNG</h1>

<p><b>Tên khách hàng: </b>{{$order->name}}</p>
<p><b>Email: </b>{{$order->email}}</p>
<p><b>Số điện thoại: </b>{{$order->phone}}</p>
<p><b>Địa chỉ giao hàng: </b>{{$order->ship_address}}</p>
<p><b>Thời gian đặt hàng: </b>{{$order->created_at}}</p>
<br>
<h3>Chi tiết đơn hàng</h3>
<table>
<tr>
	<td>Tên sản phẩm</td>
	<td>Số lượng</td>
	<td>Đơn giá</td>
	<td>Tổng cộng</td>
</tr>
@foreach($cart as $row)
	<tr>
	  <td class="cart-name">
	    <a href="{{URL::to('san-pham/'.$row->id)}}" target="_blank">
	    <div style="float:left; margin-right:10px">
	        {{HTML::image(!is_null($row->options->image) ? URL::to(productImageFolder().$row->options->image) : URL::to('/images/no_image.jpg'),'',array('width'=>"100",'height'=>"100"))}}
	        
	    </div>
	    @if(!is_null($row->options->product_id))
	    [{{$row->options->product_id}}] 
	    @endif
	    {{$row->name}}
	    </a>
		</td>
		<td>
		    {{$row->qty}}
		</td>
		<td>
		    {{displayPrice($row->price)}}  đ  
		</td>
		<td style="font-size:14px; color:red">{{displayPrice($row->subtotal)}} đ</td>
	</tr>
@endforeach
</table>
<p><b>Tổng chi phí thanh toán: </b><span style="color:red;font-size:18px">{{displayPrice($cart_total)}} đ</span></p>
<br>
<h3 style="text-transform: uppercase">Mắt kính MinhRayBan sẽ kiểm tra đơn hàng và liên lạc lại trong thời gian sớm nhất.<br>
Cảm ơn quí khách hàng đã tin tưởng và ủng hộ MinhRayBan.</h3>
