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
    public function index(BostonKasirChart $chart)
    {
        return view('kasir.v_dashkasir', ['chart' => $chart->build()]);
    }

    public function kasir()
    {
        $model = new M_Kasir();
        $kasir = $model->allData();
        return view('kasir.v_kasir', compact('kasir'));
    }

    public function penjualan()
    {
        $data = penjualan::all();
        return view('kasir.penjualan', compact('data'));
    }

    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $lastPenjualan = DB::table('tb_penjualan')
            ->select('id_penjualan')
            ->orderByDesc('id_penjualan')
            ->first();

            if ($lastPenjualan) {
            $lastNumpenjualan = (int) substr($lastPenjualan->id_penjualan, 1); 
            $idPenjualan = 'T' . str_pad($lastNumpenjualan + 1, 4, '0', STR_PAD_LEFT);
            } else {
            $idPenjualan = 'T0001'; 
            }

            $id_akun = Session::get('user')['id_akun'];
            $idFranchise = DB::table('tb_kasir')
                ->join('tb_franchise', 'tb_kasir.id_franchise', '=', 'tb_franchise.id_franchise')
                ->where('tb_kasir.id_akun', $id_akun)
                ->select('tb_franchise.id_franchise')
                ->first();

            // Simpan ke tabel transaksi
            $transaksiId = DB::table('tb_penjualan')->insertGetId([
                'id_penjualan' => $idPenjualan,
                'id_franchise' => $idFranchise->id_franchise,
                'pelanggan' => $request->kode,
                'harga' => $request->total,
            ]);
            
                $lastDetail = DB::table('tb_detailpenjualan')
                ->select('id_detailpenjualan')
                ->orderByDesc('id_detailpenjualan')
                ->first();
            
            $lastNumber = 0;
            if ($lastDetail) {
                // Ambil angka dari akhir ID contoh DT000102 => 02
                $lastNumber = (int) substr($lastDetail->id_detailpenjualan, -4);
            }
            
            foreach ($request->pesanan as $index => $item) {
                $newNumber = $lastNumber + $index + 1;
                $idDetail = 'DT' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            
                DB::table('tb_detailpenjualan')->insert([
                    'id_detailpenjualan' => $idDetail,
                    'id_penjualan' => $idPenjualan,
                    'nama_produk' => $item['nama'],
                    'harga' => $item['harga'],
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

    public function pelaporan()
    {
        $data = penjualan::all();
        return view('kasir.pelaporan', compact('data'));
    }
}
