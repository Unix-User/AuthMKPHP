<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Models\Device;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\User;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/showcase', function () {
        return Inertia::render('Showcase', [
            'data' => Product::all()->where('team_id',  '=', auth()->user()->current_team_id)
        ]);
    })->name('showcase');

    Route::resource('products', ProductsController::class);
    Route::resource('devices', DevicesController::class);
    Route::resource('users', UsersController::class);

    Route::get('/products', function () {
        return Inertia::render('Products', [
            'data' => Product::all()->where('team_id',  '=', auth()->user()->current_team_id)
        ]);
    })->name('products');

    Route::get('/devices', function () {
        return Inertia::render('Devices', [
            'data' => Device::all()->where('team_id',  '=', auth()->user()->current_team_id)
        ]);
    })->name('devices');

    Route::get('/users', function () {
        return Inertia::render('Users', [
            // 'data' => User::all()->where('team_id',  '=', auth()->user()->current_team_id)
            'data' => User::all()->where('current_team_id',  '=', auth()->user()->current_team_id)
        ]);
    })->name('users');
});
