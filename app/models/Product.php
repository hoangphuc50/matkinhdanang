<?php

class Product extends Eloquent {
	protected $table = 'products';

	public function producer() {
		return $this->belongsTo('Producer','producer_id');
	}
	
	public function user() {
		return $this->belongsTo('User','user_id');
	}

	public function categories() {
		return $this->belongsToMany('Category', 'product_category', 'product_id', 'category_id');
	}

	public function images() {
		return $this->belongsToMany('Picture', 'product_image', 'product_id', 'image_id');
	}

	public function orders() {
		return $this->belongsToMany('Order', 'product_order', 'product_id', 'order_id');
	}

	public function coupons() {
		return $this->belongsToMany('Coupon', 'product_coupon', 'product_id', 'coupon_id');
	}
}
