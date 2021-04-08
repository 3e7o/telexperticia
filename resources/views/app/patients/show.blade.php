@extends('layouts.app')

@section('title', 'Ver Paciente')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('patients.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.pacientes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.ci')</h5>
                    <span>{{ $patient->ci ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.name')</h5>
                    <span>{{ $patient->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.first_surname')</h5>
                    <span>{{ $patient->first_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.last_surname')</h5>
                    <span>{{ $patient->last_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.email')</h5>
                    <span>{{ $patient->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.force')</h5>
                    <span>{{ $patient->force ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.birthday')</h5>
                    <span>{{ $patient->birthday ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.gender')</h5>
                    <span>{{ $patient->gender ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pacientes.inputs.address')</h5>
                    <span>{{ $patient->address ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('patients.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Patient::class)
                <a href="{{ route('patients.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
