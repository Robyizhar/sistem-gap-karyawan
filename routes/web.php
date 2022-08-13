<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClearController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\PenilaianNKIController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\KontrakPkwtController;
use App\Http\Controllers\CutiController;

use App\Http\Controllers\Master\JabatanController;
use App\Http\Controllers\Master\PangkatController;
use App\Http\Controllers\Master\LevelController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Master\KaryawanController;
use App\Http\Controllers\Master\KaryawanPkwtController;

Auth::routes();

Route::prefix('clear')->group(function () {

    Route::get('/all', [ClearController::class, 'clearOptimize'])->name('clear.all');
    Route::get('/config', [ClearController::class, 'clearConfig'])->name('clear.config');
    Route::get('/cache', [ClearController::class, 'clearCache'])->name('clear.cache');
    Route::get('/storage-link', [ClearController::class, 'storageLinked'])->name('storage.link');
    Route::get('/migrate', [ClearController::class, 'migrate'])->name('migrate');
    Route::get('/seed', [ClearController::class, 'seeder'])->name('seed');
    Route::get('/generate', [ClearController::class, 'ketGenerate'])->name('generate');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('jabatan')->group(function () {

        Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index')
            ->middleware(['role_or_permission:Developer|View-Jabatan']);

        Route::post('/get-data', [JabatanController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Jabatan']);

        Route::get('/create', [JabatanController::class, 'create'])->name('jabatan.create')
            ->middleware(['role_or_permission:Developer|Add-Jabatan']);

        Route::get('/edit/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit')
            ->middleware(['role_or_permission:Developer|Edit-Jabatan']);

        Route::post('/store', [JabatanController::class, 'store'])->name('jabatan.store')
            ->middleware(['role_or_permission:Developer|Add-Jabatan']);

        Route::put('/update', [JabatanController::class, 'update'])->name('jabatan.update')
            ->middleware(['role_or_permission:Developer|Edit-Jabatan']);

        Route::get('/destroy/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Jabatan']);
    });

    Route::prefix('pangkat')->group(function () {

        Route::get('/', [PangkatController::class, 'index'])->name('pangkat.index')
            ->middleware(['role_or_permission:Developer|View-Pangkat']);

        Route::post('/get-data', [PangkatController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Pangkat']);

        Route::get('/create', [PangkatController::class, 'create'])->name('pangkat.create')
            ->middleware(['role_or_permission:Developer|Add-Pangkat']);

        Route::get('/edit/{id}', [PangkatController::class, 'edit'])->name('pangkat.edit')
            ->middleware(['role_or_permission:Developer|Edit-Pangkat']);

        Route::post('/store', [PangkatController::class, 'store'])->name('pangkat.store')
            ->middleware(['role_or_permission:Developer|Add-Pangkat']);

        Route::put('/update', [PangkatController::class, 'update'])->name('pangkat.update')
            ->middleware(['role_or_permission:Developer|Edit-Pangkat']);

        Route::get('/destroy/{id}', [PangkatController::class, 'destroy'])->name('pangkat.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Pangkat']);
    });

    Route::prefix('level')->group(function () {

        Route::get('/', [LevelController::class, 'index'])->name('level.index')
            ->middleware(['role_or_permission:Developer|View-Level']);

        Route::post('/get-data', [LevelController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Level']);

        Route::get('/create', [LevelController::class, 'create'])->name('level.create')
            ->middleware(['role_or_permission:Developer|Add-Level']);

        Route::get('/edit/{id}', [LevelController::class, 'edit'])->name('level.edit')
            ->middleware(['role_or_permission:Developer|Edit-Level']);

        Route::post('/store', [LevelController::class, 'store'])->name('level.store')
            ->middleware(['role_or_permission:Developer|Add-Level']);

        Route::put('/update', [LevelController::class, 'update'])->name('level.update')
            ->middleware(['role_or_permission:Developer|Edit-Level']);

        Route::get('/destroy/{id}', [LevelController::class, 'destroy'])->name('level.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Level']);
    });

    Route::prefix('unit')->group(function () {
        Route::get('/', [UnitController::class, 'index'])->name('unit.index')
            ->middleware(['role_or_permission:Developer|View-Unit']);

        Route::post('/get-data', [UnitController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Unit']);

        Route::get('/create', [UnitController::class, 'create'])->name('unit.create')
            ->middleware(['role_or_permission:Developer|Add-Unit']);

        Route::get('/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit')
            ->middleware(['role_or_permission:Developer|Edit-Unit']);

        Route::post('/store', [UnitController::class, 'store'])->name('unit.store')
            ->middleware(['role_or_permission:Developer|Add-Unit']);

        Route::put('/update', [UnitController::class, 'update'])->name('unit.update')
            ->middleware(['role_or_permission:Developer|Edit-Unit']);

        Route::get('/destroy/{id}', [UnitController::class, 'destroy'])->name('unit.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Unit']);
    });

    Route::prefix('karyawan')->group(function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index')
            ->middleware(['role_or_permission:Developer|View-Karyawan']);

        Route::post('/get-data', [KaryawanController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Karyawan']);

        Route::get('/create', [KaryawanController::class, 'create'])->name('karyawan.create')
            ->middleware(['role_or_permission:Developer|Add-Karyawan']);

        Route::get('/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit')
            ->middleware(['role_or_permission:Developer|Edit-Karyawan']);

        Route::get('/show/{id}', [KaryawanController::class, 'show'])->name('karyawan.show')
            ->middleware(['role_or_permission:Developer|View-Karyawan']);

        Route::post('/store', [KaryawanController::class, 'store'])->name('karyawan.store')
            ->middleware(['role_or_permission:Developer|Add-Karyawan']);

        Route::put('/update', [KaryawanController::class, 'update'])->name('karyawan.update')
            ->middleware(['role_or_permission:Developer|Edit-Karyawan']);

        Route::get('/destroy/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Karyawan']);

        Route::post('/getJabatan', [KaryawanController::class, 'getJabatan'])->name('karyawan.get-jabatan');

        Route::post('/getPangkat', [KaryawanController::class, 'getPangkat'])->name('karyawan.get-pangkat');

        Route::post('/getLevel', [KaryawanController::class, 'getLevel'])->name('karyawan.get-level');
    });

    Route::prefix('karyawan-pkwt')->group(function () {
        Route::get('/', [KaryawanPkwtController::class, 'index'])->name('karyawan-pkwt.index')
            ->middleware(['role_or_permission:Developer|View-Karyawan PKWT']);

        Route::post('/get-data', [KaryawanPkwtController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Karyawan PKWT']);

        Route::get('/create', [KaryawanPkwtController::class, 'create'])->name('karyawan-pkwt.create')
            ->middleware(['role_or_permission:Developer|Add-Karyawan PKWT']);

        Route::get('/edit/{id}', [KaryawanPkwtController::class, 'edit'])->name('karyawan-pkwt.edit')
            ->middleware(['role_or_permission:Developer|Edit-Karyawan PKWT']);

        Route::post('/store', [KaryawanPkwtController::class, 'store'])->name('karyawan-pkwt.store')
            ->middleware(['role_or_permission:Developer|Add-Karyawan PKWT']);

        Route::put('/update', [KaryawanPkwtController::class, 'update'])->name('karyawan-pkwt.update')
            ->middleware(['role_or_permission:Developer|Edit-Karyawan PKWT']);

        Route::get('/destroy/{id}', [KaryawanPkwtController::class, 'destroy'])->name('karyawan-pkwt.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Karyawan PKWT']);
    });

    Route::prefix('penilaian')->group(function () {
        Route::get('/', [PenilaianController::class, 'index'])->name('penilaian.index')
            ->middleware(['role_or_permission:Developer|View-Penilaian']);

        Route::post('/get-data', [PenilaianController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Penilaian']);

        Route::get('/create', [PenilaianController::class, 'create'])->name('penilaian.create')
            ->middleware(['role_or_permission:Developer|Add-Penilaian']);

        Route::get('/edit/{id}', [PenilaianController::class, 'edit'])->name('penilaian.edit')
            ->middleware(['role_or_permission:Developer|Edit-Penilaian']);

        Route::get('/show/{id}', [PenilaianController::class, 'show'])->name('penilaian.show')
            ->middleware(['role_or_permission:Developer|Edit-Penilaian']);

        Route::post('/store', [PenilaianController::class, 'store'])->name('penilaian.store')
            ->middleware(['role_or_permission:Developer|Add-Penilaian']);

        Route::put('/update', [PenilaianController::class, 'update'])->name('penilaian.update')
            ->middleware(['role_or_permission:Developer|Edit-Penilaian']);

        Route::get('/destroy/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Penilaian']);
    });

    Route::prefix('penilaian-nki')->group(function () {
        Route::get('/', [PenilaianNKIController::class, 'index'])->name('penilaian-nki.index')
            ->middleware(['role_or_permission:Developer|View-Penilaian NKI']);

        Route::post('/get-data', [PenilaianNKIController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Penilaian NKI']);

        Route::get('/create', [PenilaianNKIController::class, 'create'])->name('penilaian-nki.create')
            ->middleware(['role_or_permission:Developer|Add-Penilaian NKI']);

        Route::get('/create/{np}', [PenilaianNKIController::class, 'createNew'])->name('penilaian-nki.create-new')
            ->middleware(['role_or_permission:Developer|Add-Penilaian NKI']);

        Route::get('/edit/{id}', [PenilaianNKIController::class, 'edit'])->name('penilaian-nki.edit')
            ->middleware(['role_or_permission:Developer|Edit-Penilaian NKI']);

        Route::get('/show/{id}', [PenilaianNKIController::class, 'show'])->name('penilaian-nki.show')
            ->middleware(['role_or_permission:Developer|View-Penilaian NKI']);

        Route::post('/store', [PenilaianNKIController::class, 'store'])->name('penilaian-nki.store')
            ->middleware(['role_or_permission:Developer|Add-Penilaian NKI']);

        Route::put('/update', [PenilaianNKIController::class, 'update'])->name('penilaian-nki.update')
            ->middleware(['role_or_permission:Developer|Edit-Penilaian NKI']);

        Route::get('/destroy/{id}', [PenilaianNKIController::class, 'destroy'])->name('penilaian-nki.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Penilaian NKI']);
    });

    Route::prefix('promosi')->group(function () {
        Route::get('/', [PromosiController::class, 'index'])->name('promosi.index')
            ->middleware(['role_or_permission:Developer|View-Promosi']);

        Route::post('/get-data', [PromosiController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Promosi']);

        Route::post('/store', [PromosiController::class, 'store'])->name('promosi.store')
            ->middleware(['role_or_permission:Developer|Add-Promosi']);

        Route::post('/cancelValid', [PromosiController::class, 'cancelValid'])->name('promosi.cancel-valid')
            ->middleware(['role_or_permission:Developer|Edit-Promosi']);

    });

    Route::prefix('kontrak')->group(function () {
        Route::get('/', [KontrakPkwtController::class, 'index'])->name('kontrak.index')
            ->middleware(['role_or_permission:Developer|View-Promosi']);

        Route::post('/get-data', [KontrakPkwtController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Promosi']);

        Route::post('/store', [KontrakPkwtController::class, 'store'])->name('kontrak.store')
            ->middleware(['role_or_permission:Developer|Add-Promosi']);

        Route::post('/cancelValid', [KontrakPkwtController::class, 'cancelValid'])->name('kontrak.cancel-valid')
            ->middleware(['role_or_permission:Developer|Edit-Promosi']);

    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index')
            ->middleware(['role_or_permission:Developer|View-User']);

        Route::post('/get-data', [UserController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-User']);

        Route::get('/create', [UserController::class, 'create'])->name('user.create')
            ->middleware(['role_or_permission:Developer|Add-User']);

        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit')
            ->middleware(['role_or_permission:Developer|Edit-User']);

        Route::post('/store', [UserController::class, 'Add'])->name('user.store')
            ->middleware(['role_or_permission:Developer|Edit-User']);

        Route::put('/update', [UserController::class, 'update'])->name('user.update')
            ->middleware(['role_or_permission:Developer|Edit-User']);

        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy')
            ->middleware(['role_or_permission:Developer|Delete-User']);
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index')
            ->middleware(['role_or_permission:Developer|View-User Group']);

        Route::post('/get-data', [RoleController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-User Group']);

        Route::get('/create', [RoleController::class, 'create'])->name('role.create')
            ->middleware(['role_or_permission:Developer|Add-User Group']);

        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')
            ->middleware(['role_or_permission:Developer|Edit-User Group']);

        Route::post('/store', [RoleController::class, 'store'])->name('role.store')
            ->middleware(['role_or_permission:Developer|Edit-User Group']);

        Route::put('/update', [RoleController::class, 'update'])->name('role.update')
            ->middleware(['role_or_permission:Developer|Edit-User Group']);

        Route::get('/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy')
            ->middleware(['role_or_permission:Developer|Delete-User Group']);
    });

    Route::prefix('rekapitulasi')->group(function () {

        Route::get('/pensiun', [RekapitulasiController::class, 'pensiun'])->name('rekapitulasi.pensiun')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);

        Route::post('/count-pensiun', [RekapitulasiController::class, 'countPensiunByUnit'])->name('count.pensiun')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);

        Route::get('/level', [RekapitulasiController::class, 'level'])->name('rekapitulasi.level')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);

        Route::post('/count-level', [RekapitulasiController::class, 'countLevelByUnit'])->name('count.level')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);

        Route::get('/pangkat', [RekapitulasiController::class, 'pangkat'])->name('rekapitulasi.pangkat')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);

        Route::post('/count-pangkat', [RekapitulasiController::class, 'countPangkatByUnit'])->name('count.pangkat')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);

        Route::get('/pkwt', [RekapitulasiController::class, 'pkwt'])->name('rekapitulasi.pkwt')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);

        Route::post('/count-pkwt', [RekapitulasiController::class, 'countPkwtByUnit'])->name('count.pkwt')
            ->middleware(['role_or_permission:Developer|View-Rekapitulasi']);
    });

    Route::prefix('cuti')->group(function () {

        Route::get('/', [CutiController::class, 'index'])->name('cuti.index')
            ->middleware(['role_or_permission:Developer|View-Cuti']);

        Route::post('/get-data', [CutiController::class, 'getData'])
            ->middleware(['role_or_permission:Developer|View-Cuti']);

        Route::get('/create', [CutiController::class, 'create'])->name('cuti.create')
            ->middleware(['role_or_permission:Developer|Add-Cuti']);

        Route::get('/edit/{id}', [CutiController::class, 'edit'])->name('cuti.edit')
            ->middleware(['role_or_permission:Developer|Edit-Cuti']);

        Route::post('/store', [CutiController::class, 'store'])->name('cuti.store')
            ->middleware(['role_or_permission:Developer|Add-Cuti']);

        Route::put('/update', [CutiController::class, 'update'])->name('cuti.update')
            ->middleware(['role_or_permission:Developer|Edit-Cuti']);

        Route::get('/destroy/{id}', [CutiController::class, 'destroy'])->name('cuti.destroy')
            ->middleware(['role_or_permission:Developer|Delete-Cuti']);
    });

});
