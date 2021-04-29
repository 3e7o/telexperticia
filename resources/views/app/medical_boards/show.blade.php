@extends('layout.master')

@section('title', 'Ver Junta Médica')
@php $editing = isset($zoom_data); @endphp

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
      <li class="breadcrumb-item"><a href="{{ route('medical-boards.index') }}">@lang('crud.juntas_medicas.index_title')</a></li>
      <li class="breadcrumb-item active" aria-current="page">@lang('crud.juntas_medicas.show_title')</li>
    </ol>
</nav>
<br>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('crud.juntas_medicas.edit_title')</h4>
            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.juntas_medicas.inputs.date')</h5>
                    <span>{{ $medicalBoard->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.juntas_medicas.inputs.patient_id')</h5>
                    <span
                        >{{ optional($medicalBoard->patient)->fullName ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>Doctor director de la Junta</h5>
                    <span>{{ $medicalBoard->doctorOwner->fullName ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Doctores supervisores de la Junta</h5>
                    <span>{{ $doctorsSupervisors }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.juntas_medicas.inputs.status')</h5>
                    <span>{{ $medicalBoard->status ?? '-' }}</span>
                </div>
@if ($medicalBoard->status === 'Programado')
@php
if($zoom_data){
@endphp

                <div class="mb-4">
                    <h5>{{ __('Zoom Duration') }}</h5>
                    <x-inputs.select name="zoom_duration" selected disabled>
                        @php $selected = old('zoom_duration', $zoom_data->duration) @endphp
                        <option {{ $selected == '30 Min' ? 'selected' : '' }} >30 Min</option>
                        <option {{ $selected == '45 Min' ? 'selected' : '' }} >45 Min</option>
                        <option {{ $selected == '1 hr' ? 'selected' : '' }} >1 hr</option>
                    </x-inputs.select>
                </div>

                <div class="mb-4">
                        <h5> {{ __('Zoom Password') }}</h5>
                        <input id="zoom-Password" placeholder="{{ __('Zoom Password') }}" class="form-control" name="zoom_password" readonly value="{{ $zoom_data->password }}">
                </div>

                <div class="mb-4">
                    <h5>{{ __('Zoom link') }}</h5>
                    <div class="input-group">
                        <input id="zoom-link" placeholder="{{ __('Zoom link') }}" class="form-control" name="zoom_link" readonly value="{{ $zoom_data->join_url }}">
                        <div class="input-group-append" >
                            <div class="input-group-text bg-blue">
                                <a href="{{ $zoom_data->start_url }}" target="_blank"><i class="fa fa-video" aria-hidden="true"></i> Iniciar
                            </a></div>
                        </div>
                    </div>
                </div>

                @if(((\Carbon\Carbon::parse($zoom_data->start_time))->addMinutes($zoom_data->duration)) > \Carbon\Carbon::now())
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        La junta iniciara: {{((\Carbon\Carbon::parse($zoom_data->start_time))->addMinutes($zoom_data->duration))->diffForHumans()}}
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        Expire:{{((\Carbon\Carbon::parse($zoom_data->start_time))->addMinutes($zoom_data->duration))->diffForHumans()}}
                    </div>
                </div>
                @endif
@php
}
@endphp
@endif
</div>
            </div>
        </div>
    </div>
</div>
@endsection
