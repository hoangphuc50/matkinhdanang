<?php

class ProductImageTableSeeder extends Seeder {
	public function run() {
		
		ProductImage::truncate();
		$products = Product::all();

		foreach($products as $p) {
			for($i=1; $i<=10; $i++) {
				ProductImage::create(array(
					'product_id' => $p->id,
					'image_id'=> 1
				));
			}			
		}
	}
}