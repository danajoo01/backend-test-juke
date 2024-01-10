<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'first_name' => "Hari",
                'last_name' => "S",
                'phone_number' => "089900001999",
                'ktp_number' => "199900001111999",
            ],
        ]);
    }
}
