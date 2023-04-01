<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\Employees;
use App\Models\Projects;
use Illuminate\Support\Facades\Route;
use App\Http\App\Http\Middleware\SetAppLang ;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.register');
});

Route::get('login', [AuthController::class ,'login'])->name('login');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('lang/ar',[LangController::class , 'ar'])->name('lang.ar');
Route::get('lang/en',[LangController::class , 'en'])->name('lang.en');  

Route::middleware('setapplang')->group( function()
{
    Route::middleware('auth')->group(function () 
    {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::group(['prefix'=>'Company'],function()
    {
        Route::get('/positions',[PositionController::class,'index'])->name('all_postions');
        Route::get('/employees',[EmployeeController::class,'index'])->name('employees');
        Route::get('/clients',[ClientController::class,'index'])->name('clients');
        Route::get('/projects',[ProjectController::class,'index'])->name('all.projects');
    
    
    
    });
    Route::group(['prefix'=>'position'],function(){
    
        //create position
        Route::get('add',[PositionController::class,'create'])->name('add.position');
        Route::post('save',[PositionController::class,'store'])->name('save.position');
        //edite position
        Route::get('edit/{id}',[PositionController::class,'edit'])->name('edit.position');
        Route::post('update/{id}',[PositionController::class,'update'])->name('update.position');
        //delete Position
        Route::get('delet/{id}',[PositionController::class,'delete'])->name('delete_position');
    
    
    });
    Route::group(['prefix'=>'employee'],function(){
        //add employee
        Route::get('add', [EmployeeController::class,'create'])->name('add.employee');
    
        Route::post('save',[EmployeeController::class,'store'])->name('save.employee');
    
        //edite employee
        Route::get('edit/{id}',[EmployeeController::class,'edit'])->name('edit.employee');
    
        Route::post('update/{id}',[EmployeeController::class,'update'])->name('update.employee');
    
        //delete employee
        Route::get('delete/{id}',[EmployeeController::class,'delete'])->name('delete_employee');
    
        //show employee
        Route::get('show/{id}',[EmployeeController::class , 'show'])->name('show.employee');
    
    
    });
    Route::group(['prefix'=>'client'],function(){
        //add client
        Route::get('add',[ClientController::class,'create'])->name('add.client');
        Route::post('save',[ClientController::class,'store'])->name('save.client');
    
        //edite client
        Route::get('edit/{id}',[ClientController::class,'edite'])->name('edit.clinet');
        Route::post('update/{id}',[ClientController::class ,'update'])->name('update_client');
    
        //delete client
        Route::get('delete/{id}',[ClientController::class,'delete'])->name('delete.client');
    
    
    });
    Route::group(['prefix'=>'Project'],function(){
    
        //add project
        Route::get('add',[ProjectController::class ,'create'])->name('add.project');
        Route::post('save',[ProjectController::class,'store'])->name('stre.project');
    
        //edite project
        Route::get('edit/{id}',[ProjectController::class,'edit'])->name('edit.project');
        Route::post('update/{id}',[ProjectController::class ,'update'])->name('update_project');
    
        //delete
        Route::get('delete/{id}',[ProjectController::class,'delete'])->name('delete.project');
    
        //new prjects
        Route::get('new',[ProjectController::class,'newProject'])->name('new.projects');
    
        //started prjects
        Route::get('started',[ProjectController::class,'startedProject'])->name('started.projects');
    
        //pending prjects
        Route::get('pending',[ProjectController::class,'pendingProject'])->name('pending.projects');
    
        Route::get('add/employees/{id}',[ProjectController::class , 'Employee'])->name('select.employe');
    
        Route::get('add_employee/{employee_id}/{project_id}',[ProjectController::class ,'add_employee'])->name('project_add_employee');
    
        Route::get('client/{id}',[ProjectController::class ,'client'])->name('project_client');
    
        Route::get('add_client/{client_id}/{project_id}',[ProjectController::class ,'add_client'])->name('project_add_client');
        
    
        //employees of project
        Route::get('employees/{id}',[ProjectController::class ,'project_employees'])->name('project.employees');
        //delete employee from project
        Route::get('delete/employees/{id}',[ProjectController::class , 'delete_employee'])->name('project.delete.employee');
    
        //show Project
        Route::get('{id}',[ProjectController::class ,'show'])->name('show.projects');
    
    });
    
    
});


Route::get('logout',[AuthController::class ,'logout'])->name('user.logout');


//show employees

//clients


//p_salary
Route::get('p_salary/{id}',[PositionController::class ,'get_position_salary']);


require __DIR__.'/auth.php';

Route::get('/employee/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:employee', 'verified'])->name('dashboard');
require __DIR__.'/employe_auth.php';
