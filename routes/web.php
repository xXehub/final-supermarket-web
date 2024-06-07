<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\MultiRoleMiddleware;
use Illuminate\Support\Facades\Auth;
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

// Default route
Route::get('/', function () {
    return view('welcome');
});

// gawe superadmindan admin
Route::middleware([MultiRoleMiddleware::class . ':superadmin,admin'])->group(function () {
    Route::get('panel', function () {
        return view('panel.dashboard');
    })->name('panel.dashboard');
    Route::resource('/panel/produk', ProdukController::class);
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('panel.produk.create');

    // kategori
    Route::resource('/panel/kategori', KategoriController::class);
    // Route::get('panel/kategori/create', [KategoriController::class, 'create'])->name('panel.kategori.create');
    // Route::get('panel/kategori', [KategoriController::class, 'index']);
    // web.php (Routes file)



});

// gawe superadmin only co
Route::middleware(['role:superadmin'])->group(function () {
    Route::get('panel/permission', function () {
        return view('panel.perms.index');
    })->name('perms.index');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// resources route public mas
// Route::resource('kategori', KategoriController::class);
// get data public mas
Route::get('data/produk', [ProdukController::class, 'getData'])->name('produk.data');
Route::get('data/kategori', [KategoriController::class, 'getData'])->name('kategori.data');
