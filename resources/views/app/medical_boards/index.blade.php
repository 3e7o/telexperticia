@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.juntas_medicas.index_title')
                </h4>
            </div>

            <div class="searchbar mt-4 mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="input-group">
                                <input
                                    id="indexSearch"
                                    type="text"
                                    name="search"
                                    placeholder="{{ __('crud.common.search') }}"
                                    value="{{ $search ?? '' }}"
                                    class="form-control"
                                    autocomplete="off"
                                />
                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="icon ion-md-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        @can('create', App\Models\MedicalBoard::class)
                        <a
                            href="{{ route('medical-boards.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>
                                Junta Médica
                            </th>
                            <th>
                                Matrícula
                            </th>
                            <th>
                                @lang('crud.juntas_medicas.inputs.patient_id')
                            </th>
                            <th>@lang('crud.juntas_medicas.inputs.status')</th>
                            @can('view', $medicalBoards)
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicalBoards as $medicalBoard)
                        <tr>
                            <td>
                                {{ $medicalBoard->code }}
                            </td>
                            <td>
                                {{ optional($medicalBoard->patient->user)->username ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($medicalBoard->patient)->fullName ?? '-'
                                }}
                            </td>
                            <td>
                                {{ $medicalBoard->status ?? '-' }}
                                @if ($medicalBoard->status === 'Programado')
                                    <a
                                        href="{{ $medicalBoard->meet }}"
                                        target="_blank"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary ml-1"
                                        >
                                            <i class="icon ion-md-videocam"></i>
                                        </button>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('view', $medicalBoard)
                                        <a
                                            href="{{ route('medical-boards.show', $medicalBoard) }}"
                                        >
                                            <button
                                                type="button"
                                                class="btn btn-outline-success ml-1"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                    @endcan
                                    @if ($medicalBoard->doctorOwner->id === optional(auth()->user()->doctor)->id || auth()->user()->isSuperAdmin())
                                        @can('update', $medicalBoard)
                                            <a
                                                href="{{ route('medical-boards.edit', $medicalBoard) }}"
                                            >
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-info ml-1"
                                                >
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            </a>
                                        @endcan @can('delete', $medicalBoard)
                                            {{-- <form
                                                action="{{ route('medical-boards.destroy', $medicalBoard) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                            >
                                                @csrf @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-outline-danger ml-1"
                                                >
                                                    <i class="icon ion-md-trash"></i>
                                                </button>
                                            </form> --}}
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                {!! $medicalBoards->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
