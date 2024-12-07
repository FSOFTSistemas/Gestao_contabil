@extends('adminlte::page')

@section('title', 'Relatórios')

@section('content_header')
    <h1>Relatórios</h1>
@stop

@section('content')
    <form action="{{ route('relatorios.index') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="start_date">Data Início</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->get('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date">Data Fim</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->get('end_date') }}">
            </div>
            <div class="col-md-4">
                <label for="report_type">Tipo de Relatório</label>
                <select name="report_type" id="report_type" class="form-control">
                    <option value="vendas" {{ request()->get('report_type') == 'vendas' ? 'selected' : '' }}>Vendas</option>
                    <option value="despesas" {{ request()->get('report_type') == 'despesas' ? 'selected' : '' }}>Despesas</option>
                    <option value="cmv" {{ request()->get('report_type') == 'cmv' ? 'selected' : '' }}>CMV</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <div class="row mt-4">
        <div class="col-md-12">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <script>
        // Gráfico de exemplo com Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril'],
                datasets: [{
                    label: 'Valor Total',
                    data: [12, 19, 3, 5],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Inicializando o DataTable
        $(document).ready(function() {
            $('#relatoriosTable').DataTable();
        });
    </script>
@endsection