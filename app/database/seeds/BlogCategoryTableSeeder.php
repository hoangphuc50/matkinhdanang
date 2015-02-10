<?php

class BlogCategoryTableSeeder extends Seeder {
	public function run() {
		
		BlogCategory::truncate();
		$blogs = Blog::all();
		$categorys = Category::where('category_type','=','blog')->get();

		foreach($blogs as $p) {
			foreach($categorys as $c) {
				BlogCategory::create(array(
					'blog_id' => $p->id,
					'category_id'=> $c->id
				));
			}			
		}	
	}
}