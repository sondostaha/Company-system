<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function handel_login(Request $request)
    {
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string|min:7|max:50'
        ]);

        $is_login = Auth::attempt(['email'=>$request->email , 'password'=>$request->password]);

        if(! $is_login)
        {
            return back();
        }

        return redirect('dashboard');

    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');

    }
}
