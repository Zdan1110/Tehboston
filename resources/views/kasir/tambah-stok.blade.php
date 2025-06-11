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
                    <select id="supplier" name="supplier" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Pilih Supplier</option>
                        <option value="PT Sari Wangi">PT Sari Wangi</option>
                        <option value="CV Rasa Segar">CV Rasa Segar</option>
                        <option value="UD Bahagia Jaya">UD Bahagia Jaya</option>
                        <option value="Toko Sumber Rejeki">Toko Sumber Rejeki</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Form Serbuk Teh (Awalnya tersembunyi) -->
        <div id="serbuk-form" class="hidden">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Serbuk Teh</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Varian Lemon Tea -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-yellow-100 p-2 rounded-full mr-3">
                            <i class="fas fa-lemon text-yellow-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Serbuk Lemon Tea</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="lemon_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="lemon_unit" class="px-3 py-1 border rounded-lg">
                            <option value="pack">Pack</option>
                            <option value="kg">Kg</option>
                            <option value="gram">Gram</option>
                        </select>
                    </div>
                </div>
                
                <!-- Varian Original -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                            <i class="fas fa-leaf text-green-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Serbuk Original Tea</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="original_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="original_unit" class="px-3 py-1 border rounded-lg">
                            <option value="pack">Pack</option>
                            <option value="kg">Kg</option>
                            <option value="gram">Gram</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Sirup (Awalnya tersembunyi) -->
        <div id="sirup-form" class="hidden">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Sirup Marjan</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Leci -->
                <div class="bg-pink-50 border border-pink-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-pink-100 p-2 rounded-full mr-3">
                            <i class="fas fa-cube text-pink-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Sirup Marjan Leci</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="leci_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="leci_unit" class="px-3 py-1 border rounded-lg">
                            <option value="botol">Botol</option>
                            <option value="liter">Liter</option>
                        </select>
                    </div>
                </div>
                
                <!-- Melon -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                            <i class="fas fa-watermelon text-green-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Sirup Marjan Melon</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="melon_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="melon_unit" class="px-3 py-1 border rounded-lg">
                            <option value="botol">Botol</option>
                            <option value="liter">Liter</option>
                        </select>
                    </div>
                </div>
                
                <!-- Mangga -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-yellow-100 p-2 rounded-full mr-3">
                            <i class="fas fa-apple-alt text-yellow-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Sirup Marjan Mangga</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="mangga_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="mangga_unit" class="px-3 py-1 border rounded-lg">
                            <option value="botol">Botol</option>
                            <option value="liter">Liter</option>
                        </select>
                    </div>
                </div>
                
                <!-- Coco Pandan -->
                <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-emerald-100 p-2 rounded-full mr-3">
                            <i class="fas fa-cookie text-emerald-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Sirup Marjan Coco Pandan</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="coco_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="coco_unit" class="px-3 py-1 border rounded-lg">
                            <option value="botol">Botol</option>
                            <option value="liter">Liter</option>
                        </select>
                    </div>
                </div>
                
                <!-- Markisa -->
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="bg-purple-100 p-2 rounded-full mr-3">
                            <i class="fas fa-star text-purple-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Sirup Marjan Markisa</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="markisa_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="markisa_unit" class="px-3 py-1 border rounded-lg">
                            <option value="botol">Botol</option>
                            <option value="liter">Liter</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Yakult -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Produk Lainnya</h3>
                
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 max-w-md">
                    <div class="flex items-center mb-3">
                        <div class="bg-amber-100 p-2 rounded-full mr-3">
                            <i class="fas fa-wine-bottle text-amber-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-800">Yakult</h4>
                    </div>
                    <div class="flex items-center">
                        <input type="number" name="yakult_qty" placeholder="Jumlah" class="w-20 px-3 py-1 border rounded-lg mr-2" min="1">
                        <select name="yakult_unit" class="px-3 py-1 border rounded-lg">
                            <option value="botol">Botol</option>
                            <option value="pack">Pack (5 botol)</option>
                        </select>
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