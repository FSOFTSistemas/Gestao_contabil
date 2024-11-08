<?php

namespace App\Http\Controllers;

use App\Models\Dre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('DRE.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dre $dre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dre $dre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dre $dre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dre $dre)
    {
        //
    }
}
