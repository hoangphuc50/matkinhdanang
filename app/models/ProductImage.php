<?php

class ProductImage extends Eloquent {
	protected $table = 'product_image';

	public function product() {
		return $this->belongsTo('Product', 'product_id');
	}

	public function image() {
		return $this->belongsTo('Image', 'image_id');
	}	
}