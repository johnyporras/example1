<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmodulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submodules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('description');
			$table->integer('modules_id');
			$table->string('url', 100);
			$table->integer('order');
			$table->timestamps();
			$table->softDeletes();
			$table->string('url2', 100)->nullable();
			$table->string('url3', 100)->nullable();
			$table->string('url4', 100)->nullable();
			$table->string('url5', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submodules');
	}

}
