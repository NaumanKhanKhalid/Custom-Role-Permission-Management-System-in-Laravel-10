<?php

namespace Database\Seeders;

use database;
use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $vendorRole = Role::where('name', 'Vendor')->first();
        $clientRole = Role::where('name', 'Client')->first();

        $users = [
            [
                'first_name' => 'Noman',
                'last_name' => 'Khan',
                'profile_picture' => "",
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'role_id' => $adminRole->id,


            ],[
                'first_name' => 'John',
                'last_name' => 'Doe',
                'profile_picture' => "",
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'role_id' => $vendorRole->id,


            ],
            [
                'first_name' => 'Mick',
                'last_name' => 'blue',
                'profile_picture' => "",
                'email' => 'client@gmail.com',
                'password' => Hash::make('123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'role_id' => $clientRole->id,

            ],
        ];
        User::insert($users);
    }
}
