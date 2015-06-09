<?php

class CartController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function addCart()
	{
		$product_id = Input::get('product_id');
		$number_of_item = Input::get('number_of_item');
		$product = Product::find($product_id);
		if(!empty($product)){
			Cart::instance('shopping')->add(
					$product->id,
					$product->name,
					$number_of_item,
					$product->price,
					array(
						'product_id' => $product->product_id,
						'image' => $product->image
						)
				);
		}else{
			return false;
		}
		$data['cart'] = Cart::instance('shopping')->content();
		//return View::make('frontend.cart.list',$data);
		return View::make('frontend.cart.index',$data)->with('success_message', 'Sản phẩm bạn chọn đã được thêm vào giỏ hàng.');
	}

	public function displayIndexPage()
	{
		$data['cart'] = Cart::instance('shopping')->content();
		return View::make('frontend.cart.index',$data);
	}

	public function deleteCart()
	{
		Cart::instance('shopping')->destroy();
		$data['cart'] = [];
		return View::make('frontend.cart.index',$data)->with('success_message', 'Giỏ hàng của bạn đã được xóa.');
	}
	public function updateCart()
	{
		$id  = Input::get('id');
		$quantity = Input::get('quantity');
		$is_delete = Input::get('is_delete');

		if($is_delete == 1){
			Cart::instance('shopping')->remove($id);
		}else{
			Cart::instance('shopping')->update($id,
			array(
					'qty' => $quantity
				)
			);
		}

		$data['cart'] = Cart::instance('shopping')->content();
		return View::make('frontend.cart._update_cart',$data)->with('success_message', 'Giỏ hàng của bạn đã được cập nhật.');
	}

	public function saveCart(){
		$rules = array(
		    'name' => 'required|max:100',
		    'email' => 'required|email|max:100',
		    'phone' => 'required:max:10',
		    'ship_address' => 'required|max:200',
		    'description' => 'max:1000',
		);
		$validate_messages = array(
			'name.required' => "Vui lòng nhập họ và tên của bạn",
			'name.max' => "Dữ liệu bạn nhập không đúng, tên quá dài",
			'phone.required' => "Vui lòng nhập điện thoại của bạn",
			'phone.max' => "Dữ liệu bạn nhập không đúng, số điện thoại quá dài",
			'ship_address.required' => "Vui lòng nhập địa chỉ giao hàng",
			'ship_address.max' => "Dữ liệu bạn nhập không đúng, địa chỉ quá dài",
			'email.required' => "Vui lòng nhập email của bạn",
			'email.email' => "Định dạng email phải là name@example.com",
			);

		$validator = Validator::make(Input::all(), $rules,$validate_messages);

		if ($validator->fails()) {
		    return Redirect::to('cart')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$order = new Order;
			$order->name = Input::get('name');
			$order->email = Input::get('email');
			$order->phone = Input::get('phone');
			$order->description = Input::get('description');
			$order->ship_address = Input::get('ship_address');

			$cart = Cart::instance('shopping')->content();
			$product_ids = '';
			$product_names = '';
			
			foreach($cart as $row){
				$product_ids = $product_ids.$row->id;
				$product_names = $product_names.$row->name;		
			}
			$order->product_ids = $product_ids;
			$order->product_names = $product_names;
			$order->state = 0;
			$order->highlight = 0;
			$order->total_price = Cart::instance('shopping')->total();

			$order->save();

			foreach($cart as $row){
				$product_order = new ProductOrder;
				$product_order->order_id = $order->id;
				$product_order->product_id = $row->id;
				$product_order->number = $row->qty;
				$product_order->save();
			}

			$data['cart'] = Cart::instance('shopping')->content();
			$data['cart_total'] = Cart::instance('shopping')->total();
			$data['order'] = $order;

			//Send email
			Mail::send('mail.order', $data, function($message) {
				$message->to(Input::get('email'),Input::get('name'))->subject('Thông báo đặt hàng thành công từ mắt kính MinhRayBan');
			});

			//Destroy cart
			Cart::instance('shopping')->destroy();

			return View::make('frontend.cart.done',$data)
						->with('success_message', 'Đơn hàng của bạn đã được gửi đến hệ thống MinhRayBan, 
						chúng tôi sẽ kiểm tra đơn hàng và gọi lại cho bạn trong thời gian sớm nhất.
						 Để xem lại đơn hàng vui lòng kiểm tra email của mình.');
		}
	}

}