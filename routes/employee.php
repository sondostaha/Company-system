<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PassportController;

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
Route::post('employees/login',[LoginController::class, 'employeeLogin'])->name('employeeLogin');
    Route::group( ['prefix' => 'employee','middleware' => ['employee-api'] ],function(){
        // authenticated staff routes here 
        Route::get('dashboard',[LoginController::class, 'employeeDashboard']);
        Route::post('emlogout',[LoginController::class , 'employeelogout']);
});