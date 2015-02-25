<?php

class CategoryTableSeeder extends Seeder {
	public function run() {
		
		Category::truncate();
		$faker = Faker\Factory::create();

		for($i=1; $i<=20; $i++) {
			Category::create(array(
				'name' => $faker->name,
				'description'=> $faker->text,
				'short_description'=> $faker->name,
				'state'=> 1,
				'highlight'=> $faker->randomElement(array(1,0)),
				'order'=> $faker->numberBetween(1,10),
				'category_type'=> $faker->randomElement(array('blog','product','menu')),
				'content'=> $faker->text
				));
		}
		for($i=1; $i<=5; $i++) {
			Category::create(array(
				'name' => $faker->name,
				'description'=> $faker->text,
				'short_description'=> $faker->name,
				'state'=> 1,
				'highlight'=> $faker->randomElement(array(1,0)),
				'order'=> $faker->numberBetween(1,10),
				'category_type'=> $faker->randomElement(array('blog','product','menu')),
				'content'=> $faker->text,
				'parent_id' => 1
				));
		}
	}
}