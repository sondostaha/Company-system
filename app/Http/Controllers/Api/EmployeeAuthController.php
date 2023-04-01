<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeAuthController extends Controller
{
   public function EmLog(Request $request)
   {
    $validate = Validator::make($request->all() ,[
        'email' => $request->email,
        'password' => $request->password
    ]);
    if($validate->failed())
    {
        return response()->json(['error'=>true , 'message' => 'UnAuthurized' ]);
    }

    $cerditional = request(['email' ,'password']);

    $access_token = auth()->guard('employee-api')->attempt($cerditional);
    if(! $access_token)
    {
        return response()->json(['error' => true , 'message' => 'UnAuthorized']);
    }
    return response()->json([
        'access_token' => $access_token,
    ]);
   }

   public function logout()
   {
        auth()->guard('employee-api')->logout();
        return response()->json(['error'=>false , 'message'=>'logout successfully'],200);
   }
}
