@extends('layout.master')

@section('title', 'Editar Informe')


@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">@lang('crud.informes.index_title')</a></li>
      <li class="breadcrumb-item active" aria-current="page">@lang('crud.informes.edit_title')</li>
    </ol>
</nav>
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
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
      <div class="d-none d-xl-block col-xl-3 right-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card rounded">
              <div class="card-body">
                <h6 class="card-title">Historial</h6>
                <div class="example">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                      </li>
                    </ul>
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
