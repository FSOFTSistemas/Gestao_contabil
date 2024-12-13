@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@can('acesso total')
<div class="d-flex justify-content-end align-items-center mt-3">
    {{-- Dropdown de Seleção de Empresas --}}
    <div class="dropdown mr-3">
        <button class="btn btn-primary dropdown-toggle px-4 py-2" type="button" id="dropdownEmpresas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-building mr-2"></i> Selecione uma Empresa
        </button>
        <div class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="dropdownEmpresas" style="min-width: 250px;">
            @foreach ($empresas as $empresa)
            <a class="dropdown-item d-flex align-items-center" href="{{ route('seletor.empresa', ['id' => $empresa->id]) }}">
                <i class="fas fa-check-circle text-primary mr-2"></i> {{ $empresa->razao_social }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Empresa Selecionada --}}
    @if (session('empresa_id'))
    <div class="alert alert-info d-flex align-items-center mb-0" style="max-width: 80%;">
        <i class="fas fa-info-circle mr-2"></i>
        <span>Empresa Selecionada: <strong>{{ App\Models\Empresa::find(session('empresa_id'))->razao_social }}</strong></span>
    </div>
    @else
    <div class="alert alert-warning d-flex align-items-center mb-0" style="max-width: 80%;">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <span>Nenhuma Empresa Selecionada</span>
    </div>
    @endif
</div>
@endcan
<br>

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $clientes }}</h3>

                <p>Clientes</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/clientes" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><sup style="font-size: 20px">R$</sup>{{ $totalReceitas }}</h3>

                <p>Total de receitas</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/movimentos" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $fornecedores }}</h3>

                <p>Fornecedores</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="/fornecedores" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><sup style="font-size: 20px">R$</sup>{{ $totalDespesas }}</h3>

                <p>Total de despesas</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/movimentos" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>




@stop

@section('css')
<style>
    .dropdown-menu a.dropdown-item:hover {
        background-color: #e9ecef;
        color: #495057;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .dropdown-toggle::after {
        display: none;
    }
</style>
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop
