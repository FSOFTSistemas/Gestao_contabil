@extends('adminlte::page')

@section('title', 'DRE')

@section('content_header')
<h1>Demonstrativo de Resultados do Exercício (DRE)</h1>
@stop

@section('content')
<div class="container-fluid">

    {{-- Filtros --}}
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Filtros</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dre.index') }}" class="form-inline">
                <div class="form-group mr-3">
                    <label for="data_inicio" class="mr-2">Data Início</label>
                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="{{ request()->data_inicio }}">
                </div>
                <div class="form-group mr-3">
                    <label for="data_fim" class="mr-2">Data Fim</label>
                    <input type="date" class="form-control" id="data_fim" name="data_fim" value="{{ request()->data_fim }}">
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>

    {{-- Card de Informações do DRE --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Receita Bruta</h4>
                </div>
                <div class="card-body">
                    <p><strong>Receita Bruta em Dinheiro:</strong> R$ {{ number_format($dre['receita_bruta_dinheiro'], 2, ',', '.') }}</p>
                    <p><strong>Receita Bruta no Cartão:</strong> R$ {{ number_format($dre['receita_bruta_cartao'], 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Despesas</h4>
                </div>
                <div class="card-body">
                    <h5>Despesas Agrupadas</h5>
                    @foreach($dre['despesas_agrupadas'] as $categoria => $valor)
                        <p><strong>{{ ucfirst($categoria) }}:</strong> R$ {{ number_format($valor, 2, ',', '.') }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Card de Lucro/Prejuízo --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Lucro ou Prejuízo</h4>
        </div>
        <div class="card-body">
            <p><strong>Lucro ou Prejuízo: </strong> R$ {{ number_format($dre['lucroOuPrejuizo'], 2, ',', '.') }}</p>
            <p><strong>Total Geral: </strong> R$ {{ number_format($dre['totalGeral'], 2, ',', '.') }}</p>
        </div>
    </div>

</div>
@stop

@section('css')
{{-- Adicionando estilos adicionais --}}
<style>
    .card-title {
        font-size: 1.25rem;
    }
    .form-inline .form-control {
        max-width: 200px;
    }
    .card-body p {
        font-size: 1.1rem;
    }
</style>
@stop

@section('js')
<script>
    console.log("DRE page loaded.");
</script>
@stop
