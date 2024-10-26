@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

@stop

@section('content')
<div class="row" style="margin-bottom: 2%">
    <div class="col">
        <a class="btn btn-primary" href="{{ route('clientes.create') }}">+ Novo Cliente</a>
    </div>
</div>

@component('components.data-table', [
    'responsive' => [
            [
                'responsivePriority' => 1,
                'targets' => 0,
            ],
            [
                'responsivePriority' => 2,
                'targets' => 1,
            ],
            [
                'responsivePriority' => 3,
                'targets' => 2,
            ],
            [
                'responsivePriority' => 4,
                'targets' => -1,
            ],
        ],
        'itemsPerPage' => 50,
    ])
    <thead class="table-primary">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Cidade</th>
            <th>Empresa</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente )
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->cidade }}</td>
                <td>{{ $cliente->empresa->razao_social }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>

@endcomponent
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
