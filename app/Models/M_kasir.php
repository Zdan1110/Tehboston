<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class M_kasir extends Model
{
    public function allData()
    {
        return DB::table('tb_produk')->get();
    }

    public function DataHarian($id_franchise)
    {
        return DB::table('tb_penjualan')
            ->leftJoin('tb_detailpenjualan', 'tb_detailpenjualan.id_penjualan', '=', 'tb_penjualan.id_penjualan')
            ->select(
                'tb_penjualan.pelanggan',
                'tb_penjualan.tanggal',
                DB::raw("GROUP_CONCAT(tb_detailpenjualan.nama_produk SEPARATOR ', ') as nama_produk"),
                DB::raw("GROUP_CONCAT(tb_detailpenjualan.harga SEPARATOR ', ') as harga"),
                DB::raw("GROUP_CONCAT(tb_detailpenjualan.jumlah SEPARATOR ', ') as jumlah")
            )
            ->where('tb_penjualan.id_franchise', $id_franchise)
            ->whereDate('tb_penjualan.tanggal', Carbon::today())
            ->groupBy('tb_penjualan.pelanggan', 'tb_penjualan.tanggal')
            ->get();
    }

    public function DataLaporan($id_franchise)
    {
        return DB::table('tb_penjualan')
            ->leftJoin('tb_detailpenjualan', 'tb_detailpenjualan.id_penjualan', '=', 'tb_penjualan.id_penjualan')
            ->select(
                'tb_penjualan.pelanggan',
                'tb_penjualan.tanggal',
                'tb_penjualan.harga',
                DB::raw("GROUP_CONCAT(CONCAT(tb_detailpenjualan.nama_produk, ' (', tb_detailpenjualan.jumlah, ')') SEPARATOR ', ') as nama_produk"),
            )
            ->where('tb_penjualan.id_franchise', $id_franchise)
            ->groupBy('tb_penjualan.pelanggan', 'tb_penjualan.tanggal', 'tb_penjualan.harga')
            ->get();
    }

    public function DataLaporanFilter($id_franchise, $tanggal_awal, $tanggal_akhir)
    {
        return DB::table('tb_penjualan')
            ->leftJoin('tb_detailpenjualan', 'tb_detailpenjualan.id_penjualan', '=', 'tb_penjualan.id_penjualan')
            ->select(
                'tb_penjualan.pelanggan',
                'tb_penjualan.tanggal',
                'tb_penjualan.harga',
                DB::raw("GROUP_CONCAT(CONCAT(tb_detailpenjualan.nama_produk, ' (', tb_detailpenjualan.jumlah, ')') SEPARATOR ', ') as nama_produk"),
            )
            ->where('tb_penjualan.id_franchise', $id_franchise)
            ->whereBetween('tb_penjualan.tanggal', [$tanggal_awal . ' 00:00:00', $tanggal_akhir . ' 23:59:59'])
            ->groupBy('tb_penjualan.pelanggan', 'tb_penjualan.tanggal', 'tb_penjualan.harga')
            ->get();
    }
}
