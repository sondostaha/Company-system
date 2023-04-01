<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PassportController extends Controller
{
    // $success['token'] =  $user->createToken('MyApp',['user'])->accessToken;
    public function login(Request $request)
    {
       
        $input = $request->all();
        // $credentional = request(['email','password']);
        // $token =  auth('api')->attempt($credentional);
        Auth::attempt($input);
        $user =Auth::user();

        $token = $user->createToken('example')->accessToken;
        if(!$token)
        {
            return response()->json(['error'=>true , 'message'=>'wwwww'],200); 
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
