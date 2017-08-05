<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REKAPITULASI_PENJUALAN', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('ORDER_ID');
            $table->char('UNIT_CODE',5);
            $table->integer('YEAR');
            $table->string('TARIF_CODE1', 32)->nullable();
            $table->string('TARIF_CODE2', 32)->nullable();
            $table->string('PJL_Q1', 32)->nullable();
            $table->string('PJL_Q2', 32)->nullable();
            $table->string('PJL_Q3', 32)->nullable();
            $table->string('PJL_Q4', 32)->nullable();
            $table->string('PJL_SUM', 32)->nullable();
            $table->string('PDP_Q1', 32)->nullable();
            $table->string('PDP_Q2', 32)->nullable();
            $table->string('PDP_Q3', 32)->nullable();
            $table->string('PDP_Q4', 32)->nullable();
            $table->string('PDP_SUM', 32)->nullable();
            $table->string('SELLING_PRICE', 32)->nullable();
            $table->integer('UPLOADBY_ID');
            $table->string('UPLOADBY_NAME', 128);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('REKAPITULASI_PENJUALAN');
    }

}
