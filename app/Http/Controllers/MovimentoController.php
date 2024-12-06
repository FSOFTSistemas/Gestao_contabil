<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Movimento;
use App\Models\Produto;
use Illuminate\Http\Request;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movimentos = Movimento::where('empresa_id', session('empresa_id'))->get();
        $produtosServicos = Produto::where('empresa_id', session('empresa_id'))->get();
        $empresas = Empresa::where('id', session('empresa_id'))->get();
        return view('movimento.all', ['movimentos' => $movimentos, 'produtosServicos' => $produtosServicos, 'empresas' => $empresas]);
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
        // Validação dos dados
        $request->validate([
            'descricao' => 'required|string|max:255',
            'tipo' => 'required|in:Despesa,Receita,cmv',
            'data' => 'required|date',
            'forma_pagamento' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        // Criar o movimento
        Movimento::create([
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'data' => $request->data,
            'forma_pagamento' => $request->forma_pagamento,
            'valor' => $request->valor,
            'empresa_id' => $request->empresa_id,
        ]);

        return redirect()->route('movimentos.index')->with('success', 'Movimento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movimento $movimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movimento $movimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encontrar o movimento
        $movimento = Movimento::findOrFail($id);

        // Validação dos dados
        $request->validate([
            'descricao' => 'required|string|max:255',
            'tipo' => 'required|in:despesa,receita',
            'data' => 'required|date',
            'forma_pagamento' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        // Atualizar o movimento
        $movimento->update([
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'data' => $request->data,
            'forma_pagamento' => $request->forma_pagamento,
            'valor' => $request->valor,
            'empresa_id' => $request->empresa_id,
        ]);

        return redirect()->route('movimentos.index')->with('success', 'Movimento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Encontrar o movimento
         $movimento = Movimento::findOrFail($id);

         // Excluir o movimento
         $movimento->delete();

         return redirect()->route('movimentos.index')->with('success', 'Movimento excluído com sucesso!');
    }
}
