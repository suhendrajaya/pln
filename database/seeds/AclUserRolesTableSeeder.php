<?php

use Illuminate\Database\Seeder;

class AclUserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ACL_USER_ROLES')->insert([
            ['USER_ID' => 2, 'ROLE_ID' => 1],
            ['USER_ID' => 2, 'ROLE_ID' => 2],
        ]);
    }

}
