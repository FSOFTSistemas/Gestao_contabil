<?php

namespace App\Http\Controllers;

use App\Models\Movimento;
use App\Models\Relatorio;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
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
        $empresaId = session('empresa_id');

        $movimentos = Movimento::query()
            ->when($empresaId, function ($query) use ($empresaId) {
                return $query->where('empresa_id', $empresaId);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('data', [$startDate, $endDate]);
            })
            ->selectRaw("DATE_FORMAT(data, '%Y-%m') as mes, tipo, SUM(valor) as total")
            ->groupBy('mes', 'tipo')
            ->orderBy('mes')
            ->get();

        // Preparando os dados para o gráfico
        $meses = $movimentos->pluck('mes')->unique()->sort()->values();
        $receitas = $movimentos->where('tipo', 'receita')->pluck('total', 'mes');
        $despesas = $movimentos->where('tipo', 'despesa')->pluck('total', 'mes');

        // Convertendo para formato compatível com o Chart.js
        $dadosGrafico = [
            'meses' => $meses->toArray(),
            'receitas' => $meses->map(fn($mes) => $receitas[$mes] ?? 0)->toArray(),
            'despesas' => $meses->map(fn($mes) => $despesas[$mes] ?? 0)->toArray(),
        ];

        return view('relatorio.index', compact('dadosGrafico'));
    }


    public function gerarPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $reportType = $request->input('report_type');
        $empresaId = session('empresa_id');

        // Verificar o tipo de relatório e carregar a lógica correspondente
        switch ($reportType) {
            case 'dre':
                $view = 'relatorio.dre';
                $dados = $this->gerarRelatorioDre($startDate, $endDate, $empresaId);
                break;

            case 'geral':
                $view = 'relatorio.geral';
                $dados = $this->gerarRelatorioGeral($startDate, $endDate, $empresaId);
                break;

            case 'cmv':
                $view = 'relatorio.cmv';
                $dados = $this->gerarRelatorioCmv($startDate, $endDate, $empresaId);
                break;

            case 'despesas':
                $view = 'relatorio.despesas';
                $dados = $this->gerarRelatorioDespesas($startDate, $endDate, $empresaId);
                break;

            default:
                // Tipo de relatório inválido
                return redirect()->back()->withErrors(['error' => 'Tipo de relatório inválido']);
        }


        $pdf = FacadePdf::loadView($view, compact('dados', 'reportType', 'startDate', 'endDate'));

        return $pdf->stream("relatorio_{$reportType}.pdf");
    }


    protected function gerarRelatorioDre($startDate, $endDate, $empresaId)
    {
        // Exemplo de lógica específica para o DRE
        return Movimento::whereBetween('data', [$startDate, $endDate])
            ->where('empresa_id', $empresaId)
            ->get()
            ->groupBy('tipo')
            ->map(function ($group) {
                return [
                    'total' => $group->sum('valor'),
                    'quantidade' => $group->count(),
                ];
            });
    }


    protected function gerarRelatorioGeral($startDate, $endDate, $empresaId)
    {
        return Movimento::whereBetween('data', [$startDate, $endDate])->where('empresa_id', $empresaId)->get();
    }

    protected function gerarRelatorioCmv($startDate, $endDate, $empresaId)
    {
        return Movimento::whereBetween('data', [$startDate, $endDate])
            ->where('tipo', 'cmv')
            ->where('empresa_id', $empresaId)
            ->get()
            ->map(function ($movimento) {
                return [
                    'descricao' => $movimento->descricao,
                    'valor' => $movimento->valor,
                    'data' => $movimento->data,
                ];
            });
    }

    protected function gerarRelatorioDespesas($startDate, $endDate, $empresaId)
    {
        return Movimento::whereBetween('data', [$startDate, $endDate])
            ->where('tipo', 'despesa')
            ->where('empresa_id', $empresaId)
            ->get();
    }
}
