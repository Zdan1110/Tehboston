@extends('kasir.template_kasir')

@section('title', 'Tambah Stok')
@section('page-title', 'Tambah Stok Bahan Baku')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Tambah Stok Bahan Baku</h2>
    
    <form action="#" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Kategori Bahan Baku -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="category-btn bg-green-100 border border-green-400 text-green-700 py-3 px-4 rounded-lg font-medium transition-all hover:bg-green-200 active:bg-green-300" data-category="serbuk">
                        <i class="fas fa-box-open mr-2"></i> Serbuk Teh
                    </button>
                    <button type="button" class="category-btn bg-blue-100 border border-blue-400 text-blue-700 py-3 px-4 rounded-lg font-medium transition-all hover:bg-blue-200 active:bg-blue-300" data-category="sirup">
                        <i class="fas fa-wine-bottle mr-2"></i> Sirup
                    </button>
                </div>
            </div>
            
            <!-- Tanggal dan Supplier -->
            <div>
                <div class="mb-4">
                    <label for="tanggal" class="block text-gray-700 font-medium mb-2">Tanggal Pembelian</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" value="{{ date('Y-m-d') }}">
                </div>
                
                <div>
                    <label for="supplier" class="block text-gray-700 font-medium mb-2">Supplier</label>
                    <input type="text" id="supplier" name="supplier" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Nama Supplier">
                </div>
            </div>
        </div>
        
        <!-- Form Serbuk Teh (Awalnya tersembunyi) -->
        <div id="serbuk-form" class="hidden">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Serbuk Teh</h3>
            
            <div class="space-y-4">
                <!-- Input untuk Serbuk Teh -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Bahan</label>
                            <input type="text" name="nama_bahan" class="w-full px-3 py-2 border rounded-lg" placeholder="Nama Bahan" value="Serbuk Teh Lemon" readonly>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Stok</label>
                            <input type="number" name="stok" placeholder="Jumlah" class="w-full px-3 py-2 border rounded-lg" min="1">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Satuan</label>
                            <select name="satuan" class="w-full px-3 py-2 border rounded-lg">
                                <option value="pack">Pack</option>
                                <option value="kg">Kg</option>
                                <option value="gram">Gram</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Input untuk Original Tea -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Bahan</label>
                            <input type="text" name="nama_bahan" class="w-full px-3 py-2 border rounded-lg" placeholder="Nama Bahan" value="Serbuk Teh Original" readonly>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Stok</label>
                            <input type="number" name="stok" placeholder="Jumlah" class="w-full px-3 py-2 border rounded-lg" min="1">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Satuan</label>
                            <select name="satuan" class="w-full px-3 py-2 border rounded-lg">
                                <option value="pack">Pack</option>
                                <option value="kg">Kg</option>
                                <option value="gram">Gram</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Sirup (Awalnya tersembunyi) -->
        <div id="sirup-form" class="hidden">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Sirup</h3>
            
            <div class="space-y-4">
                <!-- Input untuk Sirup Leci -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Bahan</label>
                            <input type="text" name="nama_bahan" class="w-full px-3 py-2 border rounded-lg" placeholder="Nama Bahan" value="Sirup Leci" readonly>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Stok</label>
                            <input type="number" name="stok" placeholder="Jumlah" class="w-full px-3 py-2 border rounded-lg" min="1">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Satuan</label>
                            <select name="satuan" class="w-full px-3 py-2 border rounded-lg">
                                <option value="botol">Botol</option>
                                <option value="liter">Liter</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Input untuk Sirup Melon -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Bahan</label>
                            <input type="text" name="nama_bahan" class="w-full px-3 py-2 border rounded-lg" placeholder="Nama Bahan" value="Sirup Melon" readonly>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Stok</label>
                            <input type="number" name="stok" placeholder="Jumlah" class="w-full px-3 py-2 border rounded-lg" min="1">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Satuan</label>
                            <select name="satuan" class="w-full px-3 py-2 border rounded-lg">
                                <option value="botol">Botol</option>
                                <option value="liter">Liter</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Input untuk Yakult -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Nama Bahan</label>
                            <input type="text" name="nama_bahan" class="w-full px-3 py-2 border rounded-lg" placeholder="Nama Bahan" value="Yakult" readonly>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Stok</label>
                            <input type="number" name="stok" placeholder="Jumlah" class="w-full px-3 py-2 border rounded-lg" min="1">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Satuan</label>
                            <select name="satuan" class="w-full px-3 py-2 border rounded-lg">
                                <option value="botol">Botol</option>
                                <option value="pack">Pack (5 botol)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tombol Submit -->
        <div class="flex justify-end mt-8">
            <button type="button" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg font-medium mr-4 hover:bg-gray-400 transition">
                Batal
            </button>
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition flex items-center">
                <i class="fas fa-save mr-2"></i> Simpan Stok
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryBtns = document.querySelectorAll('.category-btn');
    const serbukForm = document.getElementById('serbuk-form');
    const sirupForm = document.getElementById('sirup-form');
    
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Reset semua tombol
            categoryBtns.forEach(b => {
                b.classList.remove('ring-2', 'ring-green-500', 'ring-offset-2');
            });
            
            // Highlight tombol yang dipilih
            this.classList.add('ring-2', 'ring-green-500', 'ring-offset-2');
            
            // Tampilkan form yang sesuai
            const category = this.dataset.category;
            if(category === 'serbuk') {
                serbukForm.classList.remove('hidden');
                sirupForm.classList.add('hidden');
            } else if(category === 'sirup') {
                sirupForm.classList.remove('hidden');
                serbukForm.classList.add('hidden');
            }
        });
    });
});
</script>

<style>
    .category-btn:focus {
        outline: none;
    }
</style>
@endsection