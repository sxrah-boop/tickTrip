<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // fetches the authenticated user and passes it to the dashboard view,
    public function index()
{
    $user = auth()->user();
    if (!$user) {
    return redirect('/');
    }
    return view('admin.dashboard', compact('user'));
}

}
