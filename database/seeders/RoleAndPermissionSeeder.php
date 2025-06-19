<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use App\Models\RolePermission;

class RoleAndPermissionSeeder extends Seeder
{
   public function run()
    {
        // Create or get admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password') // change this if needed
            ]
        );

        // Create or get normal user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Normal User',
                'password' => bcrypt('password')
            ]
        );

        // Assign roles
        $adminRole = UserRole::create([
            'user_id' => $admin->id,
            'role_name' => 'Admin',
            'description' => 'Can do everything'
        ]);

        $userRole = UserRole::create([
            'user_id' => $user->id,
            'role_name' => 'User',
            'description' => 'Can create and view tasks only'
        ]);

        // Admin permissions: CRUD
        foreach (['Create', 'Retrieve', 'Update', 'Delete'] as $perm) {
            RolePermission::create([
                'role_id' => $adminRole->role_id,
                'description' => $perm
            ]);
        }

        // User permissions: Create, Retrieve only
        foreach (['Create', 'Retrieve'] as $perm) {
            RolePermission::create([
                'role_id' => $userRole->role_id,
                'description' => $perm
            ]);
        }
    }
}
