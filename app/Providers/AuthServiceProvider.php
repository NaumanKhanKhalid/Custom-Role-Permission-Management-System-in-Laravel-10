<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // ========== Gate for managing user-related permissions Start ==========

        Gate::define('user_management', function ($user, $ability) {
            $permissions = ['view_users', 'create_user', 'edit_user', 'delete_user'];
            if ($user->role) {
                return $user->role->permissions()->whereIn('name', $permissions)->where('name', $ability)->exists();
            }
            return false;
        });

        // ========== Gate for managing user-related permissions End ==========
    }
}
