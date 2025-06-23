<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UlasanController extends Controller
{
    // Menampilkan semua ulasan di halaman admin
    public function index()
    {
        $ulasan = DB::table('tb_ulasan')->get();
        return view('admin.v_tabellulasan', compact('ulasan'));
    }

    public function indexuser()
    {
        $testimonials = DB::table('tb_ulasan')
        ->where('status_tampil', 1)
        ->orderByDesc('id_ulasan')
        ->limit(10)
        ->get();

        return view('v_index', compact('testimonials'));
    }

    public function home()
    {
        $testimonials = DB::table('tb_ulasan')
        ->where('status_tampil', 1)
        ->orderByDesc('id_ulasan')
        ->limit(10)
        ->get();

        return view('v_home', compact('testimonials'));
    }


    // Menghapus ulasan berdasarkan ID
    public function destroy($id)
    {
        DB::table('tb_ulasan')->where('id_ulasan', $id)->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }

    // Menyimpan ulasan baru
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'name' => 'required_without:user|string|max:255',
            'email' => 'required_without:user|email|max:255',
        ]);

        // Generate ID ulasan otomatis (U0001, U0002, dst.)
        $lastUlasan = DB::table('tb_ulasan')
            ->select('id_ulasan')
            ->orderByDesc('id_ulasan')
            ->first();

        if ($lastUlasan) {
            $lastNum = (int) substr($lastUlasan->id_ulasan, 1);
            $idUlasan = 'U' . str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $idUlasan = 'U0001';
        }

        // Ambil data user dari session jika login
        $sessionUser = Session::get('user');
        $idAkun = $sessionUser['id'] ?? null;
        $namaLengkap = $sessionUser['nama'] ?? $request->input('name');
        $email = $sessionUser['email'] ?? $request->input('email');

        // Jika user login, pastikan akun ada di tabel tb_akun
        if ($idAkun) {
            $akunExists = DB::table('tb_akun')->where('id', $idAkun)->exists();
            if (!$akunExists) {
                return redirect()->back()->withErrors(['Akun tidak ditemukan.']);
            }
        }

        // Simpan ulasan ke database
        DB::table('tb_ulasan')->insert([
            'id_ulasan'     => $idUlasan,
            'id_akun'       => $idAkun,
            'nama_lengkap'  => $namaLengkap,
            'email'         => $email,
            'rating'        => $request->input('rating'),
            'subjek'        => $request->input('subject'),
            'ulasan_pesan'  => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }

    public function tampilkan($id)
    {
        DB::table('tb_ulasan')->where('id_ulasan', $id)->update(['status_tampil' => 1]);
        return redirect()->back()->with('success', 'Ulasan berhasil ditampilkan.');
    }


    public function sembunyikan($id)
    {
        DB::table('tb_ulasan')->where('id_ulasan', $id)->update(['status_tampil' => 0]);
        return redirect()->back()->with('success', 'Ulasan disembunyikan dari halaman depan.');
    }

    
}
