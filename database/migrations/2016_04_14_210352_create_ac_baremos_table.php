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
			$table->increments('id');
			$table->integer('id_procedimiento')->unsigned();
            $table->integer('id_proveedor')->unsigned();
			$table->double('monto')->nullable();
			$table->text('observaciones', 65535);
            $table->timestamps();
            $table->softDeletes();
            	$table->foreign('id_procedimiento')->references('id')->on('ac_procedimientos_medicos')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_proveedor')->references('codigo_proveedor')->on('ac_proveedores_extranet')
                ->onUpdate('cascade')->onDelete('cascade');
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
