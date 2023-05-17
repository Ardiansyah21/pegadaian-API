<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegadaiantController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegadaiant', [PegadaiantController::class, 'index'])->name('index');
Route::post('/pegadaiant/store', [PegadaiantController::class, 'store']);
Route::get('/', [PegadaiantController::class, 'createToken'])->name('createToken');
Route::get('/pegadaiant/{id}', [PegadaiantController::class, 'show'])->name('show');
Route::patch('/pegadaiant/update/{id}', [PegadaiantController::class, 'update'])->name('update');
Route::delete('/pegadaiant/delete/{id}', [PegadaiantController::class, 'destroy'])->name('destroy');
Route::get('/pegadaiant/show/trash/', [PegadaiantController::class, 'trash'])->name('trash');
Route::get('/pegadaiant/show/trash/{id}', [PegadaiantController::class, 'restore'])->name('restore');
Route::get('/pegadaiant/show/trash/permanent/{id}', [PegadaiantController::class, 'permanenDelete'])->name('permanen Delete');








