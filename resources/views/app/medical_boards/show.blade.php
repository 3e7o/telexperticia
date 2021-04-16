@extends('layout.master')

@section('title', 'Ver Junta Médica')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('medical-boards.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.juntas_medicas.show_title')

                @if ($medicalBoard->status === 'Programado')
                    <a
                        href="{{ $medicalBoard->meet }}"
                        target="_blank"
                    >
                        <button
                            type="button"
                            class="btn btn-outline-primary ml-4"
                        >
                            <i class="icon ion-md-videocam"></i>
                        </button>
                    </a>
                @endif
            </h4>

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
                +                @php
                if($zoom_data){
                $zoom_start_time=$zoom_data->start_time;
                $zoom_duration=$zoom_data->duration;
                }else{
                $zoom_start_time=$medicalBoard->date;
                $zoom_duration="0";

                }
                @endphp

                <div class="mb-4">
                    <h5>{{ __('Zoom Duration') }}</h5>
                    <x-inputs.select name="zoom_duration" selected disabled>
                        @php $selected = old('zoom_duration', $zoom_duration) @endphp
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
@php
if($zoom_data){
@endphp

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

            </div>

            <div class="mt-4">
                <a
                    href="{{ route('medical-boards.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\MedicalBoard::class)
                <a
                    href="{{ route('medical-boards.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
