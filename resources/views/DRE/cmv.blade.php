@extends('adminlte::page')

@section('title', 'CMV')

@section('content_header')
    <h1>CMV - Custo de Mercadoria Vendida</h1>
@stop

@section('content')
    {{-- Filtros --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Filtros</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('cmv') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Data Inicial</label>
                        <input type="date" name="start_date" class="form-control" id="start_date">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Data Final</label>
                        <input type="date" name="end_date" class="form-control" id="end_date">
                    </div>
                    <div class="col-md-4">
                        <label for="product" class="form-label">Produto</label>
                        <input type="text" name="product" class="form-control" id="product" placeholder="Buscar produto">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabela com DataTable --}}
    <div class="card mt-3">
        <div class="card-header bg-secondary text-white">
            <h5>Resultados</h5>
        </div>
        <div class="card-body">
            @component('components.data-table', [
                'uniqueId' => 'cmvTable',
                'itemsPerPage' => 10,
                'responsive' => [],
            ])
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade Vendida</th>
                        <th>Custo Unitário</th>
                        <th>Receita Total</th>
                        <th>CMV Total</th>
                        <th>Margem de Lucro</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Renderizar resultados dinâmicos aqui --}}
                    @foreach ($resultados as $resultado)
                        <tr>
                            <td>{{ $resultado->produto }}</td>
                            <td>{{ $resultado->quantidade }}</td>
                            <td>{{ number_format($resultado->custo_unitario, 2, ',', '.') }}</td>
                            <td>{{ number_format($resultado->receita_total, 2, ',', '.') }}</td>
                            <td>{{ number_format($resultado->cmv_total, 2, ',', '.') }}</td>
                            <td>{{ number_format($resultado->margem_lucro, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            @endcomponent
        </div>
    </div>
@stop