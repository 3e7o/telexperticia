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
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="{{ URL::previous() }}">Informe De Junta Médica</a></li>
      <li class="breadcrumb-item active" aria-current="page">@lang('crud.antecedentes.edit_title')</li>
    </ol>
</nav>
<br>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">@lang('crud.antecedentes.edit_title')</h4>
            <x-form
                method="PUT"
                action="{{ route('records.update', $record) }}"
                class="mt-4"
            >
            @php $editing = isset($record) @endphp

            <div class="row">
            
                <x-inputs.group class="form-group col-sm-6">
                    <x-inputs.select name="blood_type" label="Grupo Sanguineo" disabled required>
                        @php $selected = old('blood_type', ($editing ? $record->blood_type : '')) @endphp
                        <option disabled {{ empty($selected) ? 'selected' : '' }}>Por favor seleccione un paciente</option>
                        @foreach($blood_types as $blood_type)
                        <option value="{{ $blood_type->name }}" {{ $selected == $blood_type->name ? 'selected' : '' }} >{{ $blood_type->name }}</option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>
            
                <div class="form-group col-sm-6">
                    <x-inputs.select name="allergies[]" label="Alergias" class="js-example-basic-multiple w-100" disabled multiple="multiple">
                        @php $selected = old('allergie_id', ($editing ? $selectedAllergies : '')) @endphp
                        @foreach ($allergies as $allergie)
                        <div>
                        <option
                            id="allergie{{ $allergie->id }}"
                            value="{{ $allergie->id }}"
                            <?php if (is_array($selected) || is_object($selected))
                           {
                               ?>
                               @foreach ( $selected as $item)
                               <?php if(isset($record) and $item==$allergie->id){ echo "selected='selected'";}?>
                               @endforeach
                               <?php
                           }
                           ?>
                        >{{ ucfirst($allergie->name) }}
                        </option>
                        </div>
                        @endforeach
                    </x-inputs.select>
                </div>
            
                <div class="form-group col-sm-6">
                    <x-inputs.select name="vaccines[]" label="Vacunas" class="js-example-basic-multiple w-100" disabled multiple="multiple">
                        @php $selected = old('vaccine_id', ($editing ? $selectedVaccines : '')) @endphp
                        @foreach ($vaccines as $vaccine)
                        <div>
                        <option
                            id="vaccine{{ $vaccine->id }}"
                            value="{{ $vaccine->id }}"
                            <?php if (is_array($selected) || is_object($selected))
                            {
                                ?>
                                @foreach ( $selected as $item)
                                <?php if(isset($record) and $item==$vaccine->id){ echo "selected='selected'";}?>
                                @endforeach
                                <?php
                            }
                            ?>
                        >{{ ucfirst($vaccine->name) }}
                        </option>
                        </div>
                        @endforeach
                    </x-inputs.select>
                </div>
            
                <div class="form-group col-sm-6">
                    <x-inputs.select name="operations[]" label="Operaciones" class="js-example-basic-multiple w-100" disabled multiple="multiple">
                        @php $selected = old('operation_id', ($editing ? $selectedOperations : '')) @endphp
                        @foreach ($operations as $operation)
                        <div>
                        <option
                            id="operation{{ $operation->id }}"
                            value="{{ $operation->id }}"
                            <?php if (is_array($selected) || is_object($selected))
                            {
                                ?>
                                @foreach ( $selected as $item)
                                <?php if(isset($record) and $item==$operation->id){ echo "selected='selected'";}?>
                                @endforeach
                                <?php
                            }
                            ?>
                        >{{ ucfirst($operation->name) }}
                        </option>
                        </div>
                        @endforeach
                    </x-inputs.select>
                </div>
            
                <x-inputs.group class="col-sm-12">
                    <x-inputs.textarea
                        style="resize: vertical;"
                        name="record_familiar"
                        label="Antecedentes Familiares"
                        required
                        disabled
                        >{{ old('record_familiar', ($editing ? $record->record_familiar : ''))
                        }}</x-inputs.textarea
                    >
                </x-inputs.group>
            
                <x-inputs.group class="col-sm-12">
                    <x-inputs.textarea
                        style="resize: vertical;"
                        name="record_clinic"
                        label="Antecedentes Clinicos"
                        required
                        disabled
                        >{{ old('record_clinic', ($editing ? $record->record_clinic : ''))
                        }}</x-inputs.textarea
                    >
                </x-inputs.group>
            
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
