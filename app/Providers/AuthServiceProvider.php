<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (config('admin_permissions.areas') as $area => $roles) {
            Gate::define("manage-{$area}", fn ($admin) => in_array($admin->role, $roles['manage']));
            Gate::define("view-{$area}", fn ($admin) =>
                in_array($admin->role, $roles['manage']) || in_array($admin->role, $roles['view'])
            );
        }
    }
}
