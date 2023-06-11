<?php

// use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\DashboardController;

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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/dashboard', function () {
    //     return view('auth.dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('auth.dashboard');
    Route::get('/locations', [LocationsController::class, 'index'])->name('locations.index');
    Route::get('/locations/create', [LocationsController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationsController::class, 'store'])->name('locations.store');
    Route::get('/locations/{location}', [LocationsController::class, 'show'])->name('locations.show');
    Route::get('/locations/{location}/edit', [LocationsController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{location}', [LocationsController::class, 'update'])->name('locations.update');
    Route::delete('/locations/{location}', [LocationsController::class, 'destroy'])->name('locations.destroy');
    

});
