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
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'role_id' => $adminRole->id,
               
                
            ],[
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('123'),
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'role_id' => $vendorRole->id,
             

            ],
            [
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
