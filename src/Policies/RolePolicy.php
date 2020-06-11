<?php

namespace Microboard\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Microboard\Models\Role;
use App\User;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->permissions()->contains('name', 'roles-viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return mixed
     */
    public function view(User $user, Role $model)
    {
        return $user->permissions()->contains('name', 'roles-view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->permissions()->contains('name', 'roles-create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return mixed
     */
    public function update(User $user, Role $model)
    {
        return $user->permissions()->contains('name', 'roles-update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Role  $model
     * @return mixed
     */
    public function delete(User $user, Role $model)
    {
        return $user->permissions()->contains('name', 'roles-delete');
    }
}
