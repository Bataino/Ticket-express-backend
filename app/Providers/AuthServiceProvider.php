<?php

namespace App\Providers;

use App\Models\User;
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

        /* define a admin user role */
        Gate::define('isAdmin', function (User $user) {
            return $user->role == 'admin';
        });



        /* define a super admin user role */
        Gate::define('isSuperAdmin', function (User $user) {
            return $user->role == 'super-admin';
        });


        /* define a user role */
        Gate::define('isUser', function (User $user) {
            return $user->role == 'user';
        });

        /* define owner role */
        Gate::define('isOwner', function (User $user, $id) {
            return $user->id == $id;
        });
        //

        //
    }
}
