@extends('layout.master')
@section('title', 'Juntas Médicas')

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
                        <h4 class="mb-3 mb-md-0">@lang('crud.juntas_medicas.index_title')</h4>
                    </div>
                    @can('create', App\Models\MedicalBoard::class)
                    <div class="d-flex align-items-center flex-wrap text-nowrap">
                        <a href="{{ route('medical-boards.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                    </div>
                    @endcan
                </div>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table dataTable no-footer" role="grid"
                        aria-describedby="dataTableExample_info">
                        <thead>
                            <tr>
                                <th style="display:none;" aria-sort="descending">Fecha</th>
                                <th>Junta Médica</th>
                                <th>Matrícula</th>
                                <th>@lang('crud.juntas_medicas.inputs.status')</th>

                                <th class="text-center">@lang('crud.common.actions')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicalBoards as $medicalBoard)
                            <tr @php if($medicalBoard->status=='Programado'){ echo "class='table-info'";}@endphp>
                                <td style="display:none;">{{ $medicalBoard->date ?? '-' }}</td>
                                <td>{{ $medicalBoard->code }}</td>
                                <td>{{ optional($medicalBoard->patient->user)->username ?? '-'}}</td>
                                <td>{{ $medicalBoard->status ?? '-' }}</td>

                                <td class="text-center" style="width: 134px;">
                                    <div role="group" aria-label="Row Actions" class="btn-group">
                                        @can('view', $medicalBoard)
                                        <a href="{{ route('medical-boards.show', $medicalBoard) }}">
                                            <button type="button" class="btn btn-primary btn-icon">
                                                <i data-feather="eye"></i>
                                            </button>
                                        </a>
                                        @endcan
                                    </div>

                                    <div role="group" aria-label="Row Actions" class="btn-group">
                                        @if ($medicalBoard->doctorOwner->id === optional(auth()->user()->doctor)->id ||
                                        auth()->user()->isSuperAdmin())
                                        @can('update', $medicalBoard)
                                        <a href="{{ route('medical-boards.edit', $medicalBoard) }}">
                                            <button type="button" class="btn btn-info btn-icon">
                                                <i data-feather="edit"></i>
                                            </button>
                                        </a>
                                        @endcan
                                    </div>
                                
                                    @endif
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