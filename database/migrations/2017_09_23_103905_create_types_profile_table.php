<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypesProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('types_profile', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_type');
			$table->integer('id_module');
			$table->timestamps();
			$table->softDeletes();
			$table->unique(['id_type','id_module'], 'types_profile_uk1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('types_profile');
	}

}
