<?php

namespace Microboard\Widgets;

use Microboard\Foundations\Widget;
use Microboard\Models\Permission;
use Microboard\Models\Role;

class PermissionsCount extends Widget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'background' => 'bg-white',
        'icon-background' => 'red',
        'text' => 'dark'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('microboard::state', [
            'config' => $this->config,
            'title' => trans('microboard::pages.widgets.permissions-count.title'),
            'info' => trans('microboard::pages.widgets.permissions-count.info'),
            'icon' => 'ni ni-key-25',
            'count' => Permission::count()
        ]);
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return auth()->user()->can('viewAny', new Role);
    }
}
