<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonMitra;
use App\Models\M_Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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
            'provinsi_usaha' => 'required|string|max:100',
            'kota_usaha' => 'required|string|max:100',
            'kelurahan_usaha' => 'required|string|max:100',
            'kecamatan_usaha' => 'required|string|max:100',
            'alamat_usaha' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'titik_koordinat' => 'required|string|max:255',
            'lokasi_usaha' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
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
            $fileNamelokasi = $idCalon . '.' . $filelokasi->extension();
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
                return redirect('/qrcode')->with('success', 'Pendaftaran berhasil!.');
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
                dd($e->getMessage());
                Log::error('Gagal update status: ' . $e->getMessage());
                return back()->with('error', 'Gagal memperbarui status.');
            }
        }

        public function status()
        {
            return view('v_preview');
        }

        public function qrcode()
        {   
            $id_akun = Session::get('user')['id_akun'];
            $idcalon = DB::table('tb_calonmitra')
                        ->where('id_akun', $id_akun)
                        ->first();
                        
            if (!$idcalon) {
                return back()->with('error', 'Data calon mitra tidak ditemukan!');
            }

            $qrdata = url('/cekstatus?id=' . $idcalon->id_calon);
            $path = public_path('uploads/qrcode/'.$idcalon->id_calon.'.png');
            QrCode::format('png')->size(300)->generate($qrdata, $path);
            return view('v_qrcode', compact('idcalon', 'id_akun', 'qrdata', 'path'));
        }

        public function downloadQrCode()
        {
            $id_akun = Session::get('user')['id_akun'];
            $idcalon = DB::table('tb_calonmitra')
                        ->where('id_akun', $id_akun)
                        ->first();
                        
            if (!$idcalon) {
                return back()->with('error', 'Data calon mitra tidak ditemukan!');
            }
            $qrdata = $idcalon->id_calon;
            $image = QrCode::format('png')
                        ->size(400)
                        ->margin(2)
                        ->generate($qrdata);

            return response($image)
                ->header('Content-Type', 'image/png')
                ->header('Content-Disposition', 'attachment; filename="qrcode.png"');
        }
        
        public function indextambahfranchise()
        {
            return view('v_tambahfranchise');
        }

        public function tambahfranchise(Request $request)
        {
            $request->validate([
                'provinsi_usaha' => 'required|string|max:100',
                'kota_usaha'     => 'required|string|max:100',
                'kelurahan_usaha'=> 'required|string|max:100',
                'kecamatan_usaha'=> 'required|string|max:100',
                'alamat_usaha'   => 'required|string',
                'kode_pos'       => 'required|string|max:10',
                'titik_koordinat'=> 'required|string|max:255',
                'lokasi_usaha'   => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            ]);
        
            $id_akun = Auth::user()->id_akun;
            $lastFBaru = DB::table('tb_franchisebaru')->orderByDesc('id_franchisebaru')->first();
            $idFBaru = $lastFBaru
                ? 'FB' . str_pad(((int)substr($lastFBaru->id_franchisebaru, 2)) + 1, 4, '0', STR_PAD_LEFT)
                : 'FB0001';
        
            $fileNamelokasi = null;
            if ($filelokasi = $request->file('lokasi_usaha')) {
                $fileNamelokasi = $idFBaru . '.' . $filelokasi->extension();
                $filelokasi->move(public_path('uploads/lokasi'), $fileNamelokasi);
            }
        
            $mitra = DB::table('tb_mitra')->where('id_akun', $id_akun)->first();
            if (!$mitra) {
                return redirect()->back()->with('error', 'User belum terdaftar sebagai mitra.');
            }
        
            $data = [
                'id_franchisebaru' => $idFBaru,
                'id_mitra'         => $mitra->id_mitra,
                'nama_franchise'   => $mitra->nama_lengkap,
                'provinsi_usaha'   => $request->provinsi_usaha,
                'kota_usaha'       => $request->kota_usaha,
                'kelurahan_usaha'  => $request->kelurahan_usaha,
                'kecamatan_usaha'  => $request->kecamatan_usaha,
                'alamat_usaha'     => $request->alamat_usaha,
                'kode_pos'         => $request->kode_pos,
                'titik_koordinat'  => $request->titik_koordinat,
                'lokasi_usaha'     => $fileNamelokasi,
                'status'           => 'Proses',
            ];
        
            try {
                DB::table('tb_franchisebaru')->insert($data);
                Log::info('Franchise Baru disimpan', $data);
                return redirect('/home')->with('success', 'Pendaftaran franchise berhasil!');
            } catch (\Exception $e) {
                Log::error('Gagal simpan franchise baru: '.$e->getMessage());
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan. Silakan coba lagi.');
            }
        }
        
}
