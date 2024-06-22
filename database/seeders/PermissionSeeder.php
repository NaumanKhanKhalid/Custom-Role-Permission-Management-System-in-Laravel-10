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
            ['name' => 'create_package'],
            ['name' => 'view_packages'],
            ['name' => 'edit_package'],
            ['name' => 'delete_package'],
            ['name' => 'create_item'],
            ['name' => 'view_items'],
            ['name' => 'edit_item'],
            ['name' => 'delete_item'],
        ];

        Permission::insert($permissions);
    }

}
