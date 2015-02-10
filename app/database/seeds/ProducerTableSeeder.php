<?php

class ProducerTableSeeder extends Seeder {
	public function run() {
		Producer::truncate();
		$faker = Faker\Factory::create();
		
		for($i=1; $i<=20; $i++) {
			Producer::create(array(
				'name' => $faker->name
			));
		}
	}
}