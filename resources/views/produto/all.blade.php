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
        <th>P. Custo</th>
        <th>P. Venda</th>
        <th>Estoque</th>
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
        <td>
            <!-- Botão Visualizar -->
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal{{ $p->id }}" title="Visualizar">
                <i class="fas fa-eye"></i>
            </button>

            <!-- Modal de Visualização -->
            <div class="modal fade" id="viewModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $p->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel{{ $p->id }}">Visualizar Produto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Descrição:</strong> {{ $p->descricao }}</p>
                            <p><strong>Preço Custo:</strong> R$ {{ number_format($p->precocusto, 2, ',', '.') }}</p>
                            <p><strong>Preço Venda:</strong> R$ {{ number_format($p->precovenda, 2, ',', '.') }}</p>
                            <p><strong>Estoque:</strong> {{ $p->estoque }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botão Editar -->
            <a href="{{ route('produtos.edit', $p->id) }}" class="btn btn-warning btn-sm" title="Editar">
                <i class="fas fa-edit"></i>
            </a>

            <!-- Botão Deletar com Modal -->
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $p->id }}" title="Excluir">
                <i class="fas fa-trash-alt"></i>
            </button>

            <!-- Modal de Exclusão -->
            <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $p->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $p->id }}">Confirmar Exclusão</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Tem certeza de que deseja excluir o produto <strong>{{ $p->descricao }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('produtos.destroy', $p->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
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
