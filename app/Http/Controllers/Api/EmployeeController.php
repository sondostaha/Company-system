<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
     $employees = Employees::with('position')->get();
     return response()->json($employees);
    }
 
    public function create(Request $request)
    {
      $validatedate = Validator::make($request->all(),[
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:employees',
          'pic'=>'image',
          'birthday'=>'required',
          'password' => 'required|min:8',
          ]);
        if($validatedate->failed())
        {
            return response()->json(['error'=>true , 'message'=>'please check your data'],200); 
        }

          $image = $request->file('pic');
 
          $extintion = $image->getClientOriginalExtension();
    
         
          $employee_name = $request->name;
          $image_name = uniqid().".".$extintion;
    
          $image->move(public_path('employees/'.$employee_name), "$image_name");
    
         
          
         $employees = Employees::create(
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
 
       return response()->json(['message'=>'employee created successfully',$employees]);
 
 
    }
 

    public function edite($id , Request $request)
    {
        $validatedate = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'pic'=>'image',
            'birthday'=>'required',
            'password' => 'required|min:8',
            ]);
        if($validatedate->failed())
        {
            return response()->json(['error'=>true , 'message'=>'please check your data'],200); 
        }

       $employee = Employees::findOrFail($id);
       $image = $request->file('pic');
 
       $extintion = $image->getClientOriginalExtension();
 
      
       $employee_name = $request->name;
       $image_name = uniqid().".".$extintion;
 
       $image->move(public_path('employees/'.$employee_name), "$image_name");
 
       $employee_update =$employee->update(
          [
             'company_id' => (Auth::id()),
             'name' => $request->name,
             'email' => $request->email,
             'birthdate' => $request->birthdate,
             'position_id' => $request->position,
             'salary' => $request->e_salary,
             'img' => $image_name,
             
          ]);
 
        return response()->json(['message'=>'employee updated successfully',$employee_update]);

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
      return response()->json(['message'=>'employee deleted successfully']);

    }
 
    public function show($id)
    {
       $employee = Employees::findOrFail($id);
       return response()->json($employee);

    }  
}
