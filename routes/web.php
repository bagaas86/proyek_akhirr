<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\c_barang;
use App\Http\Controllers\c_kendaraan;
use App\Http\Controllers\c_ruangan;
use App\Http\Controllers\c_pengguna;
use App\Http\Controllers\c_peminjaman;
use App\Http\Controllers\c_history;


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
Route::get('/', [App\Http\Controllers\c_login::class, 'landingPage'])->name('user.login');
// Login Logout
Route::get('/auth', [App\Http\Controllers\c_login::class, 'index']);
Route::get('/dashboard', [App\Http\Controllers\c_login::class, 'dashboard'] )->name('dashboard');
Route::post('/check', [App\Http\Controllers\c_login::class, 'check'])->name('login.check');
Route::post('/', [App\Http\Controllers\c_login::class, 'logout'])->name('user.logout');

// Barang
Route::controller(c_barang::class)->group(function () {
    Route::get('dm/barang', 'index')->name('dm.barang.index');
    Route::get('dm/barang/create', 'create')->name('dm.barang.create');
    Route::post('dm/barang/store', 'store')->name('dm.barang.store');
    Route::get('dm/barang/detail/{id}', 'detail')->name('dm.barang.detail');
    Route::get('dm/barang/edit/{id}', 'edit')->name('dm.barang.edit');
    Route::post('dm/barang/update/{id}', 'update')->name('dm.barang.update');
    Route::get('dm/barang/destroy/{id}', 'destroy')->name('dm.barang.destroy');
});

// Ruangan
Route::controller(c_ruangan::class)->middleware('auth')->group(function () {
    Route::get('dm/ruangan', 'index')->name('dm.ruangan.index');
    Route::get('dm/ruangan/create', 'create')->name('dm.ruangan.create');
    Route::post('dm/ruangan/store', 'store')->name('dm.ruangan.store');
    Route::get('dm/ruangan/edit/{id}', 'edit')->name('dm.ruangan.edit');
    Route::post('dm/ruangan/update/{id}', 'update')->name('dm.ruangan.update');
    Route::get('dm/ruangan/destroy/{id}', 'destroy')->name('dm.ruangan.destroy');
});

// Kendaraan
Route::controller(c_kendaraan::class)->group(function () {
    Route::get('dm/kendaraan', 'index')->name('dm.kendaraan.index');
    Route::get('dm/kendaraan/create', 'create')->name('dm.kendaraan.create');
    Route::post('dm/kendaraan/store', 'store')->name('dm.kendaraan.store');
    Route::get('dm/kendaraan/detail/{id}', 'detail')->name('dm.kendaraan.detail');
    Route::get('dm/kendaraan/edit/{id}', 'edit')->name('dm.kendaraan.edit');
    Route::post('dm/kendaraan/update/{id}', 'update')->name('dm.kendaraan.update');
    Route::get('dm/kendaraan/destroy/{id}', 'destroy')->name('dm.kendaraan.destroy');
});

// Pengguna
Route::controller(c_pengguna::class)->middleware('auth')->group(function () {
    Route::get('dm/pengguna', 'index')->name('dm.pengguna.index');
    Route::get('dm/pengguna/create', 'create')->name('dm.pengguna.create');
    Route::post('dm/pengguna/store', 'store')->name('dm.pengguna.store');
    Route::get('dm/pengguna/edit/{id}', 'edit')->name('dm.pengguna.edit');
    Route::post('dm/pengguna/update/{id}', 'update')->name('dm.pengguna.update');
    Route::get('dm/pengguna/destroy/{id}', 'destroy')->name('dm.pengguna.destroy');
});

// Peminjaman
Route::controller(c_peminjaman::class)->middleware('auth')->group(function () {
    // admin
    Route::get('peminjaman/pengajuan/index', 'viewPengajuan')->name('peminjaman.pengajuan.index');
    Route::get('peminjaman/pengajuan/cetak/{id}', 'cetakBerita')->name('peminjaman.pengajuan.cetak');
  
        // js
        Route::get('detailpeminjaman/{id}', 'detailPengajuan')->name('peminjaman.pengajuan.detail');
        Route::get('tableormawa', 'tableOrmawa')->name('tableormawa');
        Route::get('tabledosen', 'tableDosen')->name('tabledosen');
        Route::get('ubahstatus/{id}', 'ubahStatus')->name('ubahstatus');
        Route::get('modalcetak/{id}', 'modalCetak')->name('modalcetak');
        Route::get('modalapproval/{id}', 'modalApproval')->name('modalapproval');

    // user
    Route::get('dm/peminjaman', 'index')->name('dm.peminjaman.index');
    Route::post('kirimpengajuan','kirimPengajuan')->name('kirimpengajuan');
        // js
        Route::get('read', 'read')->name('read');
        Route::get('listbarang', 'listBarang')->name('listbarang');
        Route::get('loaditem', 'loadItem')->name('loaditem');
        Route::get('tambahitem', 'tambahItem')->name('tambahitem');
        Route::get('ubahjumlah', 'ubahJumlah')->name('ubahjumlah');
        Route::get('hapusbarang/{id}', 'hapusBarang')->name('hapusbarang');
        Route::get('filteruser', 'filterUser')->name('filteruser');
        Route::get('detailbmn/{id}', 'detailBMN')->name('detailbmn');
    

});

Route::controller(c_history::class)->middleware('auth')->group(function () {
    Route::get('history', 'index')->name('history.index');
    Route::get('history/detail/{id}', 'detailHistory')->name('history.detail');
});



// Route::get('/', function () {
//     return view('v_dashboard');
// });

?>