<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\c_barang;
use App\Http\Controllers\c_kendaraan;
use App\Http\Controllers\c_ruangan;
use App\Http\Controllers\c_pengguna;
use App\Http\Controllers\c_peminjaman;
use App\Http\Controllers\c_history;
use App\Http\Controllers\c_unit;
use App\Http\Controllers\c_supir;
use App\Http\Controllers\c_pengembalian;
use App\Http\Controllers\c_laporan;
use App\Http\Controllers\c_info;
use App\Http\Controllers\c_pengaturan;

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

// Route::get('wa', [App\Http\Controllers\c_peminjaman::class, 'createNumber'])->name('sendWhatsapp');

Route::get('error', [App\Http\Controllers\c_login::class, 'errorPage'])->name('error');
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
    Route::post('dm/pengguna/import1', 'import1')->name('dm.pengguna.import1');
    Route::get('dm/pengguna/edit/{id}', 'edit')->name('dm.pengguna.edit');
    Route::post('dm/pengguna/update/{id}', 'update')->name('dm.pengguna.update');
    Route::get('dm/pengguna/destroy/{id}', 'destroy')->name('dm.pengguna.destroy');

        // user
        Route::get('profilsaya', 'myProfil_User')->name('profil.user');
        Route::post('editprofil','editProfil_User')->name('profil.user.edit');

         // admin
         Route::get('profil', 'myProfil_Admin')->name('profil.admin');
         Route::post('updateprofil','editProfil_Admin')->name('profil.admin.edit');
         Route::get('tambahtugas/{id}', 'tambahTugas')->name('tambah.tugas.index');
         Route::post('tambahtugasupdate/{id}', 'tambahTugasUpdate')->name('tambah.tugas.update');
});

// Unit
Route::controller(c_unit::class)->middleware('auth')->group(function () {
    Route::get('dm/unit', 'index')->name('dm.unit.index');
    Route::get('dm/unit/create', 'create')->name('dm.unit.create');
    Route::post('dm/unit/store', 'store')->name('dm.unit.store');
    Route::get('dm/unit/edit/{id}', 'edit')->name('dm.unit.edit');
    Route::post('dm/unit/update/{id}', 'update')->name('dm.unit.update');
    Route::get('dm/unit/destroy/{id}', 'destroy')->name('dm.unit.destroy');
});

// Supir
Route::controller(c_supir::class)->middleware('auth')->group(function () {
    Route::get('supir/kelola', 'index')->name('supir.kelola.index');
    Route::get('supir/kelola/create', 'create')->name('supir.kelola.create');
    Route::post('supir/kelola/store', 'store')->name('supir.kelola.store');
    Route::get('supir/kelola/edit/{id_supir}', 'edit')->name('supir.kelola.edit');
    Route::post('supir/kelola/update/{id_supir}', 'update')->name('supir.kelola.update');
    Route::get('supir/kelola/destroy/{id_supir}', 'destroy')->name('supir.kelola.destroy');

    Route::get('supir/aktivitas', 'tampilAktivitas')->name('supir.aktivitas.index');
    Route::get('supir/aktivitas/create', 'createAktivitas')->name('supir.aktivitas.create');
    Route::post('supir/aktivitas/store', 'storeAktivitas')->name('supir.aktivitas.store');
    Route::get('supir/aktivitas/edit/{id_aktivitas}', 'editAktivitas')->name('supir.aktivitas.edit');
    Route::post('supir/aktivitas/update/{id_aktivitas}', 'updateAktivitas')->name('supir.aktivitas.update');
    Route::get('supir/aktivitas/cetaksurat/{id_aktivitas}', 'cetakSurat')->name('supir.aktivitas.cetaksurat');

        // js
        Route::get('ubahstatussupir/{id_supir}', 'ubahStatus_Supir')->name('ubahstatussupir');
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
        Route::get('ubahstatustolak/{id}', 'ubahStatusTolak')->name('ubahstatustolak');
        Route::get('modalcetak/{id}', 'modalCetak')->name('modalcetak');
        Route::get('modalapproval/{id}', 'modalApproval')->name('modalapproval');
        Route::get('tampilpeminjaman', 'tablePeminjaman')->name('tablepeminjaman');
        Route::get('hari', 'hari')->name('hari');
        Route::get('editsupir/{id_keranjang}', 'editSupir')->name('editsupir');

    // user
    Route::get('dm/peminjaman', 'index')->name('dm.peminjaman.index');
    Route::post('kirimpengajuan','kirimPengajuan')->name('kirimpengajuan');
        // js
        Route::get('read', 'read')->name('read');
        Route::get('listbarang', 'listBarang')->name('listbarang');
        Route::get('loaditem', 'loadItem')->name('loaditem');
        Route::get('tambahitem', 'tambahItem')->name('tambahitem');
        Route::get('tambahsupir', 'tambahSupir')->name('tambahsupir');
        Route::get('ubahjumlah', 'ubahJumlah')->name('ubahjumlah');
        Route::get('hapusbarang/{id}', 'hapusBarang')->name('hapusbarang');
        Route::get('filteruser', 'filterUser')->name('filteruser');
        Route::get('detailbmn/{id}', 'detailBMN')->name('detailbmn');
        Route::get('resetkeranjang', 'resetKeranjang')->name('resetkeranjang');
        Route::get('modalsupir', 'modalSupir')->name('modalsupir');


    

});

Route::controller(c_pengembalian::class)->middleware('auth')->group(function () {
    // admin
    Route::get('pengembalian/index', 'viewPengembalian')->name('pengembalian.index');
        // js
        Route::get('tampilpengembalian', 'tablePengembalian')->name('tablepengembalian');
        Route::get('detailpengembalianadmin/{id}', 'detailPengembalian_Admin')->name('detailpengembalianadmin');
        Route::get('konfirmasipengembalian/{id}', 'ubahStatus_Pengembalian')->name('ubahstatuspengembalian');
        Route::get('ulasan/{id}', 'kirimUlasan')->name('kirimulasan');
        Route::get('dataulasan/{id}', 'dataUlasan')->name('dataulasan');
        Route::get('terima', 'updateItem')->name('updateitem');
        Route::get('feedback/{id_peminjaman}', 'feedback')->name('feedback');


    // user
    Route::get('pengembalian/lapor', 'index')->name('pengembalian.lapor.index');
    Route::post('pengembalian/lapor/store', 'storePengembalian')->name('pengembalian.lapor.store');
    Route::post('pengembalian/laporulang/store', 'storePengembalian_Ulang')->name('pengembalian.laporulang.store');
    Route::get('buktipengembalian/{id_keranjang}', 'lihatBukti')->name('lihat.bukti');
    Route::get('buktiawal/{id_keranjang}', 'lihatBukti_Awal')->name('lihat.bukti.awal');
        // js
        Route::get('jspengembalian', 'pengembalian')->name('jspengembalian');
        Route::get('detailpengembalian/{id}', 'detailPengembalian_User')->name('detailpengembalianuser');
        Route::get('laporpengembalian/{id}', 'laporPengembalian')->name('dm.pengembalian.lapor');
        Route::get('laporpengembalianulang/{id}', 'laporPengembalian_Ulang')->name('dm.pengembalianulang.lapor');
});



Route::controller(c_history::class)->middleware('auth')->group(function () {
    Route::get('history', 'index')->name('history.index');
    Route::post('kirimbuktiawal', 'sendBukti_Awal')->name('foto.awal');

    // js
    Route::get('jshistory', 'history')->name('jshistory');
    Route::get('detailhistory/{id}', 'detailHistory')->name('detailhistory');
});

Route::controller(c_info::class)->middleware('auth')->group(function () {
    Route::get('info', 'index')->name('info.index');
    Route::get('info/detail/{id_item}', 'infoDetail')->name('info.detail');
    Route::get('datainfo/{id_item}', 'dataInfo')->name('datainfo');
    Route::get('datainfosupir/{id_supir}', 'dataSupir')->name('datasupir');
});



Route::controller(c_laporan::class)->middleware('auth')->group(function () {
    Route::get('laporan', 'index')->name('laporan.index');

    Route::get('profil/chartlahan', 'chartPanen')->name('profil.chartlahan');
    Route::get('profil/chartpeminjaman', 'chartPeminjaman')->name('profil.chartpeminjaman');
    Route::get('tampillaporan', 'tablePeminjaman')->name('tablelaporan');
    Route::get('harilaporan', 'hari')->name('hari.laporan');
    Route::get('cetaklaporan', 'cetakLaporan')->name('cetak.laporan');

   
});

Route::controller(c_pengaturan::class)->middleware('auth')->group(function () {
    Route::get('pengaturan', 'index')->name('pengaturan.index');
    Route::post('pengaturan/simpan', 'simpan')->name('pengaturan.simpan');
});



// Route::get('/', function () {
//     return view('v_dashboard');
// });

?>