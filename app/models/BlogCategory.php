<?php

class BlogCategory extends Eloquent {
	protected $table = 'blog_category';

	public function category() {
		return $this->belongsTo('Category', 'category_id');
	}

	public function blog() {
		return $this->belongsTo('Blog', 'blog_id');
	}
}