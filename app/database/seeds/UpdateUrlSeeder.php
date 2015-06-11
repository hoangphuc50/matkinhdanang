<?php

class UpdateUrlSeeder extends Seeder {
	public function run() {
		
		//For Category
		foreach (Category::all() as $category) {
			$_row = Category::find($category->id);
			$_row->id = $category->id;
			$_row->save();
		}
		//For Blog
		foreach (Blog::all() as $blog) {
			$_row = Blog::find($blog->id);
			$_row->id = $blog->id;
			$_row->save();
		}
		//For Product
		foreach (Product::all() as $product) {
			$_row = Product::find($product->id);
			$_row->id = $product->id;
			$_row->save();
		}

	}
}