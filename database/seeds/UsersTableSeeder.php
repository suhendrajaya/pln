<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('USERS')->insert([
            'username' => 'admin',
            'NAME' => 'admin',
            'EMAIL' => 'suhendrajaya@gmail.com',
            'PASSWORD' => bcrypt('admin'),
            'UNIT_CODE' => '4A00',
            'IS_ACTIVED' => 1
        ]);
    }

}
