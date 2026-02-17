<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\isAdminMiddleware;
use App\Http\Middleware\LoggedIAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::prefix('admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'AdminLoginPage')->name('admin.login.page')->middleware(LoggedIAdminMiddleware::class);
        Route::middleware(isAdminMiddleware::class)->group(function () {
            Route::get('/dashboard', 'AdminDashboard')->name('admin.dashboard');
            Route::get('/profile', 'AdminProfile')->name('admin.profile');
        });

        Route::post('/login', 'AdminLogin')->name('admin.login');
        Route::post('/logout', 'AdminLogout')->name('admin.logout');
        Route::post('/profile/update', 'ProfileUpdate')->name('admin.profile.update');
    });
});
