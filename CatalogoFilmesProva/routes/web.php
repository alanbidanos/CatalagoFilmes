<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiretorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/diretores', [DiretorController::class, 'index'])->name('diretores.index');
Route::get('/diretores/create', [DiretorController::class, 'create'])->name('diretores.create');
Route::post('/diretores', [DiretorController::class, 'store'])->name('diretores.store');
//Route::delete('/diretores/{id}', [DiretorController::class, 'destroy'])->name('diretores.destroy');
//oute::search('/diretores/{id}', [DiretorController::class, 'search'])->name('diretores.search');
//Route::get('/diretores/{id}/edit', [DiretorController::class, 'edit'])->name('diretores.edit');
//Route::put('/diretores/{id}', [DiretorController::class, 'update'])->name('diretores.update');
