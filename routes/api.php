<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/chkuname/{username}', [authController::class, 'check_user']);
Route::post('/req/adduser', [authController::class, 'adduser']);
Route::post('/req/login', [authController::class, 'login']);
/*Route::post('/logout', [AuthController::class, 'logout']);*/
