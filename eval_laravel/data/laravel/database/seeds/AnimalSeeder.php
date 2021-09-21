<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animals')->insert([
            [
                'name' => "Bacheleot",
                'age' => '67',
                'description' =>'Too old too stupid',
                'sexe' => 'female',
                'weight' =>'78',
                'specie_id' => '1',
            ],
            [
                'name' => "Macron",
                'age' => '45',
                'description' =>'as is species',
                'sexe' => 'male',
                'weight' =>'67',
                'specie_id' => '2',
            ],
            [
                'name' => "Trump",
                'age' => '78',
                'description' =>'The end of the world',
                'sexe' => 'male',
                'weight' =>'78',
                'specie_id' => '3',
            ],
            [
                'name' => "Melenchon",
                'age' => '67',
                'description' =>'Just a joke',
                'sexe' => 'male',
                'weight' =>'67',
                'specie_id' => '3',
            ],
            [
                'name' => "Sarkozy",
                'age' => '67',
                'description' =>'Run away',
                'sexe' => 'male',
                'weight' =>'56',
                'specie_id' => '2',
            ],
            [
                'name' => "Borloo",
                'age' => '67',
                'description' =>'And i was very very very drunked',
                'sexe' => 'male',
                'weight' =>'78',
                'specie_id' => '3',
            ]
        ]);
    }
}

