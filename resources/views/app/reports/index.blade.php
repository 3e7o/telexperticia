@extends('layout.master')
@section('title', 'Informes')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                    <h4 class="mb-3 mb-md-0">@lang('crud.informes.index_title')</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table dataTable no-footer" role="grid" aria-describedby="dataTableExample_info">
                            <thead>
                                <tr>
                                    <th>@lang('crud.informes.inputs.medical_board_id')</th>
                                    <th>Matrícula</th>
                                    <th>Especialidad</th>
                                    <th>Estado</th>
                                    <th class="text-center">@lang('crud.common.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports as $report)
                                <tr>
                                    <td>
                                        {{ optional($report->medicalBoard)->code ?? '-' }}
                                    </td>
                                    <td>
                                        {{ optional($report->medicalBoard->patient)->matricula ?? '-' }}
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
                                            @if (($report->medicalBoard)->status === 'Programado')
                                            @php
                                            if(($report->medicalBoard)->zoom){
                                            @endphp
                                                <a
                                                    href="{{ optional(($report->medicalBoard)->zoom)->start_url ?? '-'}}"
                                                    target="_blank"
                                                >
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-primary btn-icon"
                                                >
                                                    <i data-feather="video"></i>
                                                </button>
                                                </a>

                                            @php
                                            }else {
                                            @endphp
                                                <a
                                                    href="{{ ($report->medicalBoard)->meet }}"
                                                    target="_blank"
                                                >
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-primary btn-icon"
                                                >
                                                    <i data-feather="video"></i>
                                                </button>
                                                </a>
                                            @php
                                            }
                                            @endphp
                                            @endif
                                        </div>
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
                                                    class="btn btn-primary btn-icon"
                                                >
                                                    <i data-feather="eye"></i>
                                                </button>
                                            </a>
                                            @endcan
                                        </div>

                                            <div
                                            role="group"
                                            aria-label="Row Actions"
                                            class="btn-group"
                                            >
                                            @can('update', $report)
                                                @if ($report->medicalBoard->doctorOwner->id === optional(auth()->user()->doctor)->id || auth()->user()->isSuperAdmin())
                                                    <a
                                                        href="{{ route('reports.edit', $report) }}"
                                                    >
                                                        <button
                                                            type="button"
                                                            class="btn btn-info btn-icon"
                                                        >
                                                            <i data-feather="edit"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            @endcan
                                            </div>
                                            <div
                                            role="group"
                                            aria-label="Row Actions"
                                            class="btn-group"
                                            >
                                            @can('view', $report)
                                                <a
                                                    href="{{ route('reports.download', $report) }}"
                                                    target="_blank"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn btn-light btn-icon"
                                                    >
                                                        <i data-feather="download"></i>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush
@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush

