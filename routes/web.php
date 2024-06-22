<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Login Route
Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('forget-password', [AuthController::class, 'showForgetForm'])->name('show.forget.form');
Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth.check')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========== User Module Routes Start ==========

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission.check:view_users');
        Route::get('{user}/show', [UserController::class, 'show'])->name('user.show');
        Route::post('create', [UserController::class, 'store'])->name('user.store')->middleware('permission.check:create_user');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('permission.check:edit_user');
        Route::put('{user}/update', [UserController::class, 'update'])->name('user.update')->middleware('permission.check:edit_user');
        Route::delete('{user}/trash-delete', [UserController::class, 'destroy'])->name('user.destroy')->middleware('permission.check:delete_user');
        Route::post('{user}/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus')->middleware('permission.check:edit_user');
        Route::delete('{id}/permanent-delete', [UserController::class, 'userPermanentDelete'])->name('user.permanent.delete')->middleware('permission.check:delete_user');
        Route::put('{id}/restore', [UserController::class, 'restoreUser'])->name('user.restore');
    });

    // ========== User Module Routes End ==========

    // ========== Services Module Routes Start ==========

    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services.index')->middleware('permission.check:view_services');
        Route::post('create', [ServiceController::class, 'store'])->name('service.store')->middleware('permission.check:create_service');
        Route::get('{service}/edit', [ServiceController::class, 'edit'])->name('service.edit')->middleware('permission.check:edit_service');
        Route::put('{service}/update', [ServiceController::class, 'update'])->name('service.update')->middleware('permission.check:edit_service');
        Route::delete('{service}/trash-delete', [ServiceController::class, 'destroy'])->name('service.destroy')->middleware('permission.check:delete_service');
        Route::post('{service}/update-status', [ServiceController::class, 'updateStatus'])->name('service.updateStatus')->middleware('permission.check:edit_service');
        Route::delete('{id}/permanent-delete', [ServiceController::class, 'servicePermanentDelete'])->name('service.permanent.delete')->middleware('permission.check:delete_service');
        Route::put('{id}/restore', [ServiceController::class, 'restoreservice'])->name('service.restore');
    });

    // ========== Services Module Routes End ==========


    // ========== Packages Module Routes Start ==========

    Route::prefix('packages')->group(function () {
        Route::get('/', [PackageController::class, 'index'])->name('packages.index')->middleware('permission.check:view_packages');
        Route::post('create', [PackageController::class, 'store'])->name('package.store')->middleware('permission.check:create_package');
        Route::get('{package}/edit', [PackageController::class, 'edit'])->name('package.edit')->middleware('permission.check:edit_package');
        Route::put('{package}/update', [PackageController::class, 'update'])->name('package.update')->middleware('permission.check:edit_package');
        Route::delete('{package}/trash-delete', [PackageController::class, 'destroy'])->name('package.destroy')->middleware('permission.check:delete_package');
        Route::post('{package}/update-status', [PackageController::class, 'updateStatus'])->name('package.updateStatus')->middleware('permission.check:edit_package');
        Route::delete('{id}/permanent-delete', [PackageController::class, 'packagePermanentDelete'])->name('package.permanent.delete')->middleware('permission.check:delete_package');
        Route::put('{id}/restore', [PackageController::class, 'restorepackage'])->name('package.restore');


        Route::get('/{package}', [ItemController::class, 'index'])
        ->name('items.package')
        ->middleware('permission.check:view_items');
    });

    // ========== Packages Module Routes End ==========
    // ========== Items Module Routes End ==========
    Route::prefix('items')->group(function () {

        Route::get('/', [ItemController::class, 'index'])
        ->name('items.index')
        ->middleware('permission.check:view_items');        Route::post('create', [ItemController::class, 'store'])->name('item.store')->middleware('permission.check:create_item');
        // Route::post('{package}/create', [ItemController::class, 'store'])->name('item.store')->middleware('permission.check:create_item');
        Route::post('{item}/update-status', [ItemController::class, 'updateStatus'])->name('item.updateStatus')->middleware('permission.check:edit_item');
        Route::delete('{item}/trash-delete', [ItemController::class, 'destroy'])->name('item.destroy')->middleware('permission.check:delete_item');
        Route::get('{item}/edit', [ItemController::class, 'edit'])->name('item.edit')->middleware('permission.check:edit_item');
        Route::put('{item}/update', [ItemController::class, 'update'])->name('item.update')->middleware('permission.check:edit_item');
        Route::delete('{id}/permanent-delete', [ItemController::class, 'itemPermanentDelete'])->name('item.permanent.delete')->middleware('permission.check:delete_item');
        Route::put('{id}/restore', [ItemController::class, 'restoreitem'])->name('item.restore');
    });
    // ========== Items Module Routes End ==========

    Route::resource('role', RoleController::class);
    Route::delete('role-permanent-delete/{id}', [RoleController::class, 'rolePermanentDelete'])->name('role.permanent.delete');
    Route::put('role-restore/{id}', [RoleController::class, 'restoreRole'])->name('role.restore');
    Route::get('view-permission/{id}', [RoleController::class, 'showPermissions'])->name('permission.show');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
