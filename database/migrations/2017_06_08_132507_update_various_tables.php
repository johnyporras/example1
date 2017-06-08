<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVariousTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('ac_cuenta', function ($table) {
           $table->renameColumn('producto_id', 'id_producto');
        });

        Schema::table('ac_afiliados', function ($table) {
           $table->renameColumn('cuenta_id', 'id_cuenta');
           $table->renameColumn('estado_id', 'id_estado');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
