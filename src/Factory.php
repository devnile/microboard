<?php

namespace Microboard;

use Microboard\Models\Permission;
use Microboard\Models\Role;

class Factory
{
    public function createResourcesPermissionsFor(Role $role, array $permissions)
    {
        foreach ($permissions as $model => $abilities) {
            if (is_array($abilities)) {
                $this->createPermissionsFor($model, $role, $abilities);
            }
        }
    }

    protected function createPermissionsFor($model, Role $role, array $abilities)
    {
        if (empty($abilities)) {
            $abilities = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete'];
        }

        foreach ($abilities as $ability) {
            $role->permissions()->updateOrCreate([
                'name' => "{$model}-{$ability}",
            ], [
                'name' => "{$model}-{$ability}",
                'display_name' => "{$role->display_name} can {$ability} {$model}"
            ]);
        }
    }
}
