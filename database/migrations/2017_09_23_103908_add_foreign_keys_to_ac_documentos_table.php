<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcDocumentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_documentos', function(Blueprint $table)
		{
			$table->foreign('id_tipo_documento', 'ac_ac_documentos_fk')->references('id')->on('ac_tipo_documentos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_paciente', 'ac_documentos_fk1')->references('id')->on('ac_pacientes_atendidos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_documentos', function(Blueprint $table)
		{
			$table->dropForeign('ac_ac_documentos_fk');
			$table->dropForeign('ac_documentos_fk1');
		});
	}

}
