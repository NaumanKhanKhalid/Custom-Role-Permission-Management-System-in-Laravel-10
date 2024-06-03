<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserBasicInformation;
use App\Models\User;

class UserBasicInformationSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $userInformation = [
            [
                'user_id' => $users->where('email', 'admin@gmail.com')->first()->id,
                'first_name' => 'Noman',
                'last_name' => 'Khan',
                'dob' => '1990-01-01',
                'address' => '123 Main St, City',
                'phone' => '123-456-7890',
                'profile_picture' => "avatar.jpg",

            ],
            [
                'user_id' => $users->where('email', 'vendor@gmail.com')->first()->id,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'dob' => '1990-01-01',
                'address' => '123 Main St, City',
                'phone' => '123-456-7890',
                'profile_picture' => "avatar.jpg",

            ],
            [
                'user_id' => $users->where('email', 'client@gmail.com')->first()->id,
                'first_name' => 'Mick',
                'last_name' => 'blue',
                'dob' => '1990-01-01',
                'address' => '123 Main St, City',
                'phone' => '123-456-7890',
                'profile_picture' => "avatar.jpg",

            ],
        ];

        UserBasicInformation::insert($userInformation);
    }
}
