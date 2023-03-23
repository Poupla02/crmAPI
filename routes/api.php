<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmployeController;
use App\Http\Controllers\API\EntrepriseController;
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
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router){
    Route::post('/register',[AuthController::class, 'register']);
    Route::post('/login',[AuthController::class, 'login']);
    Route::get('/profile',[AuthController::class, 'profile']);
    Route::get('/logout',[AuthController::class, 'logout']);
});
Route::group(['middleware' => 'api', 'prefix' => 'entreprises'], function (){
    Route::apiResource('entreprise', EntrepriseController::class)->middleware('auth:api');
});
Route::group(['middleware' => 'api', 'prefix' => 'employes'], function (){
    Route::apiResource('employe', EmployeController::class)->middleware('auth:api');
});
