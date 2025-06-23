<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\BostonKasirChart;
use App\Models\M_Kasir;
use App\Models\penjualan; // Assuming 'penjualan' is your model for tb_penjualan
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

    public function index(Request $request, BostonKasirChart $chart)
    {
        $bulanAwal = $request->input('bulan_awal'); // format: 2025-04
        $bulanAkhir = $request->input('bulan_akhir');
        $id_akun = Session::get('user')['id_akun'];

        // Get id_franchise for the logged-in kasir
        $idFranchise = DB::table('tb_kasir')
            ->join('tb_franchise', 'tb_kasir.id_franchise', '=', 'tb_franchise.id_franchise')
            ->where('tb_kasir.id_akun', $id_akun)
            ->select('tb_franchise.id_franchise')
            ->first();

        // Check if idFranchise exists before proceeding
        if (!$idFranchise) {
            Log::warning("Kasir with id_akun: {$id_akun} not linked to any franchise.");
            return redirect('/')->with('error', 'Akun kasir tidak terhubung dengan franchise.');
        }

        $currentFranchiseId = $idFranchise->id_franchise;

        $pendapatanperhari = DB::table('tb_penjualan')
            ->select('id_franchise', DB::raw('SUM(harga) as total_pendapatan'))
            ->whereDate('tanggal', Carbon::today())
            ->where('id_franchise', $currentFranchiseId)
            ->groupBy('id_franchise')
            ->orderBy('id_franchise', 'asc')
            ->first();

        $pendapatanbulanini = DB::table('tb_penjualan')
            ->select('id_franchise', DB::raw('SUM(harga) as total_pendapatan'))
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->where('id_franchise', $currentFranchiseId)
            ->groupBy('id_franchise')
            ->orderBy('id_franchise', 'asc')
            ->first();

        $jumlahpelangganperhari = DB::table('tb_penjualan')
            ->select('id_franchise', DB::raw('COUNT(*) as total_transaksi'))
            ->whereDate('tanggal', Carbon::today())
            ->where('id_franchise', $currentFranchiseId)
            ->groupBy('id_franchise')
            ->orderBy('id_franchise', 'asc')
            ->first();

        $chart = $chart->build($bulanAwal, $bulanAkhir);

        $tahunList = DB::table('tb_penjualan')
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // --- START: MODIFIED CODE TO INCLUDE PELANGGAN ---
        $penjualan = DB::table('tb_detailpenjualan as dp')
            ->join('tb_penjualan as p', 'dp.id_penjualan', '=', 'p.id_penjualan')
            ->select(
                'p.id_penjualan',
                'p.pelanggan',     // <-- Added this line to select the customer name
                'dp.nama_produk',
                'dp.jumlah',
                'dp.harga',
                'p.tanggal'
            )
            ->where('p.id_franchise', $currentFranchiseId)
            ->orderBy('p.tanggal', 'desc')
            ->limit(5)
            ->get();
        // --- END: MODIFIED CODE ---

        return view('kasir.v_dashkasir', compact('chart', 'tahunList', 'bulanAkhir', 'bulanAwal', 'pendapatanperhari', 'pendapatanbulanini', 'jumlahpelangganperhari', 'penjualan'));
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
                'pelanggan' => $request->kode, // This value is inserted here
                'harga' => $request->total,
                'tanggal' => Carbon::now(),
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
            return response()->json(['success' => true, 'redirect' => url('/print/{id_penjualan}')]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Checkout failed: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::table('tb_detailpenjualan')->where('id_penjualan', $id)->delete();
        penjualan::where('id_penjualan', $id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

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

    public function print()
    {
        
        return view('kasir.v_print');
    }
}