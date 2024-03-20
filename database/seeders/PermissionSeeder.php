<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'create_user'],
            ['name' => 'view_users'],
            ['name' => 'edit_user'],
            ['name' => 'delete_user'],
        ];


        Permission::insert($permissions);
    }
}
