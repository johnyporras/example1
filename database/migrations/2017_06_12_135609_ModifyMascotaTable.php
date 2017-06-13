<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyMascotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('mascotas', function ($table) {
    
            $table->enum('tipo', ['gato', 'perro'])->after('fecha')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('mascotas', function ($table) {
    
            $table->dropColumn('tipo');
        });

    }
}
