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
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'no_hp' => 'required|string|max:15',
            'alamat_lengkap' => 'required|string',
            'pas_photo' => 'required|file|mimes:jpg,jpeg,png|max:1024',

            // Data Lokasi Usaha
            'provinsi_usaha' => 'required|string|max:100',
            'kota_usaha' => 'required|string|max:100',
            'kelurahan_usaha' => 'required|string|max:100',
            'kecamatan_usaha' => 'required|string|max:100',
            'alamat_usaha' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'titik_koordinat' => 'required|string|max:100',
            'lokasi_usaha' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

            if (Auth::check()) {
                $id_akun = Auth::user()->id_akun;
            }
        
            
            // Di Controller saat insert:
            $lastCalon = DB::table('tb_calonmitra')
            ->select('id_calon')
            ->orderByDesc('id_calon')
            ->first();

            if ($lastCalon) {
            $lastNumcalon = (int) substr($lastCalon->id_calon, 1); // ambil angka setelah 'C'
            $idCalon = 'C' . str_pad($lastNumcalon + 1, 4, '0', STR_PAD_LEFT);
            } else {
            $idCalon = 'C0001'; // Kalau belum ada data
            }

            $filektp = Request()->file('ktp');
            $fileNamektp = Request()->no_ktp . '.' . $filektp->extension();
            $filektp->move(public_path('uploads/ktp'), $fileNamektp);

            $filephoto = Request()->file('pas_photo');
            $fileNamephoto = Request()->nama_lengkap . '.' . $filephoto->extension();
            $filephoto->move(public_path('uploads/photo'), $fileNamephoto);

            $filelokasi = Request()->file('lokasi_usaha');
            $fileNamelokasi = Request()->titik_koordinat . '.' . $filelokasi->extension();
            $filelokasi->move(public_path('uploads/lokasi'), $fileNamelokasi);

            // Simpan Data ke Database
            $datacalon = [
                // Data Calon Mitra
                'id_calon' => $idCalon,
                'id_akun' => $id_akun,
                'nama_lengkap' => $request->nama_lengkap,
                'no_ktp' => $request->no_ktp,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kelurahan' => $request->kelurahan,
                'ktp' => $fileNamektp,
                'no_hp' => $request->no_hp,
                'alamat_lengkap' => $request->alamat_lengkap,
                'pas_photo' => $fileNamephoto,

                // Data Lokasi Usaha
                'provinsi_usaha' => $request->provinsi_usaha,
                'kota_usaha' => $request->kota_usaha,
                'kelurahan_usaha' => $request->kelurahan_usaha,
                'kecamatan_usaha' => $request->kecamatan_usaha,
                'alamat_usaha' => $request->alamat_usaha,
                'kode_pos' => $request->kode_pos,
                'titik_koordinat' => $request->titik_koordinat,
                'lokasi_usaha' => $fileNamelokasi,
            ];

            try {
                DB::table('tb_calonmitra')->insert($datacalon);
                Log::info('Data calon mitra berhasil disimpan.', $datacalon);
    
                // Redirect ke /home jika sukses
                return redirect('/home')->with('success', 'Pendaftaran berhasil!.');
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan data calon mitra: ' . $e->getMessage());
    
                // Redirect balik ke /daftarmitra dengan pesan error
                return redirect('/home')->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
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
                }
        
                return back()->with('success', 'Status berhasil diperbarui.');
            } catch (\Exception $e) {
                dd($e->getMessage());
                Log::error('Gagal update status: ' . $e->getMessage());
                return back()->with('error', 'Gagal memperbarui status.');
            }
        }
        
}
