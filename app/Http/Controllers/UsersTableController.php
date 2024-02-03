<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersTableController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();

        // Return the view with the users data and the active tab
        return view('admin.dashboard.users', [
            'activeTab' => 'users',
            'users' => $users,
        ]);
    }
    public function deleteUser($userId)
    {
        echo 'Debugiign';
        try {
            $user = User::findOrFail($userId);
            $user->delete();

            return redirect()->route('dashboard.users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions, if any
            return redirect()->route('dashboard.users')->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    public function updateUser(Request $request, $userId)
    {
        try {
            // Validate the request data as needed
            $user = User::findOrFail($userId);
    
            // Update user details based on the form data
            $user->update([
                'firstname' => $request->input('editFirstname'),
                'lastname' => $request->input('editLastname'),
                'matricule' => $request->input('editMatricule'),
                'email' => $request->input('editEmail'),
                'phone' => $request->input('editPhone'),
            ]);
    
            // Redirect to dashboard on success
            return redirect()->route('dashboard.users')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            // Display error message on failure
            return redirect()->back()->withInput()->withErrors(['error' => 'Error updating user']);
        }
    }

    
}
