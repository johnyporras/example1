<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_afiliado')->unsigned();
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('parentesco')->nullable();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_afiliado')->references('id')->on('ac_afiliados')
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
        Schema::dropIfExists('contactos');
    }
}
