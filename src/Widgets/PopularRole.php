<?php

namespace Microboard\Widgets;

use Microboard\Foundations\Widget;
use Microboard\Models\Role;

class PopularRole extends Widget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'background' => 'bg-white',
        'icon-background' => 'info',
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
            'title' => trans('microboard::pages.widgets.popular-roles.title'),
            'info' => trans('microboard::pages.widgets.popular-roles.info'),
            'icon' => 'ni ni-key-25',
            'count' => Role::withCount('users')->orderBy('users_count', 'desc')->first()->display_name
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
