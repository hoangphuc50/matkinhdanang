<?php

class UserTableSeeder extends Seeder {
	public function run() {
		
		User::truncate();

		User::create(array(
			'username' => 'admin',
			'password' => Hash::make('123456'),
			'email' => 'ptheme.net@gmail.com',
			'name' => 'Administrator',
			'user_type' => 'admin'
			));
	}
}