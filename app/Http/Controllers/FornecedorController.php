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
        $fornecedores = Fornecedor::where('empresa_id', session('empresa_id'))->get();
        return view('fornecedores.all', ['fornecedores' =>  $fornecedores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresas = Empresa::where('id', session('empresa_id'))->get();
        return view('fornecedores.form', ['empresas' => $empresas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        Fornecedor::create($validatedData);

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor criado com sucesso!');
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
    public function edit($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $empresas = Empresa::where('id', session('empresa_id'))->get();
        return view('fornecedores.form', ['fornecedor' => $fornecedor, 'empresas' => $empresas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
        ]);
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($validatedData);

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso!');
    }
}
