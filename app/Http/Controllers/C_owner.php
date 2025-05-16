<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_owner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class C_owner extends Controller
{
    public function __construct()
    {
        $this->M_owner = new M_owner();
    }

    public function index()
    {
        $owner = [
            'owner' => $this->M_owner->allData()
        ];
        return view('owner.v_tabelcalon', $owner);
    }

    public function index2()
    {
        $owner = [
            'owner' => $this->M_owner->dataakun()
        ];
        return view('owner.v_tabelakun', $owner);
    }

    public function index3()
    {
        $owner = [
            'owner' => $this->M_owner->dataproduk()
        ];
        return view('owner.v_tabelproduk', $owner);
    }

    public function deletecalon($id_calon)
    {
        // Hapus atau delete foto
        $owner = $this->M_owner->detailDatacalon($id_calon);
        if ($owner->ktp != "") {
            unlink(public_path('uploads/ktp') . '/' . $owner->ktp);
        }
        if ($owner->pas_photo != "") {
            unlink(public_path('uploads/photo') . '/' . $owner->pas_photo);
        }
        if ($owner->lokasi_usaha != "") {
            unlink(public_path('uploads/lokasi') . '/' . $owner->lokasi_usaha);
        }
    
        $this->M_owner->deleteDatacalon($id_calon);
        return redirect()->route('ownercalon')->with('success', 'Data berhasil dihapus');
    }

    public function deleteakun($id_akun)
    {
        // Hapus atau delete foto
        $owner = $this->M_owner->detailDataakun($id_akun);
    
        $this->M_owner->deleteDataakun($id_akun);
        return redirect()->route('ownerakun')->with('success', 'Akun berhasil dihapus');
    }

    public function updatetipe(Request $request, $id_akun)
    {
        $request->validate([
            'type_akun' => 'required|in:admin,user'
        ]);
    
        try {
            DB::table('tb_akun')
                ->where('id_akun', $id_akun)
                ->update([
                    'type_akun' => $request->type_akun
                ]);
    
            return back()->with('success', 'Tipe berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update Tipe: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui Tipe.');
        }
    }

    public function tambahproduk()
    {
        return view('owner.v_tambahproduk');
    }

    public function insertproduk(Request $request)
    {
        // Validasi Input
        $request->validate([
            'nama_produk' => 'required|string|max:25',
            'harga' => 'required|integer',
            'gambar_produk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);            
            // Di Controller saat insert:
            $lastProduk = DB::table('tb_produk')
            ->select('id_produk')
            ->orderByDesc('id_produk')
            ->first();

            if ($lastProduk) {
            $lastNumproduk = (int) substr($lastProduk->id_produk, 1); // ambil angka setelah 'C'
            $idProduk = 'P' . str_pad($lastNumproduk + 1, 4, '0', STR_PAD_LEFT);
            } else {
            $idProduk = 'P0001'; // Kalau belum ada data
            }

            $fileproduk = Request()->file('gambar_produk');
            $fileNameproduk = Request()->nama_produk . '.' . $fileproduk->extension();
            $fileproduk->move(public_path('uploads/produk'), $fileNameproduk);

            // Simpan Data ke Database
            $dataproduk = [
                // Data Calon Mitra
                'id_produk' => $idProduk,
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'gambar_produk' => $fileNameproduk,
            ];

            try {
                DB::table('tb_produk')->insert($dataproduk);
                Log::info('Data produk berhasil disimpan.', $dataproduk);
    
                // Redirect ke /home jika sukses
                return redirect('/owner/tabelproduk')->with('success', 'Tambah Produk Berhasil!.');
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan produk: ' . $e->getMessage());
    
                // Redirect balik ke /daftarmitra dengan pesan error
                return redirect('/owner/tabelproduk/tambah')->with('error', 'Terjadi kesalahan tambah produk. Silakan coba lagi.');
            }
            
        }

        public function editproduk($id_produk)
        {
            if (!$this->M_owner->detailDataproduk($id_produk)) {
                abort(404);
            }
    
            $data = [
                'produk' => $this->M_owner->detailDataproduk($id_produk)
            ];
            return view('owner.v_editproduk', $data);
        }

        public function updateproduk($id_produk)
        {
            Request()->validate([
                'id_produk' => 'required',
                'nama_produk' => 'required|min:5|max:20',
                'harga' => 'required|integer',
                'gambar_produk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'nama_produk.required' => 'Nama Produk wajib di isi !',
                'nama_produk.min' => 'Nama Produk minimal 5 karakter',
                'nama_produk.max' => 'Nama Produk maksimal 20 karakter',
                'harga.required' => 'Harga Produk wajib di isi !',
            ]);
        
            // Jika validasi tidak ada, maka lakukan simpan data
            if (Request()->file('gambar_produk')) {
                // Jika ganti gambar/foto
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
                // Jika tidak ganti gambar
                $data = [
                    'id_produk' => Request()->id_produk,
                    'nama_produk' => Request()->nama_produk,
                    'harga' => Request()->harga,
                ];
            }
        
            $this->M_owner->editDataproduk($id_produk, $data);
        
            return redirect()->route('ownerproduk')->with('pesan', 'Data berhasil diperbarui!');
        }

        public function deleteproduk($id_produk)
        {
            // Hapus atau delete foto
            $produk = $this->M_owner->detailDataproduk($id_produk);
        
            $this->M_owner->deleteDataproduk($id_produk);
            return redirect()->route('ownerproduk')->with('success', 'Produk Berhasil Dihapus');
        }
}
