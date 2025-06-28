<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    C_Home, C_Dosen, C_Mahasiswa, C_Login, C_admin, C_owner,
    UserController, AuthController, CalonMitraController,
    KasirController, C_Status, C_Survey, UlasanController,
    KontakController, TransaksiController, GoogleController
    
};

// ========================
// ROUTE UMUM (TANPA LOGIN)
// ========================
Route::view('/contact', 'v_contact');
Route::view('/kontak', 'v_kontak');
Route::view('/kontaks', 'v_kontaklog');
Route::view('/kemitraan', 'v_kemitraan');
Route::view('/kemitraann', 'v_kemitraanlog');
Route::view('/cabang', 'v_cabang');
Route::view('/cabangg', 'v_cabanglog');
Route::view('/profile', 'v_profile');
Route::view('/profilee', 'v_profilelog');
Route::view('/status', 'v_preview');
Route::view('/cek-status', 'v_status');
// Forgot Password
Route::get('/forgotpassword', [App\Http\Controllers\C_LupaPassword::class, 'showForgot'])->name('password.request');
Route::post('/forgotpassword', [App\Http\Controllers\C_LupaPassword::class, 'sendOtp'])->name('password.send');

// Reset Password
Route::get('/resetpassword', [App\Http\Controllers\C_LupaPassword::class, 'showReset'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\C_LupaPassword::class, 'resetPassword'])->name('password.update');



// Route::view('/loginkasir', 'v_loginkasir');

// ========================
// ROUTE HALAMAN LOGIN/REGISTER
// ========================
Route::get('/login', fn() => view('v_login'));
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.proses');

Auth::routes([
    'reset' => true,
    'verify' => false,
    'login' => false,
    'register' => false
]);

// ========================
// ROUTE ULASAN DAN HOMEPAGE
// ========================
Route::get('/', [UlasanController::class, 'indexuser']);
Route::get('/profiles', [C_admin::class, 'indexprofile']);
Route::get('/franchisee', [C_admin::class, 'indexfranchise']);
Route::get('/home', [UlasanController::class, 'home']);
Route::post('/kirim-ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
Route::post('/kontak/kirim-ulasan', [KontakController::class, 'storeUlasan'])->name('kontak.storeUlasan');
Route::get('/loginkasir/{id_franchise}',[AuthController::class, 'loginkasir']);
Route::get('/print/{id_penjualan}', [KasirController::class, 'print'])->name('printkasir');

// ========================
// CEK STATUS & MITRA
// ========================
Route::get('/status', [CalonMitraController::class, 'status']);
Route::get('/cekstatus', [CalonMitraController::class, 'viewStatus']);
Route::get('/cekstatus/{id}', [CalonMitraController::class, 'viewStatus'])->name('cek.status.view');
Route::post('/cekstatus', [C_Status::class, 'cek'])->name('cek.status');

Route::get('/tambahfranchise', [CalonMitraController::class, 'indextambahfranchise']);
Route::post('/tambahfranchise/insert', [CalonMitraController::class, 'tambahfranchise'])->name('franchise.baru');
Route::get('/daftarmitra', [CalonMitraController::class, 'indexdaftar']);

Route::middleware('auth')->group(function () {
    Route::post('/daftarmitra', [CalonMitraController::class, 'store'])->name('calonmitra.store');
});

Route::get('/qrcode', [CalonMitraController::class, 'qrcode'])->name('qr.code');
Route::get('/qrcode/{id_franchisebaru}', [CalonMitraController::class, 'qrcodefranchise'])->name('qrcode.franchise');
Route::get('/download-qrcode', [CalonMitraController::class, 'downloadQrCode'])->name('download.qrcode');
Route::get('/download-qrcodefranchise/{id_franchisebaru}', [CalonMitraController::class, 'downloadQrCodefranchise'])->name('download.qrcodefranchise');
Route::post('/uploadbukti/{id_calon}', [CalonMitraController::class, 'uploadtransaksi'])->name('upload.transaksi');
Route::post('/uploadbuktifranchise/{id_franchisebaru}', [CalonMitraController::class, 'uploadtransaksifranchise'])->name('upload.transaksifranchise');

// =================================================
// KASIR GROUP (dengan middleware kasir)
// =================================================

    Route::get('/kasir', [KasirController::class, 'kasir']);
Route::get('/dashkasir', [KasirController::class, 'index'])->name('kasir.v_dashkasir');
Route::post('/kasir/store', [KasirController::class, 'store'])->name('kasir.store');
Route::post('/kasir/checkout', [KasirController::class, 'checkout']);
Route::get('/pelaporan', [KasirController::class, 'laporan']);
Route::get('/print/{id_penjualan}', [KasirController::class, 'print'])->name('printkasir');
Route::get('/loginkasir/{id_franchise}', [AuthController::class, 'loginkasir']);
Route::get('/kasir/akun', [KasirController::class, 'showakun'])->name('kasirakun');
Route::get('/kasir/akun/edit/{id_akun}', [KasirController::class, 'editakun'])->name('editakun');
Route::post('/kasir/akun/update/{id_akun}', [KasirController::class, 'updateakun'])->name('updateakun');

    


// Pengaturan akun kasir
Route::get('/kasir/akun', [KasirController::class, 'showakun'])->name('kasirakun');
Route::get('/kasir/akun/edit/{id_akun}', [KasirController::class, 'editakun'])->name('editakun');
Route::post('/kasir/akun/update/{id_akun}', [KasirController::class, 'updateakun'])->name('updateakun');

// =================================================
// OWNER GROUP (dengan middleware owner)
// =================================================
Route::middleware(['auth', 'owner.only'])->prefix('owner')->group(function () {
    Route::get('/tabelcalon', [C_owner::class, 'index'])->name('ownercalon');
    Route::get('/tabelakun', [C_owner::class, 'index2'])->name('ownerakun');
    Route::get('/tabelproduk', [C_owner::class, 'index3'])->name('ownerproduk');
    Route::delete('/calonmitra/{id_calon}', [C_owner::class, 'deletecalon'])->name('C_owner.delete');
    Route::delete('/akun/{id_akun}', [C_owner::class, 'deleteakun'])->name('akunowner.delete');
    Route::put('/update-tipe/{id_akun}', [C_owner::class, 'updatetipe'])->name('owner.updatetipe');
    Route::delete('/produk/{id_akun}', [C_owner::class, 'deleteproduk'])->name('produkowner.delete');
    Route::get('/produk/edit/{id_produk}', [C_owner::class, 'editproduk']);
    Route::post('/produk/update/{id_produk}', [C_owner::class, 'updateproduk']);
    Route::get('/produk/add', [C_owner::class, 'tambahproduk']);
    Route::post('/produk/insert', [C_owner::class, 'insertproduk'])->name('produk.insert');
    Route::get('/tabelfranchisebaru', [C_owner::class, 'index4'])->name('ownerfranchisebaru');
    Route::resource('/transaksi', TransaksiController::class);
});


// ========================
// ROUTE ADMIN - TERPROTEKSI
// ========================
Route::middleware(['auth', 'admin.only'])->prefix('admin')->group(function () {
    Route::get('/', [C_admin::class, 'index'])->name('admin.v_dashboard');
    Route::get('/tabelcalon', [C_admin::class, 'index1'])->name('admincalon');
    Route::get('/tabelakun', [C_admin::class, 'index2'])->name('adminakun');
    Route::get('/tabelproduk', [C_admin::class, 'index3'])->name('adminproduk');
    Route::get('/tabelfranchisebaru', [C_admin::class, 'index4'])->name('adminfranchisebaru');
    Route::get('/tabelfranchise', [C_admin::class, 'tabelfranchise'])->name('adminfranchise');
    Route::get('/tabelulasan', [UlasanController::class, 'index'])->name('admin.ulasan.index');
    Route::get('/datasurvey', [C_Survey::class, 'indexadmin'])->name('datasurvey');
    Route::delete('/admin/franchisebaru/{id_franchisebaru}', [C_admin::class, 'deletefranchisebaru'])->name('franchisebaruadmin.delete');
    Route::resource('/transaksi', TransaksiController::class);

    Route::get('/profiles', [C_admin::class, 'indexprofileadmin']);
    Route::get('/admin/notifikasi', [C_admin::class, 'getNotifikasi'])->name('admin.notifikasi');


    // CRUD produk
    Route::get('/produk/edit/{id_produk}', [C_admin::class, 'editproduk']);
    Route::post('/produk/update/{id_produk}', [C_admin::class, 'updateproduk']);
    Route::get('/produk/add', [C_admin::class, 'tambahproduk']);
    Route::post('/produk/insert', [C_admin::class, 'insertproduk'])->name('produkadmin.insert');
    Route::delete('/produk/{id_akun}', [C_admin::class, 'deleteproduk'])->name('produkadmin.delete');

    // Calon Mitra
    Route::put('/calonmitra/update-status/{id_calonmitra}', [CalonMitraController::class, 'updateStatus'])->name('calonmitra.updateStatus');
    Route::delete('/calonmitra/{id_calon}', [C_admin::class, 'deletecalon'])->name('C_admin.delete');

    // Akun
    Route::delete('/akun/{id_akun}', [C_admin::class, 'deleteakun'])->name('deleteadmin');

    // Franchise Baru
    Route::put('/franchisebaru/update-status/{id_franchisebaru}', [C_admin::class, 'updateStatus'])->name('franchisebaru.updateStatus');
    Route::delete('/franchisebaru/{id_franchisebaru}', [C_admin::class, 'deletefranchisebaru'])->name('deletefranchisebaru');

    // Ulasan
    Route::delete('/tabelulasan/{id}', [UlasanController::class, 'destroy']);
    Route::put('/ulasan/show/{id}', [UlasanController::class, 'tampilkan']);
    Route::put('/ulasan/hide/{id}', [UlasanController::class, 'sembunyikan']);
    Route::patch('/ulasan/tampilkan/{id}', [UlasanController::class, 'tampilkan']);

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});

// ========================
// PROFILE USER (dengan OTP)
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/editakun', [UserController::class, 'showEditForm'])->name('user.edit');
    Route::put('/update-akun', [UserController::class, 'update'])->name('user.update');
    Route::get('/profile/edit', [UserController::class, 'showEditForm'])->name('user.edit-profile');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/profile/verify-otp', [UserController::class, 'showOtpForm'])->name('user.show-otp-form');
    Route::post('/profile/verify-otp', [UserController::class, 'verifyOtpAndUpdate'])->name('user.verify-otp');
    Route::post('/profile/resend-otp', [UserController::class, 'resendOtp'])->name('user.resend-otp');
});

// ========================
// SURVEY
// ========================
Route::get('/survey/datasurvey', [C_Survey::class, 'index'])->name('datasurvey');
Route::get('/survey/tabelcalon', [C_Survey::class, 'index2'])->name('survey.calon');
Route::get('/survey/laporansurvey/{id_calon}', [C_Survey::class, 'index3'])->name('survey.laporan');
Route::post('/survey/laporansurvey/insert/{id_calon}', [C_Survey::class, 'laporansurvey'])->name('membuat.laporan');
Route::delete('/survey/delete/{id_calon}', [C_Survey::class, 'destroy'])->name('survey.destroy');

// ========================
// TEST EMAIL
// ========================
Route::get('/test-email', function () {
    try {
        Mail::raw('Ini adalah email test dari Laravel', function ($message) {
            $message->to('your@email.com')->subject('Test Kirim Email');
        });
        return 'Berhasil kirim email.';
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});





