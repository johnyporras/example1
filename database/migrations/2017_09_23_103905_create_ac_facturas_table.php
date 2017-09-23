<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcFacturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_facturas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('numero_factura');
			$table->integer('numero_control')->nullable();
			$table->date('fecha_factura')->nullable();
			$table->decimal('monto', 10);
			$table->text('observaciones')->nullable();
			$table->date('fecha_creacion')->nullable();
			$table->integer('usuario_creador')->nullable();
			$table->integer('codigo_estatus')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->string('documento', 400)->nullable();
			$table->integer('codigo_proveedor_creador')->nullable()->comment('Cada proveedor carga su factura');
			$table->index(['numero_factura','numero_control'], 'idxf1_numero_factura');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_facturas');
	}

}
