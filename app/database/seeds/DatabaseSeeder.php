<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		// $this->call('ProducerTableSeeder');
		// $this->call('CategoryTableSeeder');
		// $this->call('BlogTableSeeder');
		// $this->call('ProductTableSeeder');

		// $this->call('ProductCategoryTableSeeder');
		// $this->call('BlogCategoryTableSeeder');
		// $this->call('ImageTableSeeder');
		// $this->call('BlogImageTableSeeder');
		// $this->call('ProductImageTableSeeder');
		// $this->call('OrderTableSeeder');
		// $this->call('CouponTableSeeder');
		// $this->call('ProductCouponTableSeeder');
		// $this->call('ProductOrderTableSeeder');
	}

}
