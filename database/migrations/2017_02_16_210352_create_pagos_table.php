<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo_confirmacion',30)->unique();
			$table->double('monto');
			$table->date('fecha_pago');
			$table->enum('estatus', ['Aprobado', 'Anulado', 'Devuelto', 'Negado'])->default('Aprobado');
			$table->integer('cuenta_id')->unsigned();
			$table->timestamps();
            $table->softDeletes();
            	$table->foreign('cuenta_id')->references('id')->on('ac_cuenta')
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
		Schema::drop('pagos');
	}

}
