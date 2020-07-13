<?php

namespace Microboard;

use Exception;
use Illuminate\Session\Store;
use Illuminate\Support\Str;
use Microboard\Models\Role;

class Factory
{
    /**
     * @var Store
     */
    private Store $session;

    /**
     * Factory constructor.
     *
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

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

    /**
     * @param string $title
     * @param string $body
     * @param string $level
     */
    public function message($title, $body = '', $level = 'info')
    {
        $this->session->flash('flash_notifications.title', $title);
        $this->session->flash('flash_notifications.body', $body);
        $this->session->flash('flash_notifications.level', $level);
    }

    /**
     * @param string $title
     * @param string $body
     */
    public function success($title, $body = '')
    {
        $this->message($title, $body, 'success');
    }

    /**
     * @param string $title
     * @param string $body
     */
    public function error($title, $body = '')
    {
        $this->message($title, $body, 'danger');
    }

    /**
     * @param string $title
     * @param string $body
     */
    public function warning($title, $body = '')
    {
        $this->message($title, $body, 'warning');
    }
}
