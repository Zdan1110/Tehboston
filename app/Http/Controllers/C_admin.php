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

    public function index(BostonAdminChart $chart)
    {
        return view('admin.v_dashboard', ['chart' => $chart->build()]);
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
}

