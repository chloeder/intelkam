<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

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
    return view('welcome');
});

Route::get('/data', [DataController::class, 'index'])->name('data');

Route::get('/add-data', [DataController::class, 'add'])->name('tambah-data');
Route::post('/insert-data', [DataController::class, 'store'])->name('insert-data');

Route::get('/edit-data/{id}', [DataController::class, 'edit'])->name('edit-data');
Route::post('/update-data/{id}', [DataController::class, 'update'])->name('update-data');

Route::get('/delete/{id}', [DataController::class, 'delete'])->name('delete');

Route::get('/export-pdf', [DataController::class, 'export'])->name('export');
