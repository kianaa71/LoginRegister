<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function LoginForm()
    {
        return view('auth.login');
    }

    public function RegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('name', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back();
    }

    public function dashboard()
    {
        return view('dashboard');
    }

}

