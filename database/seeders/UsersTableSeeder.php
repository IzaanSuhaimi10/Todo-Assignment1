<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            "name" => "user",
            "email" => "user1@gmail.com",
            "password" => Hash::make("12345678"),
        ]);
    }
}

