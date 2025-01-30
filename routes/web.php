<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', function () {
    return redirect()->route('login');  // Arahkan langsung ke login
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index_product', [App\Http\Controllers\ProducController::class, 'index_product'])->name('index_product');
Route::get('/get_datatables_product', [App\Http\Controllers\ProducController::class, 'get_datatables_product'])->name('get_datatables_product');
Route::post('/create_data', [App\Http\Controllers\ProducController::class, 'create_data'])->name('create_data');
Route::post('/void_data', [App\Http\Controllers\ProducController::class, 'void_data'])->name('void_data');
Route::get('/get_edit_data', [App\Http\Controllers\ProducController::class, 'get_edit_data'])->name('get_edit_data');
Route::post('/edit_data/{id}', [App\Http\Controllers\ProducController::class, 'edit_data'])->name('edit_data');
Route::post('/export_excel_product', [App\Http\Controllers\ProducController::class, 'export_excel_product'])->name('export_excel_product');

Route::get('/index_profil', [App\Http\Controllers\ProfilController::class, 'index_profil'])->name('index_profil');
