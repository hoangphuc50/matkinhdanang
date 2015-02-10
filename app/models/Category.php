<?php

class Category extends Eloquent {
	protected $table = 'categories';

	public function blogs() {
		$this->belongsToMany('Blog', 'blog_category', 'blog_id', 'category_id');
	}
	public function products() {
		$this->belongsToMany('Product', 'product_category', 'product_id', 'category_id');
	}
}