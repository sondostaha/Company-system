<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;

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
Route::post('companies/login',[LoginController::class, 'userLogin'])->name('userLogin');
    Route::group( ['middleware' => ['auth:user_api'] ],function(){
        // authenticated staff routes here 
        Route::get('dashboard',[LoginController::class, 'userDashboard']);
        Route::POST('uslogout',[LoginController::class , 'userlogout']);
});