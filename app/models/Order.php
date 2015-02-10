<?php

class Order extends Eloquent {
	protected $table = 'orders';

	public function user() {
		return $this->belongsTo('User', 'user_id');
	}

	public function products() {
		$this->belongsToMany('Product', 'product_order', 'product_id', 'order_id');
	}
}