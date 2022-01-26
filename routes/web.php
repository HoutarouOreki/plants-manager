<?php

use App\Http\Controllers\BreedsController;
use App\Http\Controllers\PlantsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/plants');
});

Route::get('/plants', [PlantsController::class, 'index'])->name('plants');
Route::get('/plants/create', [PlantsController::class, 'create'])->name('plants/create');

Route::get('/breeds', [BreedsController::class, 'index'])->name('breeds');
Route::get('/breeds/create', [BreedsController::class, 'create'])->name('breeds/create');
Route::post('/breeds/create', [BreedsController::class, 'store'])->name('breeds/store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
