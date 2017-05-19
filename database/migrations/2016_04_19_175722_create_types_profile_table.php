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

				$table->foreign('id_type', 'user_types_profile_fk')->references('id')->on('user_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
				$table->foreign('id_module', 'user_types_submodules_fk')->references('id')->on('submodules')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
