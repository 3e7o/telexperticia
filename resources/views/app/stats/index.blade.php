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
    <form method="post">
        {{ csrf_field() }}
        @method('PATCH')
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
                <span class="input-group-addon bg-transparent"><i data-feather="target"
                        class=" text-primary"></i></span>

                <input type="date" class="form-control" name="start_date" value="{{ $filter_start_date }}">
            </div>
            <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
                <span class="input-group-addon bg-transparent"><i class=" text-primary">Fin</i></span>
                <input class="form-control" name="end_date" type="date" value="{{ $filter_end_date }} ">
            </div>
            <button type="submit" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
                <i class="btn-icon-prepend" data-feather="search"></i>
                Filtrar
            </button>
        </div>
    </form>
</div>


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
                                <h3 class="numbers" style="color:white">{{ $patients }} </h3>
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
                                <h3 class="numbers" style="color:white">{{ $doctors }} </h3>
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
                                <h3 class="numbers" style="color:white">{{ $jrealizadas }} </h3>
                                <h4 style="color:white">Juntas Realizadas</h4>
                            </div>
                            <div class="icon">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <a href="#realizadas" class="small-box-footer">
                                Juntas Medicas Realizadas &nbsp<i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="small-box bg-gradient-primary">
                            <div class="inner">
                                <h3 class="numbers" style="color:white">{{ $jprogramado }} </h3>
                                <h4 style="color:white">Juntas Programadas </h4>
                            </div>
                            <div class="icon">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <a href="#programadas" class="small-box-footer">
                                Juntas Medicas Programadas &nbsp<i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3 class="numbers" style="color:white">{{ $jcancelado }} </h3>
                                <h4 style="color:white">Juntas Canceladas </h4>
                            </div>
                            <div class="icon">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <a href="#canceladas" class="small-box-footer">
                                Juntas Medicas Canceladas&nbsp<i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="small-box bg-gradient-primary">
                            <div class="inner">
                                <h3 class="numbers" style="color:white">{{ $jexpirado }} </h3>
                                <h4 style="color:white">Juntas a Reprogramar</h4>
                            </div>
                            <div class="icon">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <a href="#reprogramar" class="small-box-footer">
                                Juntas Medicas a Reprogramar &nbsp<i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="small-box bg-gradient-info">
                            <div class="inner">
                                <h3 class="numbers" style="color:white">{{ $aprobado }} </h3>
                                <h4 style="color:white">Informes Aprobados </h4>
                            </div>
                            <div class="icon">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <a href="#aprobados" class="small-box-footer">
                                Lista de Informes &nbsp<i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="small-box bg-gradient-info">
                            <div class="inner">
                                <h3 class="numbers" style="color:white">
                                    {{ $noaprobado }} </h3>
                                <h4 style="color:white">Inf. no Aprobados </h4>
                            </div>
                            <div class="icon">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <a href="#noaprobado" class="small-box-footer">
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

    <div class="col-lg-5 col-xl-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Número de Juntas Médicas</h6>
                </div>

                {!! $chart_total->container() !!}

            </div>
        </div>
    </div>

    <div class="col-lg-5 col-xl-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Juntas Médicas por Regionales</h6>
                </div>
                <div style="max-width:100%;height:auto;">
                    {!! $chart_reg->render() !!}
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7 email-aside border-lg-right ">
                        <div class="aside-content">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">Número de Juntas Médicas por Especialidad</h6>
                            </div>
                            <div style="max-width:100%;height:auto;">
                                {!! $chart_especialidad->render() !!}
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5 email-content">
                        <div class="table-responsive">
                            <table id="dataTableExample10" class="table-responsive-sm table table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Especialidad</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($especialidades as $especialidad => $label)
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
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7 email-aside border-lg-right ">
                        <div class="aside-content">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">Juntas Médicas por Médico Encargado</h6>
                            </div>
                            <div class="table-responsive">
                                <table id="dataTableExample2" class="table dataTable no-footer " role="grid">
                                    <thead>
                                        <tr>
                                            <th>Médico</th>
                                            <th>Especialidad</th>
                                            <th>Regional</th>
                                            <th>Matricula</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctor_pacientes as $doctor_paciente)
                                        <tr>
                                            <td>{{ $doctor_paciente->first_surname . ' ' . $doctor_paciente->last_surname ?? '-' }}
                                            </td>
                                            <td>{{ $doctor_paciente->name ?? '-' }}</td>
                                            <td>{{ $doctor_paciente->regional ?? '-' }}</td>
                                            <td>{{ $doctor_paciente->mat_beneficiario ?? '-' }}</td>
                                            <td>{{ $doctor_paciente->status ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 email-content">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h5 class="card-title mb-0">Número de Juntas Médicas por Médico Encargado</h5>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTableExample11" class="table-responsive-sm table table-striped">
                                <thead>
                                    <tr>
                                        <th>Médico Encargado</th>
                                        <th>Número de Juntas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medico_numero as $medico_num => $label)
                                    <tr>
                                        <td>{{ $medico_num ?? '-' }}</td>
                                        <td>{{ $label ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- row -->
<div class="row">
    <div class="col-lg-5 col-xl-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Pacientes Atendidos en Juntas Médicas</h6>
                </div>
                <div class="table-responsive">
                    <table id="pacientes1" class="table dataTable no-footer" role="grid"
                        aria-describedby="dataTableExample_info">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Matricula</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacientes_juntas as $pacientes_junta)
                            <tr>
                                <td>{{ $pacientes_junta->name . ' ' . $pacientes_junta->first_surname . ' ' . $pacientes_junta->last_surname ?? '-' }}
                                </td>
                                <td>{{ $pacientes_junta->mat_beneficiario ?? '-' }}</td>
                                <td>{{ $pacientes_junta->date ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-xl-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Número de Juntas Médicas por pacientes</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="pacientes2" class="table dataTable no-footer" role="grid"
                            aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paciente_conts as $paciente_cont => $label)
                                <tr>
                                    <td>{{ $paciente_cont ?? '-' }}</td>
                                    <td>{{ $label ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {!! $chart_gender->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->

<div id="realizadas" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h6 class="card-title mb-0">Juntas Médicas Realizadas</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample5" class="table dataTable no-footer" role="grid"
                            aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th style="display:none;" aria-sort="descending">Fecha</th>
                                    <th>Junta Médica</th>
                                    <th>Matrícula</th>
                                    <th>Regional</th>
                                    <th>Médico Encargado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($juntas_realizadas as $juntas_realizada)
                                <tr>
                                    <td style="display:none;">{{ $juntas_realizada->date ?? '-' }}</td>
                                    <td>{{ $juntas_realizada->code }}</td>
                                    <td>{{ optional($juntas_realizada->patient->user)->username ?? '-' }}</td>
                                    <td>{{ $juntas_realizada->regional }}</td>
                                    <td>{{ $juntas_realizada->first_surname . ' ' . $juntas_realizada->last_surname. ' ' . $juntas_realizada->name ?? '-' }}</td>
                                    <td>{{ $juntas_realizada->date->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="programado" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h6 class="card-title mb-0">Juntas Médicas Programadas</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample6" class="table dataTable no-footer" role="grid"
                            aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th style="display:none;" aria-sort="descending">Fecha</th>
                                    <th>Junta Médica</th>
                                    <th>Matrícula</th>
                                    <th>Regional</th>
                                    <th>Médico Encargado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($juntas_programado as $junta_programado)
                                <tr>
                                    <td style="display:none;">{{ $junta_programado->date ?? '-' }}</td>
                                    <td>{{ $junta_programado->code }}</td>
                                    <td>{{ optional($junta_programado->patient->user)->username ?? '-' }}</td>
                                    <td>{{ $junta_programado->regional }}</td>
                                    <td>{{ $junta_programado->first_surname . ' ' . $junta_programado->last_surname. ' ' . $junta_programado->name ?? '-' }}</td>
                                    <td>{{ $junta_programado->date->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cancelado" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h6 class="card-title mb-0">Juntas Médicas Canceladas</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample7" class="table dataTable no-footer" role="grid"
                            aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th style="display:none;" aria-sort="descending">Fecha</th>
                                    <th>Junta Médica</th>
                                    <th>Matrícula</th>
                                    <th>Regional</th>
                                    <th>Médico Encargado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($juntas_cancelado as $junta_cancelado)
                                <tr>
                                    <td style="display:none;">{{ $junta_cancelado->date ?? '-' }}</td>
                                    <td>{{ $junta_cancelado->code }}</td>
                                    <td>{{ optional($junta_cancelado->patient->user)->username ?? '-' }}</td>
                                    <td>{{ $junta_cancelado->regional }}</td>
                                    <td>{{ $junta_cancelado->first_surname . ' ' . $junta_cancelado->last_surname. ' ' . $junta_cancelado->name ?? '-' }}</td>
                                    <td>{{ $junta_cancelado->date->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="reprogramar" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h6 class="card-title mb-0">Juntas Médicas a Repogramar</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample8" class="table dataTable no-footer" role="grid"
                            aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th style="display:none;" aria-sort="descending">Fecha</th>
                                    <th>Junta Médica</th>
                                    <th>Matrícula</th>
                                    <th>Regional</th>
                                    <th>Médico Encargado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($juntas_expirado as $junta_expirado)
                                <tr>
                                    <td style="display:none;">{{ $junta_expirado->date ?? '-' }}</td>
                                    <td>{{ $junta_expirado->code }}</td>
                                    <td>{{ optional($junta_expirado->patient->user)->username ?? '-' }}</td>
                                    <td>{{ $junta_expirado->regional }}</td>
                                    <td>{{ $junta_expirado->first_surname . ' ' . $junta_expirado->last_surname. ' ' . $junta_expirado->name ?? '-' }}</td>
                                    <td>{{ $junta_expirado->date->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="aprobado" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h6 class="card-title mb-0">Informes Aprobados</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample9" class="table dataTable no-footer" role="grid"
                            aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th style="display:none;" aria-sort="descending">Fecha</th>
                                    <th>@lang('crud.informes.inputs.medical_board_id')</th>
                                    <th>Matrícula</th>
                                    <th>Especialidad</th>
                                    <th>Regional</th>
                                    <th>Médico Encargado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports as $report)
                                @if ($report->approved == "Aprobado")
                                <tr>
                                    <td style="display:none;">{{ ($report->medicalBoard)->date ?? '-' }}</td>
                                    <td>
                                        {{ optional($report->medicalBoard)->code ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($report->medicalBoard->patient)->matricula ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($report->medicalBoard->doctorOwner->specialty)->name ?? '-' }}
                                    </td>
                                    <td>{{ $report->regional }} </td>
                                    <td>
                                        {{ $report->first_surname . ' ' . $report->last_surname. ' ' . $report->name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ ($report->medicalBoard)->date->format('d/m/Y') }}
                                    </td>
                                </tr>
                                @endif

                                @empty
                                <tr>
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="noaprobado" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h6 class="card-title mb-0">Informes No aprobados</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table dataTable no-footer" role="grid"
                            aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th style="display:none;" aria-sort="descending">Fecha</th>
                                    <th>@lang('crud.informes.inputs.medical_board_id')</th>
                                    <th>Matrícula</th>
                                    <th>Especialidad</th>
                                    <th>Regional</th>
                                    <th>Médico Encargado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports as $report)
                                @if ($report->approved == "No aprobado")
                                <tr>
                                    <td style="display:none;">{{ ($report->medicalBoard)->date ?? '-' }}</td>
                                    <td>
                                        {{ optional($report->medicalBoard)->code ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($report->medicalBoard->patient)->matricula ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($report->medicalBoard->doctorOwner->specialty)->name ?? '-' }}
                                    </td>
                                    <td>{{ $report->regional }} </td>
                                    <td>
                                        {{ $report->first_surname . ' ' . $report->last_surname. ' ' . $report->name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ ($report->medicalBoard)->date->format('d/m/Y') }}
                                    </td>
                                </tr>
                                @endif

                                @empty
                                <tr>
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <form method="post" action="{{ route('stats.download') }}">
        {{ csrf_field() }}
        <div class="d-flex align-items-right flex-wrap text-nowrap">
            <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
                <span class="input-group-addon bg-transparent"><i data-feather="target"
                        class=" text-primary"></i></span>

                <input type="date" class="form-control" name="start_date" value="{{ $filter_start_date }}">
            </div>
            <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
                <span class="input-group-addon bg-transparent"><i class=" text-primary">Fin</i></span>
                <input class="form-control" name="end_date" type="date" value="{{ $filter_end_date }} ">
            </div>
            <button class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="printer"></i>
                Imprimir
            </button>

        </div>
    </form>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{!! $chart_total->script() !!}
{!! $chart_gender->script() !!}
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