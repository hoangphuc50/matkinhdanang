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

}