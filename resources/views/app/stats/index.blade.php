@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Información del Sistema</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control">
    </div>
    <a
    href="{{ route('stats.download') }}"
    target="_blank"
    >
    <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Imprimir
    </button>
</a>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">

    </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                <h6 class="card-title mb-0">Datos Generales</h6>
                </div>
                <div class="row align-items-start mb-2">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">{{ $patients }}  </h3>
                                    <h4 style="color:white">Pacientes Registrados</h4>
                                </div>
                                <div class="icon">
                                    <i class="mdi mdi-account-box"></i>
                                </div>
                                <a href="{{ route('patients.index') }}" class="small-box-footer">
                                    Lista de Pacientes &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">{{$doctors}}  </h3>
                                    <h4 style="color:white">Médicos Registrados</h4>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-primary"></i>
                                </div>
                                <a href="{{ route('doctors.index') }}" class="small-box-footer">
                                    Lista de Médicos &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">{{$jrealizadas}}  </h3>
                                    <h4 style="color:white">Juntas Realizadas</h4>
                                </div>
                                <div class="icon">
                                    <i class="far fa-calendar-check"></i>
                                </div>
                                <a href="{{ route('medical-boards.index') }}" class="small-box-footer">
                                    Juntas Medicas &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">{{$jprogramado}}  </h3>
                                    <h4 style="color:white">Juntas Programadas </h4>
                                </div>
                                <div class="icon">
                                    <i class="far fa-calendar-check"></i>
                                </div>
                                <a href="{{ route('medical-boards.index') }}" class="small-box-footer">
                                    Juntas Medicas &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">{{$jcancelado}}  </h3>
                                    <h4 style="color:white">Juntas Canceladas </h4>
                                </div>
                                <div class="icon">
                                    <i class="far fa-calendar-check"></i>
                                </div>
                                <a href="{{ route('medical-boards.index') }}" class="small-box-footer">
                                    Juntas Medicas &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">{{$jexpirado}}  </h3>
                                    <h4 style="color:white">Juntas Expiradas</h4>
                                </div>
                                <div class="icon">
                                    <i class="far fa-calendar-check"></i>
                                </div>
                                <a href="{{ route('medical-boards.index') }}" class="small-box-footer">
                                    Juntas Medicas &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">{{$aprobado}}  </h3>
                                    <h4 style="color:white">Informes Aprobados </h4>
                                </div>
                                <div class="icon">
                                    <i class="far fa-calendar-check"></i>
                                </div>
                                <a href="{{ route('reports.index') }}" class="small-box-footer">
                                    Lista de Informes &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">
                                        {{$noaprobado}}  </h3>
                                    <h4 style="color:white">Inf. no Aprobados </h4>
                                </div>
                                <div class="icon">
                                    <i class="far fa-calendar-check"></i>
                                </div>
                                <a href="{{ route('reports.index') }}" class="small-box-footer">
                                    Lista de Informes &nbsp<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Número de Juntas Médicas por Especialidad</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Especialidad</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($especialidades as $especialidad => $label)
                    <tr>
                        <td>{{ $especialidad ?? '-' }}</td>
                        <td>{{ $label ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Grafico de Juntas Médicas</h6>
        </div>
        {!! $chart->container() !!}
    </div>
  </div>
  </div>
</div> <!-- row -->
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    {{ $chart->script() }}
    <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush