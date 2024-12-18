<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\Empresa;
use App\Models\Fornecedor;
use App\Models\Movimento;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresas = Empresa::all();
        $empresaId = session('empresa_id');

        if (!$empresaId)
        {
            $empresaId = Auth::user()->empresa_id;
        }

        $clientes = Cliente::where('empresa_id', $empresaId)->count();
        $fornecedores = Fornecedor::where('empresa_id', $empresaId)->count();
        $totalDespesas = Movimento::where('tipo', 'despesa')->where('empresa_id', $empresaId)->sum('valor');
        $totalReceitas = Movimento::where('tipo', 'receita')->where('empresa_id', $empresaId)->sum('valor');
        

        return view('home', [
            'empresas' => $empresas,
            'clientes' => $clientes,
            'fornecedores' => $fornecedores,
            'totalDespesas' => $totalDespesas,
            'totalReceitas' => $totalReceitas,
        ]);
    }
}


