<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
       
        $validate =Validator::make($request->all(),[
            'email' => 'required|email|max:100',
            'password' => 'required|min:8' 
        ]); 

        if($validate->failed())
        {
            return response()->json(['error'=>true , 'message'=>'UnAuthorized'],200); 
        }
        $credentional = request(['email','password']);
        $token =  auth('api')->attempt($credentional);
        
        if(!$token)
        {
            return response()->json(['error'=>true , 'message'=>'UnAuthorized'],200); 

        }

        return response()->json([
            'access_token' => $token 
        ]);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['error'=>false , 'message'=>'logout successfully'],200);
    }
}
