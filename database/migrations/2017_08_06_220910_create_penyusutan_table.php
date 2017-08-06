<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyusutanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PENYUSUTAN', function (Blueprint $table) {
            $table->increments('ID');
            $table->char('UNIT_CODE', 5);
            $table->integer('YEAR');
            $table->integer('NO');
            $table->string('FUNGSI', 132)->nullable();
            $table->string('BIAYA', 32)->nullable();
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
        Schema::drop('PENYUSUTAN');
    }

}
