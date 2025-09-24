<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
     * Find a role by its id and guard name.
     *
     * @param  int|string  $id
     * @param  string|null  $guardName
     *
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findById(int|string $id, ?string $guardName = null): self
    {
        $guardName = $guardName ?? \Spatie\Permission\Guard::getDefaultName(static::class);

        $role = static::where('id', $id)->where('guard_name', $guardName)->first();

        if (! $role) {
            throw \Spatie\Permission\Exceptions\RoleDoesNotExist::withId($id);
        }

        return $role;
    }

    /**
     * Find a role by its name and guard name.
     *
     * @param  string  $name
     * @param  string|null  $guardName
     *
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findByName(string $name, ?string $guardName = null): self
    {
        $guardName = $guardName ?? \Spatie\Permission\Guard::getDefaultName(static::class);

        $role = static::where('name', $name)->where('guard_name', $guardName)->first();

        if (! $role) {
            throw \Spatie\Permission\Exceptions\RoleDoesNotExist::named($name);
        }

        return $role;
    }

    /**
     * Find or create role by its name (and optionally guardName).
     *
     * @param  string  $name
     * @param  string|null  $guardName
     */
    public static function findOrCreate(string $name, ?string $guardName = null): self
    {
        $guardName = $guardName ?? \Spatie\Permission\Guard::getDefaultName(static::class);

        $role = static::where('name', $name)->where('guard_name', $guardName)->first();

        if (! $role) {
            return static::query()->create(['name' => $name, 'guard_name' => $guardName]);
        }

        return $role;
    }
}