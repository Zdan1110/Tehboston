<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Charts\BostonAdminChart;

class C_admin extends Controller
{

public function index(Request $request, BostonAdminChart $chart)
{
    $jumlahPendaftar = DB::table('tb_calonmitra')
                        ->where('status', 'LIKE', '%Proses%')
                        ->count();

    $jumlahFranchise = DB::table('tb_franchise')
                        ->count();

    $totalditerima = DB::table('tb_calonmitra')
                        ->where('status', 'LIKE', '%Diterima%')
                        ->count();
    
    $topFranchise = DB::table('tb_penjualan')
        ->join('tb_franchise', 'tb_penjualan.id_franchise', '=', 'tb_franchise.id_franchise')
        ->select('tb_penjualan.id_franchise', 'tb_franchise.nama_franchise', DB::raw('SUM(tb_penjualan.harga) as total_penjualan'))
        ->groupBy('tb_penjualan.id_franchise', 'tb_franchise.nama_franchise')
        ->orderByDesc('total_penjualan')
        ->first();

    $pendapatan = $totalditerima * 25000000;

    $bulanAwal = $request->input('bulan_awal'); // format: 2025-04
    $bulanAkhir = $request->input('bulan_akhir');
                    
    $chart = $chart->build($bulanAwal, $bulanAkhir);
    
    $daftarbaru = DB::table('tb_calonmitra')
        ->where('status', 'Proses')
        ->get();

    // Ambil tahun dari data penjualan (otomatis)
    $tahunList = DB::table('tb_penjualan')
        ->selectRaw('YEAR(tanggal) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');
                    
    return view('admin.v_dashboard', compact('daftarbaru','chart', 'tahunList', 'bulanAkhir', 'bulanAwal', 'jumlahPendaftar', 'jumlahFranchise', 'totalditerima', 'pendapatan', 'topFranchise'));
}


    public function __construct()
    {
        $this->M_Admin = new M_Admin();
    }

    public function data()
    {
        $admin = [
            'admin' => $this->M_Admin->allData()
        ];
        return view('admin.v_tabelcalon', $admin);
    }

    public function indexprofile()
    {
        $id_akun = Session::get('user')['id_akun'];

        $mitra = [
            'mitra' => $this->M_Admin->datamitra($id_akun)
        ];
        $foto = [
            'foto' => $this->M_Admin->datamitrafoto($id_akun)
        ];
        return view('v_profileakun', $mitra, $foto);
    }

public function indexfranchise()
{
    $id_akun = Session::get('user')['id_akun'];

    // Cek apakah user sudah punya mitra
    $id_mitra = DB::table('tb_mitra')
                    ->select('id_mitra')
                    ->where('id_akun', $id_akun)
                    ->first();

    // Jika belum daftar mitra, redirect kembali dengan notifikasi
    if (!$id_mitra) {
        return redirect()->back()->with('error', 'Silahkan daftar mitra dulu ya');
    }

    // Ambil data franchise berdasarkan id_mitra
    $franchise = DB::table('tb_franchise')
                    ->where('id_mitra', $id_mitra->id_mitra)
                    ->get();

    // Ambil satu data foto
    $foto = DB::table('tb_franchise')
                ->select('lokasi_usaha')
                ->where('id_mitra', $id_mitra->id_mitra)
                ->get();

    // Ambil profil mitra
    $profile = DB::table('tb_mitra')
                    ->where('id_akun', $id_akun)
                    ->first();

    return view('v_franchisee', compact('franchise', 'foto', 'profile'));
}



    public function index1()
    {
        $admin = [
            'admin' => $this->M_Admin->datacalon()
        ];
        return view('admin.v_tabelcalon', $admin);
    }

    public function index2()
    {
        $admin = [
            'admin' => $this->M_Admin->dataakun()
        ];
        return view('admin.v_tabelakun', $admin);
    }

    public function index3()
    {
        $admin = [
            'admin' => $this->M_Admin->dataproduk()
        ];
        return view('admin.v_tabelproduk', $admin);
    }

    public function index4()
    {
        $admin = [
            'admin' => $this->M_Admin->datafranchisebaru()
        ];
        return view('admin.v_tabelfranchisebaru', $admin);
    }


    public function tabelfranchise()
    {
    $admin = DB::table('tb_franchise')->get(); // ambil semua data dari tabel franchise

    return view('admin.v_tabelfranchise', compact('admin'));
    }

    public function deletecalon($id_calon)
    {
        // Hapus atau delete foto
        $admin = $this->M_Admin->detailDatacalon($id_calon);
        if ($admin->ktp != "") {
            unlink(public_path('uploads/ktp') . '/' . $admin->ktp);
        }
        if ($admin->pas_photo != "") {
            unlink(public_path('uploads/photo') . '/' . $admin->pas_photo);
        }
        if ($admin->lokasi_usaha != "") {
            unlink(public_path('uploads/lokasi') . '/' . $admin->lokasi_usaha);
        }
    
        $this->M_Admin->deleteDatacalon($id_calon);
        return redirect()->route('admincalon')->with('success', 'Data berhasil dihapus');
    }

    public function deleteakun($id_akun)
    {
        $admin = $this->M_Admin->detailDataakun($id_akun);
    
        $this->M_Admin->deleteDataakun($id_akun);
        return redirect()->route('adminakun')->with('success', 'Akun berhasil dihapus');
    }

    public function tambahproduk()
    {
        return view('admin.v_tambahproduk');
    }

    public function insertproduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:25',
            'harga' => 'required|integer',
            'gambar_produk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);            
            $lastProduk = DB::table('tb_produk')
            ->select('id_produk')
            ->orderByDesc('id_produk')
            ->first();

            if ($lastProduk) {
            $lastNumproduk = (int) substr($lastProduk->id_produk, 1); 
            $idProduk = 'P' . str_pad($lastNumproduk + 1, 4, '0', STR_PAD_LEFT);
            } else {
            $idProduk = 'P0001'; 
            }

            $fileproduk = Request()->file('gambar_produk');
            $fileNameproduk = Request()->nama_produk . '.' . $fileproduk->extension();
            $fileproduk->move(public_path('uploads/produk'), $fileNameproduk);

            $dataproduk = [

                'id_produk' => $idProduk,
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'gambar_produk' => $fileNameproduk,
            ];

            try {
                DB::table('tb_produk')->insert($dataproduk);
                Log::info('Data produk berhasil disimpan.', $dataproduk);
    
                return redirect('/admin/tabelproduk')->with('success', 'Tambah Produk Berhasil!.');
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan produk: ' . $e->getMessage());
    
                return redirect('/admin/tabelproduk/tambah')->with('error', 'Terjadi kesalahan tambah produk. Silakan coba lagi.');
            }
            
        }

        public function editproduk($id_produk)
        {
            if (!$this->M_Admin->detailDataproduk($id_produk)) {
                abort(404);
            }
    
            $data = [
                'produk' => $this->M_Admin->detailDataproduk($id_produk)
            ];
            return view('admin.v_editproduk', $data);
        }

        public function updateproduk($id_produk)
        {
            Request()->validate([
                'id_produk' => 'required',
                'nama_produk' => 'required|min:5|max:20',
                'harga' => 'required|integer',
                'gambar_produk' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'nama_produk.required' => 'Nama Produk wajib di isi !',
                'nama_produk.min' => 'Nama Produk minimal 5 karakter',
                'nama_produk.max' => 'Nama Produk maksimal 20 karakter',
                'harga.required' => 'Harga Produk wajib di isi !',
            ]);
        
           
            if (Request()->file('gambar_produk')) {
              
                $fileproduk = Request()->file('gambar_produk');
                $fileNameproduk = Request()->nama_produk . '.' . $fileproduk->extension();
                $fileproduk->move(public_path('uploads/produk'), $fileNameproduk);
        
                $data = [
                    'id_produk' => Request()->id_produk,
                    'nama_produk' => Request()->nama_produk,
                    'harga' => Request()->harga,
                    'gambar_produk' => $fileNameproduk,
                ];
            } else {
               
                $data = [
                    'id_produk' => Request()->id_produk,
                    'nama_produk' => Request()->nama_produk,
                    'harga' => Request()->harga,
                ];
            }
        
            $this->M_Admin->editDataproduk($id_produk, $data);
        
            return redirect()->route('adminproduk')->with('pesan', 'Data berhasil diperbarui!');
        }

        public function deleteproduk($id_produk)
        {
            // Hapus atau delete foto
            $produk = $this->M_Admin->detailDataproduk($id_produk);
        
            $this->M_Admin->deleteDataproduk($id_produk);
            return redirect()->route('adminproduk')->with('success', 'Produk Berhasil Dihapus');
        }

        public function updateStatus(Request $request, $id_franchisebaru)
        {
            $request->validate([
                'status' => 'required|in:Proses,Diterima,Ditolak'
            ]);
        
            try {
                DB::table('tb_franchisebaru')
                    ->where('id_franchisebaru', $id_franchisebaru)
                    ->update([
                        'status' => $request->status
                    ]);

                if ($request->status == 'Diterima') {

                    $ubah = $this->M_Admin->datafranchisepindah($id_franchisebaru);

                    $id_akun = Session::get('user')['id_akun'];
                    $nama_franchise = Session::get('user')['username'];

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
                        'id_mitra' => $ubah->id_mitra,
                        'nama_franchise' => $ubah->nama_franchise,
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

