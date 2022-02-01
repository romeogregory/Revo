<?php

use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\PackageController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\ShopController;
use Illuminate\Support\Facades\Route;

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

require_once __DIR__ . '/fortify.php';

/* Landing page routes */
Route::group(['domain' => config('app.landing_url')], function() {

});

/* Booter panel routes */
Route::group(['domain' => config('app.panel_url'), 'middleware' => ['verified','auth']], function() {

    /* Admin pages */
    Route::prefix('managment')
    ->as('managment.')
    ->group(function () {

        Route::get('packages', [PackageController::class, 'index'])->name('packages');
        
    });

    /* General pages */
    Route::prefix('profile')
    ->as('profile.')
    ->group(function () {

        Route::get('overview', [ProfileController::class, 'overview'])->name('overview');
        Route::get('settings', [ProfileController::class, 'settings'])->name('settings');
        
    });

    


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/shop', [ShopController::class, 'index'])->name('shop');

});