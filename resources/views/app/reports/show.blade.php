@extends('layout.master')

@section('title', 'Editar Informe')


@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">@lang('crud.informes.index_title')</a></li>
    <li class="breadcrumb-item active" aria-current="page">@lang('crud.informes.show_title')</li>
  </ol>
</nav>
<br>
<div class="profile-page tx-13">
  <div class="row profile-body">
    <!-- left wrapper start -->
    <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
      <div class="card rounded">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="card-title mb-0">Informacion del Paciente</h6>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Numero de Informe:</label>
            <p class="text-muted">{{ optional($report->medicalBoard)->code ?? '-' }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Nombre Paciente:</label>
            <p class="text-muted">{{ optional($report->medicalBoard->patient)->fullName ?? '-' }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Matricula:</label>
            <p class="text-muted">{{ optional($report->medicalBoard->patient)->matricula ?? '-' }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Medico Encargado:</label>
            <p class="text-muted"> {{ optional($report->medicalBoard->doctorOwner)->fullName ?? '-' }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Medicos Participantes:</label>
            <p class="text-muted">{{ $doctorsSupervisors }}</p>
          </div>
          <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Estado:</label>
            <p class="text-muted">{{ optional($report->medicalBoard)->status ?? '-' }}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- left wrapper end -->
    <!-- middle wrapper start -->
    <div class="col-md-8 col-xl-6 middle-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card rounded">
            <div class="card-body">
              <h6 class="card-title mb-0">@lang('crud.informes.show_title')

                @if (($report->medicalBoard)->status === 'Programado')
                @php
                if(($report->medicalBoard)->zoom){
                @endphp
                <a href="{{ optional(($report->medicalBoard)->zoom)->start_url ?? '-'}}" target="_blank">
                  <button type="button" class="btn btn-outline-primary btn-icon ">
                    <i data-feather="video"></i>
                  </button>
                </a>

                @php
                }else {
                @endphp
                <a href="{{ ($report->medicalBoard)->meet }}" target="_blank">
                  <button type="button" class="text-right float-right btn btn-outline-primary btn-icon">
                    <i data-feather="video"></i>
                  </button>
                </a>
                @php
                }
                @endphp
                @endif
                @if ($isSupervisor)
                @if ($approved)
                <span class="text-right float-right btn btn-success">
                  <i data-feather="check-square"></i>
                  Reporte Aprobado
                </span>
                @else
                <span class="text-right float-right">
                  <a href="{{ route('reports.approve', $report) }}" class="btn btn-success">
                    <i class="icon ion-md-checkmark"></i>
                    Aprobar
                  </a>
                </span>
                <span class="text-right float-right">
                  <a href="{{ route('reports.noapprove', $report) }}" class="btn btn-danger">
                    <i class="icon ion-md-checkmark"></i>
                    Rechazar
                  </a>
                </span>
                @endif
                @endif
              </h6>

              <div class="mt-4">
                <div class="mb-4">
                  <h5>@lang('crud.informes.inputs.medical_board_id')</h5>
                  <span>{{ optional($report->medicalBoard)->identification ?? '-' }}</span>
                </div>
                <div class="mb-4">
                  <h5>@lang('crud.informes.inputs.record')</h5>
                  <span>{{ $report->record ?? '-' }}</span>
                </div>
                <div class="mb-4">
                  <h5>@lang('crud.informes.inputs.evaluation')</h5>
                  <span>{{ $report->evaluation ?? '-' }}</span>
                </div>
                <div class="mb-4">
                  <h5>@lang('crud.informes.inputs.diagnosis')</h5>
                  <span>{{ $report->diagnosis ?? '-' }}</span>
                </div>
                <div class="mb-4">
                  <h5>@lang('crud.informes.inputs.recommendations')</h5>
                  <span>{{ $report->recommendations ?? '-' }}</span>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- middle wrapper end -->
    <!-- right wrapper start -->
    <div class="d-none d-xl-block col-xl-3 right-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card rounded">
            <div class="card-body">
              <h6 class="card-title">Historial</h6>
              <a href="{{ route('records.show', $report) }}">
                <button type="button" class="btn btn-primary btn-block btn-icon-text">Antecedentes
                  <i data-feather="book-open"></i>
                </button>
              </a>
              <div class="example">
                @foreach($records as $record)
                @if (($record->medicalBoard)->id != ($report->medicalBoard)->id)
                <div class="list-group">
                  <a href="#" data-toggle="modal" data-target="#ID{{ ($record->medicalBoard)->id }}"
                    class="list-group-item list-group-item-action">{{ optional($record->medicalBoard)->identification ?? '-' }}</a>
                </div>
                <div class="modal fade" id="ID{{ ($record->medicalBoard)->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ID{{ ($record->medicalBoard)->id }}Title">
                          @lang('crud.informes.inputs.medical_board_id')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        @include('app.reports.record')
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- right wrapper end -->
</div>
</div>
@endsection