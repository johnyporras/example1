<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuenta_id')->unsigned();
            $table->integer('tamano_id')->unsigned();
            $table->string('nombre');
            $table->string('raza');
            $table->string('color_pelage');
            $table->integer('edad');
            $table->date('fecha');
            $table->enum('tipo', ['perro', 'gato']);
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('cuenta_id')->references('id')->on('ac_cuenta')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('tamano_id')->references('id')->on('tamanos')
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
        Schema::drop('mascotas');
    }
}
