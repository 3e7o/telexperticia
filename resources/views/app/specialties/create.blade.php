@extends('layout.master')

@section('title', 'Crear Especialidad')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('specialties.index') }}">@lang('crud.especialidades.index_title')</a></li>
      <li class="breadcrumb-item active" aria-current="page">@lang('crud.especialidades.create_title')</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-6 offset-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">@lang('crud.especialidades.create_title')</h4>
            <x-form
                method="POST"
                action="{{ route('specialties.store') }}"
                class="mt-4"
            >
                @include('app.specialties.form-inputs')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
      </div>
    </div>
  </div>
@endsection
