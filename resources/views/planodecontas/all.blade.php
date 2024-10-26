@extends('adminlte::page')

@section('title', 'Plano de contas')

@section('content_header')
    <h1>Plano de contas</h1>
@stop

@section('content')
<div class="row" style="margin-bottom: 2%">
    <div class="col">
        <a class="btn btn-primary" href="{{ route('planos-de-contas.create') }}">+ Novo Plano de Conta</a>
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
'itemsPerPage' => 50,
],
'itemsPerPage' => 50,
])
<thead class="table-primary">
    <tr>
        <th>Descricao</th>
        <th>Tipo</th>
        <th>Ações</th>
    </tr>
</thead>
<tbody>
    @foreach ($planodecontas as $p)
    <tr>
        <td>{{ $p->descricao }}</td>
        <td>{{ $p->tipo }}</td>

        <td></td>
    </tr>
    @endforeach
</tbody>

@endcomponent
@stop

@section('css')

@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
