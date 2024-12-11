<?php

namespace App\Http\Controllers;

use App\Models\Dre;
use App\Http\Controllers\Controller;
use App\Models\Movimento;
use Illuminate\Http\Request;

class DreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $empresaId = session('empresa_id');


        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');


        $dre = Dre::obterDre($empresaId, $dataInicio, $dataFim);

        return view('DRE.index', ['dre' => $dre]);
    }

    
    public function dre(Request $request)
    {
        $empresaId = session('empresa_id');

        $startDate = $request->input('data_inicio');
        $endDate = $request->input('data_fim');

        $dataRange = $request->only(['data_inicio', 'data_fim']);
        $startDate = $dataRange['data_inicio'];
        $endDate = $dataRange['data_fim'];

        $totalDespesasOperacionais = Movimento::join('plano_de_contas', 'movimentos.planodecontas_id', '=', 'plano_de_contas.id')
        ->where('plano_de_contas.codigo', '>', 3) 
        ->where('plano_de_contas.codigo', '<', 4)  
        ->where('movimentos.empresa_id', $empresaId)
        ->whereBetween('movimentos.data', [$startDate, $endDate])
        ->sum('movimentos.valor');  

        $totalReceita = Movimento::where('empresa_id', $empresaId)
        ->whereBetween('data', [$startDate, $endDate])
        ->where('tipo', 'receita')  
        ->sum('valor'); 

        $totalDespesa = Movimento::where('empresa_id', $empresaId)
        ->whereBetween('data', [$startDate, $endDate])
        ->where('tipo', 'despesa') 
        ->sum('valor'); 
        

        $dre = [
            'receita_bruta' => $totalReceita,
            'impostos' => 0,
            'receita_liquida' => 0,
            'custos' => $totalDespesa,
            'lucro_bruto' => $totalReceita - $totalDespesa,
            'despesas_operacionais' => $totalDespesasOperacionais,
            'lucro_operacional' => 0,
            'despesas_financeiras' => 0,
            'lucro_antes_impostos' => 0,
            'impostos_sobre_lucro' => 0,
            'lucro_liquido' => 0,
        ];

        return view('DRE.rel', compact('dre'));
    }

    public function cmv()
    {
        
        $resultados = [];
        return view('DRE.cmv', compact('resultados'));
    }

    public function cmv_filtro(Request $request)
    {
        $empresaId = session('empresa_id');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $dataRange = $request->only(['start_date', 'end_date']);
        $startDate = $dataRange['start_date'];
        $endDate = $dataRange['end_date'];



        $resultados = Movimento::where('tipo','cmv')->get();
        return view('DRE.cmv', compact('resultados'));
    }
}
