<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SaranaKesehatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNonApproveController;
use App\Http\Controllers\UserSelesaiController;
use App\Http\Controllers\UserWawancaraController;
use App\Models\Admin;
use App\Models\SaranaKesehatan;
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




Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('login.proses');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('register', 'register')->name('register.pmi');
    Route::post('register/store', 'storePmi')->name('register.store');
    Route::get('/getProvince/{regencyId}', 'getKab');
});

Route::prefix('admin')->group(function() {
     Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth:admin,web']);
});

Route::prefix('users')->middleware(['auth:admin,web', 'web'])->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/store/{id}', [UserController::class, 'getId'])->name('user.getId');
    Route::get('/detail/{id}', [UserController::class, 'detail'])->name('user.detail');
    Route::get('/{id}', [UserController::class, 'detailId'])->name('user.detailId');
    Route::get('/download-document/{id}/{document}', [UserController::class, 'downloadBpjs'])->name('download.bpjs');
    Route::get('/download-merged-pdf/{id}', [UserController::class, 'downloadMergedPDF'])->name('download.merged.pdf');
    Route::post('/addData', [UserController::class, 'addData'])->name('user.addData');
});

Route::get('/pmi-excel/{status}', [ExportController::class, 'exportNew'])->name('pmi.exportExcel')->middleware(['auth:admin,web']);

Route::prefix('/api/users')->group(function() {
    Route::get('/', [UserController::class, 'indexApi'])->name('user.indexApi')->middleware(['auth:admin,web']);
    Route::post('/store/{id}', [UserController::class, 'storeApi'])->name('user.storeApi')->middleware(['auth:admin,web']);
    Route::delete('/delete/{id}', [UserController::class, 'deleteApi'])->name('user.deleteApi')->middleware(['auth:admin,web']);
    Route::delete('/deleteAll', [UserController::class, 'deleteAll'])->name('user.deleteAll')->middleware(['auth:admin,web']);
    Route::post('/setComplete/{id}', [UserController::class , 'setComplete'])->name('user.setComplete')->middleware(['auth:admin,web']);
});

Route::prefix('dashboard')->middleware(['auth:admin,web', 'web'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/{type}/{status}', [DashboardController::class, 'indexGet'])->name('dashboard.indexGet');
    Route::get('/viewFilter/{type}/{status}', [DashboardController::class, 'viewFilter'])->name('dashboard.viewFilter');
});

Route::prefix('users-nonapproved')->middleware(['auth:admin,web', 'web'])->group(function() {
    Route::get('/', [UserNonApproveController::class, 'index'])->name('user-nonapproved.index');
    Route::get('/{id}', [UserNonApproveController::class, 'detailId'])->name('user.detailId');
});

Route::prefix('/api/users-nonapproved')->group(function() {
    Route::get('/', [UserNonApproveController::class, 'indexApi'])->name('user-nonapproved.indexApis')->middleware(['auth:admin,web']);
    Route::delete('/delete/{id}', [UserNonApproveController::class, 'deleteApi'])->name('user-nonapproved.deleteApi')->middleware(['auth:admin,web']);
    Route::delete('/deleteAll', [UserNonApproveController::class, 'deleteAll'])->name('user-nonapproved.deleteAll')->middleware(['auth:admin,web']);
    Route::post('/setComplete/{id}', [UserNonApproveController::class , 'setComplete'])->name('user-nonapproved.setComplete')->middleware(['auth:admin,web']);
});

Route::prefix('sarana-kesehatan')->middleware(['auth:admin,web', 'web'])->group(function() {
    Route::get('/', [SaranaKesehatanController::class, 'index'])->name('sarana-kesehatan.index');
});


Route::prefix('/api/sarana-kesehatan')->group(function() {
    Route::get('/', [SaranaKesehatanController::class, 'indexApi'])->name('sarana-kesehatan.indexApi')->middleware(['auth:admin,web']);
    Route::post('/store', [SaranaKesehatanController::class, 'storeApi'])->name('sarana-kesehatan.storeApi')->middleware(['auth:admin,web']);
    Route::delete('/delete/{id}', [SaranaKesehatanController::class, 'deleteApi'])->name('sarana-kesehatan.deleteApi')->middleware(['auth:admin,web']);
    Route::delete('/deleteAll', [SaranaKesehatanController::class, 'deleteAll'])->name('sarana-kesehatan.deleteAll')->middleware(['auth:admin,web']);
    Route::get('/edit/{id}', [SaranaKesehatanController::class, 'editApi'])->name('sarana-kesehatan.edit')->middleware(['auth:admin,web']);
    Route::post('/update/{id}', [SaranaKesehatanController::class, 'updateApi'])->name('sarana-kesehatan.updateApi')->middleware(['auth:admin,web']);
});

Route::prefix('users-selesai')->middleware(['auth:admin,web', 'web'])->group(function() {
    Route::get('/', [UserSelesaiController::class, 'index'])->name('user-selesai.index');
});

Route::prefix('/api/users-selesai')->group(function() {
    Route::get('/', [UserSelesaiController::class, 'indexApi'])->name('user-selesai.indexApi')->middleware(['auth:admin,web']);
    Route::post('/setTerbang/{id}', [UserSelesaiController::class, 'setTerbang'])->name('user-selesai.setTerbang')->middleware(['auth:admin,web']);
});

Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth:admin,web']);
});

Route::prefix('/api/admin')->group(function() {
    Route::get('/', [AdminController::class, 'indexApi'])->name('admin.indexApi')->middleware(['auth:admin,web']);
    Route::post('/store', [AdminController::class, 'storeApi'])->name('admin.storeApi')->middleware(['auth:admin,web']);
    Route::get('/edit/{id}', [AdminController::class, 'editApi'])->name('admin.edit')->middleware(['auth:admin,web']);
    Route::post('/update/{id}', [AdminController::class, 'updateApi'])->name('admin.updateApi')->middleware(['auth:admin,web']);
    Route::delete('/delete/{id}', [AdminController::class, 'deleteApi'])->name('admin.deleteApi')->middleware(['auth:admin,web']);
    Route::delete('/deleteAll', [AdminController::class, 'deleteAll'])->name('admin.deleteAll')->middleware(['auth:admin,web']);
});



Route::prefix('direktur')->middleware(['auth:admin,web', 'web'])->group(function() {
    Route::get('/', [DirekturController::class, 'index'])->name('direktur.index');
    Route::get('/{type}/{status}', [DirekturController::class, 'indexGet'])->name('direktur.indexGet');
    Route::get('/viewFilter/{type}/{status}', [DirekturController::class, 'viewFilter'])->name('direktur.viewFilter');
});


Route::prefix('users-wawancara')->middleware(['auth:admin,web', 'web'])->group(function() {
    Route::get('/', [UserWawancaraController::class, 'index'])->name('userWawancara.index');
});


Route::prefix('/api/users-wawancara')->group(function() {
    Route::get('/', [UserWawancaraController::class, 'indexApi'])->name('userWawancara.indexApi')->middleware(['auth:admin,web']);
    Route::get('/edit/{id}', [UserWawancaraController::class, 'editApi'])->name('userWawancara.edit')->middleware(['auth:admin,web']);
    Route::post('/update/{id}', [UserWawancaraController::class, 'updateApi'])->name('userWawancara.updateApi')->middleware(['auth:admin,web']);
    Route::post('/setComplete/{id}', [UserWawancaraController::class , 'setComplete'])->name('user-nonapproved.setComplete')->middleware(['auth:admin,web']);
});