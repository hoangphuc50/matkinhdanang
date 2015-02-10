<?php

class ProductOrder extends Eloquent {
	protected $table = 'product_order';

	public function product() {
		return $this->belongsTo('Product', 'product_id');
	}

	public function order() {
		return $this->belongsTo('Order', 'order_id');
	}		
}