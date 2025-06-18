<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UlasanController extends Controller
{

    public function index()
    {
        $ulasan = DB::table('tb_ulasan')->get();
        return view('admin.v_tabellulasan', compact('ulasan'));
    }

    public function destroy($id)
    {
        DB::table('tb_ulasan')->where('id_ulasan', $id)->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'name' => 'required_without:user|string|max:255',
            'email' => 'required_without:user|email|max:255',
        ]);

        // Generate ID ulasan otomatis: U0001, U0002, dst
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

        // Ambil data dari session atau request
        $idAkun = Session::get('user')['id'] ?? null;
        $namaLengkap = Session::get('user')['nama'] ?? $request->input('name');
        $email = Session::get('user')['email'] ?? $request->input('email');

        // Simpan ke database
        DB::table('tb_ulasan')->insert([
            'id_ulasan'     => $idUlasan,
            'id_akun'       => $idAkun,
            'nama_lengkap'  => $namaLengkap,
            'email'         => $email,
            'rating'        => $request->input('rating'),
            'subjek'        => $request->input('subject'),
            'ulasan_pesan'  => $request->input('message'),
        ]);

        // Redirect kembali dengan notifikasi sukses
        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }
}


