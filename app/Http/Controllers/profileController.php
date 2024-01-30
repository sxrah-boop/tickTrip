<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $user = Auth::user(); // Get the authenticated user

        return view('profile'); // Pass the user to the 'profile' view
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Validate the incoming data (customize this based on your needs)
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            // Add more validation rules as needed
        ]);

        // Update the user's profile information
        $user->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            // Add more fields as needed
        ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
        // Redirect back to the profile page with a success message
    }
}
