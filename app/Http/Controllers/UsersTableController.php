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
        try {
            $user = User::findOrFail($userId);
            $user->delete();

            return redirect()->route('dashboard.users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions, if any
            return redirect()->route('dashboard.users')->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
    
}
