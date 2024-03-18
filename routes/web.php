<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KostumController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengunjungController;

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
//     return view('pengunjung.kostum');
// });

Route::get('/', [PengunjungController::class, 'index'])->name('home');
Route::get('/kostum', [PengunjungController::class, 'kostum'])->name('kostum');
// Route::post('/kostum', [PengunjungController::class, 'kostum'])->name('kostum');

// Route::get('/syarat-ketentuan', [PengunjungController::class, 'syarat-ketentuan'])->name('syarat-ketentuan');



Auth::routes();

Route::redirect('/admin', '/admin-dashboard');

Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/kostum-detail/{id}', [KostumController::class, 'show'])->name('admin.kostum-detail');

Route::get('/admin/kostum-list', [KostumController::class, 'index'])->name('admin.kostum-list');
Route::get('/admin/kostum-create', [KostumController::class, 'create'])->name('admin.kostum-create');
Route::post('/admin/kostum-create', [KostumController::class, 'store'])->name('admin.kostum-store');

Route::get('/admin/kostum-edit/{id}', [KostumController::class, 'edit'])->name('admin.kostum-edit');
Route::put('/admin/kostum-edit/{id}', [KostumController::class, 'update'])->name('admin.kostum-update');

Route::delete('/admin/kostum-hapus/{id}', [KostumController::class, 'destroy'])->name('admin.kostum-destroy');



Route::get('/admin/peminjaman-list', [PeminjamanController::class, 'index'])->name('admin.peminjaman-list');
Route::get('/admin/peminjaman-detail/{id}',[PeminjamanController::class,'show'])->name('admin.peminjaman-detail');
Route::get('/admin/peminjaman-create', [PeminjamanController::class, 'create'])->name('admin.peminjaman-create');
Route::post('/admin/peminjaman-create', [PeminjamanController::class, 'store'])->name('admin.peminjaman-store');

Route::put('/admin/peminjaman-update', [PeminjamanController::class, 'update'])->name('admin.peminjaman-update');
Route::delete('/admin/peminjaman-hapus', [PeminjamanController::class, 'destroy'])->name('admin.peminjaman-destroy');



// slider routes
// Route::resource('admin-home-slider', SliderController::class);
Route::get('/admin-home-slider', [SliderController::class, 'index'])->name('admin.home-slider');
Route::put('/admin-home-slider', [SliderController::class, 'update_image'])->name('admin.update-slider');
Route::delete('/admin-home-slider', [SliderController::class, 'destroy_update'])->name('admin.destroy-slider');


Route::resource('/admin/kategori', KategoriController::class, [
    'names' => [
        'index' => 'admin.kategori.index',
        'create' => 'admin.kategori.create',
        'store' => 'admin.kategori.store',
        'show' => 'admin.kategori.show',
        'edit' => 'admin.kategori.edit',
        'update' => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ],
]);
