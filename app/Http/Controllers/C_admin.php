<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Charts\BostonAdminChart;
use App\Mail\KirimNotifikasi;
use Illuminate\Support\Facades\Mail;
use App\Models\NotifikasiAdmin;

class C_admin extends Controller
{
    public function __construct()
    {
        $this->M_Admin = new M_Admin();
        $this->Transaksi = new \App\Models\Transaksi();
    }

    public function index(Request $request, BostonAdminChart $chart)
    {
        $jumlahPendaftar = DB::table('tb_calonmitra')
                            ->where('status', 'Review Dokumen')
                            ->count();

        $jumlahFranchise = DB::table('tb_franchise')
                            ->count();

        $totalditerima = DB::table('tb_calonmitra')
                            ->where('status', 'Diterima')
                            ->count();
        
        $topFranchise = DB::table('tb_penjualan')
            ->join('tb_franchise', 'tb_penjualan.id_franchise', '=', 'tb_franchise.id_franchise')
            ->select('tb_penjualan.id_franchise', 'tb_franchise.nama_franchise', DB::raw('SUM(tb_penjualan.harga) as total_penjualan'))
            ->groupBy('tb_penjualan.id_franchise', 'tb_franchise.nama_franchise')
            ->orderByDesc('total_penjualan')
            ->first();

        $pendapatan = $totalditerima * 25000000;

        $bulanAwal = $request->input('bulan_awal');     
        $bulanAkhir = $request->input('bulan_akhir');
                        
        $chart = $chart->build($bulanAwal, $bulanAkhir);
        
        $daftarbaru = DB::table('tb_calonmitra')
            ->where('status', 'Review Dokumen')
            ->get();

        $transaksi = $this->Transaksi->allData();

        // Ambil tahun dari data penjualan (otomatis)
        $tahunList = DB::table('tb_penjualan')
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
                        
        return view('admin.v_dashboard', compact(
            'daftarbaru', 'chart', 'tahunList', 'bulanAkhir', 'bulanAwal', 
            'jumlahPendaftar', 'jumlahFranchise', 'totalditerima', 
            'pendapatan', 'topFranchise', 'transaksi'
        ));
    }

    // Fungsi mencatat notifikasi
    private function tambahNotifikasi($pesan)
    {
        DB::table('notifikasi_admin')->insert([
            'pesan' => $pesan,
            'dibuat_pada' => now()
        ]);
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

        $admin = [
            'admin' => $this->M_Admin->dataakun($id_akun)
        ];

        $foto = [
            'foto' => $this->M_Admin->datamitrafoto($id_akun)
        ];
        return view('v_profileakun', $mitra, $foto);
    }

     public function indexprofileadmin()
    {
        $id_akun = Session::get('user')['id_akun'];

        $admin = DB::table('tb_akun')->where('type_akun', 'admin')->first(); // pakai first(), bukan get()


        return view('admin.v_profileakun', compact('admin'));
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

    public function index1(Request $request)
    {
        $search = $request->input('search');
        $dataCalon = $this->M_Admin->datacalon();
        if ($search) {
            $dataCalon = collect($dataCalon)->filter(function ($item) use ($search) {
                return stripos($item->id_calon, $search) !== false||
                        stripos($item->nama_lengkap, $search) !== false;;
            });
        }
        $admin = [
            'admin' => $dataCalon
        ];

        return view('admin.v_tabelcalon', $admin);
    }

    public function index2(Request $request)
    {
        $search = $request->input('search');
        $dataAkun = $this->M_Admin->dataakun();

        if ($search) {
            $dataAkun = collect($dataAkun)->filter(function ($item) use ($search) {
                return stripos($item->username, $search) !== false||
                        stripos($item->nama, $search) !== false;
            });
        }

        $admin = [
            'admin' => $dataAkun
        ];

        return view('admin.v_tabelakun', $admin);
    }

    public function index3(Request $request)
    {
        $search = $request->input('search');
        $dataProduk = $this->M_Admin->dataproduk();

        if ($search) {
            $dataProduk = collect($dataProduk)->filter(function ($item) use ($search) {
                return stripos($item->nama_produk, $search) !== false;
            });
        }

        $admin = [
            'admin' => $dataProduk
        ];
        return view('admin.v_tabelproduk', $admin);
    }


    public function index4(Request $request)
{
    $search = $request->input('search');
    $dataFranchise = $this->M_Admin->datafranchisebaru();

    if ($search) {
        $dataFranchise = collect($dataFranchise)->filter(function ($item) use ($search) {
            return stripos($item->nama_franchise, $search) !== false;
        });
    }

    $admin = [
        'admin' => $dataFranchise
    ];
    return view('admin.v_tabelfranchisebaru', $admin);
}


    public function tabelfranchise(Request $request)
{
    $search = $request->input('search');
    $dataFranchise = DB::table('tb_franchise')->get();

    if ($search) {
        $dataFranchise = collect($dataFranchise)->filter(function ($item) use ($search) {
            return stripos($item->nama_franchise, $search) !== false;
        });
    }

    return view('admin.v_tabelfranchise', ['admin' => $dataFranchise]);
}


    public function deletecalon($id_calon)
    {
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
        $this->M_Admin->deleteDataakun($id_akun);
        return redirect()->route('adminakun')->with('success', 'Akun berhasil dihapus');
    }

    public function deletefranchisebaruq($id_franchisebaru)
    {
        $this->M_Admin->deleteDatafranchisebaru($id_franchisebaru);
        return redirect()->route('adminfranchisebaru')->with('success', 'Akun berhasil dihapus');
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

        $idProduk = $lastProduk ? 
            'P' . str_pad((int) substr($lastProduk->id_produk, 1) + 1, 4, '0', STR_PAD_LEFT) : 
            'P0001';

        $fileproduk = $request->file('gambar_produk');
        $fileNameproduk = $request->nama_produk . '.' . $fileproduk->extension();
        $fileproduk->move(public_path('uploads/produk'), $fileNameproduk);

        $dataproduk = [
            'id_produk' => $idProduk,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'gambar_produk' => $fileNameproduk,
        ];

        try {
            DB::table('tb_produk')->insert($dataproduk);
            $this->tambahNotifikasi("Produk '{$request->nama_produk}' berhasil ditambahkan.");
            Log::info('Data produk berhasil disimpan.', $dataproduk);
            return redirect('/admin/tabelproduk')->with('success', 'Tambah Produk Berhasil!.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan produk: ' . $e->getMessage());
            return redirect('/admin/tabelproduk/tambah')->with('error', 'Terjadi kesalahan tambah produk. Silakan coba lagi.');
        }
    }

    public function editproduk($id_produk)
{
    $produk = $this->M_Admin->detailDataproduk($id_produk);

    if (!$produk) {
        return redirect()->route('adminproduk')->with('error', 'Produk tidak ditemukan.');
    }

    return view('admin.v_editproduk', compact('produk'));
}


    public function updateproduk($id_produk)
    {
        Request()->validate([
            'id_produk' => 'required',
            'nama_produk' => 'required|min:5|max:20',
            'harga' => 'required|integer',
            'gambar_produk' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        $data = [
            'id_produk' => Request()->id_produk,
            'nama_produk' => Request()->nama_produk,
            'harga' => Request()->harga,
        ];

        if (Request()->file('gambar_produk')) {
            $fileproduk = Request()->file('gambar_produk');
            $fileNameproduk = Request()->nama_produk . '.' . $fileproduk->extension();
            $fileproduk->move(public_path('uploads/produk'), $fileNameproduk);
            $data['gambar_produk'] = $fileNameproduk;
        }

        $this->M_Admin->editDataproduk($id_produk, $data);
        $this->tambahNotifikasi("Produk '{$data['nama_produk']}' berhasil diperbarui.");
        return redirect()->route('adminproduk')->with('pesan', 'Data berhasil diperbarui!');
    }

    public function deleteproduk($id_produk)
    {
        $produk = $this->M_Admin->detailDataproduk($id_produk);
        if ($produk) {
            $this->tambahNotifikasi("Produk '{$produk->nama_produk}' berhasil dihapus.");
        }
        $this->M_Admin->deleteDataproduk($id_produk);
        return redirect()->route('adminproduk')->with('success', 'Produk Berhasil Dihapus');
    }

    public function deletefranchisebaru($id_franchisebaru)
    {
        $this->M_Admin->deleteDatafranchisebaru($id_franchisebaru);
        return redirect()->route('adminfranchisebaru')->with('success', 'Franchise Baru Berhasil Dihapus');
    }

    // Update status untuk franchise baru
    public function updateStatus(Request $request, $id_franchisebaru)
    {
        $request->validate([
            'status' => 'required|in:Review Dokumen,Survey Lokasi,Pembayaran,Pembuatan Booth,Diterima,Ditolak'
        ]);
        
        try {
            DB::table('tb_franchisebaru')
                ->where('id_franchisebaru', $id_franchisebaru)
                ->update(['status' => $request->status]);

            $nama_lengkap = DB::table('tb_franchisebaru')
                                ->leftJoin('tb_mitra', 'tb_franchisebaru.id_mitra', '=', 'tb_mitra.id_mitra')
                                ->where('id_franchisebaru', $id_franchisebaru)
                                ->select('tb_mitra.nama_lengkap')
                                ->first();
                    
            $email = DB::table('tb_franchisebaru')
                        ->leftJoin('tb_mitra', 'tb_franchisebaru.id_mitra', '=', 'tb_mitra.id_mitra')
                        ->leftJoin('tb_akun', 'tb_mitra.id_akun', '=', 'tb_akun.id_akun')
                        ->where('id_franchisebaru', $id_franchisebaru)
                        ->select('tb_akun.email')
                        ->first();

            if ($nama_lengkap && $email) {
                Mail::to($email->email)->send(new KirimNotifikasi($nama_lengkap->nama_lengkap, $request->status));
            }
                                

            // Hanya lakukan proses ini jika status Diterima
            if ($request->status == 'Pembuatan Booth') {
                $ubah = $this->M_Admin->datafranchisepindah($id_franchisebaru);
                $id_akun = Session::get('user')['id_akun'];

                // Generate ID franchise
                $lastFranchise = DB::table('tb_franchise')
                    ->select('id_franchise')
                    ->orderByDesc('id_franchise')
                    ->first();
    
                $idFranchise = $lastFranchise ? 
                    'F' . str_pad((int) substr($lastFranchise->id_franchise, 1) + 1, 4, '0', STR_PAD_LEFT) : 
                    'F0001';

                // Masukkan ke tb_franchise
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

                // Generate ID kasir
                $lastKasir = DB::table('tb_kasir')
                    ->select('id_kasir')
                    ->orderByDesc('id_kasir')
                    ->first();

                $idKasir = $lastKasir ? 
                    'K' . str_pad((int) substr($lastKasir->id_kasir, 1) + 1, 4, '0', STR_PAD_LEFT) : 
                    'K0001';

                // Generate ID akun
                $lastAkun = DB::table('tb_akun')
                    ->select('id_akun')
                    ->orderByDesc('id_akun')
                    ->first();

                $idAkun = $lastAkun ? 
                    'A' . str_pad((int) substr($lastAkun->id_akun, 1) + 1, 4, '0', STR_PAD_LEFT) : 
                    'A0001';

                // Simpan ke tb_akun
                DB::table('tb_akun')->insert([
                    'id_akun' => $idAkun,
                    'username' => $idKasir,
                    'password' => bcrypt($idKasir),
                    'type_akun' => 'kasir',
                ]);

                // Simpan ke tb_kasir
                DB::table('tb_kasir')->insert([
                    'id_kasir' => $idKasir,
                    'id_akun' => $idAkun,
                    'id_franchise' => $idFranchise
                ]);
            }

            return back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update status: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui status.');
        }
    }

    // Update status untuk calon mitra
    public function updateStatusCalonMitra(Request $request, $id_calon)
    {
        $request->validate([
            'status' => 'required|in:Review Dokumen,Survey Lokasi,Pembayaran,Pembuatan Booth,Diterima,Ditolak'
        ]);
        
        try {
            DB::table('tb_calonmitra')
                ->where('id_calon', $id_calon)
                ->update(['status' => $request->status]);
        
                $nama_lengkap = DB::table('tb_calonmitra')
                                    ->where('id_calon', $id_calon)
                                    ->select('tb_calonmitra.nama_lengkap')
                                    ->first();
                        
                $email = DB::table('tb_calonmitra')
                            ->leftJoin('tb_akun', 'tb_calonmitra.id_akun', '=', 'tb_akun.id_akun')
                            ->where('id_calonmitra', $id_calon)
                            ->select('tb_akun.email')
                            ->first();
        
                if ($nama_lengkap && $email) {
                    Mail::to($email->email)->send(new KirimNotifikasi($nama_lengkap->nama_lengkap, $request->status));
                }
            // Jika status Diterima, buat data mitra
            if ($request->status == 'Pembuatan Booth') {
                $calon = DB::table('tb_calonmitra')
                    ->where('id_calon', $id_calon)
                    ->first();

                // Cek apakah sudah ada di tb_mitra
                $mitra = DB::table('tb_mitra')
                    ->where('id_akun', $calon->id_akun)
                    ->first();

                if (!$mitra) {
                    // Generate ID mitra
                    $lastMitra = DB::table('tb_mitra')
                        ->select('id_mitra')
                        ->orderByDesc('id_mitra')
                        ->first();

                    $idMitra = $lastMitra ? 
                        'M' . str_pad((int) substr($lastMitra->id_mitra, 1) + 1, 4, '0', STR_PAD_LEFT) : 
                        'M0001';

                    // Insert ke tb_mitra
                    DB::table('tb_mitra')->insert([
                        'id_mitra' => $idMitra,
                        'id_akun' => $calon->id_akun,
                        'nama_mitra' => $calon->nama_lengkap,
                        'alamat_mitra' => $calon->alamat,
                        'no_telepon' => $calon->no_telepon,
                        'email' => $calon->email,
                        'status' => 'Aktif',
                    ]);
                }
            }

            return back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update status calon mitra: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui status calon mitra.');
        }
    }

    public function getNotifikasi()
    {
        $notifikasi = NotifikasiAdmin::orderBy('dibuat_pada', 'desc')->take(10)->get();
        return response()->json($notifikasi);
    }
}