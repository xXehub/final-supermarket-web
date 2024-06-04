<?php

use App\Http\Middleware\MultiRoleMiddleware;
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


// default

Route::get('/', function () {
    return view('welcome');
});

// gawe admin
Route::get('panel', function() {
    return view('admin.index');
})->middleware('role:admin')->name('admin.index');

// gawe user
Route::get('user-page', function() {
    return view('user.index');
})->middleware(MultiRoleMiddleware::class . ':user,admin')->name('user.index');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('default');



