<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripsTableController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard.trips', ['activeTab' => 'users']);
    }
}
