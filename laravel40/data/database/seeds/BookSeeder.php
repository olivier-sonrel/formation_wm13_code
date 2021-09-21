<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => "Le chat passe a table",
                'description' => 'Bande dessinee charcastique',
                'author_id' =>'1',
                'year' => '2001',
            ],
            [
                'title' => "KVETCH!",
                'description' => 'etude sociologique du bazar et du truc',
                'author_id' =>'2',
                'year' => '2005',
            ],
            [
                'title' => "No Comment",
                'description' => 'dessein trach etc',
                'author_id' =>'3',
                'year' => '2006',
            ]
        ]);
    }
}
