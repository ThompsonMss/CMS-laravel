<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController as SiteHomeController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SiteHomeController::class, 'index']);

Route::prefix('painel')->group(function () {

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'create']);

    Route::middleware('auth')->group(function () {

        Route::get('/', [AdminHomeController::class, 'index'])->name('admin');

        Route::middleware('can:edit-users')->group(function () {
            Route::resource('users', UserController::class);
        });

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile/save', [ProfileController::class, 'save'])->name('profile.save');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::put('/settings/save', [SettingController::class, 'save'])->name('settings.save');

        Route::resource('pages', PageController::class);
    });
});
