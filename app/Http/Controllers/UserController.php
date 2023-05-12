<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Create account form
    public function create() {
        return view('users.register');
    }
    
    // Create user
    public function store(Request $req) {
        $formFields = $req->validate([
            'store' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Log in
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in.');
    }

    // Log in
    public function login() {
        return view('users.login', [
            'user' => User::all()
        ]);
    }

    // Log out
    public function logout(Request $req) {
        auth()->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    public function authenticate(Request $req) {
        $formFields = $req->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $req->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in.');
        }

        return back()->withErrors(['email' => 'Invalid email.'])->onlyInput('email');
    }

}
