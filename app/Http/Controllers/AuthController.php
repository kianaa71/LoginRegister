<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MenuModel;
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
            'role' => 'required|string|in:Admin,User'
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        // $user = User::where('name', $request->name)->first()->toArray();
        // dd(password_verify($request->password, $user['password']));

        if (Auth::attempt($request->only('name', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back();
    }

    public function dashboard()
    {
        $data = MenuModel::all();
        $user = Auth::user();
        return view('dashboard', compact('user','data'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

