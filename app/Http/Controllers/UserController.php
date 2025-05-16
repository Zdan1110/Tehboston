<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('v_registrasi');
    }
    
        public function register(Request $request)
        {
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:tb_akun,email',
                'no_hp' => 'required|string|max:15',
                'username' => 'required|string|max:255|unique:tb_akun,username',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'nama.required' => 'Nama wajib di isi',
                'no_hp.required' => 'Nomor Telepon wajib di isi',
                'username.required' => 'Username wajib di isi',
                'username.unique' => 'Username sudah dipakai, gunakan username lain!',
                'password.required' => 'Password wajib di isi',
            ]);

            $lastAkun = DB::table('tb_akun')
            ->select('id_akun')
            ->orderByDesc('id_akun')
            ->first();

            if ($lastAkun) {
            $lastNumakun = (int) substr($lastAkun->id_akun, 1); // ambil angka setelah 'C'
            $idAkun = 'A' . str_pad($lastNumakun + 1, 4, '0', STR_PAD_LEFT);
            } else {
            $idAkun = 'A0001'; // Kalau belum ada data
            }
    
            $data = [
                'id_akun' => $idAkun,
                'email' => $request->email,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'type_akun' => 'user',
            ];
            
            
            DB::table('tb_akun')->insert($data);

            try {
                User::create($data);
                Log::info('User berhasil ditambahkan', $data);
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan user: ' . $e->getMessage());
            }
                 
            return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}
    

