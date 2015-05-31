<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuKinhTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_kinh', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('image');
			$table->string('link')->nullable();
			$table->integer('order')->nullable();
			$table->boolean('state')->default(1);
			$table->boolean('highlight')->default(0);
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
		Schema::drop('menu_kinh');
	}

}
