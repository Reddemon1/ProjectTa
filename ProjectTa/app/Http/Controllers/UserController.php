<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/HomeAdmin');            
        }
        return redirect('/AdminRedirect');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/Admin'); 
    }
}
