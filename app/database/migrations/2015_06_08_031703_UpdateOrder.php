<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_order', function(Blueprint $table)
		{
			$table->integer('number')->nullable();
		});

		Schema::table('orders', function(Blueprint $table)
		{
			$table->text('email_content')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_order', function(Blueprint $table)
		{
			$table->dropColumn('number');
		});
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn('email_content');
		});
	}

}
