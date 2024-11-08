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
@php
$isEdit = isset($empresa); // Verifica se estamos em modo de edição
@endphp

<form method="POST" action="{{ $isEdit ? route('empresas.update', $empresa->id) : route('empresas.store') }}">
    @csrf

    @if ($isEdit)
    @method('PUT') <!-- Define o método PUT para a atualização -->
    @endif

    <div class="form-group mb-3">
        <label for="cnpj">CNPJ</label>
        <div class="input-group">
            <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj"
                name="cnpj" value="{{ old('cnpj', $empresa->cnpj ?? '') }}" required>
            <button class="btn btn-outline-secondary" type="button" id="search-cnpj" title="Buscar CNPJ">
                <i class="fas fa-search"></i> <!-- Ícone da lupa -->
            </button>
        </div>
        <small class="form-text text-muted">Digite o CNPJ e clique na lupa para pesquisar os dados automaticamente.</small>
        @error('cnpj')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="razao_social">Razão Social</label>
        <input type="text" class="form-control @error('razao_social') is-invalid @enderror" id="razao_social"
            name="razao_social" value="{{ old('razao_social', $empresa->razao_social ?? '') }}" required>
        @error('razao_social')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="fantasia">Nome Fantasia</label>
        <input type="text" class="form-control @error('fantasia') is-invalid @enderror" id="fantasia"
            name="fantasia" value="{{ old('fantasia', $empresa->fantasia ?? '') }}" required>
        @error('fantasia')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="IE">Inscrição Estadual</label>
        <input type="text" class="form-control @error('IE') is-invalid @enderror" id="IE"
            name="IE" value="{{ old('IE', $empresa->IE ?? '') }}">
        @error('IE')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
            name="email" value="{{ old('email', $empresa->email ?? '') }}" required>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control @error('telefone') is-invalid @enderror" id="telefone"
            name="telefone" value="{{ old('telefone', $empresa->telefone ?? '') }}">
        @error('telefone')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="cep">CEP</label>
        <div class="input-group">
            <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep"
                name="cep" value="{{ old('cep', $cliente->cep ?? '') }}">
            <button type="button" class="btn btn-outline-secondary" id="buscarCep">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <small class="form-text text-muted">Digite o CEP e clique na lupa para pesquisar o endereço automaticamente.</small>
        @error('cep')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="endereco">Endereço</label>
        <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="endereco"
            name="endereco" value="{{ old('endereco', $empresa->endereco ?? '') }}">
        @error('endereco')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade"
            name="cidade" value="{{ old('cidade', $empresa->cidade ?? '') }}">
        @error('cidade')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="estado">Estado</label>
        <input type="text" class="form-control @error('estado') is-invalid @enderror" id="estado"
            name="estado" value="{{ old('estado', $empresa->estado ?? '') }}">
        @error('estado')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>



    <button type="submit" class="btn btn-primary">
        {{ $isEdit ? 'Atualizar Empresa' : 'Cadastrar Empresa' }}
    </button>
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

        // Evento para buscar dados do CNPJ
        $('#search-cnpj').on('click', function() {
            const cnpj = $('#cnpj').val().replace(/[^\d]/g, ''); // Remove máscara para busca
            if (cnpj.length !== 14) {
                alert('Por favor, insira um CNPJ válido com 14 dígitos.');
                return;
            }
            $.ajax({
                url: `https://open.cnpja.com/office/${cnpj}`,
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer YOUR_API_TOKEN'); // Substitua pelo token de autenticação
                },
                success: function(response) {
                    if (response) {
                        $('#razao_social').val(response.alias || '');
                        $('#fantasia').val(response.alias || '');
                        $('#email').val(response.emails[0].address || '');
                        $('#telefone').val(response.phones[0].area+'' + response.phones[0].number || '');
                        $('#endereco').val(response.address.street || '');
                        $('#cidade').val(response.address.city || '');
                        $('#estado').val(response.address.state || '');
                        $('#cep').val(response.address.zip || '');
                    } else {
                        alert('Nenhum dado encontrado para o CNPJ fornecido.');
                    }
                },
                error: function() {
                    alert('Ocorreu um erro ao buscar o CNPJ. Por favor, tente novamente.');
                }
            });
        });
    });
</script>
<script>
    document.getElementById('buscarCep').addEventListener('click', function() {
        var cep = document.getElementById('cep').value;

        if (!cep) {
            alert('Por favor, insira um CEP.');
            return;
        }

        fetch(`/clientes/endereco/${cep}`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('endereco').value = data.logradouro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                } else {
                    alert('CEP não encontrado.');
                }
            })
            .catch(error => {
                console.error('Erro ao buscar o endereço:', error);
                alert('Erro ao buscar o endereço. Tente novamente.');
            });
    });
</script>


@stop
