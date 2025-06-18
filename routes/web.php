<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_Home;
use App\Http\Controllers\C_Dosen;
use App\Http\Controllers\C_Mahasiswa;
// use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_admin;
use App\Http\Controllers\C_owner;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalonMitraController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\C_Status;
use App\Http\Controllers\C_Survey;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TransaksiController;


Route::view('/contact', 'v_contact');
Route::view('/tambah-stok', 'kasir.tambah-stok');
Route::view('/status', 'v_preview');
Route::view('/coba', 'admin.v_dashboardcoba');
Route::view('/cek-status', 'v_status');
Route::get('/admin', [C_admin::class, 'index'])->name('admin.v_dashboard');
Route::get('/kasir', [KasirController::class, 'kasir']);
Route::get('/kasircoba', [KasirController::class, 'admincoba']);
Route::get('/pelaporan', [KasirController::class, 'pelaporan']);
Route::post('/kasir/store', [KasirController::class, 'store'])->name('kasir.store');
Route::post('/kasir/checkout', [KasirController::class, 'checkout']);
// Route::view('/admin', 'admin.v_tabelcalon');
Route::view('/admin/tabelcalon', 'admin.v_tabelcalon');
Route::get('/admin/tabelfranchise', [C_admin::class, 'tabelfranchise'])->name('adminfranchise');
// Route::view('/admin/tabelfranchise', 'admin.v_tabelfranchise');
Route::view('/', 'v_index');

Route::get('/profiles', [C_admin::class, 'indexprofile']);
Route::get('/franchisee', [C_admin::class, 'indexfranchise']);
Route::get('/admin/tabelcalon', [C_admin::class, 'index1'])->name('admincalon');
Route::get('/admin/tabelakun', [C_admin::class, 'index2'])->name('adminakun');
Route::get('/admin/tabelproduk', [C_admin::class, 'index3'])->name('adminproduk');
Route::get('/admin/tabelfranchisebaru', [C_admin::class, 'index4'])->name('adminfranchisebaru');
Route::put('/admin/calonmitra/update-status/{id_calonmitra}', [CalonMitraController::class, 'updateStatus'])->name('calonmitra.updateStatus');
Route::put('/admin/franchisebaru/update-status/{id_franchisebaru}', [C_admin::class, 'updateStatus'])->name('franchisebaru.updateStatus');
Route::delete('/admin/calonmitra/{id_calon}', [C_admin::class, 'deletecalon'])->name('C_admin.delete');
Route::delete('/admin/akun/{id_akun}', [C_admin::class, 'deleteakun'])->name('deleteadmin');
Route::delete('/admin/produk/{id_akun}', [C_admin::class, 'deleteproduk'])->name('produkadmin.delete');
Route::get('/admin/produk/edit/{id_produk}', [C_admin::class, 'editproduk']);
Route::post('/admin/produk/update/{id_produk}', [C_admin::class, 'updateproduk']);
Route::get('/admin/produk/add', [C_admin::class, 'tambahproduk']);
Route::post('/admin/produk/insert', [C_admin::class, 'insertproduk'])->name('produkadmin.insert');
Route::get('/admin/tabelfranchise', [C_admin::class, 'tabelfranchise'])->name('adminfranchise');
Route::get('/owner/tabelcalon', [C_owner::class, 'index'])->name('ownercalon');
Route::get('/owner/tabelakun', [C_owner::class, 'index2'])->name('ownerakun');
Route::get('/owner/tabelproduk', [C_owner::class, 'index3'])->name('ownerproduk');
Route::delete('/calonmitra/{id_calon}', [C_owner::class, 'deletecalon'])->name('C_owner.delete');
Route::delete('/akun/{id_akun}', [C_owner::class, 'deleteakun'])->name('akunowner.delete');
Route::put('/owner/update-tipe/{id_akun}', [C_owner::class, 'updatetipe'])->name('owner.updatetipe');
Route::delete('/produk/{id_akun}', [C_owner::class, 'deleteproduk'])->name('produkowner.delete');
Route::get('/produk/edit/{id_produk}', [C_owner::class, 'editproduk']);
Route::post('/produk/update/{id_produk}', [C_owner::class, 'updateproduk']);
Route::get('/produk/add', [C_owner::class, 'tambahproduk']);
Route::post('/produk/insert', [C_owner::class, 'insertproduk'])->name('produk.insert');
Route::get('/admin/tabelulasan', [UlasanController::class, 'index'])->name('admin.ulasan.index');
Route::delete('/admin/tabelulasan/{id}', [UlasanController::class, 'destroy']);

Route::prefix('admin')->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index'); // Untuk menampilkan daftar transaksi
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create'); // Untuk menampilkan formulir
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store'); // Untuk menyimpan data dari formulir
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy'); // Untuk menghapus transaksi
});



Route::get('/kasir', [KasirController::class, 'kasir']);
Route::get('/dashkasir', [KasirController::class, 'index'])->name('kasir.v_dashkasir');
Route::post('/kasir/store', [KasirController::class, 'store'])->name('kasir.store');
Route::post('/kasir/checkout', [KasirController::class, 'checkout']);
Route::get('/pelaporan', [KasirController::class, 'laporan']);
Route::get('/loginkasir/{id_franchise}', [AuthController::class, 'loginkasir']);


// Route::view('/status', 'v_preview');
Route::get('/status', [CalonMitraController::class, 'status']);
// Route::view('/cek-status', 'v_status');
Route::get('cekstatus', [CalonMitraController::class, 'viewStatus']);
Route::get('/tambahfranchise', [CalonMitraController::class, 'indextambahfranchise']);
Route::post('/tambahfranchise/insert', [CalonMitraController::class, 'tambahfranchise'])->name('franchise.baru');
// Route::get('/cek-status', function () {
//     return view('status');
// });
Route::get('/cekstatus/{id}', [CalonMitraController::class, 'viewStatus'])->name('cek.status.view');
Route::post('/cekstatus', [C_Status::class, 'cek'])->name('cek.status');
Route::get('/qrcode', [CalonMitraController::class, 'qrcode'])->name('qr.code');
Route::get('/download-qrcode', [CalonMitraController::class, 'downloadQrCode'])->name('download.qrcode');



// Route::view('/kasir', 'kasir.v_kasir');
// Route::view('/dashkasir', 'kasir.v_dashkasir');
Route::view('/kontak', 'v_kontak');
Route::view('/kontaks', 'v_kontaklog');
Route::view('/kemitraan', 'v_kemitraan');
Route::view('/cabang', 'v_cabang');
Route::view('/cabangg', 'v_cabanglog');
Route::view('/profilee', 'v_profilelog');
Route::view('/kemitraann', 'v_kemitraanlog');


Route::get('/cek-status', function () {
    return view('status');
});


// Halaman Home
Route::get('/login', function () {
    return view('v_login');
});

Route::get('/home', function () {
    return view('v_home');
});

// Route::get('/dashkasir', function () {
//     return view('kasir.dashkasir');
// });


Route::get('/daftarmitra', function () {
    return view('daftarmitra');
});


Route::get('/profile', function () {
    return view('v_profile');
});
Route::get('/menu', function () {
    return view('v_profile');
});

// Route::get('/kasir', function () {
//     return view('kasir.v_kasir');
// });


Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);


Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::post('/daftarmitra', [CalonMitraController::class, 'store'])->name('calonmitra.store');
Route::middleware(['auth'])->group(function () {
    Route::post('/daftarmitra', [CalonMitraController::class, 'store'])->name('calonmitra.store');
});


// Untuk navigasi sidebar “Setting Akun”
Route::get('/kasir/akun', [KasirController::class, 'showakun'])->name('kasirakun');

// Yang sudah ada tetap dipakai
Route::get('/kasir/akun/edit/{id_akun}', [KasirController::class, 'editakun'])->name('editakun');
Route::post('/kasir/akun/update/{id_akun}', [KasirController::class, 'updateakun'])->name('updateakun');


Route::get('/datasurvey', [C_Survey::class, 'index'])->name('datasurvey');
Route::get('/survey/tabelcalon', [C_Survey::class, 'index2'])->name('survey.calon');
Route::get('/survey/laporansurvey/{id_calon}', [C_Survey::class, 'index3'])->name('survey.laporan');
Route::post('/survey/laporansurvey/insert/{id_calon}', [C_Survey::class, 'laporansurvey'])->name('membuat.laporan');
Route::delete('/survey/delete/{id_calon}', [C_Survey::class, 'destroy'])->name('survey.destroy');

Route::post('/kirim-ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
Route::post('/kontak/kirim-ulasan', [KontakController::class, 'storeUlasan'])->name('kontak.storeUlasan');

