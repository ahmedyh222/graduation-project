<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\testcontroller;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/chkuname/{username}', [authController::class, 'check_user']);
Route::post('/adduser', [authController::class, 'adduser']);
Route::post('/login', [authController::class, 'login']);
Route::get('/user/{id}',[userController::class,'getUserData']);

