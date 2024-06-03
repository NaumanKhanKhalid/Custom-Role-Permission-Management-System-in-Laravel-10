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

    public function boot()
    {
        $this->registerPolicies();

        // ========== Gate for managing user_management-related permissions Start ==========

        Gate::define('user_management', function ($user, $ability) {
            $permissions = ['view_users', 'create_user', 'edit_user', 'delete_user'];
            if ($user->role) {
                return $user->role->permissions()->whereIn('name', $permissions)->where('name', $ability)->exists();
            }
            return false;
        });

        // ========== Gate for managing user_management-related permissions End ==========

        // ========== Gate for managing service_management-related permissions Start ==========

        Gate::define('service_management', function ($user, $ability) {
            $permissions = ['view_services', 'create_service', 'edit_service', 'delete_service'];
            if ($user->role) {
                return $user->role->permissions()->whereIn('name', $permissions)->where('name', $ability)->exists();
            }
            return false;
        });
        // ========== Gate for managing service_management-related permissions End ==========

    }
}
