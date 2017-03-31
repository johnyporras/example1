<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorFunerariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_funerario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique();
            $table->string('razon_social')->nullable();
            $table->string('rif')->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefono', 20)->nullable();        
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
        Schema::drop('proveedor_funerario');
    }
}
