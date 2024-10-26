@extends('adminlte::page')

@section('title', 'Plano de contas')

@section('content_header')
@stop

@section('content')
<h2>{{ isset($planoDeContas) ? 'Editar Plano de Contas' : 'Novo Plano de Contas' }}</h2>

<form action="{{ isset($planoDeContas) ? route('planos-de-contas.update', $planoDeContas->id) : route('planos-de-contas.store') }}" method="POST">
    @csrf
    @if(isset($planoDeContas))
    @method('PUT')
    @endif

    <!-- Descrição -->
    <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror"
            value="{{ old('descricao', $planoDeContas->descricao ?? '') }}" required>
        @error('descricao')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Tipo -->
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
            <option value="">Selecione o Tipo</option>
            <option value="despesa" {{ old('tipo', $planoDeContas->tipo ?? '') === 'despesa' ? 'selected' : '' }}>Despesa</option>
            <option value="receita" {{ old('tipo', $planoDeContas->tipo ?? '') === 'receita' ? 'selected' : '' }}>Receita</option>
        </select>
        @error('tipo')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Botões de Ação -->
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">{{ isset($planoDeContas) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('planos-de-contas.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@stop

@section('css')
<style>
    .container {
        max-width: 600px;
        margin: auto;
        padding-top: 20px;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop
