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


        Gate::define('package_management', function ($user, $ability) {
            $permissions = ['view_packages', 'create_package', 'edit_package', 'delete_package'];
            if ($user->role) {

                return $user->role->permissions()->whereIn('name', $permissions)->where('name', $ability)->exists();
            }
            return false;
        });
        // ========== Gate for managing package_management-related permissions End ==========

         // ========== Gate for managing service_management-related permissions End ==========


         Gate::define('item_management', function ($user, $ability) {
            $permissions = ['view_items', 'create_item', 'edit_item', 'delete_item'];
            if ($user->role) {

                return $user->role->permissions()->whereIn('name', $permissions)->where('name', $ability)->exists();
            }
            return false;
        });
        // ========== Gate for managing item_management-related permissions End ==========

    }
}
