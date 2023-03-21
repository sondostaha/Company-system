<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('Position',[PositionController::class,'index'])->name('all_postions');
//create position
Route::get('add_position',[PositionController::class,'create'])->name('add.position');

Route::post('save_position',[PositionController::class,'store'])->name('save.position');

//edite position
Route::get('edit_position/{id}',[PositionController::class,'edit'])->name('edit.position');

Route::post('update_position',[PositionController::class,'update'])->name('update.position');

//delete Position

Route::get('delet_position/{id}',[PositionController::class,'delete'])->name('delete_position');

//show employees
Route::get('/employees',[EmployeeController::class,'index'])->name('all_employees');
Route::get('Company_Employees',[EmployeeController::class,'index'])->name('employees');

//add employee
Route::get('add_employee', [EmployeeController::class,'create'])->name('add.employee');

Route::post('save_employee',[EmployeeController::class,'store'])->name('save.employee');

//edite employee
Route::get('edit_employee/{id}',[EmployeeController::class,'edit'])->name('edit.employee');

Route::post('update_employee/{id}',[EmployeeController::class,'update'])->name('update.employee');

//delete employee
Route::get('delete_employee/{id}',[EmployeeController::class,'delete'])->name('delete_employee');

//p_salary
Route::get('p_salary/{id}',[PositionController::class ,'get_position_salary']);
require __DIR__.'/auth.php';
