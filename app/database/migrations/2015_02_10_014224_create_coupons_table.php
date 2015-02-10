<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->text('content')->nullable();
			$table->string('image')->nullable();
			$table->boolean('state')->default(0);
			$table->datetime('date_begin')->nullable();
			$table->datetime('date_end')->nullable();
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
		Schema::drop('coupons');
	}

}
