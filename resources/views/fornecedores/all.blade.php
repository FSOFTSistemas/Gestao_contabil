@extends('adminlte::page')

@section('title', 'Fornecedores')

@section('content_header')

@stop

@section('content')
<div class="row" style="margin-bottom: 2%">
    <div class="col">
        <a class="btn btn-primary" href="{{ route('fornecedores.create') }}">+ Novo fornecedor</a>
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
        ],
        'itemsPerPage' => 50,
    ])
    <thead class="table-primary">
        <tr>
            <th>Nome</th>
            <th>Cnpj</th>
            <th>Telefone</th>
            <th>Cidade</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fornecedores as $f)
            <tr>
                <td>{{ $f->nome }}</td>
                <td>{{ $f->cnpj }}</td>
                <td>{{ $f->telefone }}</td>
                <td>{{ $f->cidade }}</td>
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
