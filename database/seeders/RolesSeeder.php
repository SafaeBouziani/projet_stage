<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $permissions_admin = [
            'view_requests',
            'approve_request',
            'decline_request',
            'generate_pdf',
            'view_users',
            'manage_users',
            'view_notifications',
            'manage_permissions',
        ];

        foreach ($permissions_admin as $permission) {
            Permission::findOrCreate($permission);
        }
        
        // Sync permissions to the role
        $admin->syncPermissions($permissions_admin);
        
        $permissions_user = [
            'view_request',
            'submit_request',
            'view_notifications',
        ];

        foreach ($permissions_user as $permission) {
            Permission::findOrCreate($permission);
        }
        
        // Sync permissions to the role
        $user->syncPermissions($permissions_user);
    }
}
