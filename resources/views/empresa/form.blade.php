@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

<h2 class="mb-4">Cadastrar Empresa</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('empresas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="razao_social" class="form-label">Razão Social</label>
        <input type="text" class="form-control" id="razao_social" name="razao_social" value="{{ old('razao_social') }}" required>
    </div>

    <div class="mb-3">
        <label for="fantasia" class="form-label">Nome Fantasia</label>
        <input type="text" class="form-control" id="fantasia" name="fantasia" value="{{ old('fantasia') }}" required>
    </div>

    <div class="mb-3">
        <label for="cnpj" class="form-label">CNPJ</label>
        <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj') }}" required>
    </div>

    <div class="mb-3">
        <label for="IE" class="form-label">Inscrição Estadual</label>
        <input type="text" class="form-control" id="IE" name="IE" value="{{ old('IE') }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}" required>
    </div>

    <div class="mb-3">
        <label for="endereco" class="form-label">Endereço</label>
        <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco') }}">
    </div>

    <div class="mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}">
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}">
    </div>

    <div class="mb-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep') }}">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Voltar</a>
</form>

@stop

@section('css')
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function() {
        $('#cnpj').mask('99.999.999/9999-99'); // Máscara para CNPJ
        $('#telefone').mask('(99) 99999-9999'); // Máscara para telefone
    });
</script>
@stop
