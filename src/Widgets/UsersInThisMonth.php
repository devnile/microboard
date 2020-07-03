<?php

namespace Microboard\Widgets;

use App\User;
use Microboard\Foundations\Widget;

class UsersInThisMonth extends Widget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'background' => 'bg-white',
        'icon-background' => 'success',
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
            'title' => trans('microboard::pages.widgets.users-in-this-month.title'),
            'info' => trans('microboard::pages.widgets.users-in-this-month.info'),
            'icon' => 'fa fa-user',
            'count' => User::count(),
            'extra' => User::whereBetween('created_at', [
                now()->firstOfMonth(),
                now()->lastOfMonth()
            ])->count()
        ]);
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return auth()->user()->can('viewAny', new User);
    }
}
