<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\BostonKasirChart;
use App\Models\M_Kasir;
use App\Models\penjualan;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string',
            'total' => 'required|numeric',
            'tanggal' => 'required|string', // Format: 'd/m/Y'
        ]);

        $lastPenjualan = DB::table('tb_penjualan')
            ->select('id_penjualan')
            ->orderByDesc('id_penjualan')
            ->first();

        if ($lastPenjualan) {
            $lastNum = (int) substr($lastPenjualan->id_penjualan, 1);
            $idPenjualan = 'J' . str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $idPenjualan = 'J0001';
        }

        // Simpan data ke tabel penjualan
        penjualan::create([
            'id_penjualan' => $idPenjualan,
            'id_kasir' => session('user')['id_kasir'] ?? 'K0001', // sesuaikan defaultnya jika perlu
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'total' => $validated['total'],
            'tanggal' => Carbon::createFromFormat('d/m/Y', $validated['tanggal'])->format('Y-m-d'),
        ]);

        return response()->json(['success' => true]);
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
