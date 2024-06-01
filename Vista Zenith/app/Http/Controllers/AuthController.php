<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        $personnel = Personnel::all();
        return view('auth.register', compact('personnel'));
    }

    public function doRegister(RegisterRequest $request)
    {
        $validated = $request->validated();

        
        $user = User::create([
            'username' => $validated['username'],
            'personnel_id' => $validated['personnel'],
            'password' => Hash::make($validated['password']),
        ]);

        // Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return to_route('auth.login')->withErrors([
            'error' => 'Invalid username or password.',
        ]);
    }
}
