@extends('layout.master')

@section('title', 'Ver Medico')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('doctors.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.doctores.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.ci')</h5>
                    <span>{{ $doctor->ci ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.name')</h5>
                    <span>{{ $doctor->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.first_surname')</h5>
                    <span>{{ $doctor->first_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.last_surname')</h5>
                    <span>{{ $doctor->last_surname ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.email')</h5>
                    <span>{{ $doctor->email ?? '-' }}</span>
                </div>
                {{-- <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.phone')</h5>
                    <span>{{ $doctor->phone ?? '-' }}</span>
                </div> --}}
                <div class="mb-4">
                    <h5>@lang('crud.doctores.inputs.specialty_id')</h5>
                    <span>{{ optional($doctor->specialty)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('doctors.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Doctor::class)
                <a href="{{ route('doctors.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
