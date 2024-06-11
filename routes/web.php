<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::can('auth.check')->group(function () {

    Route::get('
    ', [DashboardController::class, 'index'])->name('dashboard');

    // ========== User Module Routes Start ==========

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->can('permission.check:view_users');
        Route::get('{user}/show', [UserController::class, 'show'])->name('user.show');
        Route::post('create', [UserController::class, 'store'])->name('user.store')->can('permission.check:create_user');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('user.edit')->can('permission.check:edit_user');
        Route::put('{user}/update', [UserController::class, 'update'])->name('user.update')->can('permission.check:edit_user');
        Route::delete('{user}/trash-delete', [UserController::class, 'destroy'])->name('user.destroy')->can('permission.check:delete_user');
        Route::post('{user}/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus')->can('permission.check:edit_user');
        Route::delete('{id}/permanent-delete', [UserController::class, 'userPermanentDelete'])->name('user.permanent.delete')->can('permission.check:delete_user');
        Route::put('{id}/restore', [UserController::class, 'restoreUser'])->name('user.restore');
    });

    // ========== User Module Routes End ==========

    // ========== Services Module Routes Start ==========

    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services.index')->can('permission.check:view_services');
        Route::get('{service}/show', [ServiceController::class, 'show'])->name('service.show');
        Route::post('create', [ServiceController::class, 'store'])->name('service.store')->can('permission.check:create_service');
        Route::get('{service}/edit', [ServiceController::class, 'edit'])->name('service.edit')->can('permission.check:edit_service');
        Route::put('{service}/update', [ServiceController::class, 'update'])->name('service.update')->can('permission.check:edit_service');
        Route::delete('{service}/trash-delete', [ServiceController::class, 'destroy'])->name('service.destroy')->can('permission.check:delete_service');
        Route::post('{service}/update-status', [ServiceController::class, 'updateStatus'])->name('service.updateStatus')->can('permission.check:edit_service');
        Route::delete('{id}/permanent-delete', [ServiceController::class, 'servicePermanentDelete'])->name('service.permanent.delete')->can('permission.check:delete_service');
        Route::put('{id}/restore', [ServiceController::class, 'restoreservice'])->name('service.restore');
    });

    // ========== Services Module Routes End ==========

    Route::resource('role', RoleController::class);
    Route::delete('role-permanent-delete/{id}', [RoleController::class, 'rolePermanentDelete'])->name('role.permanent.delete');
    Route::put('role-restore/{id}', [RoleController::class, 'restoreRole'])->name('role.restore');

    Route::get('view-permission/{id}', [RoleController::class, 'showPermissions'])->name('permission.show');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
