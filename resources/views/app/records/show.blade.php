@extends('layout.master')

@section('title', 'Ver Junta Médica')
@php $editing = isset($zoom_data); @endphp

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('records.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.juntas_medicas.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.juntas_medicas.inputs.date')</h5>
                    <span>{{ $record->record_familiar ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.juntas_medicas.inputs.patient_id')</h5>
                    <span
                        >{{ $record->record_clinic ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>Doctor director de la Junta</h5>
                    <span>{{ $record->allergies ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>Doctores supervisores de la Junta</h5>
                    <span>{{ $doctorsSupervisors }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.juntas_medicas.inputs.status')</h5>
                    <span>{{ $record->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('records.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Record::class)
                <a
                    href="{{ route('records.create') }}"
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
