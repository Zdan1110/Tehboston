<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BostonAdminChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Ambil total harga penjualan per pelanggan
        $penjualan = DB::table('tb_penjualan')
        ->select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('SUM(harga) as total_harga'))
        ->groupBy(DB::raw('DATE(tanggal)'))
        ->get();
    

        // Pisahkan data untuk chart
        $labels = $penjualan->pluck('pelanggan')->toArray();
        $data = $penjualan->pluck('total_harga')->toArray();

        return $this->chart->lineChart()
            ->setTitle('Total Penjualan per Pelanggan')
            ->setSubtitle('Berdasarkan data pada tb_penjualan')
            ->addData('Total Harga', $data)
            ->setXAxis($labels);
    }
}
