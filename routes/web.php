<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalApproveController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalSparepartController;

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SetupFormController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\PelumasController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\SetupMesinController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\SetupMaintenanceController;
use App\Http\Controllers\UpdateDbController;
use App\Http\Controllers\UpdateMaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StasiunController;

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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::post('/masuk', [UserController::class, 'masuk'])->middleware('guest');

Route::get('/akun', [UserController::class, 'akun'])->middleware('auth');
Route::put('/user/akun/update/', [UserController::class, 'update_akun'])->middleware('auth');
Route::put('/user/akun/update/password/', [UserController::class, 'ganti_password'])->middleware('auth');


Route::get('/user/all/', [UserController::class, 'index'])->middleware('auth')->middleware('superadmin');
Route::get('/user/create/', [UserController::class, 'create'])->middleware('auth')->middleware('superadmin');
Route::post('/user/store/', [UserController::class, 'store'])->middleware('superadmin');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('superadmin');
Route::put('/user/update/', [UserController::class, 'update'])->middleware('superadmin');
Route::delete('/user/delete/', [UserController::class, 'delete'])->middleware('superadmin');

Route::get('/mesin', [MesinController::class, 'index'])->middleware('auth')->middleware('teknisi');
Route::get('/mesin/create', [MesinController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post('/mesin/create', [MesinController::class, 'tambah'])->middleware('admin');
Route::get('/mesin/detail/{id}', [MesinController::class, 'detail'])->middleware('auth')->middleware('teknisi');
Route::get('/mesin/edit/{id}', [MesinController::class, 'edit'])->middleware('auth')->middleware('admin');

Route::put('/mesin/update', [MesinController::class, 'update'])->middleware('admin');
Route::delete('/mesin/destroy', [MesinController::class, 'destroy'])->middleware('admin');
Route::post('/mesin/ruang/create', [MesinController::class, 'create_ruang'])->middleware('admin');


Route::get('/mesin/maintenance/{id}', [MaintenanceController::class, 'maintenance_mesin'])->middleware('auth')->middleware('teknisi');
Route::post('/mesin/maintenance/create/', [UpdateMaintenanceController::class, 'create'])->middleware('mahasiswa');
Route::put('/mesin/maintenance/create/submit/', [UpdateMaintenanceController::class, 'submit_create'])->middleware('mahasiswa');
Route::put('/mesin/maintenance/edit/', [UpdateMaintenanceController::class, 'edit'])->middleware('mahasiswa');
Route::put('/mesin/maintenance/edit/submit', [UpdateMaintenanceController::class, 'submit_edit'])->middleware('mahasiswa');
Route::delete('/mesin/maintenance/delete/', [UpdateMaintenanceController::class, 'delete'])->middleware('mahasiswa');




Route::get('/setupMaintenance/{id}', [SetupMaintenanceController::class, 'setup'])->middleware('auth')->middleware('teknisi');
Route::post('/setupMaintenance/create', [SetupMaintenanceController::class, 'createPadaSetup'])->middleware('mahasiswa');
Route::put('/setupMaintenance/edit', [SetupMaintenanceController::class, 'editPadaSetup'])->middleware('mahasiswa');
Route::delete('/setupMaintenance/destroy', [SetupMaintenanceController::class, 'hapusPadaSetup'])->middleware('mahasiswa');


Route::post('/setupForm/create/', [SetupFormController::class, 'createPadaSetup'])->middleware('mahasiswa');
Route::put('/setupForm/edit/', [SetupFormController::class, 'editPadaSetup'])->middleware('mahasiswa');
Route::delete('/setupForm/delete/', [SetupFormController::class, 'deletePadaSetup'])->middleware('mahasiswa');



Route::get('/ruang', [RuangController::class, 'index'])->middleware('auth')->middleware('teknisi');
Route::post('/ruang/create', [RuangController::class, 'create'])->middleware('admin');
Route::put('/ruang/update', [RuangController::class, 'update'])->middleware('admin');
Route::delete('/ruang/destroy', [RuangController::class, 'destroy'])->middleware('admin');


Route::get('/approve', [JadwalApproveController::class, 'index'])->middleware('auth')->middleware('manager')->middleware('admin');
Route::post('/approve/jadwal', [JadwalApproveController::class, 'approve'])->middleware('manager')->middleware('admin');
Route::put('/approve/jadwal/tetap', [JadwalApproveController::class, 'approve_tetap'])->middleware('manager')->middleware('admin');
Route::put('/approve/jadwal/ubah', [JadwalApproveController::class, 'approve_ubah'])->middleware('manager')->middleware('admin');


Route::post('/maintenance/form/pilih/', [SetupMesinController::class, 'pilih_template'])->middleware('teknisi');
Route::post('/maintenance/form/pilih/kirim/', [SetupMesinController::class, 'ambil_template'])->middleware('mahasiswa');
Route::get('/maintenance/form/pilih/', [SetupMesinController::class, 'tampil_template'])->middleware('auth')->middleware('mahasiswa');

Route::post('/maintenance/ubah_template/', [SetupMesinController::class, 'ubah_template'])->middleware('mahasiswa');

Route::post('/maintenance/create/', [SetupMesinController::class, 'create_maintenance'])->middleware('mahasiswa');
Route::post('/maintenance/edit/', [SetupMesinController::class, 'edit_maintenance'])->middleware('mahasiswa');
Route::post('/maintenance/delete/', [SetupMesinController::class, 'delete_maintenance'])->middleware('mahasiswa');

Route::put('/maintenance/submit/', [MaintenanceController::class, 'update'])->middleware('mahasiswa');

Route::post('/maintenance/form/create/', [SetupMesinController::class, 'create_maintenance_form'])->middleware('mahasiswa');
Route::post('/maintenance/form/update/', [SetupMesinController::class, 'update_maintenance_form'])->middleware('mahasiswa');
Route::post('/maintenance/form/delete/', [SetupMesinController::class, 'delete_maintenance_form'])->middleware('mahasiswa');

//Route::post('/maintenance/action/create/', [MaintenanceController::class, 'maintenance_add']);

Route::get('/sparepart', [SparepartController::class, 'index'])->middleware('auth')->middleware('teknisi');
Route::get('/sparepart/create', [SparepartController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post('/sparepart/create', [SparepartController::class, 'tambah'])->middleware('admin');
Route::get('/sparepart/edit/{id}', [SparepartController::class, 'edit'])->middleware('auth')->middleware('admin');
Route::put('/sparepart/update', [SparepartController::class, 'update'])->middleware('admin');
Route::delete('/sparepart/destroy', [SparepartController::class, 'destroy'])->middleware('admin');


Route::get('/pelumas', [PelumasController::class, 'index'])->middleware('auth')->middleware('teknisi');
Route::get('/pelumas/create', [PelumasController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post('/pelumas/create', [PelumasController::class, 'tambah'])->middleware('admin');
Route::get('/pelumas/edit/{id}', [PelumasController::class, 'edit'])->middleware('auth')->middleware('admin');
Route::put('/pelumas/update', [PelumasController::class, 'update'])->middleware('admin');
Route::delete('/pelumas/destroy', [PelumasController::class, 'destroy'])->middleware('admin');


Route::get('/protocol', [ProtocolController::class, 'index'])->middleware('auth')->middleware('teknisi');
Route::get('/protocol/create', [ProtocolController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post('/protocol/create', [ProtocolController::class, 'tambah'])->middleware('admin');
Route::get('/protocol/edit/{id}', [ProtocolController::class, 'edit'])->middleware('auth')->middleware('admin');
Route::put('/protocol/update', [ProtocolController::class, 'update'])->middleware('admin');
Route::delete('/protocol/destroy', [ProtocolController::class, 'destroy'])->middleware('admin');


Route::get('/stasiun', [StasiunController::class, 'index'])->middleware('auth')->middleware('teknisi');
Route::get('/stasiun/create', [StasiunController::class, 'create'])->middleware('auth')->middleware('admin');
Route::post('/stasiun/create', [StasiunController::class, 'tambah'])->middleware('admin');
Route::get('/stasiun/detail/{id}', [StasiunController::class, 'detail'])->middleware('auth')->middleware('teknisi');
Route::get('/stasiun/edit/{id}', [StasiunController::class, 'edit'])->middleware('auth')->middleware('admin');
Route::put('/stasiun/update', [StasiunController::class, 'update'])->middleware('admin');
Route::delete('/stasiun/destroy', [StasiunController::class, 'destroy'])->middleware('admin');

/*
diilangin, diganti pake model jadwal biasa
Route::get('/sparepart/maintenance/{id}', [MaintenanceController::class, 'tampil_sparepart']);
Route::post('/sparepart/maintenance/', [MaintenanceController::class, 'tambah_sparepart']);
Route::delete('/sparepart/maintenance/delete/', [MaintenanceController::class, 'hapus_sparepart']);
*/

Route::post('/sparepart/jadwal/', [JadwalSparepartController::class, 'tambah_sparepart'])->middleware('teknisi');
Route::delete('/sparepart/jadwal/delete/', [JadwalSparepartController::class, 'hapus_sparepart'])->middleware('teknisi');


// Tambahkan route ini SEBELUM route /jadwal/{id}
Route::get('/jadwal/all', [JadwalController::class, 'indexAll'])->middleware('auth');
Route::get('/jadwal/{id}', [JadwalController::class, 'index'])->middleware('auth');
Route::get('/jadwal/detail/{id}', [JadwalController::class, 'detail'])->middleware('auth');
Route::put('/jadwal/update/', [JadwalController::class, 'update'])->middleware('teknisi')->middleware('bukan admin');
Route::put('/jadwal/update_alasan/', [JadwalController::class, 'update_with_alasan'])->middleware('teknisi')->middleware('bukan admin');
Route::post('/jadwal/update_alasan_batal/', [JadwalController::class, 'update_with_alasan_batal'])->middleware('teknisi')->middleware('bukan admin');
Route::put('/jadwal/update-status/{id}', [JadwalController::class, 'updateStatus'])->middleware('auth');


Route::get('/update_tahunan', [UpdateDbController::class, 'index'])->middleware('auth')->middleware('manager');
Route::post('/update_tahunan', [UpdateDbController::class, 'update_jadwal'])->middleware('manager');


Route::get('/laporan', [LaporanController::class, 'index'])->middleware('auth')->middleware('mahasiswa');
Route::post('/laporan/inspeksi', [LaporanController::class, 'laporan_general_inspection'])->middleware('mahasiswa');
Route::post('/laporan/maintenance', [LaporanController::class, 'laporan_maintenance'])->middleware('mahasiswa');
Route::post('/laporan/rencana_realisasi', [LaporanController::class, 'laporan_rencana_realisasi'])->middleware('mahasiswa');
Route::get('/laporan/harian', [LaporanController::class, 'laporan_harian'])->middleware('mahasiswa');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
