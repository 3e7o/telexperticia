@extends('layout.master')

@section('title', 'Crear Especialidad')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('specialties.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.especialidades.create_title')
            </h4>

            <x-form
                method="POST"
                action="{{ route('specialties.store') }}"
                class="mt-4"
            >
                @include('app.specialties.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('specialties.index') }}"
                        class="btn btn-secondary btn-icon-text mb-1 mb-md-0"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
