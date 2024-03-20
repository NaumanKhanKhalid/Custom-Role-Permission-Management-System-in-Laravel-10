<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $role = Role::create(

            ['name' => 'Admin']

        );

        $permissions = Permission::all()->pluck('id');
        $role->permissions()->attach($permissions);

        $userRole = Role::create(

            ['name' => 'User']

        );
        $userPermissions = [

            1, 2, 3, 4,
        ];
        $userRole->permissions()->attach($userPermissions);
    }
}
