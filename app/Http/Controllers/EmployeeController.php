<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Position;
use Doctrine\Inflector\Rules\English\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;

class EmployeeController extends Controller
{
   public function index()
   {
    $employees = Employees::all();
    $position = Position::all();
    return view('employees.employe',compact('employees','position'));
   }

   public function create()
   {
    $position = Position::all();
    return view('employees.add',compact('position'));
   }
   public function store(Request $request)
   {
      // $request->validate([
      //    'name' => 'required|string|max:255',
      //    'email' => 'required|string|email|max:255|unique:employees',
      //    'pic'=>'image',
      //    'birthday'=>'required',
      //    'password' => 'required',

      //    ]);
        
         $image = $request->file('pic');

         $extintion = $image->getClientOriginalExtension();
   
        
         $employee_name = $request->name;
         $image_name = uniqid().".".$extintion;
   
         $image->move(public_path('employees/'.$employee_name), "$image_name");
   
        
         
         Employees::create(
         [
            'company_id' => (Auth::id()),
            'name' => $request->name,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'position_id' => $request->position,
            'salary' => $request->e_salary,
            'img' => $image_name,
            'password' => Hash::make($request->password),
         ]);

      session()->flash('Add','employee added sussesfully');
      return back();


   }

   public function edit($id)
   {
      $employee = Employees::findOrFail($id);
      $position= Position::all();
      return view('employees.edit',compact('employee','position'));
   }

   public function update($id , Request $request)
   {
      $employee = Employees::findOrFail($id);
      $image = $request->file('pic');

      $extintion = $image->getClientOriginalExtension();

     
      $employee_name = $request->name;
      $image_name = uniqid().".".$extintion;

      $image->move(public_path('employees/'.$employee_name), "$image_name");

      $employee->update(
         [
            'company_id' => (Auth::id()),
            'name' => $request->name,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'position_id' => $request->position,
            'salary' => $request->e_salary,
            'img' => $image_name,
            
         ]);

      session()->flash('Edite','employee edited sussesfully');
      return back();

   }
   public function delete($id)
   {
      $employee = Employees::findOrFail($id);
      $employee_name = $employee->name;

      $image_path = public_path("employees\." . $employee_name) ;

      if(file_exists($image_path))
       {
         unlink($image_path);
     
       }
     $employee->delete($id);
     session()->flash('Delete','employee edited sussesfully');

     return back();
   }

   public function show($id)
   {
      $employee = Employees::findOrFail($id);
      return view('employees.show',compact('employee'));
   }  
}
