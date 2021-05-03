@extends('layout.master')
@section('title', 'Pacientes')

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
                  <h4 class="mb-3 mb-md-0">@lang('crud.pacientes.index_title')</h4>
                </div>
                        @can('create', App\Models\Patient::class)
                        <div class="d-flex align-items-center flex-wrap text-nowrap">
                        <a
                            href="{{ route('patients.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        </div>
                        @endcan
                    </div>
                    <div class="table-responsive">
                      <table id="dataTableExample" class="table dataTable no-footer" role="grid" aria-describedby="dataTableExample_info">
                          <thead>
                              <tr>
                                <th style="display:none;" aria-sort="descending">Fecha</th>
                                <th>@lang('crud.pacientes.inputs.name')</th>
                                <th>@lang('crud.pacientes.inputs.first_surname')</th>
                                <th>Matricula</th>
                                <th>@lang('crud.pacientes.inputs.ci')</th>
                                <th class="text-center">@lang('crud.common.actions')</th>
                              </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                        <tr>
                            <td style="display:none;">{{ $patient->created_at ?? '-' }}</td>
                            <td>{{ $patient->name ?? '-' }}</td>
                            <td>{{ $patient->first_surname ?? '-' }}</td>
                            <td>{{ $patient->matricula ?? '-' }}</td>
                            <td>{{ $patient->ci ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                role="group"
                                aria-label="Row Actions"
                                class="btn-group"
                            >
                                @can('view', $patient)
                                <a>
                                <button
                                    type="button"
                                    class="btn btn-primary btn-icon"
                                    data-toggle="modal"
                                    data-target="#ID{{ $patient->matricula ?? '-' }}"
                                >
                                    <i data-feather="eye"></i>
                                </button>
                                <div class="modal fade" id="ID{{ $patient->matricula ?? '-' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="ID{{ $patient->matricula ?? '-' }}Title">@lang('crud.usuarios.show_title')</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            @include('app.patients.show')
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </a>
                                @endcan
                            </div>
                                <div
                                role="group"
                                aria-label="Row Actions"
                                class="btn-group"
                                >
                                    @can('update', $patient)
                                        <a
                                            href="{{ route('patients.edit', $patient) }}"
                                        >
                                        <button
                                            type="button"
                                            class="btn btn-info btn-icon"
                                        >
                                            <i data-feather="edit"></i>
                                        </button>
                                        </a>
                                    @endcan
                                </div>
                                    @can('delete', $patient)
                                    {{-- <form
                                        action="{{ route('patients.destroy', $patient) }}"
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
