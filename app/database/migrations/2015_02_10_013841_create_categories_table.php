<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->string('short_description')->nullable();
			$table->boolean('state')->default(1);
			$table->boolean('highlight')->default(0);
			$table->string('link')->nullable();
			$table->integer('order')->nullable();
			$table->integer('parent_id')->nullable();
			$table->string('image')->nullable();
			$table->string('category_type')->nullable();
			$table->text('content')->nullable();
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
		Schema::drop('categories');
	}

}
