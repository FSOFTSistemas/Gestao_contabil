<?php

namespace App\Http\Controllers;

use App\Models\PlanoDeContas;
use Illuminate\Http\Request;

class PlanoDeContasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planoDeContas = PlanoDeContas::all();
        return view('planodecontas.all', ['planodecontas' => $planoDeContas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('planodecontas.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'tipo' => 'required|in:despesa,receita',
        ]);

        PlanoDeContas::create($validatedData);

        return redirect()->route('planos-de-contas.index')->with('success', 'Plano de contas criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanoDeContas $planoDeContas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanoDeContas $planoDeContas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'tipo' => 'required|in:despesa,receita',
        ]);

        $planoDeContas = PlanoDeContas::findOrFail($id);
        $planoDeContas->update($validatedData);

        return redirect()->route('planos-de-contas.index')->with('success', 'Plano de contas atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $planoDeContas = PlanoDeContas::findOrFail($id);
        $planoDeContas->delete();

        return redirect()->route('planos-de-contas.index')->with('success', 'Plano de contas deletado com sucesso!');
    }
}
