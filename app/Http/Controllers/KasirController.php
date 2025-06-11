<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\BostonKasirChart;
use App\Models\M_Kasir;
use App\Models\penjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; 
use Carbon\Carbon;

class KasirController extends Controller
{
    protected $kasir;

    public function __construct()
    {
        $this->kasir = new M_Kasir(); // Inisialisasi model kasir
    }

    public function index(BostonKasirChart $chart)
    {
        return view('kasir.v_dashkasir', ['chart' => $chart->build()]);
    }

    public function kasir()
    {
        $model = new M_Kasir();
        $kasir = $model->allData();
        $id_akun = Session::get('user')['id_akun'];
        $idFranchise = DB::table('tb_kasir')
            ->join('tb_franchise', 'tb_kasir.id_franchise', '=', 'tb_franchise.id_franchise')
            ->where('tb_kasir.id_akun', $id_akun)
            ->select('tb_franchise.id_franchise')
            ->first();
        $id_franchise = $idFranchise->id_franchise;
        $riwayat = $model->DataHarian($id_franchise);
        return view('kasir.v_kasir', compact('kasir', 'riwayat'));
    }

    public function laporan(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $model = new M_Kasir();
        $id_akun = Session::get('user')['id_akun'];
        $idFranchise = DB::table('tb_kasir')
            ->join('tb_franchise', 'tb_kasir.id_franchise', '=', 'tb_franchise.id_franchise')
            ->where('tb_kasir.id_akun', $id_akun)
            ->select('tb_franchise.id_franchise')
            ->first();
        $id_franchise = $idFranchise->id_franchise;

        if ($tanggal_awal && $tanggal_akhir) {
            $penjualan = $model->DataLaporanFilter($id_franchise, $tanggal_awal, $tanggal_akhir);
        } else {
            $penjualan = $model->DataLaporan($id_franchise);
        }

        return view('kasir.v_pelaporan', compact('penjualan'));
    }

    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $lastPenjualan = DB::table('tb_penjualan')
                ->select('id_penjualan')
                ->orderByDesc('id_penjualan')
                ->first();

            $idPenjualan = $lastPenjualan
                ? 'T' . str_pad((int) substr($lastPenjualan->id_penjualan, 1) + 1, 4, '0', STR_PAD_LEFT)
                : 'T0001';

            $id_akun = Session::get('user')['id_akun'];
            $idFranchise = DB::table('tb_kasir')
                ->join('tb_franchise', 'tb_kasir.id_franchise', '=', 'tb_franchise.id_franchise')
                ->where('tb_kasir.id_akun', $id_akun)
                ->select('tb_franchise.id_franchise')
                ->first();

            DB::table('tb_penjualan')->insert([
                'id_penjualan' => $idPenjualan,
                'id_franchise' => $idFranchise->id_franchise,
                'pelanggan' => $request->kode,
                'harga' => $request->total,
            ]);
            
            $lastDetail = DB::table('tb_detailpenjualan')
                ->select('id_detailpenjualan')
                ->orderByDesc('id_detailpenjualan')
                ->first();

            $lastNumber = $lastDetail ? (int) substr($lastDetail->id_detailpenjualan, -4) : 0;
            
            foreach ($request->pesanan as $index => $item) {
                $newNumber = $lastNumber + $index + 1;
                $idDetail = 'DT' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            
                DB::table('tb_detailpenjualan')->insert([
                    'id_detailpenjualan' => $idDetail,
                    'id_penjualan' => $idPenjualan,
                    'nama_produk' => $item['nama'],
                    'harga' => $item['harga'] * $item['jumlah'],
                    'jumlah' => $item['jumlah'],
                ]);
            }
            
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        penjualan::where('id_penjualan', $id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    // ================================
    // ✅ Bagian Edit Akun Kasir
    // ================================

    public function editakun($id_akun)
    {
        $akun = $this->kasir->getAkunById($id_akun); 

        if (!$akun) {
            abort(404);
        }

        return view('kasir.v_editakun', compact('akun'));
    }

    public function updateakun($id_akun)
    {
        Request()->validate([
            'username' => 'required|min:5|max:20',
            'password' => 'nullable|min:6|max:100',
        ]);

        $data = [
            'username' => Request()->username,
        ];

        if (Request()->filled('password')) {
            $data['password'] = bcrypt(Request()->password);
        }

        $this->kasir->updateAkun($id_akun, $data);

        return redirect()->route('editakun', ['id_akun' => $id_akun])->with('pesan', 'Akun kasir berhasil diperbarui!');
    }
}
