<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->text('feature')->nullable();
			$table->string('product_id')->nullable();
			$table->string('alias')->nullable();
		});

		Schema::table('blogs', function(Blueprint $table)
		{
			$table->string('alias')->nullable();
		});

		Schema::table('categories', function(Blueprint $table)
		{
			$table->string('alias')->nullable();
		});

		Schema::table('orders', function(Blueprint $table)
		{
			$table->text('email')->nullable();
			$table->integer('phone')->nullable();;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropColumn('feature');
			$table->dropColumn('product_id');
		});

		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn('email');
			$table->dropColumn('phone');
		});

		Schema::table('blogs', function(Blueprint $table)
		{
			$table->dropColumn('alias');
		});

		Schema::table('categories', function(Blueprint $table)
		{
			$table->dropColumn('alias');
		});
	}

}
