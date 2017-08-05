<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('USERS', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('NAME');
            $table->string('USERNAME')->unique();
            $table->string('EMAIL')->unique();
            $table->string('PASSWORD', 60);
            $table->date('BIRTH_DATE')->nullable();
            $table->char('IS_ACTIVED', 1)->nullable();
            $table->char('UNIT_CODE',5);
            $table->integer('REGIONAL_ID')->nullable();
            $table->rememberToken();
            $table->nullableTimestamps();
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
        Schema::drop('USERS');
    }
}