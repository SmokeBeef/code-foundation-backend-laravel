<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'author_id' => Str::uuid(),
                'author_name' => 'Tere Liye',
                'author_birthplace' => 'Medan',
                'author_birthdate' => '1979-05-21'
            ],
            [
                'author_id' => Str::uuid(),
                'author_name' => 'Khen Cahyo',
                'author_birthplace' => 'Kediri',
                'author_birthdate' => '2002-04-13'
            ],
        ]);
    }
}
