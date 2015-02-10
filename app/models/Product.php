<?php

class Product extends Eloquent {
	protected $table = 'products';

	public function producer() {
		$this->belongsTo('Producer','producer_id');
	}
	
	public function user() {
		$this->belongsTo('User','user_id');
	}

	public function categories() {
		$this->belongsToMany('Category', 'product_category', 'product_id', 'category_id');
	}

	public function orders() {
		$this->belongsToMany('Order', 'product_order', 'product_id', 'order_id');
	}

	public function coupons() {
		$this->belongsToMany('Coupon', 'product_coupon', 'product_id', 'coupon_id');
	}
}
