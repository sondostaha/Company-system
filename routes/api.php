<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\EmployeeController;





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
Route::middleware('jwt.auth')->group(function(){
    Route::group(['prefix'=>'Company'],function()
        {
            Route::get('/positions',[PositionController::class,'index']);
            Route::get('/employees',[EmployeeController::class,'index']);
            Route::get('/clients',[ClientController::class,'index']);
            Route::get('/projects',[ProjectController::class,'index']);
        
        
        
        });
    Route::group(['prefix'=>'position'],function(){

        //create position
        Route::post('add',[PositionController::class,'create']);
        //edite position
        Route::post('edit/{id}',[PositionController::class,'edite']);
        //delete Position
        Route::post('delet/{id}',[PositionController::class,'delete']);

        
    });
    Route::group(['prefix'=>'employee'],function(){
        //add employee
        Route::post('add', [EmployeeController::class,'create'])->name('add.employee');

        //edite employee
        Route::post('edit/{id}',[EmployeeController::class,'edite'])->name('edit.employee');

        //delete employee
        Route::post('delete/{id}',[EmployeeController::class,'delete'])->name('delete_employee');

        //show employee
        Route::get('show/{id}',[EmployeeController::class , 'show'])->name('show.employee');


    });
    Route::group(['prefix'=>'client'],function(){
        //add client
        Route::post('add',[ClientController::class,'create'])->name('add.client');
    
        //edite client
        Route::post('edit/{id}',[ClientController::class,'edite'])->name('edit.clinet');

        //delete client
        Route::post('delete/{id}',[ClientController::class,'delete'])->name('delete.client');


    });
    Route::group(['prefix'=>'Project'],function(){

        //add project
        Route::post('add',[ProjectController::class ,'create'])->name('add.project');

        //edite project
        Route::post('edit/{id}',[ProjectController::class,'edite']);

        //delete
        Route::post('delete/{id}',[ProjectController::class,'delete']);

        //new prjects
        Route::get('new',[ProjectController::class,'newProject']);

        //started prjects
        Route::get('started',[ProjectController::class,'startedProject']);

    
        Route::get('add_employee/{employee_id}/{project_id}',[ProjectController::class ,'add_employee']);

        Route::get('add_client/{client_id}/{project_id}',[ProjectController::class ,'add_client']);
        

        //employees of project
        Route::get('employees/{id}',[ProjectController::class ,'project_employees']);
        //delete employee from project
        Route::post('delete/employees/{id}',[ProjectController::class , 'delete_employee']);

        //show Project
        Route::get('{id}',[ProjectController::class ,'show'])->name('show.projects');

        Route::post('/logout', [AuthController::class, 'logout']);

    });
});