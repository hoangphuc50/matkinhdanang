<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
class Blog extends Eloquent implements SluggableInterface{
	use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'alias',
    );

	protected $table = 'blogs';
	/*
	* Define relationship
	*/
	public function user() {
		return $this->belongsTo('User', 'user_id');
	}
	public function categories() {
		return $this->belongsToMany('Category', 'blog_category', 'blog_id', 'category_id');
	}
}