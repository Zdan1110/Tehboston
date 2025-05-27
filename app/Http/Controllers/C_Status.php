<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_Status extends Controller
{
        public function cek(Request $request)
        {
            $id = trim($request->input('id_pendaftar'));

            $calon = DB::table('tb_calonmitra')
                ->where('id_calon', $id)
                ->first();

            if ($calon) {
                return view('status', ['calon' => $calon]); // ⬅ ini harus cocok
            } else {
                return redirect()->back()->with('error', 'ID tidak ditemukan.');
            }
        }

}


