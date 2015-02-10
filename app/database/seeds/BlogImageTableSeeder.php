<?php

class BlogImageTableSeeder extends Seeder {
	public function run() {
		
		BlogImage::truncate();

		$blogs = Blog::all();

		foreach($blogs as $p) {
			for($i=1; $i<=10; $i++) {
				BlogImage::create(array(
					'blog_id' => $p->id,
					'image_id'=> 1
				));
			}			
		}
	}
}