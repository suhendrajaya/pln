<?php

use Illuminate\Database\Seeder;

class AclRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ACL_ROLES')->insert([
            ['NAME' => 'Admin'],
            ['NAME' => 'Unit'],
            ['NAME' => 'Reviewer']
        ]);
    }

}
