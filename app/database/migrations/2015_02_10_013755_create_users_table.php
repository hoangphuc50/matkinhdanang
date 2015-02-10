<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->integer('state')->default(1);
			$table->string('email');
			$table->boolean('facebook')->default(false);
			$table->string('name')->nullable();
			$table->integer('gender')->nullable();
			$table->date('birthday')->nullable();

			$table->string('address')->nullable();
			$table->string('phone')->nullable();
			$table->boolean('newletters')->default(true);
			$table->string('user_type')->nullable();
			$table->string('active_token')->nullable();

			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
