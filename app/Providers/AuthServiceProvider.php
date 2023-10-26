<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        // check patient permissin
        Gate::define('patient', function(User $user) {
            return $user->user_role === 'p';
        });

        // check docter permissin
        Gate::define('docter', function(User $user) {
            return $user->user_role === 'd';
        });

        // check patient permissin
        Gate::define('admin', function(User $user) {
            return $user->user_role === 'a';
        });

    }
}
