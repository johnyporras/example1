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
			$table->string('imagen_perfil');
			$table->integer('type')->index('type');
			$table->boolean('active')->default(true);
			$table->string('pregunta_1');
			$table->string('respuesta_1');
			$table->string('pregunta_2');
			$table->string('respuesta_2');
			$table->date('ultimo_acceso');
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
		Schema::drop('users');
	}

}
