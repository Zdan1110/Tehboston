<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\BostonKasirChart;
use App\Models\M_Kasir;
use App\Models\penjualan; // Use the penjualan model

class KasirController extends Controller
{

    public function index(BostonKasirChart $chart)
    {
        return view('kasir.v_dashkasir', ['chart' => $chart->build()]);
        
    } 

    public function kasir()
    {
        $model = new M_kasir();
        $kasir = $model->allData(); // Ambil data dari method allData()
        return view('kasir.v_kasir', compact('kasir'));
    }

    public function penjualan()
    {
        // Use the penjualan model to retrieve all data
        $data = penjualan::all();
        return view('kasir.penjualan', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan' => 'required|string',
            'menu' => 'required|string',
            'total' => 'required|numeric',
            'waktu' => 'required|string',
        ]);

        $lastPenjualan = DB::table('tb_penjualan')
        ->select('id_penjualan')
        ->orderByDesc('id_penjualan')
        ->first();

        if ($lastPenjualan) {
        $lastNumpenjualan = (int) substr($lastPenjualan->id_penjualan, 1); 
        $idPenjualan = 'J' . str_pad($lastNumpenjualan + 1, 4, '0', STR_PAD_LEFT);
        } else {
        $idPenjualan = 'J0001'; 
        }
    
        M_kasir::create([
            'id_penjualan' => $idPenjualan,
            'pelanggan' => $validated['pelanggan'],
            'menu' => $validated['menu'],
            'harga' => $validated['total'],
            'tanggal' => Carbon::createFromFormat('d/M/yyyy, HH.mm.ss', $validated['waktu'])->format('Y-m-d H:i:s'),
        ]);
    
        return response()->json(['success' => true]);
    }
    

    public function destroy($id)
    {
       
        penjualan::where('id_pelanggan', $id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function pelaporan()
    {
        $data = penjualan::all(); // Ambil semua data penjualan
        return view('kasir.pelaporan', compact('data'));
    }

} 