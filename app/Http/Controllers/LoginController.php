<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function loginForm(){
        return view('login.form');
    }

    function logout(){
        Auth::logout();
        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('login');
    }

    function authenticate(ServerRequestInterface $request){
        $data = $request->getParsedBody();
        $credentials = [ 'email' => $data['email'], 'password' => $data['password'],];

        if(Auth::attempt($credentials)){
            session()->regenerate();

            return redirect()->intended(route('product-list'));
        }

        return redirect()->back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.'
        ]);
    }


}
