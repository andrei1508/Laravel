<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function login(Request $request) {
        $request->validate([
            'email' => 'required | email', 
            'password' => 'required'
        ]);
        if(!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'Credentials not good']);
        }
        $request->session()->regenerate();

        return redirect()->intended('/users');
    }

    public function logout() {
        Auth::logout(); 
        return redirect()->intended('/login');
    }
}