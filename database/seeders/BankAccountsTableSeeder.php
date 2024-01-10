<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_accounts')->insert([
            [
                'name' => "BCA",
            ],
            [
                'name' => "BRI",
            ],
            [
                'name' => "Mandiri",
            ],
            [
                'name' => "BNI",
            ],
        ]);
    }
}
