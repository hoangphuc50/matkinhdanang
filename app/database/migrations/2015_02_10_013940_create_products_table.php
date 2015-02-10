<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->text('content')->nullable();
			$table->boolean('state')->default(1);
			$table->boolean('highlight')->default(0);
			$table->float('old_price')->nullable();
			$table->float('price')->nullable();
			$table->boolean('public_price')->nullable();
			$table->string('include')->nullable();

			$table->string('image')->nullable();
			$table->integer('user_id');
			$table->integer('producer_id');
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
		Schema::drop('products');
	}

}
