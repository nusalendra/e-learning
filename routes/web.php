<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\KepalaSekolah\EkstrakulikulerController;
use App\Http\Controllers\KepalaSekolah\GuruController;
use App\Http\Controllers\KepalaSekolah\IdentitasSiswaController;
use App\Http\Controllers\KepalaSekolah\KategoriController;
use App\Http\Controllers\KepalaSekolah\KelasController;
use App\Http\Controllers\KepalaSekolah\PeriodeController;
use App\Http\Controllers\KepalaSekolah\WaliKelasController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\WaliKelas\CapaianKompetensiController;
use App\Http\Controllers\WaliKelas\JadwalKelasController;
use App\Http\Controllers\WaliKelas\KelolaRuangPresensiController;
use App\Http\Controllers\WaliKelas\MataPelajaranController;
use App\Http\Controllers\WaliKelas\NilaiMataPelajaranController;
use App\Http\Controllers\WaliKelas\PresensiController;
use App\Http\Controllers\WaliKelas\SemesterController;
use App\Http\Controllers\WaliKelas\SiswaController;
use App\Http\Controllers\WaliKelas\UnduhRaporController;
use App\Http\Controllers\WaliKelas\UploadTugasController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['auth']], function () {
	// Kepala Sekolah
	Route::group(['middleware' => 'role:Kepala Sekolah'], function () {
        Route::get('dashboard-kepala-sekolah', function () {
            return view('pages.kepala-sekolah.dashboard-kepala-sekolah');
        })->name('dashboard-kepala-sekolah');

		Route::resource('/periode', PeriodeController::class);
		Route::resource('/kelas', KelasController::class);
		Route::resource('/wali-kelas', WaliKelasController::class);
		Route::resource('/guru', GuruController::class);
		Route::resource('/identitas-siswa', IdentitasSiswaController::class);
		Route::resource('/kategori', KategoriController::class);
		Route::resource('/ekstrakulikuler', EkstrakulikulerController::class);
	
		Route::get('/user-profile', [InfoUserController::class, 'create']);
		Route::post('/user-profile', [InfoUserController::class, 'store']);
		Route::get('/login', function () {
			return view('dashboard');
		})->name('sign-up');
    });

	// Wali Kelas
	Route::group(['middleware' => 'role:Wali Kelas'], function () {
		Route::get('/', [HomeController::class, 'home']);
		Route::get('dashboard-wali-kelas', function () {
			return view('pages.wali-kelas.dashboard-wali-kelas');
		})->name('dashboard-wali-kelas');

		Route::resource('/semester', SemesterController::class);
		Route::resource('/siswa', SiswaController::class);
		Route::put('/siswa/{id}/tambah-siswa', [SiswaController::class, 'tambahSiswa']);
		Route::resource('/mata-pelajaran', MataPelajaranController::class);
		Route::resource('/jadwal-kelas', JadwalKelasController::class);
		Route::resource('/kelola-ruang-presensi', KelolaRuangPresensiController::class);
		Route::resource('/presensi', PresensiController::class);
		Route::resource('/upload-tugas', UploadTugasController::class);
		Route::resource('/nilai-mata-pelajaran', NilaiMataPelajaranController::class);
		Route::resource('/capaian-koompetensi', CapaianKompetensiController::class);
		Route::resource('/unduh-rapor', UnduhRaporController::class);
	});

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');
	
	Route::get('/logout', [SessionsController::class, 'destroy']);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');