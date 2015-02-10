<?php

class BlogTableSeeder extends Seeder {
	public function run() {
		
		Blog::truncate();
		$faker = Faker\Factory::create();

		for($i=1; $i<=20; $i++) {
			Blog::create(array(
				'title' => $faker->name,
				'description'=> $faker->text,
				'state'=> 1,
				'highlight'=> $faker->randomElement(array(1,0)),
				'user_id'=> 1,
				'content'=> $faker->text
			));
		}
	}
}