@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.informes.index_title')</h4>
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
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>
                                @lang('crud.informes.inputs.medical_board_id')
                            </th>
                            <th>
                                Paciente
                            </th>
                            <th>
                                Especialidad
                            </th>
                            <th>
                                Estado
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <td>
                                {{ optional($report->medicalBoard)->code ?? '-' }}
                            </td>
                            <td>
                                {{ optional($report->medicalBoard->patient)->fullName ?? '-' }}
                            </td>
                            <td>
                                {{ optional($report->medicalBoard->doctorOwner->specialty)->name ?? '-' }}
                            </td>
                            <td>
                                {{ $report->approved }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('view', $report)
                                    <a
                                        href="{{ route('reports.show', $report) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-outline-success ml-1"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('update', $report)
                                        @if ($report->medicalBoard->doctorOwner->id === optional(auth()->user()->doctor)->id || auth()->user()->isSuperAdmin())
                                            <a
                                                href="{{ route('reports.edit', $report) }}"
                                            >
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-info ml-1"
                                                >
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            </a>
                                        @endif
                                    @endcan @can('view', $report)
                                        <a
                                            href="{{ route('reports.download', $report) }}"
                                            target="_blank"
                                        >
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary ml-1"
                                            >
                                                <i class="icon ion-md-archive"></i>
                                            </button>
                                        </a>
                                    @endcan @can('delete', $report)

                                    {{-- <form
                                        action="{{ route('reports.destroy', $report) }}"
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
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">{!! $reports->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
