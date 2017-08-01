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
            $table->decimal('PJL_Q1', 10, 2)->nullable();
            $table->decimal('PJL_Q2', 10, 2)->nullable();
            $table->decimal('PJL_Q3', 10, 2)->nullable();
            $table->decimal('PJL_Q4', 10, 2)->nullable();
            $table->decimal('PJL_SUM', 10, 2)->nullable();
            $table->decimal('PDP_Q1', 10, 2)->nullable();
            $table->decimal('PDP_Q2', 10, 2)->nullable();
            $table->decimal('PDP_Q3', 10, 2)->nullable();
            $table->decimal('PDP_Q4', 10, 2)->nullable();
            $table->decimal('PDP_SUM', 10, 2)->nullable();
            $table->decimal('SELLING_PRICE', 10, 2)->nullable();
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
