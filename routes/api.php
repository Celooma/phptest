<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AuthController;
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

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);
Route::post('logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::post('leave',[LeaveController::class, 'store'])->middleware('auth:sanctum');
Route::get('leave',[LeaveController::class, 'index'])->middleware('auth:sanctum');;
Route::put('leave/{id}',[LeaveController::class, 'update'])->middleware('auth:sanctum');

