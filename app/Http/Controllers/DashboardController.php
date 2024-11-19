<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userAct = User::where('status', 'active')->count();
        $userInact = User::where('status', 'inactive')->count();

        return view('dashboard', compact('userAct', 'userInact'));
    }
}
