<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedores.all', ['fornecedores' =>  $fornecedores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = Empresa::all();
        return view('fornecedores.form', ['empresas' => $empresas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:fornecedores,cnpj|size:18',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        Fornecedor::create($validatedData);

        return redirect()->route('fornecedores.all')->with('success', 'Fornecedor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornecedor $fornecedor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornecedor $fornecedor)
    {
        $empresas = Empresa::all();
        return view('fornecedor.form', compact('fornecedor', 'empresas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:fornecedores,cnpj,' . $fornecedor->id . '|size:18',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $fornecedor->update($validatedData);

        return redirect()->route('fornecedores.all')->with('success', 'Fornecedor atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.all')->with('success', 'Fornecedor removido com sucesso!');
    }
}
