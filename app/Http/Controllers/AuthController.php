<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Аутентификация прошла успешно
            return redirect()->intended('/');
        }

        // Аутентификация не удалась
        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        $user = User::create([
            'Username' => $validatedData['username'],
            'Email' => $validatedData['email'],
            'Password' => Hash::make($validatedData['password']),
            'Role' => 'Пользователь', // По умолчанию все новые пользователи будут обычными пользователями
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}