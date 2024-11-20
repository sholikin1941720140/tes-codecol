<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function index()
    {
        $data = DB::table('attendances as at')
                    ->join('users as u', 'u.id', '=', 'at.user_id')
                    ->select('at.*', 'u.name')
                    ->orderBy('at.created_at', 'desc')
                    ->get();
        // return response()->json($data);

        return view('admin.report.index', compact('data'));
    }
}
