<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunerarioDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funerario_detalle', function (Blueprint $table) {
            $table->integer('funerario_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->integer('monto');
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('funerario_id')
                        ->references('id')->on('funerario')
                        ->onUpdate('CASCADE');
                $table->foreign('proveedor_id')
                        ->references('id')->on('proveedor_funerario')
                        ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funerario_detalle');
    }
}
