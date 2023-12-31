<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class customAuth extends Controller
{
    //
    public function login(){
        return view("auth.login");
    }
    public function register(){
        return view("auth.register");
    }
    public function registerUser(Request $request){
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'matricule' => 'required|min:12|max:12',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6', // Minimum password length of 6 characters
        ]);
    
        // Check for validation errors
    if ($validator->fails()) {
        // If validation fails, redirect back with errors and input data
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // If validation passes, proceed with processing the data
    $user = new User();
    $user->firstname = $request->input('firstname');
    $user->lastname = $request->input('lastname');
    $user->matricule = $request->input('matricule');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->password = bcrypt($request->input('password')); // Hash the password before saving

    // Save the user to the database
    $user->save();

    // Redirect to a success page or return a success response
    return redirect()->route('home'); // Change 'success-page' to your desired route
    }

    public function HomePage()
    {
        return view('home'); // 'success' is the name of your success view
    }

    public function loginUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Check for validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Retrieve user data by email
        $user = User::where('email', $request->input('email'))->first();
    
        // Check if user exists and if the provided password matches the hashed password in the database
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // If the password matches, set the user in the session
            $request->session()->put('loginId', $user->id);
            return redirect()->route('home'); // Redirect to the home page after successful login
        }
    
        // Display appropriate error messages based on the condition
        if (!$user) {
            return back()->with('fail', 'This email is not registered.');
        } else {
            return back()->with('fail', 'Password not matched.');
        }
    }
    
    
    

}