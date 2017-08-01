<?php

use Illuminate\Database\Seeder;

class RegionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('REGIONAL')->insert([
            ['NAME' => 'anonymous'],
            ['NAME' => 'Regional Sumatera'],
            ['NAME' => 'Regional Kalimantan'],
            ['NAME' => 'Regional SNT'],
            ['NAME' => 'Regional MP'],
            ['NAME' => 'Regional JBB'],
            ['NAME' => 'Regional JBT'],
            ['NAME' => 'Regional JBTB'],
            ['NAME' => 'Anak Perusahaan'],
            ['NAME' => 'Holding'],
            ['NAME' => 'Konsolidasi']
        ]);
    }

}
