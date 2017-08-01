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
        Schema::create('PENJUALAN', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('ORDER_ID');
            $table->integer('ORDER_GROUP_ID');
            $table->integer('UNIT_ID');
            $table->integer('YEAR');
            $table->string('TARIF_CODE1', 32)->nullable();
            $table->string('TARIF_CODE2', 32)->nullable();
            $table->double('PJL_Q1', 15, 2)->nullable();
            $table->double('PJL_Q2', 15, 2)->nullable();
            $table->double('PJL_Q3', 15, 2)->nullable();
            $table->double('PJL_Q4', 15, 2)->nullable();
            $table->double('PJL_SUM', 15, 2)->nullable();
            $table->double('PDP_Q1', 15, 2)->nullable();
            $table->double('PDP_Q2', 15, 2)->nullable();
            $table->double('PDP_Q3', 15, 2)->nullable();
            $table->double('PDP_Q4', 15, 2)->nullable();
            $table->double('PDP_SUM', 15, 2)->nullable();
            $table->double('SELLING_PRICE', 15, 2)->nullable();
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
        Schema::drop('PENJUALAN');
    }

}
