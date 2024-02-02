<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class customAuth extends Controller
{
    protected function registrationRules(Request $request)
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'matricule' => 'required|min:12|max:12',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',
        ];
    }

    protected function loginRules(Request $request)
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function login()
    {
        return view("auth.login");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerUser(Request $request, User $user)
    {
        $request->validate($this->registrationRules($request));

        $user->create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'matricule' => $request->input('matricule'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('home');
        
    }

    public function HomePage()
    {
        return view('home');
    }

    public function loginUser(Request $request)
    {
        $request->validate($this->loginRules($request));

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->with('fail', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
