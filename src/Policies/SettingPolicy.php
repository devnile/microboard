<?php

namespace Microboard\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Microboard\Models\Setting;
use App\User;

class SettingPolicy
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
        return $user->permissions()->contains('name', 'settings-viewAny');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->permissions()->contains('name', 'settings-create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->permissions()->contains('name', 'settings-update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Setting  $model
     * @return mixed
     */
    public function delete(User $user, Setting $model)
    {
        return $user->permissions()->contains('name', 'settings-delete');
    }
}
