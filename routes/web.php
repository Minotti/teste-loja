<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\HomeController::class, 'index'])->name('home');
    Route::get('/atributos', [App\Http\Controllers\Dashboard\AtributosController::class, 'index'])->name('atributos')->middleware(['role:gerente']);

    Route::get('/atributos/novo', [App\Http\Controllers\Dashboard\AtributosController::class, 'novo'])->name('novo.atributo')->middleware(['role:gerente']);
    Route::post('/atributos/novo', [App\Http\Controllers\Dashboard\AtributosController::class, 'postNovo'])->name('post.novo.atributo')->middleware(['role:gerente']);

    Route::get('/produtos', [App\Http\Controllers\Dashboard\ProdutosController::class, 'index'])->name('produtos');

    Route::get('/produtos/novo', [App\Http\Controllers\Dashboard\ProdutosController::class, 'novo'])->name('novo.produto')->middleware(['role:gerente']);
    Route::post('/produtos/novo', [App\Http\Controllers\Dashboard\ProdutosController::class, 'postNovo'])->name('post.novo.produto')->middleware(['role:gerente']);

    Route::get('/produtos/editar/{id}', [App\Http\Controllers\Dashboard\ProdutosController::class, 'editar'])->name('editar.produto')->middleware(['role:gerente']);
    Route::post('/produtos/editar', [App\Http\Controllers\Dashboard\ProdutosController::class, 'postEditar'])->name('post.editar.produto')->middleware(['role:gerente']);

    Route::get('/produtos/{id}/movimentacao', [App\Http\Controllers\Dashboard\ProdutosController::class, 'movimentacao'])->name('movimentacao.produto')->middleware(['role:gerente']);
    Route::post('/produtos/movimentacao', [App\Http\Controllers\Dashboard\ProdutosController::class, 'postMovimentacao'])->name('post.movimentacao.produto')->middleware(['role:gerente']);

});
