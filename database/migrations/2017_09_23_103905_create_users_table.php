<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 50);
			$table->string('email')->unique();
			$table->string('password');
			$table->string('department', 50)->nullable();
			$table->integer('type')->index('type');
			$table->string('user', 20)->unique('avu_user');
			$table->string('active', 1)->default('S');
			$table->integer('detalles_usuario_id')->comment('Id proveedor, Id Afiliado o ID Aseguradora (campo de relacion de usuario con sus detalles)');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->text('salt')->nullable();
			$table->date('ultimo_acceso')->nullable();
			$table->string('pregunta_1')->nullable();
			$table->string('respuesta_1')->nullable();
			$table->string('pregunta_2')->nullable();
			$table->string('respuesta_2')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
