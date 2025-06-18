@extends('kasir.template_kasir')

@section('title', 'Dashboard Kasir')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pendapatan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($pendapatanperhari->total_pendapatan ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600">
                    <p class="fas fa-arrow-up mr-1"></i>
                    <span>12% dari kemarin</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                        <i class="fas fa-money-bill-wave text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pendapatan Bulan Ini</p>
                        <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($pendapatanbulanini->total_pendapatan ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-red-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>8% dari kemarin</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pelanggan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $jumlahpelangganperhari->total_transaksi ?? 0 }} Pelanggan</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-blue-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>5 dari kemarin</span>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ url('/dashkasir') }}" class="filter-section" style="margin-bottom: 15px;">
        <label><strong>Filter Bulan:</strong></label>
        <input type="month" name="bulan_awal" value="{{ request('bulan_awal') }}">
        <span>sampai</span>
        <input type="month" name="bulan_akhir" value="{{ request('bulan_akhir') }}">
        <button type="submit">Filter</button>
    </form>
    <div class="row">
        <div class="col-md-8" style="width: 1300px">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                    </div>
                </div>
                <div class="card-body">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Histori Transaksi Terakhir</h3>
                    <a href="/pelaporan" class="text-sm text-green-600 hover:text-green-800 font-medium">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    @if(!empty($penjualan) && count($penjualan) > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th> {{-- <-- ADDED THIS HEADER --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu (Jumlah terjual)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Item</th> {{-- Changed from 'Total Harga' as this is per item detail --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Transaksi</th> {{-- Changed from 'Waktu' for clarity --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $no = 1; @endphp
                                @foreach($penjualan as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $no++ }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->pelanggan }}</td> {{-- <-- ADDED THIS CELL --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nama_produk }} ({{ $item->jumlah }})</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button type="button" class="text-red-600 hover:text-red-900" onclick="alert('Fitur hapus belum diimplementasikan.')">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="px-6 py-4 text-gray-600 text-center">Tidak ada data transaksi untuk ditampilkan.</p>
                    @endif
                </div>
                {{-- Pagination (if you implement it for $penjualan) --}}
                {{-- <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 text-right">
                    <nav class="inline-flex">
                        <a href="#" class="px-3 py-1 rounded-md bg-green-600 text-white font-medium">1</a>
                        <a href="#" class="ml-1 px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">2</a>
                        <a href="#" class="ml-1 px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">3</a>
                        <a href="#" class="ml-1 px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">Next</a>
                    </nav>
                </div> --}}
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Stok Bahan Baku</h3>
                    <a href="/tambah-stok" class="text-sm text-green-600 hover:text-green-800 font-medium flex items-center">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Serbuk Lemon Tea</p>
                            <p class="text-sm text-gray-500">500gr/pack</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">8 Pack</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Serbuk Original Tea</p>
                            <p class="text-sm text-gray-500">500gr/pack</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">12 Pack</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Sirup Marjan Leci</p>
                            <p class="text-sm text-gray-500">1 botol</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">3 Botol</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Sirup Marjan Melon</p>
                            <p class="text-sm text-gray-500">1 botol</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">7 Botol</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Sirup Marjan Mangga</p>
                            <p class="text-sm text-gray-500">1 botol</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">10 Botol</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Sirup Marjan Coco Pandan</p>
                            <p class="text-sm text-gray-500">1 botol</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">5 Botol</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Sirup Marjan Markisa</p>
                            <p class="text-sm text-gray-500">1 botol</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">6 Botol</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Yakult</p>
                            <p class="text-sm text-gray-500">1 botol</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">15 Botol</span>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <a href="/tambah-stok" class="text-sm font-medium text-green-600 hover:text-green-800 flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Stok
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{{ $chart->script() }}
@endsection