<?php

class Picture extends Eloquent {
	protected $table = 'images';

	public function blogs() {
		return $this->belongsToMany('Blog', 'blog_image', 'blog_id', 'image_id');
	}
	public function products() {
		return $this->belongsToMany('Product', 'product_image', 'image_id','product_id');
	}
}