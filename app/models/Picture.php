<?php

class Picture extends Eloquent {
	protected $table = 'images';

	public function blogs() {
		$this->belongsToMany('Blog', 'blog_image', 'blog_id', 'image_id');
	}
	public function products() {
		$this->belongsToMany('Product', 'product_image', 'product_id', 'image_id');
	}
}