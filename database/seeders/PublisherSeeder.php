<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publishers')->insert([
            [
                'publisher_id' => Str::uuid(),
                'publisher_name' => 'Erlangga',
                'publisher_address' => 'Ciracas, Jakarta Timur',
                'publisher_phonenumber' => '085746876541',
                'publisher_email' => 'erlangga@gmail.com'
            ],
            [
                'publisher_id' => Str::uuid(),
                'publisher_name' => 'Gagas Media',
                'publisher_address' => 'Surabaya, Jawa Timur',
                'publisher_phonenumber' => '08813102187',
                'publisher_email' => 'gagasmedia@gmail.com'
            ],
        ]);
    }
}
