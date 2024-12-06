<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DreController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MovimentoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PlanoDeContasController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;

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
    Route::resource('settings', ConfigController::class);
    Route::resource('dre', DreController::class);
    Route::post('/dre/dre', [DreController::class, 'dre'])->name('dre.dre');
    Route::resource('usuarios', UsuarioController::class)->middleware(['role:admin']);
    Route::get('/seletor-empresa/{id}', [EmpresaController::class, 'selecionarEmpresa'])->name('seletor.empresa');
    Route::get('/clientes/endereco/{cep}', [ClienteController::class, 'buscarEnderecoPorCep']);
    Route::get('/cmv', [DreController::class, 'cmv'])->name('cmv');


});
