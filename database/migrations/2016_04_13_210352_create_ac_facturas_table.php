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
			$table->increments('id');
			$table->integer('numero_factura')->index('idxf1_numero_factura');
			$table->integer('numero_control')->nullable();
			$table->date('fecha_factura')->nullable();
			$table->decimal('monto', 10)->nullable();
			$table->text('observaciones')->nullable();
			$table->date('fecha_creacion')->nullable();
			$table->integer('usuario_creador')->nullable();
			$table->integer('codigo_estatus')->nullable()->unsigned();
			$table->string('documento')->nullable();
            $table->integer('codigo_proveedor_creador')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            	$table->foreign('codigo_estatus')->references('id')->on('ac_estatus')
                ->onUpdate('cascade')->onDelete('cascade');
            	$table->foreign('codigo_proveedor_creador')->references('codigo_proveedor')->on('ac_proveedores_extranet')
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
		Schema::dropIfExists('ac_facturas');
	}

}
