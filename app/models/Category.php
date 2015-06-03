<?php

class Category extends Eloquent {
	protected $table = 'categories';

	public function blogs() {
		return $this->belongsToMany('Blog', 'blog_category','category_id', 'blog_id');
	}
	public function products() {
		return $this->belongsToMany('Product', 'product_category','category_id', 'product_id');
	}

	public function parent() {

        return $this->hasOne('category', 'id', 'parent_id');

    }

    public function children() {

        return $this->hasMany('category', 'parent_id', 'id');

    }  

    public static function tree($type="product") {
    	if($type == "all"){
    		return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', NULL)->get();
    	}
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('category_type','=',$type)->where('parent_id', '=', NULL)->get();

    }
}