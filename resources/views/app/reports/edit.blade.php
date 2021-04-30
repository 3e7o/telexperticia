@extends('layout.master')

@section('title', 'Editar Informe')


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
      <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">@lang('crud.informes.index_title')</a></li>
      <li class="breadcrumb-item active" aria-current="page">@lang('crud.informes.edit_title')</li>
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
                <a
                href="{{ route('reports.download', $report) }}"
                target="_blank"
                >
                    <button
                        type="button"
                        class="float-right btn btn-light btn-icon"
                    >
                        <i data-feather="download"></i>
                    </button>
                </a>
            <h6 class="card-title mb-0">Informe de Junta Médica</h6>

            <x-form
                method="PUT"
                action="{{ route('reports.update', $report) }}"
                class="mt-4"
            >
                @include('app.reports.form-inputs')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-none d-xl-block col-xl-3 right-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card rounded">
              <div class="card-body">
                <h6 class="card-title">Historial</h6>
                <div class="example">
                    @foreach($records as $record)
                    @if (($record->medicalBoard)->id != ($report->medicalBoard)->id)
                    <div class="list-group">
                        <a href="#" data-toggle="modal" data-target="#ID{{ ($record->medicalBoard)->id }}" class="list-group-item list-group-item-action">{{ optional($record->medicalBoard)->identification ?? '-' }}</a>
                    </div>
                      <div class="modal fade" id="ID{{ ($record->medicalBoard)->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ID{{ ($record->medicalBoard)->id }}Title">@lang('crud.informes.inputs.medical_board_id')</h5>
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
  </div>
  @endsection
