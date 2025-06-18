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
        } else if ($user->type_akun === 'survey') {
            return redirect('/datasurvey')->with('success', 'Login berhasil sebagai kasir');
        }
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/')->with('success', 'Logout berhasil');
    }

    public function loginkasir($id_franchise)
    {
        $idakun = DB::table('tb_kasir')->where('id_franchise', $id_franchise)->first();
        $kasir = DB::table('tb_akun')->where('id_akun', $idakun->id_akun)->first();
        $user = DB::table('tb_akun')->where('username', $kasir->username)->first();

        // Cek apakah username ditemukan
        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan');
        }


        Session::put('user', [
            'id_akun' => $user->id_akun,
            'username' => $user->username,
            'email' => $user->email,
            'nama' => $user->nama,
            'type_akun' => $user->type_akun
        ]);

        session()->regenerate();
        


         return redirect('/kasir')->with('success', 'Login berhasil sebagai kasir');
    }
}
