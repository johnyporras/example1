<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcDetprogpagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_detprogpago', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_factura')->nullable()->unsigned();
            $table->doble('montofact')->nullable();
            $table->doble('montoimp1')->nullable();
            $table->doble('montoimp2')->nullable();
            $table->doble('montoimp3')->nullable();
            $table->integer('estatus')->nullable()->unsigned();
            $table->integer('id_progpago')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_progpago')->references('id')->on('ac_progpago')
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
        Schema::dropIfExists('ac_detprogpago');
    }
}
