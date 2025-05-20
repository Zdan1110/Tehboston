<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Ambil data akun berdasarkan username
        $user = DB::table('tb_akun')->where('username', $request->username)->first();

        // Cek apakah username ditemukan
        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan');
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }


        Session::put('user', [
            'id_akun' => $user->id_akun,
            'username' => $user->username,
            'email' => $user->email,
            'nama' => $user->nama,
            'type_akun' => $user->type_akun
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
        }
        

        if ($user->type_akun === 'admin') {
            return redirect('/admin')->with('success', 'Login berhasil sebagai Admin');
        } else if ($user->type_akun === 'owner'){
            return redirect('/owner/tabelcalon')->with('success', 'Login berhasil sebagai Owner');
        } else if ($user->type_akun === 'user') {
            return redirect('/home')->with('success', 'Login berhasil sebagai User');
        } else if ($user->type_akun === 'kasir') {
            return redirect('/kasir')->with('success', 'Login berhasil sebagai kasir');
        }
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/')->with('success', 'Logout berhasil');
    }
}
