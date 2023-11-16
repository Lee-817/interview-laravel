<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
/**
 * Dashboard Routes
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Auth Routes
 */
Route::controller(AuthController::class)->group(function () {
    /**
     * Register Routes
     */
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'postRegister')->name('register.post');

    /**
     * Login Routes
     */
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin')->name('login.post');
});

Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Routes
     */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(DashboardController::class)->group(function () {
        /**
         * Dashboard Routes
         */
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::post('/dashboard', 'postDashboard')->name('dashboard.post');
    });
});
