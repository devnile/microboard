<?php

namespace Microboard\Widgets;

use Microboard\Foundations\Widget;
use Microboard\Models\Role;

class DefaultRole extends Widget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'background' => 'bg-white',
        'icon-background' => 'primary',
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
            'title' => trans('microboard::pages.widgets.default-role.title'),
            'info' => trans('microboard::pages.widgets.default-role.info'),
            'icon' => 'ni ni-key-25',
            'count' => Role::where('name', config('microboard.roles.default', 'admin'))->first()->display_name
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
