<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the permission
        Permission::firstOrCreate(['name' => 'manage-menus', 'guard_name' => 'web']);

        // Create menu items
        $menus = [
            [
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'permission_name' => 'dashboard-list', // Assuming a permission for the dashboard
                'icon' => 'fa-tachometer-alt', // AdminLTE icon
                'order' => 0,
            ],
            [
                'name' => 'Users',
                'route' => 'users.index',
                'permission_name' => 'user-list',
                'icon' => 'fa-users',
                'order' => 1,
            ],
            [
                'name' => 'Roles',
                'route' => 'roles.index',
                'permission_name' => 'role-list',
                'icon' => 'fa-user-tag',
                'order' => 2,
            ],
            [
                'name' => 'Permissions',
                'route' => 'permissions.index',
                'permission_name' => 'permission-list',
                'icon' => 'fa-key',
                'order' => 3,
            ],
            [
                'name' => 'Settings',
                'route' => 'settings.index',
                'permission_name' => 'setting-list',
                'icon' => 'fa-cogs',
                'order' => 4,
            ],
            [
                'name' => 'Menu Management',
                'route' => 'menus.index',
                'permission_name' => 'manage-menus',
                'icon' => 'fa-bars',
                'order' => 5,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate($menu);
        }
    }
}