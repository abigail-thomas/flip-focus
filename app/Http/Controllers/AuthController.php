<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function register(Request $request) {
        // validate
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // create user
        $user = User::create($validated);

        Auth::login($user);
        // login and redirect

        return redirect()->route('profile');

    }

    public function login(Request $request) {
        // validate
        $validated = $request->validate([
            'email'=> 'required|email',
            'password' => 'required|string'
        ]);
        // login
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('profile');
        }
        // redirect for failure
        throw ValidationException::withMessages([
            'credentials' => 'Sorry, incorrect creditentials',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
