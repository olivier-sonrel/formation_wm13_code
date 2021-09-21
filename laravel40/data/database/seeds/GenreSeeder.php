<?php

use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'name' => "BD",
            ],
            [
                'name' => "Essai",
            ],
            [
                'name' => "Comique",
            ],
            [
                'name' => "Social",
            ]
        ]);
    }
}
