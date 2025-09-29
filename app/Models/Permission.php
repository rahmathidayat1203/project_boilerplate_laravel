<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    /**
     * Find a permission by its id (and optionally guardName).
     *
     * @param  int|string  $id
     * @param  string|null  $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     */
    public static function findById(int|string $id, ?string $guardName = null): \Spatie\Permission\Contracts\Permission
    {
        $guardName = $guardName ?? \Spatie\Permission\Guard::getDefaultName(static::class);
        $permission = static::getPermissions(['id' => $id, 'guard_name' => $guardName])->first();

        if (! $permission) {
            throw \Spatie\Permission\Exceptions\PermissionDoesNotExist::withId($id, $guardName);
        }

        return $permission;
    }
    
    /**
     * Find a permission by its name (and optionally guardName).
     *
     * @param  string  $name
     * @param  string|null  $guardName
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     */
    public static function findByName(string $name, ?string $guardName = null): \Spatie\Permission\Contracts\Permission
    {
        $guardName = $guardName ?? \Spatie\Permission\Guard::getDefaultName(static::class);
        $permission = static::getPermissions(['name' => $name, 'guard_name' => $guardName])->first();
        if (! $permission) {
            throw \Spatie\Permission\Exceptions\PermissionDoesNotExist::create($name, $guardName);
        }

        return $permission;
    }
    
    /**
     * Find or create permission by its name (and optionally guardName).
     *
     * @param  string  $name
     * @param  string|null  $guardName
     */
    public static function findOrCreate(string $name, ?string $guardName = null): \Spatie\Permission\Contracts\Permission
    {
        $guardName = $guardName ?? \Spatie\Permission\Guard::getDefaultName(static::class);
        $permission = static::getPermissions(['name' => $name, 'guard_name' => $guardName])->first();

        if (! $permission) {
            return static::query()->create(['name' => $name, 'guard_name' => $guardName]);
        }

        return $permission;
    }
}