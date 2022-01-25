<?php

use App\Http\Controllers\Panel\DashboardController;
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
Route::group(['domain' => config('app.panel_url')], function() {

    Route::get('/', [DashboardController::class, 'index']);

});