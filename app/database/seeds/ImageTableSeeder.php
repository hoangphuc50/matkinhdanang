<?php

class ImageTableSeeder extends Seeder {
	public function run() {
		
		Image::truncate();
		Image::create(array(
			'url' => 'no_image.png',
			'name' => 'Default'
			));
	}
}