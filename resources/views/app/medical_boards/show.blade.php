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
