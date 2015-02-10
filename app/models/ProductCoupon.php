<?php

class ProductCoupon extends Eloquent {
	protected $table = 'product_coupon';

	public function product() {
		return $this->belongsTo('Product', 'product_id');
	}

	public function coupon() {
		return $this->belongsTo('Coupon', 'counpon_id');
	}
}