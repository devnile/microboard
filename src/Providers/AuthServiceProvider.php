<?php

namespace Microboard\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Microboard\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'Microboard\Policies\UserPolicy',
        'Microboard\Models\Role' => 'Microboard\Policies\RolePolicy',
        'Microboard\Models\Setting' => 'Microboard\Policies\SettingPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param GateContract $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('view-dashboard', function(User $user) {
            return $user->permissions()->contains('name', 'dashboard-viewAny');
        });
    }
}
