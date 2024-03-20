<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Login Route
Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');

// Authenticated Routes
Route::middleware('auth.check')->group(function () {

    // Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission.check:1234');
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // ========== User Module Routes Start ==========

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission.check:view_users');
        Route::get('{user}/show', [UserController::class, 'show'])->name('users.show');
        Route::post('create', [UserController::class, 'store'])->name('users.store')->middleware('permission.check:create_user');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission.check:edit_user');
        Route::put('{user}/update', [UserController::class, 'update'])->name('users.update')->middleware('permission.check:edit_user');
        Route::delete('{user}/trash-delete', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission.check:delete_user');
        Route::post('{user}/update-status', [UserController::class, 'updateStatus'])->name('users.updateStatus')->middleware('permission.check:edit_user');
        Route::delete('{id}/permanent-delete', [UserController::class, 'userPermanentDelete'])->name('users.permanent.delete')->middleware('permission.check:delete_user');
        Route::put('{id}/restore', [UserController::class, 'restoreUser'])->name('users.restore');
    });

    // ========== User Module Routes End ==========



    // User Module Routes
    Route::resource('role', RoleController::class);
    Route::delete('role-permanent-delete/{id}', [RoleController::class, 'rolePermanentDelete'])->name('role.permanent.delete');
    Route::put('role-restore/{id}', [RoleController::class, 'restoreRole'])->name('role.restore');


    Route::get('view-permission/{id}', [RoleController::class, 'showPermissions'])->name('permission.show');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
