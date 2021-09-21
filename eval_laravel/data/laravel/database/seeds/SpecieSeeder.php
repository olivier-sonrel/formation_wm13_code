<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('species')->insert([
            [
                'name' => "Baleine",
            ],
            [
                'name' => "Yene",
            ],
            [
                'name' => "Ane",
            ]
        ]);
    }
}
