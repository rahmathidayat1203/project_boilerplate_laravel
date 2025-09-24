<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test role creation.
     */
    public function test_admin_can_create_role()
    {
        $this->seed();
        
        $admin = User::first();
        $admin->assignRole('admin');
        
        $response = $this->actingAs($admin)->post('/roles', [
            'name' => 'editor',
        ]);

        $response->assertRedirect('/roles');
        $this->assertDatabaseHas('roles', [
            'name' => 'editor',
        ]);
    }

    /**
     * Test permission assignment to role.
     */
    public function test_admin_can_assign_permission_to_role()
    {
        $this->seed();
        
        $admin = User::first();
        $admin->assignRole('admin');
        
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'edit-posts']);
        
        $response = $this->actingAs($admin)->put("/roles/{$role->id}", [
            'name' => 'editor',
            'permissions' => [$permission->id],
        ]);

        $response->assertRedirect('/roles');
        $this->assertTrue($role->hasPermissionTo('edit-posts'));
    }
}