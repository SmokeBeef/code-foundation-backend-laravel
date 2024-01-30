<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_id' => Str::uuid(),
                'category_name' => 'Komik'
            ],
            [
                'category_id' => Str::uuid(),
                'category_name' => 'Novel'
            ],
            [
                'category_id' => Str::uuid(),
                'category_name' => 'Biografi'
            ],
        ]);
    }
}
