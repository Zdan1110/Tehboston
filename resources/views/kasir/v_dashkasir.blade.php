@extends('kasir.template_kasir')

@section('title', 'Dashboard Kasir')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Card Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pendapatan Hari Ini -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-wallet text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pendapatan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800">Rp 3.250.000</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>12% dari kemarin</span>
                </div>
            </div>
        </div>

        <!-- Pengeluaran Hari Ini -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                        <i class="fas fa-money-bill-wave text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pengeluaran Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800">Rp 1.120.000</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-red-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>8% dari kemarin</span>
                </div>
            </div>
        </div>

        <!-- Jumlah Pelanggan -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pelanggan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800">42</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-blue-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>5 dari kemarin</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Tabel Transaksi (2/3 width) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Histori Transaksi Terakhir</h3>
                    <a href="/pelaporan" class="text-sm text-green-600 hover:text-green-800 font-medium">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Data Dummy Transaksi -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TRX-20230601-001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10:15 WIB</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Budi Santoso</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 125.000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TRX-20230601-002</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11:30 WIB</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ani Wijaya</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 85.000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TRX-20230601-003</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12:45 WIB</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Citra Dewi</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 210.000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TRX-20230601-004</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">14:20 WIB</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Doni Pratama</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 65.000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">TRX-20230601-005</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">16:05 WIB</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Eva Susanti</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 175.000</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Batal</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 text-right">
                    <nav class="inline-flex">
                        <a href="#" class="px-3 py-1 rounded-md bg-green-600 text-white font-medium">1</a>
                        <a href="#" class="ml-1 px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">2</a>
                        <a href="#" class="ml-1 px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">3</a>
                        <a href="#" class="ml-1 px-3 py-1 rounded-md bg-white text-gray-700 hover:bg-gray-100">Next</a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ... bagian sebelumnya ... -->

<!-- Stok Bahan Baku (1/3 width) -->
<div class="lg:col-span-1">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Stok Bahan Baku</h3>
            <a href="/tambah-stok" class="text-sm text-green-600 hover:text-green-800 font-medium flex items-center">
                <i class="fas fa-plus-circle mr-1"></i> Tambah
            </a>
        </div>
        <div class="divide-y divide-gray-200">
            <!-- Data Dummy Stok -->
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

<!-- ... bagian setelahnya ... -->
@endsection