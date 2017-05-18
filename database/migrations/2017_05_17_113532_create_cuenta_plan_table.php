<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating roles to users (Many-to-Many)
        Schema::create('cuenta_plan', function (Blueprint $table) {
            $table->integer('cuenta_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->double('monto')->nullable();

            $table->foreign('cuenta_id')->references('id')->on('ac_cuenta')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('ac_planes_extranet')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['cuenta_id', 'plan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta_plan');
    }
}
