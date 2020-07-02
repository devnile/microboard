<?php

namespace Microboard;

use Exception;
use Illuminate\Support\Str;
use Microboard\Models\Role;

class Factory
{
    /**
     * creates permissions of the given resource for the given role.
     *
     * @param Role $role
     * @param array $resources
     * @throws Exception
     */
    public function createResourcesPermissionsFor(Role $role, array $resources)
    {
        foreach ($resources as $model => $abilities) {
            $this->createPermissionsFor($role, $model, $abilities);
        }
    }

    /**
     * creates resource's permissions for the given role.
     *
     * @param Role $role
     * @param string $model
     * @param array|null $abilities
     * @throws Exception
     */
    public function createPermissionsFor(Role $role, $model, $abilities = [])
    {
        if ($model !== 'dashboard') {
            $model = Str::of($model)->snake()->plural();
        }

        if (empty($abilities)) {
            $abilities = ['viewAny', 'view', 'create', 'update', 'delete'];
        }

        if (! method_exists($role, 'permissions')) {
            throw new Exception('Role not accepted or don\'t have permissions relationship');
        }

        foreach ($abilities as $ability) {
            $role->permissions()->firstOrCreate([
                'name' => "{$model}-{$ability}",
            ]);
        }
    }
}
