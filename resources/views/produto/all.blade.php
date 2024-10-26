@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
<h1>Produtos</h1>
@stop

@section('content')
<div class="row" style="margin-bottom: 2%">
    <div class="col">
        <a class="btn btn-primary" href="{{ route('produtos.create') }}">+ Novo produto</a>
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
[
'responsivePriority' => 5,
'targets' => 3,
]
],
'itemsPerPage' => 50,
])
<thead class="table-primary">
    <tr>
        <th>Descricao</th>
        <th>Custo</th>
        <th>Venda</th>
        <th>Estoque</th>
        <th>Cidade</th>
        <th>Ações</th>
    </tr>
</thead>
<tbody>
    @foreach ($produtos as $p)
    <tr>
        <td>{{ $p->descricao }}</td>
        <td>{{ $p->precocusto }}</td>
        <td>{{ $p->precovenda }}</td>
        <td>{{ $p->estoque }}</td>
        <td>{{ $p->cidade }}</td>
        <td></td>
    </tr>
    @endforeach
</tbody>

@endcomponent
@stop

@section('css')

@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop
