<?php

use App\Helpers\GlobalFunction;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ListPendaftaranController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ObjekWisataController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeleksiJurController;
use App\Http\Controllers\SiswaCekLulusController;
use App\Http\Controllers\SiswaPendaftaranController;
use App\Http\Controllers\SiswaProfileController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\UserController;
use App\Models\Kamar;
use App\Models\Lokasi;
use App\Models\ObjekWisata;
use App\Models\PaketTour;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.pages.dashboard');
// });

// Guest
Route::get('/', function () {
    $page = 'Home';
    // $objekWisata = ObjekWisata::inRandomOrder()->paginate(16);
    return view('guest.index', compact('page'));
})->name('index');

// Admin & Owner
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::prefix('transportasi')->group(function () {
//     Route::get('/show', [TransportasiController::class, 'index'])->name('transportasi.show');
//     Route::post('/store', [TransportasiController::class, 'store'])->name('transportasi.store');
//     Route::post('/update/{id}', [TransportasiController::class, 'update'])->name('transportasi.update');
//     Route::get('/destroy/{id}', [TransportasiController::class, 'destroy'])->name('transportasi.destroy');
//     Route::get('/download', [TransportasiController::class, 'download'])->name('transportasi.download');
// });

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::prefix('jurusan')->group(function () {
        Route::get('/show', [JurusanController::class, 'index'])->name('jurusan.show');
        Route::post('/store', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::post('/update/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::get('/destroy/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
        // Route::get('/download', [JurusanController::class, 'download'])->name('jurusan.download');
        // Route::get('/acc-user/{id}/{action}', [JurusanController::class, 'accUser'])->name('jurusan.accUser');
    });
    Route::prefix('calon-siswa')->group(function () {
        Route::get('/show', [CalonSiswaController::class, 'index'])->name('calonsiswa.show');
        // Route::post('/store', [CalonSiswaController::class, 'store'])->name('calonsiswa.store');
        // Route::post('/update/{id}', [CalonSiswaController::class, 'update'])->name('calonsiswa.update');
        // Route::get('/destroy/{id}', [CalonSiswaController::class, 'destroy'])->name('calonsiswa.destroy');
        // Route::get('/download', [CalonSiswaController::class, 'download'])->name('calonsiswa.download');
        // Route::get('/acc-user/{id}/{action}', [CalonSiswaController::class, 'accUser'])->name('calonsiswa.accUser');
    });
    Route::prefix('list-pendaftaran')->group(function () {
        Route::get('/show', [ListPendaftaranController::class, 'index'])->name('listpendaftaran.show');
        Route::get('/detail/{id}', [ListPendaftaranController::class, 'detail'])->name('listpendaftaran.detail');
        Route::post('/lolos/{id}', [ListPendaftaranController::class, 'lolos'])->name('listpendaftaran.lolos');
        Route::post('/tolak/{id}', [ListPendaftaranController::class, 'tolak'])->name('listpendaftaran.tolak');
        Route::put('/pendaftaran/publish-all', [ListPendaftaranController::class, 'publish'])->name('listpendaftaran.publish');
        Route::delete('/destroy/{id}', [ListPendaftaranController::class, 'destroy'])->name('listpendaftaran.destroy');
    });
    Route::prefix('seleksi-jurusan')->group(function () {
        Route::get('/show', [SeleksiJurController::class, 'index'])->name('seleksijurusan.show');
        Route::post('/store/{id}', [SeleksiJurController::class, 'store'])->name('seleksijurusan.store');
        Route::put('/publish-all', [SeleksiJurController::class, 'publish'])->name('seleksijurusan.publish');
        Route::put('/publish-reset', [SeleksiJurController::class, 'resetPublish'])->name('seleksijurusan.reset');
    });
    Route::prefix('users')->group(function () {
        Route::get('/show', [UserController::class, 'index'])->name('users.show');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/download', [UserController::class, 'download'])->name('users.download');
        Route::get('/acc-user/{id}/{action}', [UserController::class, 'accUser'])->name('users.accUser');
    });
});

// user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::prefix('profile-siswa')->group(function () {
        Route::get('/show', [SiswaProfileController::class, 'index'])->name('siswaProfile.show');
    });
    Route::prefix('pendaftaran-siswa')->group(function () {
        Route::get('/show', [SiswaPendaftaranController::class, 'index'])->name('siswaPendaftaran.show');
        Route::post('/store', [SiswaPendaftaranController::class, 'store'])->name('siswaPendaftaran.store');
    });
    Route::prefix('cek-kelulusan')->group(function () {
        Route::get('/show', [SiswaCekLulusController::class, 'index'])->name('siswaCekLulus.show');
        Route::get('/print', [SiswaCekLulusController::class, 'print'])->name('siswaCekLulus.print');
    });
});

require __DIR__ . '/auth.php';
