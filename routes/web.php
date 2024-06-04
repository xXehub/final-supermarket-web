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


// gawe superadmin dan admin
Route::get('panel', function() {
    return view('panel.index');
})->middleware(MultiRoleMiddleware::class . ':superadmin,admin')->name('panel.index');

// gawe superadmin only
Route::get('panel/permission', function() {
    return view('panel.perms.index');
})->middleware('role:superadmin')->name('perms.index');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



