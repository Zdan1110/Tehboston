<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_Home;
use App\Http\Controllers\C_Dosen;
use App\Http\Controllers\C_Mahasiswa;
use App\Http\Controllers\C_User;
// use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_admin;
use App\Http\Controllers\C_owner;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalonMitraController;
use App\Http\Controllers\KasirController;

// Route::get('/', [C_Home::class, '']);

Route::get('/tabel', [C_User::class, 'tabel']);


// Route::get('/dashboard', [C_Register::class, 'dashboard']);

Route::post('/pelaporan', [KasirController::class, 'store'])->name('penjualan.store');
// Route::get('/dashkasir', [KasirController::class, 'index']);

Route::view('/about', 'v_about');
Route::view('/contact', 'v_contact');
Route::get('/admin', [C_admin::class, 'index'])->name('admin.v_dashboard');
Route::get('/dashkasir', [KasirController::class, 'index'])->name('kasir.v_dashkasir');
// Route::view('/admin', 'admin.v_tabelcalon');
Route::view('/admin/tabelcalon', 'admin.v_tabelcalon');
Route::view('/admin/tabelfranchise', 'admin.v_tabelfranchise');
Route::view('/', 'v_index');

Route::get('/profiles', [C_admin::class, 'indexprofile']);
Route::get('/franchisee', [C_admin::class, 'indexfranchise']);
Route::get('/admin/tabelcalon', [C_admin::class, 'index1'])->name('admincalon');
Route::get('/admin/tabelakun', [C_admin::class, 'index2'])->name('adminakun');
Route::get('/admin/tabelproduk', [C_admin::class, 'index3'])->name('adminproduk');
Route::put('/admin/calonmitra/update-status/{id_calonmitra}', [CalonMitraController::class, 'updateStatus'])->name('calonmitra.updateStatus');
Route::delete('/admin/calonmitra/{id_calon}', [C_admin::class, 'deletecalon'])->name('C_admin.delete');
Route::delete('/admin/akun/{id_akun}', [C_admin::class, 'deleteakun'])->name('deleteadmin');
Route::delete('/admin/produk/{id_akun}', [C_admin::class, 'deleteproduk'])->name('produkadmin.delete');
Route::get('/admin/produk/edit/{id_produk}', [C_admin::class, 'editproduk']);
Route::post('/admin/produk/update/{id_produk}', [C_admin::class, 'updateproduk']);
Route::get('/admin/produk/add', [C_admin::class, 'tambahproduk']);
Route::post('/admin/produk/insert', [C_admin::class, 'insertproduk'])->name('produkadmin.insert');
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

Route::get('/kasir', [KasirController::class, 'kasir']);
Route::post('/checkout', [KasirController::class, 'store']);


// Route::view('/kasir', 'kasir.v_kasir');
// Route::view('/dashkasir', 'kasir.v_dashkasir');
Route::view('/pelaporan', 'kasir.v_pelaporan');
Route::view('/kontak', 'v_kontak');
Route::view('/kontaks', 'v_kontaklog');
Route::view('/kemitraan', 'v_kemitraan');
Route::view('/cabang', 'v_cabang');
Route::view('/cabangg', 'v_cabanglog');
Route::view('/profilee', 'v_profilelog');
Route::view('/kemitraann', 'v_kemitraanlog');



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