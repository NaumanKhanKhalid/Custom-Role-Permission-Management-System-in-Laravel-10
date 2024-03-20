<?php

namespace Database\Seeders;

use Carbon\Carbon;
use database;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'role_id' => 1,
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
            [
                'email' => 'user@gmail.com',
                'password' => Hash::make('123'),
                'role_id' => 2,
                'status' => 'Active',
                'created_at' => Carbon::now(),
            ],
        ];
        User::insert($users);
    }
}
