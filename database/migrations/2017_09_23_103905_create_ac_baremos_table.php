<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcBaremosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_baremos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_procedimiento');
			$table->integer('id_proveedor');
			$table->float('monto', 10, 0);
			$table->string('observaciones')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->unique(['id_procedimiento','id_proveedor'], 'ac_baremos_uk1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_baremos');
	}

}
