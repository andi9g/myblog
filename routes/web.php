<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\postinganController;
use App\Http\Controllers\editProfile;
use App\Http\Controllers\loginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\anggotaController;
use App\Http\Controllers\slideController;
use App\Http\Controllers\visimisiController;
use App\Http\Controllers\dokumentasiController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\linimasaController;
use App\Http\Controllers\pendaftaranController;
use App\Http\Controllers\rapatController;
use App\Http\Controllers\pengaturanController;
use App\Http\Controllers\aspirasiController;
use App\Http\Controllers\donasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//halaman utama
Route::get('/', [halamanController::class,'index']);
Route::get('/postingan/{judul}', [halamanController::class,'bacaPostingan']);
Route::get('/postingan', [halamanController::class,'postingan']);
Route::get('/dokumentasi', [halamanController::class,'dokumentasi']);


//login
Route::get('login', [loginController::class,'index']);
Route::post('login/proses', [loginController::class,'proses']);

// daftar 
Route::post('/daftaranggota',[halamanController::class,'daftar']);

//kritik dan saran
Route::post('/kritikdansaran',[halamanController::class,'saran'])->name('aspirasi.user');

Route::middleware(['gerbang_admin'])->group(function () {
    //home
    Route::get('/home', [homeController::class,'index']);
    Route::resource('jadwalRapat', rapatController::class)->middleware('superAdmin');
    
    //aspirasi
    Route::get('/aspirasi', [aspirasiController::class,'index']); 
    Route::delete('/aspirasi/{id}', [aspirasiController::class,'destroy'])->name('aspirasi.delete')->middleware('superAdmin');
    

    Route::middleware(['bendahara'])->group(function () {
        //donasi
        Route::resource('/donasi', donasiController::class);
        Route::put('/donasiselesai/{id}', [donasiController::class,'donasiselesai'])->name('selesai.donasi');
        Route::put('/updatedonasi/{id}', [donasiController::class,'updatedonasi'])->name('update.donasi');
        Route::delete('/hapusbank/{id}', [donasiController::class,'hapusbank'])->name('donasi.hapusBank');
        Route::post('/tambahbank', [donasiController::class,'tambahBank'])->name('bank.tambah');
    });

    //editProfile
    Route::get('profile', [editProfile::class,'index']);
    Route::post('edit_gambar', [editProfile::class,'edit_gambar'])->name('profile.edit_gambar');
    Route::post('ubah_password', [editProfile::class,'ubah_password'])->name('profile.ubah_password');

    
    //postingan
    Route::resource('/data_postingan', postinganController::class)->middleware('gerbang_penulis');
    Route::post('/ckeditor/upload', [postinganController::class,'upload'])->name('ckeditor.upload')->middleware('gerbang_penulis');
    
    // pendaftaran
    Route::resource('/pendaftaran', pendaftaranController::class)->middleware('superAdmin');
    Route::put('/openPendaftaran', [pendaftaranController::class,'openPendaftaran'])->name('openPendaftaran.open')->middleware('superAdmin');
    
    
    //angkat anggota
    Route::put('/angkatanggota/{id}', [pendaftaranController::class,'angkatanggota'])->name('angkat.anggota')->middleware('superAdmin');
    
    // dokumentasi 
    Route::resource('/doc', dokumentasiController::class)->middleware('gerbang_penulis');


    Route::middleware(['superAdmin'])->group(function () {
       // Opsi Halaman
        Route::resource('/opsiSlide', slideController::class);
        Route::resource('/opsiLinimasa', linimasaController::class);
        Route::resource('/opsiVisiDanMisi', visimisiController::class);
        Route::resource('/opsiJabatan', jabatanController::class);

        //pengaturan lanjutan
        Route::get('/opsiPengaturan', [pengaturanController::class,'index']);
        Route::put('/opsiPengaturan/logo/{ket}', [pengaturanController::class,'logo'])->name('ubah.logo');
        Route::post('/opsiPengaturan/resetLogo', [pengaturanController::class,'resetLogo'])->name('reset.logo');
        Route::put('/opsiPengaturan/sosialmedia', [pengaturanController::class,'sosialmedia'])->name('update.sosialmedia');
        Route::put('/opsiPengaturan/kontak', [pengaturanController::class,'kontak'])->name('update.kontak');
        Route::delete('/opsiPengaturan/hapus/{ket}', [pengaturanController::class,'hapusLogo'])->name('hapus.logo');
        Route::post('/opsiPengaturan/jurusan', [pengaturanController::class,'programstudi'])->name('tambah.jurusan');
        Route::delete('/opsiPengaturan/hapusJurusan/{id}', [pengaturanController::class,'hapusJurusan'])->name('hapus.jurusan');
        Route::post('/settingWeb', [pengaturanController::class,'settingWeb'])->name('web.setting');

        //anggota
        Route::resource('/anggota', anggotaController::class);
        Route::put('/ubah/posisi/{id}',[anggotaController::class,'ubahposisi'])->name('posisi.ubah');
        Route::put('/ubah/ket/{id}',[anggotaController::class,'ubahket'])->name('ket.ubah');
        Route::put('/ubah/password/{id}',[anggotaController::class,'resetPassword'])->name('reset.password');
        
        
        // tambah jabatan
        Route::post('/ketua',[jabatanController::class,'ketua']);
        Route::post('/wakil',[jabatanController::class,'wakil']);
        Route::post('/sekertaris',[jabatanController::class,'sekertaris']);
        Route::post('/bendahara',[jabatanController::class,'bendahara']);
        Route::post('/mentriDalamNegri',[jabatanController::class,'mentriDalamNegri']);
        Route::post('/mentriLuarNegri',[jabatanController::class,'mentriLuarNegri']);
        Route::post('/mentriKomunikasiDanInformasi',[jabatanController::class,'mentriKomunikasiDanInformasi']);
        Route::post('/mentriPenelitianDanPengembangan',[jabatanController::class,'mentriPenelitianDanPengembangan']);
        
        Route::DELETE('/deleteJabatan/{id}',[jabatanController::class,'delete'])->name('deleteJabatan.delete'); 
    });
    
    
    
    
    Route::get('logout', [loginController::class, 'logout'])->name('logout.logout');
    
    
});

// Route::get('/baca/{judul}', [blogController::class,'baca']);
// //Route::get('/', [blogController::class,'home']);
// Route::get('/user_admin', [blogController::class,'admin']);





// // Route::middleware('gerbang_admin')->group(function () {
//     //home
//     Route::get('home',[homeController::class,'index']);

    
//     //editProfile
//     Route::get('profile', [editProfile::class,'index']);
//     Route::post('edit_gambar', [editProfile::class,'edit_gambar'])->name('profile.edit_gambar');
//     Route::post('edit_nama', [editProfile::class,'edit_nama'])->name('profile.edit_nama');
//     Route::post('ubah_password', [editProfile::class,'ubah_password'])->name('profile.ubah_password');
    
//     Route::get('logout', [loginController::class, 'logout'])->name('logout.logout');

//     //sosial media
//     Route::get('sosial_media', [sosialmediaController::class,'index']);
//     Route::post('sosial_media', [sosialmediaController::class,'update']);

//     //pengaturan kategori
//     Route::resource('kategori', kategoriController::class)->middleware('superAdmin');
    
//     //advanced
//     Route::resource('advanced', advancedController::class)->middleware('superAdmin');
//     Route::post('edit_logo', [advancedController::class,'editLogo'])->name('logo.logo');
//     Route::delete('edit_logo', [advancedController::class,'hapusLogo'])->name('logo.hapusLogo');
//     Route::post('include_name', [advancedController::class,'includeName'])->name('include.name');

//     //admin
//     Route::resource('data_admin', adminController::class)->middleware('superAdmin');
//     Route::post('reset_pass_admin/{id}', [adminController::class, 'resetPassword'])->name('reset_pass_admin.resetPassword')->middleware('superAdmin');
    
//     //postingan
//     Route::resource('/data_postingan', postinganController::class);
//     Route::post('/ckeditor/upload', [postinganController::class,'upload'])->name('ckeditor.upload');
    
// // });



// // Route::post('/coba', [coba::class,'coba']);

