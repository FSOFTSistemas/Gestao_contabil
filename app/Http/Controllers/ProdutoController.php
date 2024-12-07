<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::where('empresa_id', session('empresa_id'))->get();
        return view('produto.all', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = Empresa::where('id', session('empresa_id'))->get();
        return view('produto.form', ['empresas' => $empresas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'precocusto' => 'required|numeric',
            'precovenda' => 'required|numeric',
            'estoque' => 'required|integer',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        Produto::create($validatedData);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        // return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $empresas = Empresa::where('id', session('empresa_id'))->get();
        return view('produto.form', compact('produto', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'precocusto' => 'required|numeric',
            'precovenda' => 'required|numeric',
            'estoque' => 'required|integer',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $produto->update($validatedData);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
