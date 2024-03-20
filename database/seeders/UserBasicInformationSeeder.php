<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserBasicInformation;

class UserBasicInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userInformation = [
            [
                'user_id' => 1,
                'first_name' => 'Noman',
                'last_name' => 'Khan',
                'dob' => '1990-01-01',
                'address' => '123 Main St, City',
                'phone' => '123-456-7890',
            ],
            [
                'user_id' => 2,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'dob' => '1990-01-01',
                'address' => '123 Main St, City',
                'phone' => '123-456-7890',
            ],
        ];

        UserBasicInformation::insert($userInformation);
    }
}
