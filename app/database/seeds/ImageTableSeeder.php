<?php

class ImageTableSeeder extends Seeder {
	public function run() {
		
		Picture::truncate();
		Picture::create(array(
			'url' => 'no_image.png',
			'name' => 'Default'
			));
	}
}