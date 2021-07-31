<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'arte'
],function($routes){

});


Route::post('register',[UserController::class,'registerUser']);
Route::post('login',[UserController::class,'login']);
Route::middleware('auth:api')->post('logout',[UserController::class,'logout']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
