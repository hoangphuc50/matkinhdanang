<?php

class BlogImage extends Eloquent {
	protected $table = 'blog_image';

	public function image() {
		return $this->belongsTo('Image', 'image_id');
	}

	public function blog() {
		return $this->belongsTo('Blog', 'blog_id');
	}
}