<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request): RedirectResponse
    {
        $remember = false;
        if (request('remember') == 'on') {
            $remember = true;
        }

        if (Auth::attempt($request->validated(), $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect()->intended('/dashboard')->with('success', 'Account successfully registered.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->flush();

        Auth::logout();

        return Redirect('/');
    }
}
