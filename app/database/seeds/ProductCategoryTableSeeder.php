<?php

class ProductCategoryTableSeeder extends Seeder {
	public function run() {
		
		ProductCategory::truncate();
		$products = Product::all();
		$categorys = Category::where('category_type','=','product')->get();

		foreach($products as $p) {
			foreach($categorys as $c) {
				ProductCategory::create(array(
					'product_id' => $p->id,
					'category_id'=> $c->id
				));
			}			
		}
	}
}