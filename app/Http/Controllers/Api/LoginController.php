<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{   
    public function userDashboard()
    {
        $users = User::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function adminDashboard()
    {
        $users = Employees::all();
        $success =  $users;

        return response()->json($success, 200);
    } 
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $credentials = request(['email','password']);
        $user = Auth::guard('user_api')->attempt($credentials);
        
        if($user){

            config(['auth.guards.api.provider' => 'user_api']);
            
            $user = User::select('companies.*')->find(auth()->guard('user_api')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp',['company'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function employeeLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('employee')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'employee']);
            
            $admin = Employees::select('employees.*')->find(auth()->guard('employees')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('MyApp',['employee'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }//
}
