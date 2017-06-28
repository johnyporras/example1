<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pais_id')->nullable()->unsigned();
            $table->text('terminos')->nullable();
                $table->foreign('pais_id')->references('id')->on('paises')
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
        Schema::dropIfExists('terminos');
    }
}
