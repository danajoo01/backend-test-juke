<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name' => "Jakarta Selatan",
                'province_id' => 1,
            ],
            [
                'name' => "Jakarta Barat",
                'province_id' => 1,
            ],
            [
                'name' => "Jakarta Pusat",
                'province_id' => 1,
            ],
            [
                'name' => "Padang",
                'province_id' => 2,
            ],
            [
                'name' => "Bukittinggi",
                'province_id' => 2,
            ],
        ]);
    }
}
