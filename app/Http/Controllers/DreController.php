<?php

namespace App\Http\Controllers;

use App\Models\Dre;
use App\Http\Controllers\Controller;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dre $dre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dre $dre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dre $dre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dre $dre)
    {
        //
    }

    public function dre(Request $request)
    {
        

        $dre = [
            'receita_bruta' => 100000,
            'impostos' => 15000,
            'receita_liquida' => 85000,
            'custos' => 40000,
            'lucro_bruto' => 45000,
            'despesas_operacionais' => 15000,
            'lucro_operacional' => 30000,
            'despesas_financeiras' => 5000,
            'lucro_antes_impostos' => 25000,
            'impostos_sobre_lucro' => 7500,
            'lucro_liquido' => 17500,
        ];

        return view('dre.rel', compact('dre'));
    }

    public function cmv()
    {
        $resultados = [];
        return view('dre.cmv', compact('resultados'));
    }
}
