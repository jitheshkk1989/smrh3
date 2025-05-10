<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Clear Cache (Important for Spatie Permissions)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Define Permissions
        $permissions = [
            'view-dashboard',
            'view-account-dashboard',
            'manage-users',
            'manage-employees',
            'view-profile',
            'edit-profile',
            'create-user',
            'list-users',
            'create-employee',
            'list-employees',
            'manage-permissions',
            'manage-menu-permissions',
            'view-ui-elements',
            'view-ui-colors',
            'view-ui-typography',
            'manage-settings',
            'view-general-settings',
            'view-email-settings',
            'view-notification-settings',
        ];

        // 3. Create Permissions (Efficiently)
        $permissionObjects = [];
        foreach ($permissions as $permission) {
            $permissionObjects[] = ['name' => $permission, 'guard_name' => 'web'];
        }
        Permission::insert($permissionObjects);

        $this->command->info('Permissions created.');

        // 4. Assign Permissions to 'admin@smrh.com' User
        $user = User::where('email', 'admin@smrh.com')->first();

        if ($user) {
            $user->syncPermissions($permissions); // Efficiently assign all at once
            $this->command->info('Permissions assigned to admin@smrh.com');
        } else {
            $this->command->error('User admin@smrh.com not found.');
        }
    }
}