<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(AclRolesTableSeeder::class);
        $this->call(AclUserRolesTableSeeder::class);
        $this->call(RegionalTableSeeder::class);
        $this->call(UnitTableSeeder::class);

        Model::reguard();
    }

}
