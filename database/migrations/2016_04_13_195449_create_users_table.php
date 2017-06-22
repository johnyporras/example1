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
			$table->increments('id');
			$table->string('name', 50);
			$table->string('email')->unique();
			$table->string('user', 20)->unique();
            $table->string('password');
			$table->string('department', 50);
			$table->string('imagen_perfil')->nullable();
			$table->integer('type')->index('type');
			$table->boolean('active')->default(true);
			$table->string('pregunta_1')->nullable();
			$table->string('respuesta_1')->nullable();
			$table->string('pregunta_2')->nullable();
			$table->string('respuesta_2')->nullable();
			$table->date('ultimo_acceso')->nullable();
			$table->integer('detalles_usuario_id')->nullable()->unsigned();
			$table->string('confirm_token',100)->nullable();
            	$table->rememberToken();
            	$table->timestamps();
            	$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}