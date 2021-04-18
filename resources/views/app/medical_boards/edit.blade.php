@extends('layout.master')

@section('title', 'Editar Junta Médica')

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
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('medical-boards.index') }}">@lang('crud.juntas_medicas.index_title')</a></li>
      <li class="breadcrumb-item active" aria-current="page">@lang('crud.juntas_medicas.edit_title')</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">@lang('crud.juntas_medicas.edit_title')</h4>
            <x-form
                method="PUT"
                action="{{ route('medical-boards.update', $medicalBoard) }}"
                class="mt-4"
            >
                @include('app.medical_boards.form-inputs')

@php $editing = isset($zoom_data); @endphp

                <x-inputs.group class="col-sm-12 col-lg-6">
                    <x-inputs.select name="zoom_duration" label="Duración">
                        @php $selected = old('zoom_duration', ($editing ? $zoom_data->duration : '')) @endphp
                        <option value="0" {{ $selected == '0 min' ? 'selected' : '' }} hidden >-Seleccione duración-</option>
                        <option value="30" {{ $selected == '30 min' ? 'selected' : '' }} >30 min</option>
                        <option value="45" {{ $selected == '45 min' ? 'selected' : '' }} >45 min</option>
                        <option value="60" {{ $selected == '60 min' ? 'selected' : '' }} >1 hr</option>
                    </x-inputs.select>
                </x-inputs.group>

@php
if($zoom_data){
@endphp

                <x-inputs.group class="col-sm-12 col-lg-6" >
                    <x-inputs.text
                        name="zoom-Password"
                        label="{{ __('Zoom Password') }}"
                        value="{{ $zoom_data->password }}"
                        readonly
                    ></x-inputs.text>
                </x-inputs.group>

                <x-inputs.group class="col-sm-12 col-lg-6" >
                    <label for="exampleInputTitle">{{ __('Zoom link') }}</label>
                            <div class="input-group">
                                <input id="zoom-link" placeholder="{{ __('Zoom link') }}" class="form-control" name="zoom_link" readonly value="{{ $zoom_data->join_url }}">
                                <div class="input-group-append" >
                                    <div class="input-group-text bg-blue">
                                        <a href="{{ $zoom_data->start_url }}" target="_blank"><i class="fa fa-video" aria-hidden="true"></i> Iniciar
                                    </a></div>
                                </div>
                            </div>
                </x-inputs.group>

                    @if(((\Carbon\Carbon::parse($zoom_data->start_time))->addMinutes($zoom_data->duration)) > \Carbon\Carbon::now())
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            La junta iniciara: {{((\Carbon\Carbon::parse($zoom_data->start_time)))->diffForHumans()}}
                        </div>
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            Expiro :{{((\Carbon\Carbon::parse($zoom_data->start_time))->addMinutes($zoom_data->duration))->diffForHumans()}}
                        </div>
                    </div>
                    @endif
@php
}
@endphp

                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary float-right" >
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

@endpush
