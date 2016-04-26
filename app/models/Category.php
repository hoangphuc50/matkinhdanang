<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
class Category extends Eloquent implements SluggableInterface{
    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'alias',
    );
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

    public static function tree($type="product",$state='') {
        if(is_array($type)){
            return static::with(implode('.', array_fill(0, 100, 'children')))->whereIn('category_type',$type)->where('parent_id', '=', NULL)->where('state','=',true)->get();
        }else{
            if($type == "all" and $state == ''){
                return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', NULL)->get();
            }

            if($state == ''){
                return static::with(implode('.', array_fill(0, 100, 'children')))->where('category_type','=',$type)->where('parent_id', '=', NULL)->get();
            }else{
                return static::with(implode('.', array_fill(0, 100, 'children')))->where('category_type','=',$type)->where('parent_id', '=', NULL)->where('state','=',true)->get();
            }
        }
    }
}