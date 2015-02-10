<?php

class Blog extends Eloquent {
	protected $table = 'blogs';
	/*
	* Define relationship
	*/
	public function user() {
		return $this->belongsTo('User', 'user_id');
	}
	public function categories() {
		$this->belongsToMany('Category', 'blog_category', 'blog_id', 'category_id');
	}
}