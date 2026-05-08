<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiretorController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\PremiacaoController;
use App\Http\Controllers\EstudioController;
use App\Models\Diretor;
use App\Models\Filme;
use App\Models\Avaliacao;
use App\Models\Premiacao;
use App\Models\Estudio;


Route::get('/', [FilmeController::class, 'index'])->name('filmes.index');

Route::get('/diretores', [DiretorController::class, 'index'])->name('diretores.index');
Route::get('/diretores/create', [DiretorController::class, 'create'])->name('diretores.create');
Route::post('/diretores', [DiretorController::class, 'store'])->name('diretores.store');
Route::delete('/diretores/{id}', [DiretorController::class, 'destroy'])
    ->name('diretores.destroy');
Route::post('/diretores/search', [DiretorController::class, 'search'])->name('diretores.search');
Route::get('/diretores/{id}/edit', [DiretorController::class, 'edit'])->name('diretores.edit');
Route::put('/diretores/{id}', [DiretorController::class, 'update'])->name('diretores.update');



Route::get('/filmes', [FilmeController::class, 'index'])->name('filmes.index');
Route::get('/filmes/create', [FilmeController::class, 'create'])->name('filmes.create');
Route::post('/filmes', [FilmeController::class, 'store'])->name('filmes.store');
Route::delete('/filmes/{id}', [FilmeController::class, 'destroy'])
   ->name('filmes.destroy');
Route::post('/filmes/search', [FilmeController::class, 'search'])->name('filmes.search');
Route::get('/filmes/{id}/edit', [FilmeController::class, 'edit'])->name('filmes.edit');
Route::put('/filmes/{id}', [FilmeController::class, 'update'])->name('filmes.update');



Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])->name('avaliacoes.index');
Route::get('/avaliacoes/create', [AvaliacaoController::class, 'create'])->name('avaliacoes.create');
Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');
Route::delete('/avaliacoes/{id}', [AvaliacaoController::class, 'destroy'])
    ->name('avaliacoes.destroy');
Route::post('/avaliacoes/search', [AvaliacaoController::class, 'search'])->name('avaliacoes.search');
Route::get('/avaliacoes/{id}/edit', [AvaliacaoController::class, 'edit'])->name('avaliacoes.edit');
Route::put('/avaliacoes/{id}', [AvaliacaoController::class, 'update'])->name('avaliacoes.update');



Route::get('/sobre', function () { return view('sobre');})->name('sobre');



Route::get('/premiacoes', [PremiacaoController::class, 'index'])->name('premiacoes.index');
Route::get('/premiacoes/create', [PremiacaoController::class, 'create'])->name('premiacoes.create');
Route::post('/premiacoes', [PremiacaoController::class, 'store'])->name('premiacoes.store');
Route::delete('/premiacoes/{id}', [PremiacaoController::class, 'destroy'])
    ->name('premiacoes.destroy');
    Route::post('/premiacoes/search', [PremiacaoController::class, 'search'])->name('premiacoes.search');
Route::get('/premiacoes/{id}/edit', [PremiacaoController::class, 'edit'])->name('premiacoes.edit');
Route::put('/premiacoes/{id}', [PremiacaoController::class, 'update'])->name('premiacoes.update');



Route::get('/estudios', [EstudioController::class, 'index'])->name('estudios.index');
Route::get('/estudios/create', [EstudioController::class, 'create'])->name('estudios.create');
Route::post('/estudios', [EstudioController::class, 'store'])->name('estudios.store');
Route::delete('/estudios/{id}', [EstudioController::class, 'destroy'])
    ->name('estudios.destroy');
Route::post('/estudios/search', [EstudioController::class, 'search'])->name('estudios.search');
Route::get('/estudios/{id}/edit', [EstudioController::class, 'edit'])->name('estudios.edit');
Route::put('/estudios/{id}', [EstudioController::class, 'update'])->name('estudios.update');



Route::get('/chart/diretor', [FilmeController::class, 'chartdiretor'])->name('filmes.chartdiretor');
Route::get('/chart/notas', [FilmeController::class,  'chartnotas'])->name('filmes.chartnotas');



Route::get('/report/ranking', [FilmeController::class,  'reportranking'])->name('filmes.reportranking');
Route::get('/report/premios', [FilmeController::class,  'reportpremios'])->name('filmes.reportpremios');
