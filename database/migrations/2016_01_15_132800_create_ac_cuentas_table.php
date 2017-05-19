<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_cuenta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_cuenta',30)->unique();
            $table->date('fecha');
            $table->enum('estatus', ['Activo', 'Pendiente', 'Suspendido', 'Anulado'])->default('Pendiente');
            $table->integer('producto_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('producto_id')->references('id')->on('ac_producto')
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
        Schema::drop('ac_cuenta');
    }
}
