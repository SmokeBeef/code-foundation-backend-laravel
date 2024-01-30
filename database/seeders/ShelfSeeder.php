<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shelfs')->insert([
            [
                'shelf_id' => Str::uuid(),
                'shelf_name' => 'A-001',
                'shelf_location' => 'Lantai 1 barat',
                'shelf_capacity' => 20,
            ],
            [
                'shelf_id' => Str::uuid(),
                'shelf_name' => 'A-002',
                'shelf_location' => 'Lantai 1 timur',
                'shelf_capacity' => 50,
            ],
            [
                'shelf_id' => Str::uuid(),
                'shelf_name' => 'A-003',
                'shelf_location' => 'Lantai 2 barat',
                'shelf_capacity' => 40,
            ],
        ]);
    }
}
