<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Produto;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $produtos = Produto::where('empresa_id', session('empresa_id'))->get();
            return view('produto.all', ['produtos' => $produtos]);
            
        } catch (\Exception $e) {
            Sweetalert::error('Verifique se selecionou a empresa !'.$e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $empresas = Empresa::where('id', session('empresa_id'))->get();
            return view('produto.form', ['empresas' => $empresas]);

        } catch (\Exception $e) {
            Sweetalert::error('Verifique se selecionou a empresa !'.$e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'descricao' => 'required|string|max:255',
                'precocusto' => 'required|numeric',
                'precovenda' => 'required|numeric',
                'estoque' => 'required|integer',
                'empresa_id' => 'required|exists:empresas,id',
            ]);
    
            Produto::create($validatedData);
            Sweetalert::success('Produto criado com sucesso!', 'Sucesso');
            return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
            
        } catch (\Exception $e) {
            Sweetalert::error('Erro ao inserir produto !'.$e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
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
        try {
            $empresas = Empresa::where('id', session('empresa_id'))->get();
            return view('produto.form', compact('produto', 'empresas'));

        } catch (\Exception $e) {
            Sweetalert::error('Verifique se selecionou a empresa !'.$e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        try {
            $validatedData = $request->validate([
                'descricao' => 'required|string|max:255',
                'precocusto' => 'required|numeric',
                'precovenda' => 'required|numeric',
                'estoque' => 'required|integer',
                'empresa_id' => 'required|exists:empresas,id',
            ]);
    
            $produto->update($validatedData);
            Sweetalert::success('Produto atualizado com sucesso!', 'Sucesso');
            return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');

        } catch (\Exception $e) {
            Sweetalert::error('Erro ao atualizar produto !'.$e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        try {
            $produto->delete();
            Sweetalert::success('Produto excluido com sucesso!', 'Sucesso');
            return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');

        } catch (\Exception $e) {
            Sweetalert::error('Erro ao atualizar produto !'.$e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
