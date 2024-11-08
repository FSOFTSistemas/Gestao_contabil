@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
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


<div class="row">
    <!-- Card 1: Calendar -->
    <div class="col-md-6">
        <div class="card bg-gradient-success">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                    <!-- button with a dropdown -->
                    <!-- <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="#" class="dropdown-item">Add new event</a>
                            <a href="#" class="dropdown-item">Clear events</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">View calendar</a>
                        </div>
                    </div> -->
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%">
                    <div class="bootstrap-datetimepicker-widget usetwentyfour">
                        <ul class="list-unstyled">
                            <li class="show">
                                <div class="datepicker">
                                    <div class="datepicker-days" style="">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th>
                                                    <th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">November 2024</th>
                                                    <th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th>
                                                </tr>
                                                <tr>
                                                    <th class="dow">Su</th>
                                                    <th class="dow">Mo</th>
                                                    <th class="dow">Tu</th>
                                                    <th class="dow">We</th>
                                                    <th class="dow">Th</th>
                                                    <th class="dow">Fr</th>
                                                    <th class="dow">Sa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td data-action="selectDay" data-day="10/27/2024" class="day old weekend">27</td>
                                                    <td data-action="selectDay" data-day="10/28/2024" class="day old">28</td>
                                                    <td data-action="selectDay" data-day="10/29/2024" class="day old">29</td>
                                                    <td data-action="selectDay" data-day="10/30/2024" class="day old">30</td>
                                                    <td data-action="selectDay" data-day="10/31/2024" class="day old">31</td>
                                                    <td data-action="selectDay" data-day="11/01/2024" class="day">1</td>
                                                    <td data-action="selectDay" data-day="11/02/2024" class="day weekend">2</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="11/03/2024" class="day weekend">3</td>
                                                    <td data-action="selectDay" data-day="11/04/2024" class="day">4</td>
                                                    <td data-action="selectDay" data-day="11/05/2024" class="day">5</td>
                                                    <td data-action="selectDay" data-day="11/06/2024" class="day">6</td>
                                                    <td data-action="selectDay" data-day="11/07/2024" class="day active today">7</td>
                                                    <td data-action="selectDay" data-day="11/08/2024" class="day">8</td>
                                                    <td data-action="selectDay" data-day="11/09/2024" class="day weekend">9</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="11/10/2024" class="day weekend">10</td>
                                                    <td data-action="selectDay" data-day="11/11/2024" class="day">11</td>
                                                    <td data-action="selectDay" data-day="11/12/2024" class="day">12</td>
                                                    <td data-action="selectDay" data-day="11/13/2024" class="day">13</td>
                                                    <td data-action="selectDay" data-day="11/14/2024" class="day">14</td>
                                                    <td data-action="selectDay" data-day="11/15/2024" class="day">15</td>
                                                    <td data-action="selectDay" data-day="11/16/2024" class="day weekend">16</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="11/17/2024" class="day weekend">17</td>
                                                    <td data-action="selectDay" data-day="11/18/2024" class="day">18</td>
                                                    <td data-action="selectDay" data-day="11/19/2024" class="day">19</td>
                                                    <td data-action="selectDay" data-day="11/20/2024" class="day">20</td>
                                                    <td data-action="selectDay" data-day="11/21/2024" class="day">21</td>
                                                    <td data-action="selectDay" data-day="11/22/2024" class="day">22</td>
                                                    <td data-action="selectDay" data-day="11/23/2024" class="day weekend">23</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="11/24/2024" class="day weekend">24</td>
                                                    <td data-action="selectDay" data-day="11/25/2024" class="day">25</td>
                                                    <td data-action="selectDay" data-day="11/26/2024" class="day">26</td>
                                                    <td data-action="selectDay" data-day="11/27/2024" class="day">27</td>
                                                    <td data-action="selectDay" data-day="11/28/2024" class="day">28</td>
                                                    <td data-action="selectDay" data-day="11/29/2024" class="day">29</td>
                                                    <td data-action="selectDay" data-day="11/30/2024" class="day weekend">30</td>
                                                </tr>
                                                <tr>
                                                    <td data-action="selectDay" data-day="12/01/2024" class="day new weekend">1</td>
                                                    <td data-action="selectDay" data-day="12/02/2024" class="day new">2</td>
                                                    <td data-action="selectDay" data-day="12/03/2024" class="day new">3</td>
                                                    <td data-action="selectDay" data-day="12/04/2024" class="day new">4</td>
                                                    <td data-action="selectDay" data-day="12/05/2024" class="day new">5</td>
                                                    <td data-action="selectDay" data-day="12/06/2024" class="day new">6</td>
                                                    <td data-action="selectDay" data-day="12/07/2024" class="day new weekend">7</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <li class="picker-switch accordion-toggle"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <!-- Card 2: Bar Chart -->
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 451px;" width="902" height="500" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
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
