<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//auth routes
Auth::routes();

//middleware auth
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [App\Http\Controllers\DashboardController::class, 'index'])->name('profile');

    //boilerplate routes

    Route::resource('setting/group', App\Http\Controllers\Setting\GroupController::class);
    Route::resource('setting/menu', App\Http\Controllers\Setting\MenuController::class);

    //user
    Route::resource('master/user', App\Http\Controllers\Master\UserController::class)->parameter('user', 'id');
    Route::post('master/user/list', [App\Http\Controllers\Master\UserController::class, 'list'])->name('master.user.list');
});


//cache clear
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// Clear route cache:
Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return "Routes are cached";
});

//Clear config cache:
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return "Configurations are cached";
});

// Clear view cache:
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return "View cache is cleared";
});
