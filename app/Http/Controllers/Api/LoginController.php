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

    public function employeeDashboard()
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
         $credentional = request(['email','password']);

        if( Auth::guard('user_api')->attempt($credentional))
        {
        $user =Auth::guard('user_api')->user();

        $token = $user->createToken('example')->accessToken;

        return response()->json([
            'access_token' => $token 
        ]); 

        }else{

            return response()->json(['error'=>'Email or password incorrect'], 401);

        }

        // if(Auth::guard('user_api')->attempt(['email' => request('email'), 'password' => request('password')])){
        //     $user = Auth::guard('user_api')->user();
        //     $success['token'] =  $user->createToken('MyApp')->accessToken;
        //     return response()->json(['success' => $success], 200);
        // }
        // else{
        //     return response()->json(['error'=>'Email or password incorrect'], 401);
        // }

       
    }

    public function userlogout()
    {
        Auth::guard('user_api')->logout();
        return response()->json(['error'=>false , 'message'=>'logout successfully'],200);
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

        $credentional = request(['email','password']);

       if( Auth::guard('employee-api')->attempt($credentional)){
        $user =Auth::guard('employee-api')->user();

        $token = $user->createToken('example')->accessToken;
       
        return response()->json([
            'access_token' => $token 
        ]);
       }
       else{
            return response()->json(['error'=>'Email or password incorrect'], 401);
        }

        
        // if(Auth::guard('employee-api')->attempt(['email' => request('email'), 'password' => request('password')])){
        //     $user = Auth::guard('employee-api')->user();
        //     $success['token'] =  $user->createToken('MyApp')->accessToken;
        //     return response()->json(['success' => $success], 200);
        // }
        // else{
        //     return response()->json(['error'=>'Email or password incorrect'], 401);
        // }
    }//

    public function employeelogout()
    {
        Auth::guard('employee-api')->logout();
        return response()->json(['error'=>false , 'message'=>'logout successfully'],200);
    }
}
