<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('users as us',)
            ->join('roles as r', 'us.role_id', '=', 'r.id')
            ->join('employees as emp', 'us.id', '=', 'emp.user_id')
            ->select('us.*', 'r.name as role', 'emp.dob as lahir', 'emp.city as kota')
            ->get();
        // return response()->json($data);

        return view('admin.user.index', compact('data'));
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $validateData= Validator::make($request->all(),[
            'role' => 'required',
            'name' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:users',
            'dob' => 'required',
            'city' => 'required',
        ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        $userId = DB::table('users')->insertGetId([
            'role_id' => $request->role,
            'name' => $request->name,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('employees')->insert([
            'user_id' => $userId,
            'dob' => $request->dob,
            'city' => $request->city,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('user')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        // return response()->json($request->all());
        $validateData= Validator::make($request->all(),[
            'role' => 'required',
            'name' => 'required',
            'status' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'dob' => 'required',
            'city' => 'required',
        ],[
            'email.unique' => 'Email sudah digunakan',
        ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        DB::table('users')->where('id', $id)->update([
            'role_id' => $request->role,
            'name' => $request->name,
            'status' => $request->status,
            'email' => $request->email,
            'updated_at' => Carbon::now(),
        ]);

        DB::table('employees')->where('user_id', $id)->update([
            'dob' => $request->dob,
            'city' => $request->city,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('user')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('employees')->where('user_id', $id)->delete();

        return redirect()->route('user')->with('success', 'Data berhasil dihapus');
    }
}
