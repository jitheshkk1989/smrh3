<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create permissions if they don't exist
        if (!Permission::where('name', 'view-dashboard')->exists()) {
            Permission::create(['name' => 'view-dashboard']);
        }
        if (!Permission::where('name', 'manage-users')->exists()) {
            Permission::create(['name' => 'manage-users']);
        }
        if (!Permission::where('name', 'edit-profile')->exists()) {
            Permission::create(['name' => 'edit-profile']);
        }

        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // Assign permissions to roles (this will re-sync if already assigned)
        $adminRole->syncPermissions(['view-dashboard', 'manage-users']);
        $editorRole->syncPermissions(['view-dashboard', 'edit-profile']);

        // Get the user
        $user = User::where('email', 'admin@smrh.com')->first();

        if ($user) {
            // Assign role to the user (this will re-sync if already assigned)
            $user->syncRoles(['admin']);
        } else {
            $this->command->warn("User with email 'admin@smrh.com' not found. Role not assigned.");
        }
    }
}