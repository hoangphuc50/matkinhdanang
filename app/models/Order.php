<?php

class Order extends Eloquent {
	protected $table = 'orders';

	public function user() {
		return $this->belongsTo('User', 'user_id');
	}

	public function products() {
		return $this->belongsToMany('Product', 'product_order', 'order_id', 'product_id');
	}
}