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
