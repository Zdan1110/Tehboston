<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonMitra;
use App\Models\M_Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CalonMitraController extends Controller
{
    public function __construct()
    {
        $this->M_Admin = new M_Admin();
    }

   public function store(Request $request)
{
    // Validasi Input
    $request->validate([
        // Data Calon Mitra
        'nama_lengkap' => 'required|string|max:255',
        'no_ktp' => 'required|string|max:20|unique:tb_calonmitra,no_ktp',
        'provinsi' => 'required|string|max:100',
        'kota' => 'required|string|max:100',
        'kelurahan' => 'required|string|max:100',
        'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf',
        'no_hp' => 'required|string|max:15',
        'alamat_lengkap' => 'required|string',
        'pas_photo' => 'required|file|mimes:jpg,jpeg,png',

        // Data Lokasi Usaha
        'provinsi_usaha' => 'required|string',
        'kota_usaha' => 'required|string',
        'kelurahan_usaha' => 'required|string',
        'kecamatan_usaha' => 'required|string',
        'alamat_usaha' => 'required|string',
        'kode_pos' => 'required|string',
        'titik_koordinat' => 'required|string',
        'lokasi_usaha' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
    ]);

    // Ambil id akun user yang login
    if (Auth::check()) {
        $id_akun = Auth::user()->id_akun;
    }

    // Generate id_calon
    $lastCalon = DB::table('tb_calonmitra')
        ->select('id_calon')
        ->orderByDesc('id_calon')
        ->first();

    if ($lastCalon) {
        $lastNumcalon = (int) substr($lastCalon->id_calon, 1);
        $idCalon = 'C' . str_pad($lastNumcalon + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $idCalon = 'C0001';
    }

    // Fungsi untuk ekstrak koordinat dari URL
    $extractCoordinates = function ($url) {
        if (preg_match('/[-]?\d{1,3}\.\d+,\s*[-]?\d{1,3}\.\d+/', $url, $matches)) {
            return trim($matches[0]);
        }
        return null;
    };

    $titikKoordinat = $extractCoordinates($request->titik_koordinat);

   

    // Upload file KTP
    $filektp = $request->file('ktp');
    $fileNamektp = $request->no_ktp . '.' . $filektp->extension();
    $filektp->move(public_path('uploads/ktp'), $fileNamektp);

    // Upload file pas photo
    $filephoto = $request->file('pas_photo');
    $fileNamephoto = preg_replace('/\s+/', '_', $request->nama_lengkap) . '.' . $filephoto->extension();
    $filephoto->move(public_path('uploads/photo'), $fileNamephoto);

    // Upload file lokasi usaha jika ada
    $fileNamelokasi = null;
    if ($request->hasFile('lokasi_usaha')) {
        $filelokasi = $request->file('lokasi_usaha');
        $fileNamelokasi = $idCalon . '.' . $filelokasi->extension();
        $filelokasi->move(public_path('uploads/lokasi'), $fileNamelokasi);
    }

    // Prepare data untuk simpan ke database
    $datacalon = [
        'id_calon' => $idCalon,
        'id_akun' => $id_akun ?? null,
        'nama_lengkap' => $request->nama_lengkap,
        'no_ktp' => $request->no_ktp,
        'provinsi' => $request->provinsi,
        'kota' => $request->kota,
        'kelurahan' => $request->kelurahan,
        'ktp' => $fileNamektp,
        'no_hp' => $request->no_hp,
        'alamat_lengkap' => $request->alamat_lengkap,
        'pas_photo' => $fileNamephoto,
        'provinsi_usaha' => $request->provinsi_usaha,
        'kota_usaha' => $request->kota_usaha,
        'kelurahan_usaha' => $request->kelurahan_usaha,
        'kecamatan_usaha' => $request->kecamatan_usaha,
        'alamat_usaha' => $request->alamat_usaha,
        'kode_pos' => $request->kode_pos,
        'titik_koordinat' => $titikKoordinat,
        'lokasi_usaha' => $fileNamelokasi,
    ];

    try {
        DB::table('tb_calonmitra')->insert($datacalon);
        Log::info('Data calon mitra berhasil disimpan.', $datacalon);

        return redirect('/home')->with('success', 'Pendaftaran berhasil!.');
    } catch (\Exception $e) {
        Log::error('Gagal menyimpan data calon mitra: ' . $e->getMessage());

        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
    }
}


        
    
        public function index() {
            $admin = CalonMitra::all(); // ambil semua data
            return view('admin.v_tabelcalon', compact('admin'));
        }
        
        public function updateStatus(Request $request, $id_calonmitra)
        {
            $request->validate([
                'status' => 'required|in:Proses,Diterima,Ditolak'
            ]);
        
            try {
                DB::table('tb_calonmitra')
                    ->where('id_calon', $id_calonmitra)
                    ->update([
                        'status' => $request->status
                    ]);

                if ($request->status == 'Diterima') {

                    $ubah = $this->M_Admin->datacalonpindah($id_calonmitra);

                    $id_akun = Session::get('user')['id_akun'];
                    $nama_franchise = Session::get('user')['username'];
                    $lastMitra = DB::table('tb_mitra')
                    ->select('id_mitra')
                    ->orderByDesc('id_mitra')
                    ->first();
        
                    if ($lastMitra) {
                    $lastNummitra = (int) substr($lastMitra->id_mitra, 1); 
                    $idMitra = 'M' . str_pad($lastNummitra + 1, 4, '0', STR_PAD_LEFT);
                    } else {
                    $idMitra = 'M0001'; 
                    }

                        // 1. Masukkan ke tb_mitra
                    DB::table('tb_mitra')->insert([
                        'id_mitra' => $idMitra, // atau bisa generate ID baru jika kamu mau
                        'id_akun' => $id_akun,
                        'nama_lengkap' => $ubah->nama_lengkap,
                        'no_ktp' => $ubah->no_ktp,
                        'provinsi' => $ubah->provinsi,
                        'kota' => $ubah->kota,
                        'kelurahan' => $ubah->kelurahan,
                        'ktp' => $ubah->ktp,
                        'no_hp' => $ubah->no_hp,
                        'alamat_lengkap' => $ubah->alamat_lengkap,
                        'pas_photo' => $ubah->pas_photo,
                    ]);

                    $lastFranchise = DB::table('tb_franchise')
                    ->select('id_franchise')
                    ->orderByDesc('id_franchise')
                    ->first();
        
                    if ($lastFranchise) {
                    $lastNumfranchise = (int) substr($lastFranchise->id_franchise, 1); 
                    $idFranchise = 'F' . str_pad($lastNumfranchise + 1, 4, '0', STR_PAD_LEFT);
                    } else {
                    $idFranchise = 'F0001'; 
                    }

                        // 2. Masukkan ke tb_franchise
                    DB::table('tb_franchise')->insert([
                        'id_franchise' => $idFranchise,
                        'id_mitra' => $idMitra,
                        'nama_franchise' => $nama_franchise,
                        'provinsi_usaha' => $ubah->provinsi_usaha,
                        'kota_usaha' => $ubah->kota_usaha,
                        'kelurahan_usaha' => $ubah->kelurahan_usaha,
                        'kecamatan_usaha' => $ubah->kecamatan_usaha,
                        'alamat_usaha' => $ubah->alamat_usaha,
                        'kode_pos' => $ubah->kode_pos,
                        'titik_koordinat' => $ubah->titik_koordinat,
                        'lokasi_usaha' => $ubah->lokasi_usaha,
                    ]);

                        // 3. Masukkan ke tb_kasir
                        $lastKasir = DB::table('tb_kasir')
                            ->select('id_kasir')
                            ->orderByDesc('id_kasir')
                            ->first();

                        if ($lastKasir) {
                            $lastNumKasir = (int) substr($lastKasir->id_kasir, 1);
                            $idKasir = 'K' . str_pad($lastNumKasir + 1, 4, '0', STR_PAD_LEFT);
                        } else {
                            $idKasir = 'K0001';
                        }

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

                        // Simpan ke tb_akun
                        DB::table('tb_akun')->insert([
                            'id_akun' => $idAkun,         // FK dari tb_akun
                            'username' => $idKasir,    
                            'password' => bcrypt($idKasir),
                            'type_akun' => 'kasir',      
                        ]);

                                                // Simpan ke tb_kasir
                        DB::table('tb_kasir')->insert([
                            'id_kasir' => $idKasir,
                            'id_akun' => $idAkun,         // FK dari tb_akun
                            'id_franchise' => $idFranchise       // FK dari tb_franchise yang baru dibuat
                        ]);

                }
        
                return back()->with('success', 'Status berhasil diperbarui.');
            } catch (\Exception $e) {
                
                Log::error('Gagal update status: ' . $e->getMessage());
                return back()->with('error', 'Gagal memperbarui status.');
            }
        }
        
}
