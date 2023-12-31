<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    // 'prefix' => 'students',
    // 'middleware' => ['auth:sanctum'],
    'namespace' => 'App\Http\Controllers',
    'controller' => 'UserController',
], function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::group([
    // 'prefix' => 'students',
    'middleware' => ['auth'],
    'namespace' => 'App\Http\Controllers',
    'controller' => 'UserController',
], function () {
    Route::get('get-user', 'getUser');
});
