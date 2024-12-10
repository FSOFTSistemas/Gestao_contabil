<?php

namespace App\Http\Controllers;

use App\Models\ContasAPagar;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;

class ContasAPagarController extends Controller
{
    public function index()
    {
        try {
            $contas = ContasAPagar::where('empresa_id', session('empresa_id'))->get();
            return view('contas_pagar.index', compact('contas'));
            
        } catch (\Exception $e) {
            Sweetalert::error('Verifique se selecionou empresa !'.$e->getMessage(), 'Error');
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'descricao' => 'required|string|max:255',
                'valor' => 'required|numeric',
                'data_vencimento' => 'required|date',
                'status' => 'required|string|in:pendente,pago',
            ]);
    
            $data['empresa_id'] = session('empresa_id');
    
            ContasAPagar::create($data);

            Sweetalert::success('Conta a pagar criada com sucesso!', 'Sucesso');

            return redirect()->back()->with('success', 'Conta a pagar criada com sucesso!');

        } catch (\Exception $e) {
            Sweetalert::error('Erro ao inserir  !'.$e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, ContasAPagar $contaPagar)
    {
        try {
            $data = $request->validate([
                'descricao' => 'required|string|max:255',
                'valor' => 'required|numeric',
                'data_vencimento' => 'required|date',
                'status' => 'required|string|in:pendente,pago',
            ]);
    
            $contaPagar->update($data);
            Sweetalert::success('Conta a pagar atualizada com sucesso!', 'Sucesso');
            return redirect()->back()->with('success', 'Conta a pagar atualizada com sucesso!');

        } catch (\Exception $e) {
            Sweetalert::error('Erro ao atualizar !'.$e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(ContasAPagar $contaPagar)
    {
        try {
            $contaPagar->delete();
            Sweetalert::success('Conta a pagar removida com sucesso!', 'Sucesso');
            return redirect()->back()->with('success', 'Conta a pagar removida com sucesso!');

        } catch (\Exception $e) {
            Sweetalert::error('Erro ao deletar !'.$e->getMessage(), 'Error');
            return redirect()->back();
        }
    }
}
