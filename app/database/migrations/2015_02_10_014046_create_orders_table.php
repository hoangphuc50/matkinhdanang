<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('product_ids')->nullable();
			$table->string('product_names')->nullable();
			$table->string('ship_address')->nullable();
			$table->boolean('state')->default(1);
			$table->boolean('highlight')->default(0);
			$table->float('total_price')->nullable();

			$table->integer('user_id')->nullable();
			$table->string('order_type')->nullable();
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
		Schema::drop('orders');
	}

}
