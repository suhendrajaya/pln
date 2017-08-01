<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('UNIT')->insert([
            ['NAME' => 'Wil. NAD', 'REGIONAL_ID' => 1],
            ['NAME' => 'Wil. Sumut', 'REGIONAL_ID' => 1],
            ['NAME' => 'Wil. Riau & Kepri', 'REGIONAL_ID' => 1],
            ['NAME' => 'Wil. S2JB', 'REGIONAL_ID' => 1],
            ['NAME' => 'Wil. Babel', 'REGIONAL_ID' => 1],
            ['NAME' => 'Dist. Lampung', 'REGIONAL_ID' => 1]
        ]);
    }

}
