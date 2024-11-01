<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingLabController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FilePondController;
use App\Http\Controllers\FrontBlogController;
use App\Http\Controllers\FrontInformationController;
use App\Http\Controllers\FrontProfileController;
use App\Http\Controllers\JadwalPraktikumController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\KerjaSamaController;
use App\Http\Controllers\KurikulumLabController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModulPraktikumController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PengelolaController;
use App\Http\Controllers\FrontPraktikumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomLabController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\UnitBagianController;
use App\Http\Controllers\VisiMisiController;

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

Route::get('/', [FrontBlogController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/sitemap.xml', [SiteMapController::class, 'index']);
Route::get('/robots.txt', function () {
    return response()->view('robots')->header('Content-Type', 'text/plain');
});

Route::name('blog.')->prefix('blog')->group(function () {
    Route::get('/search', [FrontBlogController::class, 'search'])->name('search');
    Route::get('/{slug}', [FrontBlogController::class, 'show'])->name('show');
});

Route::name('profil.')->prefix('profil')->group(function () {
    Route::get('/tujuan', [FrontProfileController::class, 'tujuan'])->name('tujuan');
    Route::get('/visi-misi', [FrontProfileController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/struktur-organisasi', [FrontProfileController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/unit-bagian', [FrontProfileController::class, 'UnitBagian'])->name('unit-bagian');
    Route::get('/pengelola', [FrontProfileController::class, 'pengelola'])->name('pengelola');
    Route::get('/fasilitas', [FrontProfileController::class, 'fasilitas'])->name('fasilitas');
});

Route::name('informasi.')->prefix('informasi')->group(function () {
    Route::get('/sop', [FrontInformationController::class, 'sop'])->name('sop');
    Route::get('/pelatihan', [FrontInformationController::class, 'pelatihan'])->name('pelatihan');
    Route::get('/pelatihan/{slug}', [FrontInformationController::class, 'detailPelatihan'])->name('pelatihan.detail');
    Route::get('/kalender-akademik', [FrontInformationController::class, 'kalender'])->name('kalender-akademik');
    Route::get('/kerja-sama', [FrontInformationController::class, 'kerjaSama'])->name('kerja-sama');
});

Route::name('praktikum.')->prefix('praktikum')->group(function () {
    Route::name('peminjaman-ruang-lab.')->prefix('peminjaman-ruang-lab')->group(function () {
        Route::get('/', [FrontPraktikumController::class, 'peminjamanLab'])->name('index');
        Route::get('/data', [FrontPraktikumController::class, 'dataPeminjamanLab'])->name('data');
        Route::get('/detail/{detail}', [FrontPraktikumController::class, 'detailPeminjamanLab']);
    });

    Route::name('modul-praktikum.')->prefix('modul-praktikum')->group(function () {
        Route::get('/', [FrontPraktikumController::class, 'modulPraktikum'])->name('index');
        Route::get('/data', [FrontPraktikumController::class, 'dataModulPraktikum'])->name('data');
    });

    Route::name('jadwal-praktikum.')->prefix('jadwal-praktikum')->group(function () {
        Route::get('/', [FrontPraktikumController::class, 'jadwalPraktikum'])->name('index');
        Route::get('/data', [FrontPraktikumController::class, 'dataJadwalPraktikum'])->name('data');
    });

    Route::name('kurikulum-lab.')->prefix('kurikulum-lab')->group(function () {
        Route::get('/', [FrontPraktikumController::class, 'kurikulumLab'])->name('index');
        Route::get('/data', [FrontPraktikumController::class, 'dataKurikulumLab'])->name('data');
    });
});

Route::name('dashboard.')->prefix('dashboard')->middleware(['auth', 'checkUserStatus'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::post('/upload-image', [FilePondController::class, 'uploadImage'])->name('upload-image');
    Route::delete('/cancel-image', [FilePondController::class, 'cancelImage'])->name('cancel-image');
    Route::post('/upload-file', [FilePondController::class, 'uploadFile'])->name('upload-file');
    Route::delete('/cancel-file', [FilePondController::class, 'cancelFile'])->name('cancel-file');
    Route::post('/ckeditor', [FilePondController::class, 'upload'])->name('ckeditor');

    Route::name('management-role.')->prefix('management-role')->middleware('admin')->group(function () {
        Route::get('/data', [RoleController::class, 'data'])->name('data');
        Route::post('/{role}/permissions', [RoleController::class, 'givePermission'])->name('permissions');
    });
    Route::resource('management-role', RoleController::class)->middleware('admin');

    Route::name('user.')->prefix('user')->middleware('admin')->group(function () {
        Route::get('/data', [UserController::class, 'data'])->name('data');
    });
    Route::resource('user', UserController::class)->middleware('admin');

    Route::name('blog.')->prefix('blog')->group(function () {
        Route::get('/data', [BlogController::class, 'data'])->name('data');
        Route::delete('/remove-image', [FilePondController::class, 'removeImageBlog'])->name('remove-image');
    });
    Route::resource('blog', BlogController::class);

    Route::name('lab.')->prefix('lab')->group(function () {
        Route::name('booking.')->prefix('booking')->group(function () {
            Route::get('/data', [BookingLabController::class, 'data'])->name('data');
        });
        Route::resource('booking', BookingLabController::class);

        Route::name('room.')->prefix('room')->group(function () {
            Route::get('/data', [RoomLabController::class, 'data'])->name('data');
        });
        Route::resource('room', RoomLabController::class);

        Route::name('kurikulum.')->prefix('kurikulum')->group(function () {
            Route::delete('/remove-file', [FilePondController::class, 'removeFileKurikulumLab'])->name('remove-file');
            Route::get('/data', [KurikulumLabController::class, 'data'])->name('data');
        });
        Route::resource('kurikulum', KurikulumLabController::class);
    });

    Route::name('pages.')->prefix('pages')->group(function () {
        Route::name('tujuan.')->prefix('tujuan')->group(function () {
            Route::get('/data', [TujuanController::class, 'data'])->name('data');
        });
        Route::resource('tujuan', TujuanController::class);

        Route::name('visi-misi.')->prefix('visi-misi')->group(function () {
            Route::get('/data', [VisiMisiController::class, 'data'])->name('data');
        });
        Route::resource('visi-misi', VisiMisiController::class);

        Route::name('struktur-organisasi.')->prefix('struktur-organisasi')->group(function () {
            Route::delete('/remove-image', [FilePondController::class, 'removeImageStrukturOrganisasi'])->name('remove-image');
        });
        Route::resource('struktur-organisasi', StrukturOrganisasiController::class);

        Route::name('unit-bagian.')->prefix('unit-bagian')->group(function () {
            Route::get('/data', [UnitBagianController::class, 'data'])->name('data');
        });
        Route::resource('unit-bagian', UnitBagianController::class);

        Route::name('pengelola.')->prefix('pengelola')->group(function () {
            Route::delete('/remove-image', [FilePondController::class, 'removeImagePengelola'])->name('remove-image');
            Route::get('/data', [PengelolaController::class, 'data'])->name('data');
        });
        Route::resource('pengelola', PengelolaController::class);

        Route::name('fasilitas.')->prefix('fasilitas')->group(function () {
            Route::delete('/remove-image', [FilePondController::class, 'removeImageFasilitas'])->name('remove-image');
            Route::get('/data', [FasilitasController::class, 'data'])->name('data');
        });
        Route::resource('fasilitas', FasilitasController::class);

        Route::name('sop.')->prefix('sop')->group(function () {
            Route::delete('/remove-image', [FilePondController::class, 'removeImageSop'])->name('remove-image');
            Route::delete('/remove-file', [FilePondController::class, 'removeFileSop'])->name('remove-file');
            Route::get('/data', [SopController::class, 'data'])->name('data');
        });
        Route::resource('sop', SopController::class);

        Route::name('kerja-sama.')->prefix('kerja-sama')->group(function () {
            Route::delete('/remove-image', [FilePondController::class, 'removeImageKerjaSama'])->name('remove-image');
            Route::get('/data', [KerjaSamaController::class, 'data'])->name('data');
        });
        Route::resource('kerja-sama', KerjaSamaController::class);

        Route::name('pelatihan.')->prefix('pelatihan')->group(function () {
            Route::delete('/remove-image', [FilePondController::class, 'removeImagePelatihan'])->name('remove-image');
            Route::get('/data', [PelatihanController::class, 'data'])->name('data');
        });
        Route::resource('pelatihan', PelatihanController::class);

        Route::name('kalender-akademik.')->prefix('kalender-akademik')->group(function () {
            Route::delete('/remove-image', [FilePondController::class, 'removeImageKalenderAkademik'])->name('remove-image');
            Route::delete('/remove-file', [FilePondController::class, 'removeFileKalenderAkademik'])->name('remove-file');
            Route::get('/data', [KalenderAkademikController::class, 'data'])->name('data');
        });
        Route::resource('kalender-akademik', KalenderAkademikController::class);
    });

    Route::name('praktikum.')->prefix('praktikum')->group(function () {
        Route::name('jadwal.')->prefix('jadwal')->group(function () {
            Route::get('/data', [JadwalPraktikumController::class, 'data'])->name('data');
        });
        Route::resource('jadwal', JadwalPraktikumController::class);

        Route::name('modul.')->prefix('modul')->group(function () {
            Route::delete('/remove-file', [FilePondController::class, 'removeFileModulPraktikum'])->name('remove-file');
            Route::get('/data', [ModulPraktikumController::class, 'data'])->name('data');
        });
        Route::resource('modul', ModulPraktikumController::class);
    });
});
