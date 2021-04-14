@extends('layout.master')

@section('title', 'Ver Especialidad')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('specialties.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.especialidades.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.especialidades.inputs.name')</h5>
                    <span>{{ $specialty->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                href="{{ route('specialties.index') }}"
                class="btn btn-secondary btn-icon-text mb-1 mb-md-0"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            @lang('crud.common.back')
            </a>

                @can('create', App\Models\Specialty::class)
                <a
                    href="{{ route('specialties.create') }}"
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
