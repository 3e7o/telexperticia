@extends('layout.master')

@section('title', 'Editar Junta Médica')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('medical-boards.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.juntas_medicas.edit_title')
            </h4>

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
                    <a
                        href="{{ route('medical-boards.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('medical-boards.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
