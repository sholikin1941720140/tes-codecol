<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $id = auth()->id();
        $data = DB::table('schedules as sc')
                    ->join('detail_schedules as ds', 'sc.id', '=', 'ds.schedule_id')
                    ->where('sc.user_id', $id)
                    ->select('sc.*', 'ds.day')
                    ->orderBy('ds.id', 'asc')
                    ->get()
                    ->groupBy('id')
                    ->map(function($item) {
                        $schedule = $item->first();
                        return [
                            'id' => $schedule->id,
                            'time_in' => $schedule->time_in,
                            'time_out' => $schedule->time_out,
                            'day' => $item->pluck('day')->toArray(),
                        ];
                    })
                    ->values();
        // return response()->json($data);

        return view('employee.schedule-index', compact('data'));
    }

    public function attendanceView()
    {
        Carbon::setlocale('id');
        $user = auth()->user();
        if($user->status == 'inactive') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak bisa melakukan absensi karena status anda tidak aktif');
        }

        $data = DB::table('schedules as sc')
                    ->join('detail_schedules as ds', 'sc.id', '=', 'ds.schedule_id')
                    ->where('sc.user_id', $user->id)
                    ->select('sc.*', 'ds.day')
                    ->orderBy('ds.id', 'asc')
                    ->get()
                    ->groupBy('id')
                    ->map(function($item) {
                        $schedule = $item->first();
                        return [
                            'id' => $schedule->id,
                            'time_in' => $schedule->time_in,
                            'time_out' => $schedule->time_out,
                            'day' => $item->pluck('day')->toArray(),
                        ];
                    })
                    ->values();

        $now = Carbon::now()->isoFormat('dddd');
        $hasSchedule = collect($data)->contains(function($item) use ($now){
            return in_array($now, $item['day']);
        });
        // return response()->json($data);

        return view('employee.attendance-index', compact('data', 'now', 'hasSchedule'));
    }

    public function submitAttendance(Request $request)
    {
        $existingAttendance = $this->checkSubmitAttendance($request);
        $existingAttendance = json_decode($existingAttendance->getContent());
    
        if($existingAttendance->status == 'success') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah absensi masuk hari ini'
            ], 422);
        }

        $user = auth()->user();
        $timeNow = Carbon::now()->format('H:i:s');
        $timeIn = $request->time_in;
        $timeOut = $request->time_out;
        $tolerance = 15;
        $toleranceTime = Carbon::parse($timeIn)->addMinutes($tolerance)->format('H:i:s');

        if($timeNow >= $timeOut) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah terlambat absen, silahkan hubungi HRD'
            ], 422);
        } elseif ($timeNow >= $timeIn && $timeNow <= $toleranceTime) {
            $status = 'present';
        } elseif ($timeNow > $toleranceTime) {
            $status = 'late';
        } elseif ($timeNow) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak dapat absen masuk sebelum waktunya masuk'
            ], 420);
        }

        DB::table('attendances')->insert([
            'user_id' => $user->id,
            'time_in' => $timeNow,
            'time_out' => null,
            'status' => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if($status == 'present') {
            return response()->json([
                'status' => 'present',
                'message' => 'Absensi masuk berhasil'
            ]);
        } elseif ($status == 'late') {
            return response()->json([
                'status' => 'late',
                'message' => 'Absensi masuk berhasil (terlambat)'
            ]);
        }
    }

    public function checkSubmitAttendance(Request $request)
    {
        $data = auth()->user();
        $now = Carbon::now()->format('Y-m-d');
        $attendance = DB::table('attendances')
                        ->where('user_id', $data->id)
                        ->whereDate('created_at', $now)
                        ->first();

        if($attendance) {
            return response()->json([
                'status' => 'success',
                'message' => 'Anda sudah absensi masuk hari ini'
            ],);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum absensi masuk hari ini'
            ], 200);
        }
    }

    public function submitLeave(Request $request)
    {
        $existingAttendance = $this->checkSubmitAttendance($request);
        $existingAttendance = json_decode($existingAttendance->getContent());

        if($existingAttendance->status == 'error') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum absensi masuk hari ini'
            ], 422);
        } elseif ($existingAttendance->status == 'success') {
            $checkSubmitLeave = $this->checkSubmitLeave($request);
            $checkSubmitLeave = json_decode($checkSubmitLeave->getContent());

            if($checkSubmitLeave->status == 'success') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah absensi pulang hari ini'
                ], 422);
            }
        }

        $user = auth()->user();
        $timeNow = Carbon::now()->format('H:i:s');
        $timeOut = $request->time_out;
        
        if($timeNow == $timeOut || $timeNow > $timeOut){
            $timeOut = $timeNow;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak dapat absensi pulang sebelum waktunya pulang'
            ], 422);
        }

        $attendance = DB::table('attendances')
                        ->where('user_id', $user->id)
                        ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
                        ->update([
                            'time_out' => $timeOut,
                            'updated_at' => Carbon::now(),
                        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Absensi pulang berhasil'
        ], 200);
    }

    public function checkSubmitLeave(Request $request)
    {
        $data = auth()->user();
        $now = Carbon::now()->format('Y-m-d');
        $attendance = DB::table('attendances')
                        ->where('user_id', $data->id)
                        ->whereDate('created_at', $now)
                        ->first();

        if($attendance) {
            if($attendance->time_out != null) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Anda sudah absensi pulang hari ini'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda belum absensi pulang hari ini'
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum absensi hari ini'
            ], 200);
        }
    }
}
