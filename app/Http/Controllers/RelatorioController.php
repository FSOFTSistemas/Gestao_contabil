<?php

namespace App\Http\Controllers;

use App\Models\Movimento;
use App\Models\Relatorio;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $reportType = $request->get('report_type');

        // Usando o Model para realizar as consultas com filtros
        $relatorios = Movimento::query()
            ->when($startDate && $endDate, function($query) use ($startDate, $endDate) {
                return $query->dataRange($startDate, $endDate);
            })
            ->when($reportType, function($query) use ($reportType) {
                return $query->reportType($reportType);
            })
            ->get();

        return view('relatorio.index', compact('relatorios'));
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
    public function show(Relatorio $relatorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relatorio $relatorio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relatorio $relatorio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relatorio $relatorio)
    {
        //
    }
}
