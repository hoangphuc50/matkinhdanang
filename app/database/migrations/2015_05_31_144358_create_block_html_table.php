<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockHtmlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('block_html', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('image')->nullable();
			$table->string('link')->nullable();
			$table->text('content')->nullable();
			$table->text('default_content')->nullable();
			$table->string('position')->nullable();
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
		Schema::drop('block_html');
	}

}
