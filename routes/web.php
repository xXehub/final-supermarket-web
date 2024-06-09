<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\ProdukController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Middleware\MultiRoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default route
Route::get('/', function () {
    return view('welcome');
});

// Middleware untuk superadmin dan admin
Route::middleware([MultiRoleMiddleware::class . ':superadmin,admin'])->group(function () {
    Route::get('panel', [\App\Http\Controllers\Panel\DashboardController::class, 'index'])->name('panel.dashboard');

    // Rute resource untuk produk
    Route::resource('/panel/produk', ProdukController::class);
    // Route::get('panel/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');

    // Rute resource untuk kategori
    Route::resource('/panel/kategori', KategoriController::class);

    // Rute resource untuk supplier mas
    Route::resource('/panel/supplier', SupplierController::class);
});

// Middleware untuk superadmin saja
Route::middleware(['role:superadmin'])->group(function () {
    Route::get('panel/permission', function () {
        return view('panel.perms.index');
    })->name('perms.index');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

// Rute untuk mendapatkan data produk dan kategori
Route::get('data/produk', [ProdukController::class, 'getData'])->name('produk.data');
Route::get('data/kategori', [KategoriController::class, 'getData'])->name('kategori.data');
Route::get('data/supplier', [SupplierController::class, 'getData'])->name('supplier.data');
