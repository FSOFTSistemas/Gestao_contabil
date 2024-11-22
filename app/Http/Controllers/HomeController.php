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
        $empresaId = Auth::user()->empresa_id;

        if ($empresaId > 1){
            session()->put('empresa_id', $empresaId);
            $clientes = Cliente::where('empresa_id', $empresaId)->count();
            $fornecedores = Fornecedor::where('empresa_id', $empresaId)->count();
            $totalDespesas = Movimento::where('tipo', 'despesa')->where('empresa_id', $empresaId)->sum('valor');
            $totalReceitas = Movimento::where('tipo', 'receita')->where('empresa_id', $empresaId)->sum('valor');
        }else{
            $clientes = 0;
            $fornecedores = 0;
            $totalDespesas = 0;
            $totalReceitas = 0;
        }

        return view('home', [
            'empresas' => $empresas,
            'clientes' => $clientes,
            'fornecedores' => $fornecedores,
            'totalDespesas' => $totalDespesas,
            'totalReceitas' => $totalReceitas,
        ]);
    }
}


