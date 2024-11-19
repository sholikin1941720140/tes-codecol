<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use DB;

class ScheduleController extends Controller
{
    public function index()
    {   
        $data = DB::table('schedules as sc')
                    ->join('detail_schedules as ds', 'sc.id', '=', 'ds.schedule_id')
                    ->join('employees as emp', 'sc.employee_id', '=', 'emp.id')
                    ->join('users as u', 'emp.user_id', '=', 'u.id')
                    ->select('sc.*', 'ds.*', 'emp.*', 'u.*')
                    ->get();
        // return response()->json($data);

        return view('admin.schedule.index', compact('data'));
    }

    public function create()
    {
        $data = DB::table('users')
                    ->where('role_id', 2)
                    ->select('id', 'name')
                    ->get();
        // return response()->json($data); 

        return view('admin.schedule.create', compact('data'));
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());

        $validateData = Validator::make($request->all(), [
            'user' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'day' => 'required',
        ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $scId = DB::table('schedules')->insertGetId([
            'employee_id' => $request->user,
            'time_in' => $request->checkin,
            'time_out' => $request->checkout,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);

        foreach($request->day as $key => $value) {
            DB::table('detail_schedules')->insert([
                'schedule_id' => $scId,
                'day' => $request->day[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
        }

        return redirect()->route('schedule')->with('success', 'Data berhasil disimpan');
    }
}
