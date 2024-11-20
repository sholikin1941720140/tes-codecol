<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userAct = User::where('status', 'active')->count();
        $userInact = User::where('status', 'inactive')->count();

        return view('dashboard', compact('userAct', 'userInact'));
    }
}
