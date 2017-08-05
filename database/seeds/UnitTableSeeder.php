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
        DB::table('UNITS')->insert([
            ['CODE' => '4A00', 'DIVISION_CODE' => '0401', 'NAME' => 'UKSU - UIP Pembangkit Sumatera (Eks. UIP I)'],
            ['CODE' => '4B00', 'DIVISION_CODE' => '0401', 'NAME' => 'USBU - UIP Sumatera Bagian Utara (Eks.UIP II)'],
            ['CODE' => '4Q00', 'DIVISION_CODE' => '0401', 'NAME' => 'USBG - UIP Sumatera Bagian Tengah'],
            ['CODE' => '4C00', 'DIVISION_CODE' => '0401', 'NAME' => 'USBS - UIP Sumatera Bagian Selatan (Eks. UIP III)'],
            ['CODE' => '2000', 'DIVISION_CODE' => '0401', 'NAME' => 'KSBU - Pembangkit Sumatera Bagian Utara'],
            ['CODE' => '2100', 'DIVISION_CODE' => '0401', 'NAME' => 'KSBS - Pembangkit Sumatera Bagian Selatan'],
            ['CODE' => '3200', 'DIVISION_CODE' => '0401', 'NAME' => 'P3BS - P3B Sumatera'],
            ['CODE' => '6100', 'DIVISION_CODE' => '0401', 'NAME' => 'WNAD - Wilayah NAD'],
            ['CODE' => '6200', 'DIVISION_CODE' => '0401', 'NAME' => 'WSBU - Wilayah Sumatera Utara'],
            ['CODE' => '6400', 'DIVISION_CODE' => '0401', 'NAME' => 'WRKR - Wilayah Riau & Kepulauan Riau'],
            ['CODE' => '6300', 'DIVISION_CODE' => '0401', 'NAME' => 'WSBB - Wilayah Sumatera Barat'],
            ['CODE' => '6500', 'DIVISION_CODE' => '0401', 'NAME' => 'WSJB - Wilayah Sumsel, Jambi, Bengkulu'],
            ['CODE' => '6600', 'DIVISION_CODE' => '0401', 'NAME' => 'WBBL - Wilayah Bangka Belitung'],
            ['CODE' => '6700', 'DIVISION_CODE' => '0401', 'NAME' => 'DLPG - Distribusi Lampung'],
            // ---
            ['CODE' => '4D00', 'DIVISION_CODE' => '0101', 'NAME' => 'UISJ - UIP Interkoneksi Sumatera Jawa (Eks. UIP IV)'],
            ['CODE' => '4E00', 'DIVISION_CODE' => '0101', 'NAME' => 'UJBB - UIP Jawa Bagian Barat (Eks. UIP V)'],
            ['CODE' => '3400', 'DIVISION_CODE' => '0101', 'NAME' => 'TJBB - Unit Transmisi Jawa Bagian Barat'],
            ['CODE' => '5400', 'DIVISION_CODE' => '0101', 'NAME' => 'DDKI - Distribusi DKI Jaya'],
            ['CODE' => '5600', 'DIVISION_CODE' => '0101', 'NAME' => 'DBTN - Distribusi Banten'],
            //
            ['CODE' => '4F00', 'DIVISION_CODE' => '0201', 'NAME' => 'UJT1 - UIP Jawa Bagian Tengah I (Eks. UIP VI)'],
            ['CODE' => '4P00', 'DIVISION_CODE' => '0201', 'NAME' => 'UJT2 - UIP Jawa Bagian Tengah II (Eks. UIP XVI)'],
            ['CODE' => '2200', 'DIVISION_CODE' => '0201', 'NAME' => 'KTJB - Pembangkitan Tanjung Jati B'],
            ['CODE' => '2300', 'DIVISION_CODE' => '0201', 'NAME' => ' TJBT - Unit Transmisi Jawa Bagian Tengah'],
            ['CODE' => '5300', 'DIVISION_CODE' => '0201', 'NAME' => 'DJBB - Distribusi Jawa Barat'],
            ['CODE' => '5200', 'DIVISION_CODE' => '0201', 'NAME' => ' DJTY - Distribusi Jawa Tengah & Yogyakarta'],
            ['CODE' => '3300', 'DIVISION_CODE' => '0201', 'NAME' => 'P2BJ - Pusat Pengatur Beban'],
            // 
            ['CODE' => '4G00', 'DIVISION_CODE' => '0301', 'NAME' => 'UJB1 - UIP Jawa Bagian Timur & Bali I (Eks.UIP VII)'],
            ['CODE' => '4H00', 'DIVISION_CODE' => '0301', 'NAME' => 'UJB2 - UIP Jawa Bagian Timur & Bali II (Eks.UIP VIII)'],
            ['CODE' => '3600', 'DIVISION_CODE' => '0301', 'NAME' => 'TJTB - Unit Transmisi Jawa Bagian Timur dan Bali'],
            ['CODE' => '5100', 'DIVISION_CODE' => '0301', 'NAME' => 'DJBT - Distribusi Jawa Timur'],
            ['CODE' => '5500', 'DIVISION_CODE' => '0301', 'NAME' => 'DJBI - Distribusi Bali'],
            ['CODE' => '4K00', 'DIVISION_CODE' => '0301', 'NAME' => 'UNTG - UIP Nusa Tenggara (Eks. UIP XI)'],
            ['CODE' => '7700', 'DIVISION_CODE' => '0301', 'NAME' => 'WNTB - Wilayah Nusa Tenggara Barat'],
            ['CODE' => '7800', 'DIVISION_CODE' => '0301', 'NAME' => 'WNTT - Wilayah Nusa Tenggara Timur'],
            //
            ['CODE' => '4J00', 'DIVISION_CODE' => '0501', 'NAME' => 'UKBT - UIP Kalimantan Bagian Timur (Eks. UIP X)'],
            ['CODE' => '4I00', 'DIVISION_CODE' => '0501', 'NAME' => 'UKBG - UIP Kalimantan Bagian Tengah (Eks. UIP IX)'],
            ['CODE' => '4R00', 'DIVISION_CODE' => '0501', 'NAME' => 'UKBB - UIP Kalimantan Bagian Barat'],
            ['CODE' => '6800', 'DIVISION_CODE' => '0501', 'NAME' => 'WKBB - Wilayah Kalimantan Barat'],
            ['CODE' => '7100', 'DIVISION_CODE' => '0501', 'NAME' => 'WKST - Wilayah Kalimantan Selatan dan Tengah'],
            ['CODE' => '7200', 'DIVISION_CODE' => '0501', 'NAME' => 'WKTU - Wilayah Kalimantan Timur dan Utara'],
            //
            ['CODE' => '4L00', 'DIVISION_CODE' => '0601', 'NAME' => 'USLU - UIP Sulawesi Bagian Utara (Eks. UIP XII)'],
            ['CODE' => '4M00', 'DIVISION_CODE' => '0601', 'NAME' => 'USLS - UIP Sulawesi Bagian Selatan (Eks.UIP XIII)'],
            ['CODE' => '7300', 'DIVISION_CODE' => '0601', 'NAME' => 'WSUT - Wilayah Sulawesi Utara, Tengah & Gorontalo'],
            ['CODE' => '7400', 'DIVISION_CODE' => '0601', 'NAME' => 'WSSB - Wilayah Sulawesi Selatan, Tenggara & Barat'],
            //
            ['CODE' => '4N00', 'DIVISION_CODE' => '0701', 'NAME' => 'UP2B - UIP Papua (Eks. UIP XIV)'],
            ['CODE' => '4O00', 'DIVISION_CODE' => '0701', 'NAME' => 'UMMU - UIP Maluku (Eks. UIP XV)'],
            ['CODE' => '7500', 'DIVISION_CODE' => '0701', 'NAME' => 'WMMU - Wilayah Maluku & Maluku Utara'],
            ['CODE' => '7600', 'DIVISION_CODE' => '0701', 'NAME' => 'WP2B - Wilayah Papua dan Papua Barat'],
//            ['CODE' => '', 'DIVISION_CODE' => '', 'NAME' => ''],
        ]);
    }

}
