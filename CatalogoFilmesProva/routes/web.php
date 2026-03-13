<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiretorController;
use App\Http\Controllers\FilmeController;
use App\Models\Diretor;
use App\Models\Filme;

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

Route::get('/filmes', [FilmeController::class, 'index'])->name('filmes.index');
Route::get('/filmes/create', [FilmeController::class, 'create'])->name('filmes.create');
Route::post('/filmes', [FilmeController::class, 'store'])->name('filmes.store');
//Route::delete('/filmes/{id}', [FilmeController::class, 'destroy'])->name('filmes.destroy');
//Route::search('/filmes/{id}', [FilmeController::class, 'search'])->name('filmes.search');
//Route::get('/filmes/{id}/edit', [FilmeController::class, 'edit'])->name('filmes.edit');
//Route::put('/filmes/{id}', [FilmeController::class, 'update'])->name('filmes.update');
