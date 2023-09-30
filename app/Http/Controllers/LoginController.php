<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($request->only('username', 'password'))) {
            return redirect('/');
        } else {
            throw ValidationException::withMessages(['messages' => 'Your credentials are not registered']);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
