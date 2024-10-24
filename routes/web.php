<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MovimentoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PlanoDeContasController;
use App\Http\Controllers\EmpresaController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::resource('empresas', EmpresaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('fornecedores', FornecedorController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('movimentos', MovimentoController::class);
    Route::resource('planos-de-contas', PlanoDeContasController::class);
});
