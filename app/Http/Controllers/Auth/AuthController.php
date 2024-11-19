<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        if ($user->status == 'inactive') {
            return response()->json([
                'message' => 'Akun anda tidak aktif, silahkan hubungi admin'
            ], 401);
        }

        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil'
            ]);
        }

        return response()->json([
            'message' => 'Password salah'
        ], 401);
    }
    

    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum login, tidak perlu logout.'
            ], 401);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('success', 'Anda berhasil Logout');

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}
