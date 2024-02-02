<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationsTableController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard.reservations', ['activeTab' => 'users']);
    }
}

