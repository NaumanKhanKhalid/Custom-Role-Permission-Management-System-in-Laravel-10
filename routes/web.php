<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\PackageController as FrontendPackageController;
use App\Http\Controllers\Frontend\ServiceController as FrontendServiceController;

Route::get('/', function () {
    return redirect()->route('backend.dashboard');
});

// Login Route
Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password', [AuthController::class, 'showForgetForm'])->name('show.forget.form');
Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth.check')->group(function () {
    Route::prefix('backend')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

        // ========== User Module Routes Start ==========

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('backend.users.index')->middleware('permission.check:view_users');
            Route::get('{user}/show', [UserController::class, 'show'])->name('backend.user.show');
            Route::post('create', [UserController::class, 'store'])->name('backend.user.store')->middleware('permission.check:create_user');
            Route::get('{user}/edit', [UserController::class, 'edit'])->name('backend.user.edit')->middleware('permission.check:edit_user');
            Route::put('{user}/update', [UserController::class, 'update'])->name('backend.user.update')->middleware('permission.check:edit_user');
            Route::delete('{user}/trash-delete', [UserController::class, 'destroy'])->name('backend.user.destroy')->middleware('permission.check:delete_user');
            Route::post('{user}/update-status', [UserController::class, 'updateStatus'])->name('backend.user.updateStatus')->middleware('permission.check:edit_user');
            Route::delete('{id}/permanent-delete', [UserController::class, 'userPermanentDelete'])->name('backend.user.permanent.delete')->middleware('permission.check:delete_user');
            Route::put('{id}/restore', [UserController::class, 'restoreUser'])->name('backend.user.restore');
        });

        // ========== User Module Routes End ==========

        // ========== Services Module Routes Start ==========

        Route::prefix('services')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('backend.services.index')->middleware('permission.check:view_services');
            Route::post('create', [ServiceController::class, 'store'])->name('backend.service.store')->middleware('permission.check:create_service');
            Route::get('{service}/edit', [ServiceController::class, 'edit'])->name('backend.service.edit')->middleware('permission.check:edit_service');
            Route::put('{service}/update', [ServiceController::class, 'update'])->name('backend.service.update')->middleware('permission.check:edit_service');
            Route::delete('{service}/trash-delete', [ServiceController::class, 'destroy'])->name('backend.service.destroy')->middleware('permission.check:delete_service');
            Route::post('{service}/update-status', [ServiceController::class, 'updateStatus'])->name('backend.service.updateStatus')->middleware('permission.check:edit_service');
            Route::delete('{id}/permanent-delete', [ServiceController::class, 'servicePermanentDelete'])->name('backend.service.permanent.delete')->middleware('permission.check:delete_service');
            Route::put('{id}/restore', [ServiceController::class, 'restoreservice'])->name('backend.service.restore');
        });

        // ========== Services Module Routes End ==========

        // ========== Packages Module Routes Start ==========

        Route::prefix('packages')->group(function () {
            Route::get('/', [PackageController::class, 'index'])->name('backend.packages.index')->middleware('permission.check:view_packages');
            Route::post('create', [PackageController::class, 'store'])->name('backend.package.store')->middleware('permission.check:create_package');
            Route::get('{package}/edit', [PackageController::class, 'edit'])->name('backend.package.edit')->middleware('permission.check:edit_package');
            Route::put('{package}/update', [PackageController::class, 'update'])->name('backend.package.update')->middleware('permission.check:edit_package');
            Route::delete('{package}/trash-delete', [PackageController::class, 'destroy'])->name('backend.package.destroy')->middleware('permission.check:delete_package');
            Route::post('{package}/update-status', [PackageController::class, 'updateStatus'])->name('backend.package.updateStatus')->middleware('permission.check:edit_package');
            Route::delete('{id}/permanent-delete', [PackageController::class, 'packagePermanentDelete'])->name('backend.package.permanent.delete')->middleware('permission.check:delete_package');
            Route::put('{id}/restore', [PackageController::class, 'restorepackage'])->name('backend.package.restore');


            Route::get('/{package}', [ItemController::class, 'index'])
                ->name('backend.items.package')
                ->middleware('permission.check:view_items');
        });

        // ========== Packages Module Routes End ==========
        // ========== Items Module Routes End ==========
        Route::prefix('items')->group(function () {

            Route::get('/', [ItemController::class, 'index'])->name('backend.items.index')->middleware('permission.check:view_items');
            Route::post('create', [ItemController::class, 'store'])->name('backend.item.store')->middleware('permission.check:create_item');
            // Route::post('{package}/create', [ItemController::class, 'store'])->name('backend.item.store')->middleware('permission.check:create_item');
            Route::post('{item}/update-status', [ItemController::class, 'updateStatus'])->name('backend.item.updateStatus')->middleware('permission.check:edit_item');
            Route::delete('{item}/trash-delete', [ItemController::class, 'destroy'])->name('backend.item.destroy')->middleware('permission.check:delete_item');
            Route::get('{item}/edit', [ItemController::class, 'edit'])->name('backend.item.edit')->middleware('permission.check:edit_item');
            Route::put('{item}/update', [ItemController::class, 'update'])->name('backend.item.update')->middleware('permission.check:edit_item');
            Route::delete('{id}/permanent-delete', [ItemController::class, 'itemPermanentDelete'])->name('backend.item.permanent.delete')->middleware('permission.check:delete_item');
            Route::put('{id}/restore', [ItemController::class, 'restoreitem'])->name('backend.item.restore');
        });
        // ========== Items Module Routes End ==========

        // ========== Role Module Routes End ==========

        Route::resource('role', RoleController::class)->names([
            'index' => 'backend.role.index',
            'create' => 'backend.role.create',
            'store' => 'backend.role.store',
            'show' => 'backend.role.show',
            'edit' => 'backend.role.edit',
            'update' => 'backend.role.update',
            'destroy' => 'backend.role.destroy'
        ]);

        Route::delete('role-permanent-delete/{id}', [RoleController::class, 'rolePermanentDelete'])->name('backend.role.permanent.delete');
        Route::put('role-restore/{id}', [RoleController::class, 'restoreRole'])->name('backend.role.restore');
        Route::get('view-permission/{id}', [RoleController::class, 'showPermissions'])->name('backend.permission.show');

        // ========== Role Module Routes End ==========




    });
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// ========== Frontend  Routes End ==========
Route::prefix('services')->group(function () {
    Route::get('/', [FrontendServiceController::class, 'index'])->name('services.index');
});

Route::prefix('packages')->group(function () {
    Route::get('/{service}', [FrontendPackageController::class, 'index'])->name('packages.index');
});
// ========== Frontend  Routes End ==========
