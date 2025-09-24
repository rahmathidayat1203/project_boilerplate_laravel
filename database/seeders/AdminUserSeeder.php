<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (admin)
        $user = User::first();
        
        if ($user) {
            // Get admin role
            $adminRole = Role::where('name', 'admin')->first();
            
            if ($adminRole) {
                // Assign admin role to the user
                $user->assignRole($adminRole);
            }
        }
    }
}
