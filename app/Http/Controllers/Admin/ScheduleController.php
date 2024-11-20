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
                    ->join('users as us', 'sc.user_id', '=', 'us.id')
                    ->select('sc.*', 'ds.day', 'us.name')
                    ->orderBy('ds.id', 'asc')
                    ->get()
                    ->groupBy('id')
                    ->map(function ($item) {
                        $schedule = $item->first();
                        return [
                            'id' => $schedule->id,
                            'name' => $schedule->name,
                            'time_in' => $schedule->time_in,
                            'time_out' => $schedule->time_out,
                            'day' => $item->pluck('day')->toArray(),
                        ];
                    })
                    ->values();
        // return response()->json($data);

        return view('admin.schedule.index', compact('data'));
    }

    public function create()
    {
        $data = DB::table('users')
                    ->where('role_id', 2)
                    ->where('status', 'active')
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
            'user_id' => $request->user,
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

    public function edit($id)
    {
        $data = DB::table('schedules as sc')
                    ->join('detail_schedules as ds', 'sc.id', '=', 'ds.schedule_id')
                    ->join('users as us', 'sc.user_id', '=', 'us.id')
                    ->select('sc.*', 'ds.day', 'us.name')
                    ->where('sc.id', $id)
                    ->get()
                    ->groupBy('id')
                    ->map(function ($item) {
                        $schedule = $item->first();
                        return [
                            'id' => $schedule->id,
                            'user_id' => $schedule->user_id,
                            'name' => $schedule->name,
                            'time_in' => $schedule->time_in,
                            'time_out' => $schedule->time_out,
                            'day' => $item->pluck('day')->toArray(),
                        ];
                    })
                    ->first();
        // return response()->json($data);

        return view('admin.schedule.edit', compact('data'));
    }

    public function update(Request $request)
    {
        // return response()->json($request->all());
        $validateData = Validator::make($request->all(), [
            'id' => 'required',
            'user_id' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'day' => 'required',
        ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        $updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('schedules')->where('id', $request->id)->update([
            'user_id' => $request->user_id,
            'time_in' => $request->checkin,
            'time_out' => $request->checkout,
            'updated_at' => $updated_at,
        ]);

        DB::table('detail_schedules')->where('schedule_id', $request->id)->delete();
        foreach($request->day as $key => $value) {
            DB::table('detail_schedules')->insert([
                'schedule_id' => $request->id,
                'day' => $request->day[$key],
                'created_at' => $updated_at,
                'updated_at' => $updated_at,
            ]);
        }

        return redirect()->route('schedule')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        DB::table('schedules')->where('id', $id)->delete();
        DB::table('detail_schedules')->where('schedule_id', $id)->delete();

        return redirect()->route('schedule')->with('success', 'Data berhasil dihapus');
    }
}
