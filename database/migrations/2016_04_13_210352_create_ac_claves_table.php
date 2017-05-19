<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcClavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_claves', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('clave', 100)->unique('uc_clave');
			$table->string('cedula_afiliado', 20)->index('cedula_afiliado');
			$table->string('codigo_proveedor', 100)->nullable()->index('idxc_codigo_proveedor');
			$table->integer('codigo_contrato')->nullable()->index('idxc_codigo_contrato');
			$table->date('fecha_cita')->nullable();
			$table->date('fecha_creacion')->nullable();
			$table->string('motivo', 100)->nullable();
			$table->integer('codigo_especialidad')->nullable()->unique('idxc_codigo_especialidad');
			$table->integer('codigo_servicio')->nullable()->unique('uxc_codigo_servicio');
			$table->integer('codigo_tipo_examen')->nullable();
			$table->string('detalle', 100)->nullable();
			$table->text('observaciones')->nullable();
			$table->decimal('costo', 10)->nullable();
			$table->integer('estatus')->nullable();
			$table->string('correo', 100)->nullable();
			$table->text('examen')->nullable();
			$table->integer('estatus_clave')->nullable();
			$table->integer('creador')->nullable();
			$table->time('hora_guardado')->nullable();
			$table->string('telefono', 25)->nullable();
			$table->text('rechazo')->nullable();
			$table->integer('tipo_afiliado')->nullable();
			$table->integer('cantidad_servicios')->nullable();
			$table->time('hora_autorizado')->nullable();
            $table->timestamps();
            $table->softDeletes();

            	$table->foreign('cedula_afiliado', 'ac_claves_ibfk_1')->references('cedula')->on('ac_afiliados')->onUpdate('CASCADE')->onDelete('RESTRICT');
				$table->foreign('codigo_proveedor', 'ac_claves_ibfk_2')->references('codigo_proveedor')->on('ac_proveedores_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
				$table->foreign('codigo_especialidad', 'ac_claves_ibfk_3')->references('codigo_especialidad')->on('ac_especialidades_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
				$table->foreign('codigo_servicio', 'ac_claves_ibfk_4')->references('codigo_servicio')->on('ac_servicios_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_claves');
	}

}
