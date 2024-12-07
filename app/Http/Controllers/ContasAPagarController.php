<?php

namespace App\Http\Controllers;

use App\Models\ContasAPagar;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ContasAPagarController extends Controller
{
    public function index()
    {
        $contas = ContasAPagar::where('empresa_id', session('empresa_id'))->get();
        return view('contas_pagar.index', compact('contas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
            'status' => 'required|string|in:pendente,pago',
        ]);

        $data['empresa_id'] = session('empresa_id');

        ContasAPagar::create($data);

        return redirect()->back()->with('success', 'Conta a pagar criada com sucesso!');
    }

    public function update(Request $request, ContasAPagar $contaPagar)
    {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
            'status' => 'required|string|in:pendente,pago',
        ]);

        $contaPagar->update($data);

        return redirect()->back()->with('success', 'Conta a pagar atualizada com sucesso!');
    }

    public function destroy(ContasAPagar $contaPagar)
    {
        $contaPagar->delete();

        return redirect()->back()->with('success', 'Conta a pagar removida com sucesso!');
    }
}
