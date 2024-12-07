<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Patrimonio;
use Illuminate\Http\Request;

class PatrimonioController extends Controller
{
    public function index()
    {
        $patrimonios = Patrimonio::where('empresa_id', session('empresa_id'))->get();
        $empresas = Empresa::where('id', session('empresa_id'))->get();
        return view('patrimonio.index', compact('patrimonios', 'empresas'));
    }

    public function create()
    {
        $empresas = Empresa::where('empresa_id', session('empresa_id'))->get();
        return view('patrimonio.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        try
        {

            $request->validate([
                'nome' => 'required|string|max:255',
                'valor' => 'required|numeric|min:0',
                'data_aquisicao' => 'required|date',
                'empresa_id' => 'required|exists:empresas,id',
            ]);
            
            Patrimonio::create($request->all());
            
            return redirect()->route('patrimonios.index')->with('success', 'Patrimônio criado com sucesso.');
        }catch(\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function edit(Patrimonio $patrimonio)
    {
        $empresas = Empresa::where('empresa_id', session('empresa_id'))->get();
        return view('patrimonio.edit', compact('patrimonio', 'empresas'));
    }

    public function update(Request $request, Patrimonio $patrimonio)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_aquisicao' => 'required|date',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $patrimonio->update($request->all());

        return redirect()->route('patrimonios.index')->with('success', 'Patrimônio atualizado com sucesso.');
    }

    public function destroy(Patrimonio $patrimonio)
    {
        $patrimonio->delete();

        return redirect()->route('patrimonios.index')->with('success', 'Patrimônio excluído com sucesso.');
    }

}
