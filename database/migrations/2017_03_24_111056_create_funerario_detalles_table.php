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
            $table->increments('id');
            $table->integer('funerario_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->string('factura');
            $table->date('fecha');
            $table->integer('monto');
            $table->text('detalles')->nullable();
            $table->text('doc_factura')->nullable();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('funerario_id')->references('id')->on('funerario')
                ->onUpdate('CASCADE')->onDelete('cascade');
                $table->foreign('proveedor_id')->references('id')->on('proveedor_funerario')
                ->onUpdate('CASCADE')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funerario_detalle');
    }
}
