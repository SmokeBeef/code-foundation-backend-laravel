<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert(
            [
                [
                    "user_id" => Str::uuid(),
                    "user_name" => "Deva Nanda",
                    "user_address" => "Tulungagung",
                    "user_username" => "nanda",
                    "user_email" => "devananda@gmail.com",
                    "user_phonenumber" => "089999111777",
                    "user_password" => Hash::make("123"),
                    "user_isadmin" => true
                ],
                [
                    "user_id" => Str::uuid(),
                    "user_name" => "Nanda Alfarizi",
                    "user_address" => "Malang",
                    "user_username" => "alfa",
                    "user_email" => "nandaalfarizi@gmail.com",
                    "user_phonenumber" => "089999111777",
                    "user_password" => Hash::make("123"),
                    "user_isadmin" => false
                ],
            ],
        );
    }
}
