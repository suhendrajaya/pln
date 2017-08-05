<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UNITS', function (Blueprint $table) {
            $table->increments('ID');
            $table->char('CODE',5)->unique();
            $table->char('DIVISION_CODE',5);
            $table->string('NAME',128);

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
        Schema::drop('UNITS');
    }

}
