<?php

class Coupon extends Eloquent {
	protected $table = 'coupons';

	public function products() {
		$this->belongsToMany('Product', 'product_coupon', 'product_id', 'coupon_id');
	}
}