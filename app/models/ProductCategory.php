<?php

class ProductCategory extends Eloquent {
	protected $table = 'product_category';

	public function category() {
		return $this->belongsTo('Category', 'category_id');
	}

	public function product() {
		return $this->belongsTo('Product', 'product_id');
	}
}