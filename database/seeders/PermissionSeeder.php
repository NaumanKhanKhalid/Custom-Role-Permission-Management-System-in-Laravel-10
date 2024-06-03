<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'create_user'],
            ['name' => 'view_users'],
            ['name' => 'edit_user'],
            ['name' => 'delete_user'],
            ['name' => 'create_service'],
            ['name' => 'view_services'],
            ['name' => 'edit_service'],
            ['name' => 'delete_service'],
        ];

        Permission::insert($permissions);
    }
}
