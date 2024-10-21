@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="row" style="margin-bottom: 2%">
    <div class="col">
        <a class="btn btn-primary" href="{{ route('empresas.create') }}">+ Nova Empresa</a>
    </div>
</div>

@component('components.data-Table', [
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
            [
                'responsivePriority' => 5,
                'targets' => 3,
            ]
        ],
        'itemsPerPage' => 50,
    ])
    <thead class="table-primary">
        <tr>
            <th>Razão Social</th>
            <th>Cnpj</th>
            <th>Telefone</th>
            <th>e-mail</th>
            <th>Cidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empresas as $emp)
            <tr>
                <td>{{ $emp->razao_social }}</td>
                <td>{{ $emp->cnpj }}</td>
                <td>{{ $emp->telefone }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->cidade }}</td>
            </tr>
        @endforeach
    </tbody>

@endcomponent
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop
