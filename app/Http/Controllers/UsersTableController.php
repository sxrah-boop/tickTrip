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
}
