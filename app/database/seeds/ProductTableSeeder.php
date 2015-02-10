<?php

class ProductTableSeeder extends Seeder {
	public function run() {
		
		Product::truncate();
		$faker = Faker\Factory::create();
		$price = $faker->numberBetween(1000, 100000);

		$producers = Producer::all();

		foreach($producers as $p) {
			for($i=1; $i<=10; $i++) {
				Product::create(array(
					'name' => $faker->name,
					'description'=> $faker->text,
					'state'=> 1,
					'highlight'=> $faker->randomElement(array(1,0)),
					'user_id'=> 1,
					'old_price'=> $price - 200,
					'price'=> $price,
					'public_price'=> $faker->randomElement(array(1,0)),
					'include'=> $faker->name,
					'producer_id'=>$p->id
				));
			}			
		}

	}
}